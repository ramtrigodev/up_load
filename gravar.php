<?php

include "conexao.php";
$imagem = $_FILES["imagem"];


if($imagem != NULL) {
	$nomeFinal = time().'.jpg';
	if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
		$tamanhoImg = filesize($nomeFinal);

		$mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));


	mysqli_query($conexao,"INSERT INTO arquivos (PES_IMG) VALUES ('$mysqlImg')") ;

		unlink($nomeFinal);

		header("location:exibir2.php");
	}
}
else {
	echo"Você não realizou o upload de forma satisfatória.";
}

?>

