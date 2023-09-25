<?php
include_once 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query_arquivo = "SELECT arquivo_pdf FROM arquivos WHERE id = ?";
$result_arquivo = $conn->prepare($query_arquivo);
$result_arquivo->bind_param('i', $id);
$result_arquivo->execute();
$result_arquivo->bind_result($arquivo_pdf);
$result_arquivo->fetch();

if ($arquivo_pdf) {
    header("Content-Type: application/pdf");
    echo $arquivo_pdf;
} else {
    echo "<p style='color: #f00;'>Erro: Nenhum arquivo encontrado!</p>";
}
?>
