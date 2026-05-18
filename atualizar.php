<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int)$_POST['id'];
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $pai = !empty($_POST['id_pai']) ? $_POST['id_pai'] : null;
    $mae = !empty($_POST['id_mae']) ? $_POST['id_mae'] : null;
    $apelido = $_POST['apelido_familiar'];

    $stmt = $conn->prepare("UPDATE pessoas SET nome=?, data_nascimento=?, sexo=?, id_pai=?, id_mae=?, apelido_familiar=? WHERE id=?");
    $stmt->bind_param("ssssssi", $nome, $data_nascimento, $sexo, $pai, $mae, $apelido, $id);
    
    if($stmt->execute()){
        header("Location: listar.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>