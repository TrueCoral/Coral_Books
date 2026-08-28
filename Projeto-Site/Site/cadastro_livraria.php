<?php
require_once 'config/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_res = trim($_POST['nome_res'] ?? '');
    $nome_est = trim($_POST['nome_est'] ?? '');
    $estado   = trim($_POST['estado'] ?? '');
    $cidade   = trim($_POST['cidade'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $senha    = $_POST['senha'] ?? '';

    if ($nome_res === '' || $nome_est === '' || $endereco === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos obrigatórios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido.';
    } else {
        $stmt = $pdo->prepare("SELECT idlivraria FROM livraria WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO livraria (nome_res, nome_est, endereco, cidade, estado, telefone, email, senha)
                                    VALUES (:nome_res, :nome_est, :endereco, :cidade, :estado, :telefone, :email, :senha)");
            $stmt->execute([
                'nome_res' => $nome_res,
                'nome_est' => $nome_est,
                'endereco' => $endereco,
                'cidade'   => $cidade,
                'estado'   => $estado,
                'telefone' => $telefone,
                'email'    => $email,
                'senha'    => $senhaHash
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
<title>Cadastro Livraria</title>
<link rel="stylesheet" href="assets/css/cadastrolivraria.css">
</head>

<body>

<h1>Cadastro de Livraria</h1>

<?php if ($erro): ?>
    <p style="color: #1A1A1A; background:#F4F3EF; padding:10px; border-radius:8px;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="POST" action="cadastro_livraria.php">

<input type="text" name="nome_res" placeholder="Nome do responsável" required value="<?= isset($nome_res) ? htmlspecialchars($nome_res) : '' ?>">

<br><br>

<input type="text" name="nome_est" placeholder="Nome do estabelecimento" required value="<?= isset($nome_est) ? htmlspecialchars($nome_est) : '' ?>">

<br><br>

<input type="text" name="estado" placeholder="Estado" maxlength="2" value="<?= isset($estado) ? htmlspecialchars($estado) : '' ?>">

<br><br>

<input type="text" name="cidade" placeholder="Cidade" value="<?= isset($cidade) ? htmlspecialchars($cidade) : '' ?>">

<br><br>

<input type="text" name="endereco" placeholder="Endereço" required value="<?= isset($endereco) ? htmlspecialchars($endereco) : '' ?>">

<br><br>

<input type="text" name="telefone" placeholder="Telefone" value="<?= isset($telefone) ? htmlspecialchars($telefone) : '' ?>">

<br><br>

<input type="email" name="email" placeholder="E-mail" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

<br><br>

<input type="password" name="senha" placeholder="Senha" required>

<br><br>

<button type="submit">
Cadastrar
</button>

<br> <br>
<a href="index.php"><button type="button">Voltar</button></a>

</form>

</body>

</html>
