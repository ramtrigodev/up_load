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
    <a href="index.php">Listar</a><br>
    <a href="cadastrar.php">Cadastrar</a><br><br>

    <h1>Upload PDF BLOB</h1>

    <?php
    include "conexao.php";
    // Receber os dados do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Acessar o IF quando o usuário clica no botão
    if (!empty($dados['CadArquivoPdf'])) {
        // Receber o arquivo PDF do formulario
        $arquivo_pdf = $_FILES['arquivo_pdf'];

        // Validar se é um arquivo PDF
        if ($arquivo_pdf['type'] == "application/pdf") {
          
            // Preparar os dados para inserção
            $numero_contrato = mysqli_real_escape_string($conexao, $dados['numero_contrato']);
            $nome_documento = mysqli_real_escape_string($conexao, $arquivo_pdf['name']);
            $arquivo_pdf_blob = mysqli_real_escape_string($conexao, file_get_contents($arquivo_pdf['tmp_name']));

            // Inserir o arquivo no banco de dados
            $query_arquivo = "INSERT INTO arquivos (numero_contrato, nome_documento, arquivo_pdf) VALUES ('$numero_contrato', '$nome_documento', '$arquivo_pdf_blob')";

            if (mysqli_query($conexao, $query_arquivo)) {
                echo "<p style='color: green;'>Arquivo cadastrado com sucesso!</p>";
            } else {
                echo "<p style='color: #f00;'>Erro: Arquivo não cadastrado com sucesso!</p>";
            }

            // Fechar a conexão
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
