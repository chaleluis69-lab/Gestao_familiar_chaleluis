<?php
include 'conexao.php';

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=pessoas_familia_".date('Y-m-d').".xls");
header("Pragma: no-cache");
header("Expires: 0");

$sql = "SELECT p.*, pai.nome as nome_pai, mae.nome as nome_mae 
        FROM pessoas p
        LEFT JOIN pessoas pai ON p.id_pai = pai.id
        LEFT JOIN pessoas mae ON p.id_mae = mae.id
        ORDER BY p.id ASC";
$result = $conn->query($sql);

echo "\xEF\xBB\xBF";

echo "<table border='1'>";
echo "<tr style='background-color:#0d6efd; color:white; font-weight:bold;'>
        <td>ID</td>
        <td>Nome</td>
        <td>Data Nascimento</td>
        <td>Sexo</td>
        <td>BI</td>
        <td>Pai</td>
        <td>Mãe</td>
        <td>Apelido Familiar</td>
      </tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".htmlspecialchars($row['nome'])."</td>";
    echo "<td>".date('d/m/Y', strtotime($row['data_nascimento']))."</td>";
    echo "<td>".($row['sexo'] == 'M' ? 'Masculino' : 'Feminino')."</td>";
    echo "<td>".$row['bi']."</td>";
    echo "<td>".htmlspecialchars($row['nome_pai'] ?? 'Não informado')."</td>";
    echo "<td>".htmlspecialchars($row['nome_mae'] ?? 'Não informado')."</td>";
    echo "<td>".htmlspecialchars($row['apelido_familiar'])."</td>";
    echo "</tr>";
}
echo "</table>";
$conn->close();
?>