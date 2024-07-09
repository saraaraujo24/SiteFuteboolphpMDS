<?php
    require_once './CalendarioInse/iniciaCalen.php';
    $PDO = db_connect();

    $sql_query = "SELECT id, noticia, titulo, nome, path, 
                             DATE_FORMAT(data_criacao,'%d/%m/%Y') AS DataFormatada, 
                             TIME_FORMAT(data_criacao,'%H:%i') AS HoraFormatada 
                             FROM News 
                             ORDER BY data_criacao DESC LIMIT 3";

    $stmt = $PDO->prepare($sql_query);
    $stmt->execute();

    $calendario = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($calendario);
?>