<?php
// Estabeleça a conexão com o banco de dados (substitua os detalhes com os seus próprios)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "documentos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique se há erros na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter todas as imagens da tabela
$sql = "SELECT id, PES_IMG FROM arquivos";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibir cabeçalho HTML
    echo "<html><head><title>Galeria de Imagens</title></head><body>";
    
    // Loop através de todas as imagens
    while ($row = $result->fetch_assoc()) {
        // Exibe cada imagem com um link para ver em tamanho completo
        echo "<a href='exibir_imagem.php?id=" . $row['id'] . "'><img src='exibir_imagem.php?id=" . $row['id'] . "' width='200' height='200' style='margin: 10px;'></a>";
    }
    
    // Exibir rodapé HTML
    echo "</body></html>";
} else {
    echo "Nenhuma imagem encontrada.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
