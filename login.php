<?php
session_start();
include "conecta.php";

$erro = "";

// Só processa o login se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cpf = $_POST['cpf'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT * FROM aluno WHERE cpf = :cpf AND senha = :senha";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        if ($linha = $stmt->fetch()) {
            // Login correto - salva na sessão e redireciona
            $_SESSION['aluno'] = $linha; // ou $_SESSION['nome'] = $linha['nome'];
            
            header("Location: lista.php"); // página depois do login
            exit;
        } else {
            $erro = "CPF ou senha incorretos.";
        }
    } catch (PDOException $e) {
        $erro = "Erro ao executar consulta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h2>Login do Aluno</h2>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>CPF:</label><br>
        <input type="text" name="cpf" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p><a href="index.php">Voltar</a></p>

</body>
</html>