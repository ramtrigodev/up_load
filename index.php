<?php
include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Visualização de documentos</title>
</head>

<body>
    <a href="cadastrar.php">Envio de Documentos</a><br><br>
    <h1>Arquivos Enviados</h1>
    <?php
    $query = "SELECT id, numero_contrato, nome_documento 
                    FROM arquivos 
                    ORDER BY id DESC";
    
    $resultado_arquivos = mysqli_query($conexao, $query);

    if ($resultado_arquivos && mysqli_num_rows($resultado_arquivos) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado_arquivos)) {
            extract($linha);
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
