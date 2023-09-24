<?php
include "conexao.php";
	$result=mysqli_query($conexao,"SELECT * FROM arquivos WHERE PES_ID=$PicNum") or die("Impossível executar a query ");
	$row=mysqli_fetch_object($result);
	Header( "Content-type: image/gif");
	echo $row->PES_IMG;
?>