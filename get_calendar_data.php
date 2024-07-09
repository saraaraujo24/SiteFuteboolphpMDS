<?php
    require_once './CalendarioInse/iniciaCalen.php';
    $PDO = db_connect();

    $sql_query = "SELECT codigo, data, hora,NameTime1,NameTime2, local FROM calendario ORDER BY data ASC LIMIT 3";
    $stmt = $PDO->prepare($sql_query);
    $stmt->execute();

    $calendario = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($calendario);
?>
