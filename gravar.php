<?php

include "conexao.php";
$imagem = $_FILES["imagem"];


if($imagem != NULL) {
	$nomeFinal = time().'.jpg';
	if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
		$tamanhoImg = filesize($nomeFinal);

		$mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));


	mysqli_query($conexao,"INSERT INTO PESSOA (PES_IMG) VALUES ('$mysqlImg')") ;

		unlink($nomeFinal);

		header("location:exibir.php");
	}
}
else {
	echo"Você não realizou o upload de forma satisfatória.";
}

?>


<?php
include "conexao.php";

// Verifica se um ID de arquivo foi fornecido na URL (por exemplo, arquivo.php?id=1)
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    
    // Consulta o banco de dados para obter o arquivo com base no ID
    $query = "SELECT nome, pdf_data FROM arquivos_pdf WHERE id = $id";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $pdf_data);

    if ($stmt->fetch()) {
        // Configura os cabeçalhos para exibir o PDF no navegador
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"$nome\"");
        echo $pdf_data;
    } else {
        echo "Arquivo não encontrado no banco de dados.";
    }

    $stmt->close();
} else {
    echo "ID de arquivo inválido.";
}

