<?php
include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listar</title>
</head>

<body>
    <a href="index.php">Listar</a><br>
    <a href="cadastrar.php">Cadastrar</a><br><br>

    <h1>Listar PDF BLOB</h1>

    <?php
    $query_arquivos = "SELECT id, numero_contrato, nome_documento 
                    FROM arquivos 
                    ORDER BY id DESC";
    
    $result_arquivos = mysqli_query($conexao, $query_arquivos);

    if ($result_arquivos && mysqli_num_rows($result_arquivos) > 0) {
        while ($row_arquivo = mysqli_fetch_assoc($result_arquivos)) {
            extract($row_arquivo);
            echo "ID: $id <br>";
            echo "Número do contrato: $numero_contrato <br>";
            echo "Nome do documento: <a href='visualizar_arquivo.php?id=$id' target='_blank'>$nome_documento</a> <br>";
            echo "<hr>";
        }
    } else {
        echo "<p style='color: #f00;'>Erro: Nenhum arquivo encontrado!</p>";
    }

    mysqli_close($conexao);
    ?>

</body>

</html>
