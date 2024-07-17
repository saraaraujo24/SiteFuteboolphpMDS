<?php
require '../CalendarioInse/iniciaCalen.php';

// Pega os dados do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

// Valida o ID
if (empty($id)) {
    echo "<p>ID para alteração não definido</p>";
    exit;
}

// Atualiza os dados no banco de dados
$sql = "UPDATE user SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: ../pagAdm.html');
    exit;
} else {
    echo "Erro ao alterar usuário.";
    print_r($stmt->errorInfo());
}
?>
