<?php

include "conexao.php";

$result=mysqli_query($conexao,"SELECT * FROM arquivos") or die("Impossível executar a query");

while($row=mysqli_fetch_object($result)) {
	echo "<img src='getImagem.php?PicNum=$row->id' \">";
}

?>