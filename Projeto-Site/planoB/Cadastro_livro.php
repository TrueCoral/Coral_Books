<?php
require_once 'Includes/Header.php';   // Verifica login de livraria + imprime o topo
require_once 'Config/Conexao.php';    // Abre a conexão $pdo com o banco

$mensagem = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo     = $_POST['titulo'];
    $autor      = $_POST['autor'];
    $genero     = $_POST['genero'];
    $descricao  = $_POST['descricao'];
    $preco      = $_POST['preco'];
    $estoque    = $_POST['estoque'];
    $corredor   = $_POST['corredor'];
    $prateleira = $_POST['prateleira'];
    $secao      = $_POST['secao'];

    $sql = "INSERT INTO livros (titulo, autor, genero, descricao, preco, estoque, corredor, prateleira, secao)
            VALUES (:titulo, :autor, :genero, :descricao, :preco, :estoque, :corredor, :prateleira, :secao)";

    $stmt = $pdo->prepare($sql); 

    $stmt->execute([
        ':titulo'     => $titulo,
        ':autor'      => $autor,
        ':genero'     => $genero,
        ':descricao'  => $descricao,
        ':preco'      => $preco,
        ':estoque'    => $estoque,
        ':corredor'   => $corredor,
        ':prateleira' => $prateleira,
        ':secao'      => $secao
    ]);

    $mensagem = "Livro \"$titulo\" cadastrado com sucesso!";
}
?>

<link rel="stylesheet" href="Assets/css/cadastrolivro.css">

<main>

<h2>Cadastrar Livro</h2>

<?php if ($mensagem): ?>

    <p class="mensagem-sucesso"><?= $mensagem ?></p>
<?php endif; ?>

<form method="post">

    <label>Título</label>
    <input type="text" name="titulo" required>

    <label>Autor</label>
    <input type="text" name="autor" required>

    <label>Gênero</label>
    <input type="text" name="genero" required>

    <label>Descrição</label>
    <textarea name="descricao" rows="4"></textarea>

    <label>Preço (R$)</label>
    <input type="text" name="preco" required>

    <label>Quantidade em Estoque</label>
    <input type="number" name="estoque" required>

    <label>Corredor</label>
    <input type="text" name="corredor" required>

    <label>Prateleira</label>
    <input type="text" name="prateleira" required>

    <label>Seção</label>
    <input type="text" name="secao" required>

    <button type="submit"><strong>Cadastrar</strong></button>

</form>

</main>

<?php require_once 'Includes/Footer.php'; 