<?php
require_once '../CalendarioInse/iniciaCalen.php';

$id = isset($_GET['id']) ? $_GET['id']:null;

if (empty($id))
{
    echo "id não informado";
    exit;
}

$PDO = db_connect();
$sql = "DELETE FROM user WHERE id= :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute())
{
    header('Location: ../pagAdm.html');

}
else
{
    echo"Erro ao remover";
}
