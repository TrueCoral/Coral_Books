<?php
session_start();
require_once 'config/conexao.php';

if (($_SESSION['perfil'] ?? '') !== 'estabelecimento') {
    header("Location: login.php");
    exit();
}

$idEstabelecimento = $_SESSION['id'];
$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id_livro = :id_livro AND id_livraria = :id_livraria");
    $stmt->execute(['id_livro' => $id, 'id_livraria' => $idEstabelecimento]);
}

header("Location: cadastro_livro.php");
exit();