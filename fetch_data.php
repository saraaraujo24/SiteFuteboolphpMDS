<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
include './Config/conexao.php'; // Verifique o caminho está correto

// Verifique a conexão
if (!$mysqli) {
    echo json_encode(["error" => "Failed to connect to database: " . mysqli_connect_error()]);
    exit;
}

$sql = "SELECT * FROM calendario"; // Ajuste sua consulta conforme necessário
$result = mysqli_query($mysqli, $sql);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . mysqli_error($mysqli)]);
    exit;
}

$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo json_encode(["message" => "No records found"]);
    exit;
}

echo json_encode($data);
mysqli_close($mysqli);
?>
