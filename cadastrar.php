<?php
include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Upload</title>
</head>

<body>
    <a href="index.php">Voltar</a><br>
    <h1>Envio de Documentos</h1>

    <?php
    include "conexao.php";
 
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['CadArquivoPdf'])) {
 
        $arquivo_pdf = $_FILES['arquivo_pdf'];

        if ($arquivo_pdf['type'] == "application/pdf") {
          
            $numero_contrato = mysqli_real_escape_string($conexao, $dados['numero_contrato']);
            $nome_documento = mysqli_real_escape_string($conexao, $arquivo_pdf['name']);
            $arquivo_pdf_blob = mysqli_real_escape_string($conexao, file_get_contents($arquivo_pdf['tmp_name']));

            $query_arquivo = "INSERT INTO arquivos (numero_contrato, nome_documento, arquivo_pdf) VALUES ('$numero_contrato', '$nome_documento', '$arquivo_pdf_blob')";

            if (mysqli_query($conexao, $query_arquivo)) {
                echo "<p style='color: green;'>Arquivo cadastrado com sucesso!</p>";
            } else {
                echo "<p style='color: #f00;'>Erro: Arquivo não cadastrado com sucesso!</p>";
            }
            mysqli_close($conexao);
        } else {
            echo "<p style='color: #f00;'>Erro: Extensão do arquivo inválida. É necessário enviar um arquivo PDF!</p>";
        }
    }
    ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label>Número do Contrato: </label>
        <input type="text" name="numero_contrato" placeholder="Número do contrato"><br><br>
        <label>Arquivo PDF: </label>
        <input type="file" name="arquivo_pdf"><br><br>
        <input type="submit" name="CadArquivoPdf" value="Enviar"><br><br>
    </form>

</body>

</html>
