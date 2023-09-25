<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UP Load Arquivos</title>
</head>

<body>
    <form action="gravar.php" method="POST" enctype="multipart/form-data">
        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" />
        <br />
        <input type="submit" value="Enviar" />
    </form>



    <h1>Listar PDF BLOB</h1>

    <?php
// Incluir o arquivo de conexão
include "conexao.php";

// Query SQL para selecionar os arquivos
$query_arquivos = "SELECT id, numero_contrato, nome_documento FROM arquivos ORDER BY id DESC";

// Executar a consulta
$result_arquivos = mysqli_query($conexao, $query_arquivos);

// Verificar se a consulta retornou resultados
if ($result_arquivos) {
    // Verificar se há registros
    if (mysqli_num_rows($result_arquivos) > 0) {
        while ($row_arquivo = mysqli_fetch_assoc($result_arquivos)) {
            // Extrair os dados
            $id = $row_arquivo['id'];
            $numero_contrato = $row_arquivo['numero_contrato'];
            $nome_documento = $row_arquivo['nome_documento'];

            // Exibir os dados
            echo "ID: $id <br>";
            echo "Número do contrato: $numero_contrato <br>";
            echo "Nome do documento: <a href='visualizar_arquivo.php?id=$id' target='_blank'>$nome_documento</a> <br>";
            echo "<hr>";
        }
    } else {
        echo "<p style='color: #f00;'>Erro: Nenhum arquivo encontrado!</p>";
    }

    // Liberar o resultado da consulta
    mysqli_free_result($result_arquivos);
} else {
    echo "Erro ao executar a consulta: " . mysqli_error($conexao);
}

// Fechar a conexão
mysqli_close($conexao);
?>

</body>


</html>