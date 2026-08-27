<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Home</title>
</head>

<body>

<a href="logout.php">
    <button type="button">Sair</button>
</a>

<h1>
Seja bem-vindo ao Coral Books!
</h1>

<?php
require_once 'config/conexao.php';
$sql = "SELECT * FROM livros";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once 'includes/Header.php'; ?>
<main>

<h2>Livros em Estoque</h2>
<div class="cards">
<?php foreach($livros as $livro): ?>
    <div class="card">
        <h2><?= $livro['titulo'] ?></h2>
        <p>
            <strong>Autor:</strong>
            <?= $livro['autor'] ?>
        </p>
        <p>
            <strong>Editora:</strong>
            <?= $livro['editora'] ?>
        </p>
        <p>
            <strong>Preço:</strong>
            R$ <?= number_format($livro['preco'], 2, ',', '.') ?>
        </p>
        <p>
            <strong>Estoque:</strong>
            <?= $livro['estoque'] ?>
        </p>
        <a class="btn" href="editar_livro.php?id=<?= $livro['id'] ?>">Editar</a>
        <a class="btn" href="excluir_livro.php?id=<?= $livro['id'] ?>">Excluir</a>
    </div>
<?php endforeach; ?>
</div>
</main>
<?php require_once 'includes/Footer.php'; ?>

</body>

</html>