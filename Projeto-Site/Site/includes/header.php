<header>
    <h2>Coral Books</h2>
    <nav>
        <a href="home.php">Início</a>
        <?php if (($_SESSION['tipo'] ?? '') === 'livraria'): ?>
            <a href="cadastro_livro.php">Cadastrar Livro</a>
        <?php endif; ?>
        <a href="logout.php">Sair</a>
    </nav>
</header>
