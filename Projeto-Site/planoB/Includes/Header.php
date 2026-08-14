<?php


session_start(); 

if (!isset($_SESSION['livraria_id']) || $_SESSION['tipo_usuario'] !== 'livraria') {
    
    header('Location: Login.php');
    exit; 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque - Biblioteca</title>
</head>
<body>

<header class="topo">
    <div class="logo-container">
        
        <img src="Assets/img/Logo.png" alt="Logo da Biblioteca" class="logo">
    </div>
</header>
