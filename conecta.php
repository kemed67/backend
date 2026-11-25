<?php
$host = "sql307.infinityfree.com";
$banco = "if0_43432473_atvdbd5";   // seu nome completo
$usuario = "if0_43535284_meu_banco";
$senha = "gcFiHuD2dDV";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit; // para a execução se não conseguir conectar
}
?>