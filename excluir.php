<?php
include 'conexao.php';

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $stmt = $conn->prepare("DELETE FROM pessoas WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()){
        header("Location: listar.php?deletado=1");
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>