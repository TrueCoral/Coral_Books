<?php
session_start();

if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit();
}

require_once 'config/conexao.php';

$livros = [];
try {
    $stmt = $pdo->prepare("SELECT livros.*, livraria.nome_est, livraria.cidade FROM livros JOIN livraria ON livraria.idlivraria = livros.idlivraria ORDER BY livros.criado_em DESC");
    $stmt->execute();
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $livros = [];
}

$statusLabel = [
    'a_venda'      => 'À venda',
    'emprestimo'   => 'Em empréstimo',
    'indisponivel' => 'Indisponível'
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Home</title>
<link rel="stylesheet" href="assets/css/home.css">
</head>

<body>

<a href="logout.php">
    <button type="button">Sair</button>
</a>


<h1>
Seja bem-vindo ao Coral Books, <?= htmlspecialchars($_SESSION['nome']) ?>!
</h1>


<main>

<h2>Livros em Estoque</h2>
<div class="cards">
<?php if (empty($livros)): ?>
    <p>Nenhum livro cadastrado ainda.</p>
<?php endif; ?>
<?php foreach($livros as $livro): ?>
    <div class="card">
        <?php if ($livro['capa']): ?>
            <img src="<?= htmlspecialchars($livro['capa']) ?>" alt="Capa de <?= htmlspecialchars($livro['titulo']) ?>" width="120">
        <?php endif; ?>
        <h2><?= htmlspecialchars($livro['titulo']) ?></h2>
        <p>
            <strong>Autor:</strong>
            <?= htmlspecialchars($livro['autor']) ?>
        </p>
        <p>
            <strong>Gênero:</strong>
            <?= htmlspecialchars($livro['genero'] ?? '-') ?>
        </p>
        <p>
            <strong>ISBN:</strong>
            <?= htmlspecialchars($livro['isbn'] ?? '-') ?>
        </p>
        <?php if (!empty($livro['descricao'])): ?>
            <p>
                <strong>Descrição:</strong>
                <?= nl2br(htmlspecialchars($livro['descricao'])) ?>
            </p>
        <?php endif; ?>
        <p>
            <strong>Preço:</strong>
            <?= $livro['preco'] !== null ? 'R$ ' . number_format($livro['preco'], 2, ',', '.') : 'Não disponível para venda' ?>
        </p>
        <p>
            <strong>Estoque:</strong>
            <?= (int)$livro['estoque'] ?>
        </p>
        <p>
            <strong>Status:</strong>
            <?= htmlspecialchars($statusLabel[$livro['status']] ?? $livro['status']) ?>
        </p>
        <p>
            <strong>Localização:</strong>
            Corredor <?= htmlspecialchars($livro['corredor'] ?? '-') ?>,
            Prateleira <?= htmlspecialchars($livro['prateleira'] ?? '-') ?>,
            Seção <?= htmlspecialchars($livro['secao'] ?? '-') ?>
        </p>
        <p>
            <strong>Disponível em:</strong>
            <?= htmlspecialchars($livro['nome_est']) ?> — <?= htmlspecialchars($livro['cidade'] ?? '') ?>
        </p>
        <?php if (($_SESSION['tipo'] ?? '') === 'livraria' && (int)$livro['idlivraria'] === (int)$_SESSION['id']): ?>
            <a class="btn" href="editar_livro.php?id=<?= $livro['id'] ?>">Editar</a>
            <a class="btn" href="excluir_livro.php?id=<?= $livro['id'] ?>">Excluir</a>
        <?php endif; ?>
        
    
</a>
    </div>
    
<?php endforeach; ?>
</div>
<a href="cadastro_livro.php">
<button type="button">Cadastrar Livro</button>
</a>
</main>

</body>

</html>
