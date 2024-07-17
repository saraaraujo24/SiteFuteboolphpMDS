<?php
require_once '../CalendarioInse/iniciaCalen.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
    // Verifica se os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($email) || empty($senha)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.');</script>";
        exit;
    }

    // Insere os dados no banco de dados
    $PDO = db_connect();
    $sql = "INSERT INTO user (nome, email, senha ) 
        VALUES (:nome, :email, :senha)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
  
    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
        // Redireciona para a página desejada após o cadastro
        header('Location: ../pagAdm.html');
    } else {
        echo "Erro ao cadastrar jogo.";
        print_r($stmt->errorInfo());
    }
}

//listra usuarios cadastrados


$sql_count = "SELECT COUNT(*) AS total FROM user ORDER BY data ASC";
$sql = "SELECT nome, email, senha  FROM user ORDER BY data ASC";

$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

$stmt = $PDO->prepare($sql);
$stmt->execute();



header('Content-Type: application/json');
echo json_encode([
    'total' => $total,
]);


?>
