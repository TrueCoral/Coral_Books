<?php
session_start();

if (($_SESSION['perfil'] ?? '') !== 'leitor') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coral Books - Leitor</title>
<link rel="stylesheet" href="assets/css/home_leitor.css">
</head>

<body>

<header>
    <div class="logo">
        <img src="assets/logo/Logocoral.png" alt="Coral Books">
    </div>

    <nav>
        <a href="#">Início</a>
        <a href="#">Livros</a>
        <a href="#">Livrarias</a>
        <a href="#">Perfil</a>
    </nav>
</header>

<main>

<section class="boas-vindas">
    <h1>Olá, <?= htmlspecialchars($_SESSION['nome']) ?>! 👋</h1>
    <p>Encontre seu próximo livro no Coral Books.</p>
</section>

<section class="pesquisa">
    <input type="text" placeholder="Pesquise por livro, autor ou ISBN...">
    <button>Pesquisar</button>
</section>

<section class="filtro">
    <label for="tipo">Tipo de estabelecimento</label>

    <select id="tipo">
        <option value="todos">Todos</option>
        <option value="biblioteca">Bibliotecas</option>
        <option value="livraria">Livrarias</option>
    </select>
</section>

<section class="livros">

    <h2>Livros disponíveis</h2>

    <div class="lista-livros">

        <div class="livro">
            <img src="../imagens/livro1.jpg" alt="Capa do livro">
            <h3>Dom Casmurro</h3>
            <p>Machado de Assis</p>
            <span class="disponivel">Disponível</span>
        </div>

        <div class="livro">
            <img src="../imagens/livro2.jpg" alt="Capa do livro">
            <h3>O Pequeno Príncipe</h3>
            <p>Antoine de Saint-Exupéry</p>
            <span class="disponivel">Disponível</span>
        </div>

        <div class="livro">
            <img src="../imagens/livro3.jpg" alt="Capa do livro">
            <h3>1984</h3>
            <p>George Orwell</p>
            <span class="disponivel">Disponível</span>
        </div>

        <div class="livro">
            <img src="../imagens/livro4.jpg" alt="Capa do livro">
            <h3>Harry Potter</h3>
            <p>J. K. Rowling</p>
            <span class="disponivel">Disponível</span>
        </div>

    </div>

</section>

</main>

<footer>
    <p>© 2026 Coral Books</p>
</footer>

</body>
</html>