<?php


require_once 'Includes/Header.php';
require_once 'Config/Conexao.php';

$sql = "SELECT * FROM livros ORDER BY titulo ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<link rel="stylesheet" href="Assets/css/perfillivraria.css">

<main>

<h2>Livros em Estoque</h2>

<div class="cards">

<?php if (count($livros) === 0): ?>
    
    <p>Nenhum livro cadastrado ainda.</p>
<?php endif; ?>

<?php foreach ($livros as $livro): 

    <div class="card">

        <h2><?= htmlspecialchars($livro['titulo']) ?></h2>

        <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
        <p><strong>Gênero:</strong> <?= htmlspecialchars($livro['genero']) ?></p>
        <p><strong>Descrição:</strong> <?= htmlspecialchars($livro['descricao']) ?></p>
        <p><strong>Preço:</strong> R$ <?= number_format($livro['preco'], 2, ',', '.') ?></p>
        <p><strong>Estoque:</strong> <?= $livro['estoque'] ?> unidade(s)</p>
        <p>
            <strong>Localização:</strong>
            Corredor <?= htmlspecialchars($livro['corredor']) ?>,
            Prateleira <?= htmlspecialchars($livro['prateleira']) ?>,
            Seção <?= htmlspecialchars($livro['secao']) ?>
        </p>

    </div>

<?php endforeach; ?>

</div>

</main>

<?php require_once 'Includes/Footer.php'; ?>
