<?php
require_once 'iniciaCalen.php';

$data = isset($_POST['data']) ? $_POST['data'] : null;
$hora = isset($_POST['hora']) ? $_POST['hora'] : null;
$local = isset($_POST['local']) ? $_POST['local'] : null;
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;

// Diretório onde as imagens serão salvas
$target_dir = "imagensTimes/";

// Processa a imagem do time 1
$time1_img = '';
if (isset($_FILES['time1_img']) && $_FILES['time1_img']['error'] == UPLOAD_ERR_OK) {
    $time1_img = $target_dir . basename($_FILES['time1_img']['name']);
    move_uploaded_file($_FILES['time1_img']['tmp_name'], $time1_img);
} else {
    // Se nenhuma nova imagem foi enviada, mantém a imagem existente
    $stmt = $PDO->prepare("SELECT time1_img FROM calendario WHERE codigo = :codigo");
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->execute();
    $time1_img = $stmt->fetchColumn();
}

// Processa as imagens do time 2
$time2_imgs = [];
if (isset($_FILES['time2_img']) && count($_FILES['time2_img']['error']) > 0) {
    foreach ($_FILES['time2_img']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $time2_img = $target_dir . basename($_FILES['time2_img']['name'][$key]);
            move_uploaded_file($_FILES['time2_img']['tmp_name'][$key], $time2_img);
            $time2_imgs[] = $time2_img;
        }
    }
}

// Se nenhuma nova imagem foi enviada, mantém as imagens existentes
if (empty($time2_imgs)) {
    $stmt = $PDO->prepare("SELECT time2_img FROM calendario WHERE codigo = :codigo");
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->execute();
    $time2_imgs = explode(',', $stmt->fetchColumn());
}

// Concatena as imagens do time 2 em uma string
$time2_img_str = implode(',', $time2_imgs);

// Atualiza os dados no banco de dados
$sql = "UPDATE calendario SET data = :data, hora = :hora, time1_img = :time1_img, time2_img = :time2_img, local = :local WHERE codigo = :codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':hora', $hora);
$stmt->bindParam(':local', $local);
$stmt->bindParam(':time1_img', $time1_img);
$stmt->bindParam(':time2_img', $time2_img_str);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: CalendarioInserir.php');
} else {
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}
?>
