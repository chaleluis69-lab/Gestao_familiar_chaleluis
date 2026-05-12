<?php
$servidor = "localhost";
$usuario = "root";
$senha = ""; // Se houver senha no XAMPP, insira aqui
$banco = "chale"; // Nome da base de dados alterado para 'chale'

// Cria a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Define o charset para evitar erros com acentos
$conn->set_charset("utf8mb4");

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco: " . $conn->connect_error);
}
?>
