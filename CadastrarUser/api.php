<?php
include("../Config/conexao.php");

$sql_read = "SELECT id, nome, email, senha FROM user";
$result = $mysqli->query($sql_read);

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
