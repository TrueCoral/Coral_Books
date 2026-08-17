<?php

require_once 'Includes/Header.php';
require_once 'Config/Conexao.php';

$livro = null;     
$mensagem = '';    

if (isset($_POST['buscar'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM livros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$livro) {
        $mensagem = "Livro com ID $id não encontrado.";
    }
}

if (isset($_POST['salvar'])) {
    $sql = "UPDATE livros SET
                titulo = :titulo,
                autor = :autor,
                genero = :genero,
                descricao = :descricao,
                preco = :preco,
                estoque = :estoque,
                corredor = :corredor,
                prateleira = :prateleira,
                secao = :secao
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id'         => $_POST['id'],
        ':titulo'     => $_POST['titulo'],
        ':autor'      => $_POST['autor'],
        ':genero'     => $_POST['genero'],
        ':descricao'  => $_POST['descricao'],
        ':preco'      => $_POST['preco'],
        ':estoque'    => $_POST['estoque'],
        ':corredor'   => $_POST['corredor'],
        ':prateleira' => $_POST['prateleira'],
        ':secao'      => $_POST['secao']
    ]);

    $mensagem = "Livro atualizado com sucesso!";
}
?>

<link rel="stylesheet" href="Assets/css/editarlivro.css">

<main>

<h2>Editar Livro</h2>

<?php if ($mensagem): ?>
    <p class="mensagem-sucesso"><?= $mensagem ?></p>
<?php endif; ?>

<form method="POST">
    <label>Digite o ID do livro que deseja editar</label>
    <input type="number" name="id" required>
    <button type="submit" name="buscar">Buscar</button>
</form>

<?php if ($livro): ?>

<form method="POST">
    
    <input type="hidden" name="id" value="<?= $livro['id'] ?>">

    <label>Título</label>
    <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>">

    <label>Autor</label>
    <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>">

    <label>Gênero</label>
    <input type="text" name="genero" value="<?= htmlspecialchars($livro['genero']) ?>">

    <label>Descrição</label>
    <textarea name="descricao" rows="4"><?= htmlspecialchars($livro['descricao']) ?></textarea>

    <label>Preço (R$)</label>
    <input type="text" name="preco" value="<?= $livro['preco'] ?>">

    <label>Quantidade em Estoque</label>
    <input type="number" name="estoque" value="<?= $livro['estoque'] ?>">

    <label>Corredor</label>
    <input type="text" name="corredor" value="<?= htmlspecialchars($livro['corredor']) ?>">

    <label>Prateleira</label>
    <input type="text" name="prateleira" value="<?= htmlspecialchars($livro['prateleira']) ?>">

    <label>Seção</label>
    <input type="text" name="secao" value="<?= htmlspecialchars($livro['secao']) ?>">

    <button type="submit" name="salvar"><strong>Salvar Alterações</strong></button>
</form>
<?php endif; ?>

</main>

<?php require_once 'Includes/Footer.php'; ?>
