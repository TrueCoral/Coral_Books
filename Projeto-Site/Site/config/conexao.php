<?php
$host = 'localhost';
$dbname = 'coral_books'; // nome do banco de dados
$usuario = 'root';
$senha = ''; // no XAMPP, por padrão o root não tem senha

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>