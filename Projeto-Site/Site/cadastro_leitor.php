<?php
require_once 'config/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido.';
    } else {
        // Verifica se o e-mail já está cadastrado (leitor ou livraria)
        $stmt = $pdo->prepare("SELECT idleitor FROM leitor WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO leitor (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->execute([
                'nome'  => $nome,
                'email' => $email,
                'senha' => $senhaHash
            ]);

            header("Location: login.php?cadastro=sucesso");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Cadastro Leitor</title>
<link rel="stylesheet" href="assets/css/cadastroleitor.css"> 
</head>

<body>

<h1>Cadastro de Leitor</h1>

<?php if ($erro): ?>
    <p style="color: #1A1A1A; background:#F4F3EF; padding:10px; border-radius:8px;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="POST" action="cadastro_leitor.php">

<input type="text" name="nome" placeholder="Nome" required value="<?= isset($nome) ? htmlspecialchars($nome) : '' ?>">

<br><br>

<input type="email" name="email" placeholder="E-mail" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

<br><br>

<input type="password" name="senha" placeholder="Senha" required>

<br><br>

<button type="submit">
Cadastrar
</button>

</form>

</body>

</html>
