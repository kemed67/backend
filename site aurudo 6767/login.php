<?php
include "conecta.php";

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM aluno WHERE cpf = :cpf AND senha = :senha";

try {
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($linha = $stmt->fetch()) {
        echo "<h2 style='color: green;'>Login bem-sucedido!</h2>";
        echo "<p>Bem-vindo(a), " . htmlspecialchars($linha['nome']) . "!</p>";
    } else {
        echo "<h2 style='color: red;'>CPF ou senha incorretos.</h2>";
        echo "<p><a href='index.php'>Tentar novamente</a></p>";
    }
} catch (PDOException $e) {
    echo "Erro ao executar consulta: " . $e->getMessage();
}
?>