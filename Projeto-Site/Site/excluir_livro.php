<?php
session_start();
require_once 'config/conexao.php';

if (($_SESSION['tipo'] ?? '') !== 'livraria') {
    header("Location: login.php");
    exit();
}

$idlivraria = $_SESSION['id'];
$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id AND idlivraria = :idlivraria");
    $stmt->execute(['id' => $id, 'idlivraria' => $idlivraria]);
}

header("Location: cadastro_livro.php");
exit();
