<?php
$host = "localhost";
$usuarioBanco = "root";
$senhaBanco = "";
$nomeBanco = "ams200";

$conexao = new mysqli($host, $usuarioBanco, $senhaBanco, $nomeBanco);

if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}
?>
