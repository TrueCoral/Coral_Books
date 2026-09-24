<?php
session_start();
require_once 'config/conexao.php';

if (($_SESSION['tipo'] ?? '') !== 'livraria') {
    header("Location: login.php");
    exit();
}

$idlivraria = $_SESSION['id'];
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$erro = '';

// Busca o livro, garantindo que ele pertence à livraria logada
$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = :id AND idlivraria = :idlivraria");
$stmt->execute(['id' => $id, 'idlivraria' => $idlivraria]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$livro) {
    header("Location: cadastro_livro.php");
    exit();
}

// UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo     = trim($_POST['titulo'] ?? '');
    $autor      = trim($_POST['autor'] ?? '');
    $genero     = trim($_POST['genero'] ?? '');
    $isbn       = trim($_POST['isbn'] ?? '');
    $descricao  = trim($_POST['descricao'] ?? '');
    $preco      = $_POST['preco'] !== '' ? str_replace(',', '.', $_POST['preco']) : null;
    $estoque    = (int)($_POST['estoque'] ?? 0);
    $status     = $_POST['status'] ?? 'a_venda';
    $corredor   = trim($_POST['corredor'] ?? '');
    $prateleira = trim($_POST['prateleira'] ?? '');
    $secao      = trim($_POST['secao'] ?? '');

    $statusValidos = ['a_venda', 'emprestimo', 'indisponivel'];
    if (!in_array($status, $statusValidos)) {
        $status = 'a_venda';
    }

    if ($titulo === '' || $autor === '') {
        $erro = 'Preencha ao menos o título e o autor.';
    } else {
        $capa = $livro['capa'];

        if (!empty($_FILES['capa']['name'])) {
            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower(pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION));

            if (in_array($ext, $extensoesPermitidas)) {
                $novoNome = uniqid('capa_') . '.' . $ext;
                $destino = 'assets/img/capas/' . $novoNome;

                if (!is_dir('assets/img/capas')) {
                    mkdir('assets/img/capas', 0777, true);
                }

                if (move_uploaded_file($_FILES['capa']['tmp_name'], $destino)) {
                    $capa = $destino;
                }
            } else {
                $erro = 'Formato de imagem inválido. Use JPG, PNG ou WEBP.';
            }
        }

        if ($erro === '') {
            $stmt = $pdo->prepare("UPDATE livros SET
                titulo = :titulo, autor = :autor, genero = :genero, isbn = :isbn, capa = :capa,
                descricao = :descricao, preco = :preco, estoque = :estoque, status = :status,
                corredor = :corredor, prateleira = :prateleira, secao = :secao
                WHERE id = :id AND idlivraria = :idlivraria");

            $stmt->execute([
                'titulo'     => $titulo,
                'autor'      => $autor,
                'genero'     => $genero,
                'isbn'       => $isbn,
                'capa'       => $capa,
                'descricao'  => $descricao,
                'preco'      => $preco,
                'estoque'    => $estoque,
                'status'     => $status,
                'corredor'   => $corredor,
                'prateleira' => $prateleira,
                'secao'      => $secao,
                'id'         => $id,
                'idlivraria' => $idlivraria
            ]);

            header("Location: cadastro_livro.php");
            exit();
        }
    }

    // Se deu erro, mantém os dados digitados na tela em vez dos antigos
    $livro = array_merge($livro, [
        'titulo' => $titulo, 'autor' => $autor, 'genero' => $genero, 'isbn' => $isbn,
        'descricao' => $descricao, 'preco' => $preco, 'estoque' => $estoque, 'status' => $status,
        'corredor' => $corredor, 'prateleira' => $prateleira, 'secao' => $secao
    ]);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Editar Livro</title>
<link rel="stylesheet" href="assets/css/cadastrolivro.css">
</head>

<body>

<?php require_once 'includes/header.php'; ?>

<h1>Editar Livro</h1>

<?php if ($erro): ?>
    <p class="mensagem erro"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="POST" action="editar_livro.php?id=<?= $livro['id'] ?>" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $livro['id'] ?>">

<input type="text" name="titulo" placeholder="Título" required value="<?= htmlspecialchars($livro['titulo']) ?>">
<br><br>

<input type="text" name="autor" placeholder="Autor" required value="<?= htmlspecialchars($livro['autor']) ?>">
<br><br>

<input type="text" name="genero" placeholder="Gênero" value="<?= htmlspecialchars($livro['genero'] ?? '') ?>">
<br><br>

<input type="text" name="isbn" placeholder="ISBN" value="<?= htmlspecialchars($livro['isbn'] ?? '') ?>">
<br><br>

<?php if ($livro['capa']): ?>
    <img src="<?= htmlspecialchars($livro['capa']) ?>" alt="Capa atual" width="100"><br>
<?php endif; ?>
<label>Trocar capa:</label>
<input type="file" name="capa" accept="image/png, image/jpeg, image/webp">
<br><br>

<textarea name="descricao" placeholder="Descrição"><?= htmlspecialchars($livro['descricao'] ?? '') ?></textarea>
<br><br>

<input type="number" step="0.01" min="0" name="preco" placeholder="Preço" value="<?= htmlspecialchars($livro['preco'] ?? '') ?>">
<br><br>

<input type="number" min="0" name="estoque" placeholder="Quantidade em estoque" value="<?= (int)$livro['estoque'] ?>">
<br><br>

<label>Status:</label>
<select name="status">
    <option value="a_venda" <?= $livro['status'] === 'a_venda' ? 'selected' : '' ?>>À venda</option>
    <option value="emprestimo" <?= $livro['status'] === 'emprestimo' ? 'selected' : '' ?>>Em empréstimo</option>
    <option value="indisponivel" <?= $livro['status'] === 'indisponivel' ? 'selected' : '' ?>>Indisponível</option>
</select>
<br><br>

<input type="text" name="corredor" placeholder="Corredor" value="<?= htmlspecialchars($livro['corredor'] ?? '') ?>">
<br><br>

<input type="text" name="prateleira" placeholder="Prateleira" value="<?= htmlspecialchars($livro['prateleira'] ?? '') ?>">
<br><br>

<input type="text" name="secao" placeholder="Seção" value="<?= htmlspecialchars($livro['secao'] ?? '') ?>">
<br><br>

<button type="submit">Salvar Alterações</button>
<a href="cadastro_livro.php">Cancelar</a>

</form>

<?php require_once 'includes/footer.php'; ?>

</body>

</html>
