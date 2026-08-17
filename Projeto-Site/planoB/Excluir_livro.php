<?php


require_once 'Includes/Header.php';
require_once 'Config/Conexao.php';

$mensagem = '';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM livros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $mensagem = "Livro com ID $id excluído.";
}

$sql = "SELECT * FROM livros ORDER BY titulo ASC";
$stmt = $pdo->query($sql);
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="Assets/css/excluirlivro.css">

<main>

<h2>Excluir Livro</h2>

<?php if ($mensagem): ?>
    <p class="mensagem-sucesso"><?= $mensagem ?></p>
<?php endif; ?>

<form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
    <label>Digite o ID do livro</label>
    <input type="number" name="id" required>
    <button type="submit">Excluir</button>
</form>

<hr>

<h3>Lista de Livros</h3>

<div class="cards">
<?php foreach ($livros as $livro): ?>
    <div class="card">
        <h2>#<?= $livro['id'] ?> - <?= htmlspecialchars($livro['titulo']) ?></h2>
        <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
        <p><strong>Preço:</strong> R$ <?= number_format($livro['preco'], 2, ',', '.') ?></p>
    </div>
<?php endforeach; ?>
</div>

</main>

<?php require_once 'Includes/Footer.php'; ?>
