<?php
include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_pessoa1 = $_POST['id_pessoa1'];
    $id_pessoa2 = $_POST['id_pessoa2'];
    $data_casamento = $_POST['data_casamento'];

    // Validação 1: Não pode casar consigo mesmo
    if($id_pessoa1 == $id_pessoa2){
        die("Erro: Uma pessoa não pode casar consigo mesma. <a href='casamento.php'>Voltar</a>");
    }

    // Validação 2: Verificar se já não são casados
    $sql_check = "SELECT * FROM casamentos 
                  WHERE (id_pessoa1 = $id_pessoa1 AND id_pessoa2 = $id_pessoa2) 
                  OR (id_pessoa1 = $id_pessoa2 AND id_pessoa2 = $id_pessoa1)";
    $check = $conn->query($sql_check);
    if($check->num_rows > 0){
        die("Erro: Estas pessoas já estão casadas. <a href='casamento.php'>Voltar</a>");
    }

    // Salva no banco
    $sql = "INSERT INTO casamentos (id_pessoa1, id_pessoa2, data_casamento) 
            VALUES ('$id_pessoa1', '$id_pessoa2', '$data_casamento')";
    
    if($conn->query($sql) === TRUE){
        header("Location: listar.php?sucesso=casamento");
    } else {
        echo "Erro: " . $conn->error;
    }
}
$conn->close();
?>