<?php
session_start();
require_once 'config/conexao.php';

if (($_SESSION['tipo'] ?? '') !== 'livraria') {
    header("Location: login.php");
    exit();
}

$idlivraria = $_SESSION['id'];
$erro = '';
$sucesso = '';

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
        $capa = null;


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
            $stmt = $pdo->prepare("INSERT INTO livros
                (idlivraria, titulo, autor, genero, isbn, capa, descricao, preco, estoque, status, corredor, prateleira, secao)
                VALUES
                (:idlivraria, :titulo, :autor, :genero, :isbn, :capa, :descricao, :preco, :estoque, :status, :corredor, :prateleira, :secao)");

            $stmt->execute([
                'idlivraria' => $idlivraria,
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
                'secao'      => $secao
            ]);

            $sucesso = 'Livro cadastrado com sucesso!';
        }
    }
}

$stmt = $pdo->prepare("SELECT * FROM livros WHERE idlivraria = :idlivraria ORDER BY criado_em DESC");
$stmt->execute(['idlivraria' => $idlivraria]);
$meusLivros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Cadastrar Livro</title>
<link rel="stylesheet" href="assets/css/cadastrolivro.css">
</head>

<body>

<?php require_once 'includes/header.php'; ?>

<h1>Cadastrar Livro</h1>

<?php if ($erro): ?>
    <p class="mensagem erro"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<?php if ($sucesso): ?>
    <p class="mensagem sucesso"><?= htmlspecialchars($sucesso) ?></p>
<?php endif; ?>

<form method="POST" action="cadastro_livro.php" enctype="multipart/form-data">

<input type="text" name="titulo" placeholder="Título" required>
<br><br>

<input type="text" name="autor" placeholder="Autor" required>
<br><br>

<input type="text" name="genero" placeholder="Gênero">
<br><br>

<input type="text" name="isbn" placeholder="ISBN">
<br><br>

<label>Capa do livro:</label>
<input type="file" name="capa" accept="image/png, image/jpeg, image/webp">
<br><br>

<textarea name="descricao" placeholder="Descrição"></textarea>
<br><br>

<input type="number" step="0.01" min="0" name="preco" placeholder="Preço (deixe em branco se não for à venda)">
<br><br>

<input type="number" min="0" name="estoque" placeholder="Quantidade em estoque" value="0">
<br><br>

<label>Status:</label>
<select name="status">
    <option value="a_venda">À venda</option>
    <option value="emprestimo">Em empréstimo</option>
    <option value="indisponivel">Indisponível</option>
</select>
<br><br>

<input type="text" name="corredor" placeholder="Corredor">
<br><br>

<input type="text" name="prateleira" placeholder="Prateleira">
<br><br>

<input type="text" name="secao" placeholder="Seção">
<br><br>

<button type="submit">Cadastrar Livro</button>

</form>

<hr>

<h2>Meu Acervo</h2>

<div class="cards">
<?php if (empty($meusLivros)): ?>
    <p>Você ainda não cadastrou nenhum livro.</p>
<?php endif; ?>

<?php foreach ($meusLivros as $livro): ?>
    <div class="card">
        <?php if ($livro['capa']): ?>
            <img src="<?= htmlspecialchars($livro['capa']) ?>" alt="Capa de <?= htmlspecialchars($livro['titulo']) ?>" width="100">
        <?php endif; ?>
        <h3><?= htmlspecialchars($livro['titulo']) ?></h3>
        <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
        <p><strong>Gênero:</strong> <?= htmlspecialchars($livro['genero'] ?? '-') ?></p>
        <p><strong>Estoque:</strong> <?= (int)$livro['estoque'] ?></p>
        <p><strong>Status:</strong>
            <?php
            $statusLabel = [
                'a_venda' => 'À venda',
                'emprestimo' => 'Em empréstimo',
                'indisponivel' => 'Indisponível'
            ];
            echo htmlspecialchars($statusLabel[$livro['status']] ?? $livro['status']);
            ?>
        </p>
        <p><strong>Localização:</strong> Corredor <?= htmlspecialchars($livro['corredor'] ?? '-') ?>, Prateleira <?= htmlspecialchars($livro['prateleira'] ?? '-') ?>, Seção <?= htmlspecialchars($livro['secao'] ?? '-') ?></p>
        <a class="btn" href="editar_livro.php?id=<?= $livro['id'] ?>">Editar</a>
        <a class="btn" href="excluir_livro.php?id=<?= $livro['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este livro?');">Excluir</a>
    </div>
<?php endforeach; ?>
</div>


</body>

</html>
