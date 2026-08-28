<?php
session_start();
require_once 'config/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = 'Preencha e-mail e senha.';
    } else {

        $stmt = $pdo->prepare("SELECT * FROM leitor WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['tipo']  = 'leitor';
            $_SESSION['id']    = $usuario['idleitor'];
            $_SESSION['nome']  = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];

            header("Location: home.php");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM livraria WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['tipo']  = 'livraria';
            $_SESSION['id']    = $usuario['idlivraria'];
            $_SESSION['nome']  = $usuario['nome_est'];
            $_SESSION['email'] = $usuario['email'];

            header("Location: home.php");
            exit();
        }

        $erro = 'E-mail ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Login</title>

<link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<h1>Entrar</h1>

<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'sucesso'): ?>
    <p style="color: #1A1A1A; background:#F4F3EF; padding:10px; border-radius:8px;">Cadastro realizado com sucesso! Faça login.</p>
<?php endif; ?>

<?php if ($erro): ?>
    <p style="color: #1A1A1A; background:#F4F3EF; padding:10px; border-radius:8px;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="POST" action="login.php">


<input type="email" name="email" placeholder="Digite seu e-mail" required>

<br><br>


<input type="password" name="senha" placeholder="Digite sua senha" required>

<br><br>

<button type="submit">
Entrar
</button>

</form>

</body>

</html>
