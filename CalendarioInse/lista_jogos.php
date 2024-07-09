<?php
/*require_once 'iniciaCalen.php';

$PDO = db_connect();
$sql_count = "SELECT COUNT(*) AS total FROM calendario ORDER BY data ASC";
$sql = "SELECT codigo, data, hora, local,time1_img,time2_img FROM calendario ORDER BY data ASC";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
$stmt = $PDO->prepare($sql);
$stmt->execute();

$jogos = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $jogos[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'total' => $total,
    'jogos' => $jogos
]);*/

require_once 'iniciaCalen.php';

$PDO = db_connect();

$sql_count = "SELECT COUNT(*) AS total FROM calendario ORDER BY data ASC";
$sql = "SELECT codigo, data, hora, local, time1_img, time2_img FROM calendario ORDER BY data ASC";

$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

$stmt = $PDO->prepare($sql);
$stmt->execute();



$jogos = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Separa os caminhos das imagens do time 2
    $time2_imgs = isset($row['time2_img']) ? explode(',', $row['time2_img']) : [];
    $row['time2_imgs'] = $time2_imgs;
    unset($row['time2_img']); // Remove a string original para evitar confusão

    $jogos[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'total' => $total,
    'jogos' => $jogos
]);
?>
