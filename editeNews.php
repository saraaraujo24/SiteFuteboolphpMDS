<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require './CalendarioInse/iniciaCalen.php';

    // Pega os dados do formulário
    $noticia = isset($_POST['noticia']) ? $_POST['noticia'] : null;
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $path = isset($_FILES['caminho']) ? $_FILES['caminho'] : null;
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;

    // Seleciona o ID
    if (empty($id)) {
        echo "<p>ID para alteração não definido</p>";
        exit;
    }

    // Processa o upload da imagem se existir
    if ($path && $path['error'] == 0) {
        $ext = pathinfo($path['name'], PATHINFO_EXTENSION);
        $newPath = 'arquivosNews/' . uniqid() . '.' . $ext;
        if (!move_uploaded_file($path['tmp_name'], $newPath)) {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        // Mantém o caminho da imagem antiga se nenhuma nova imagem for carregada
        $newPath = $noticia['path'];
    }

    // Atualiza os dados no banco de dados
    $PDO = db_connect();
    $sql = "UPDATE news SET noticia = :noticia, titulo = :titulo, path = :path WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':noticia', $noticia);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':path', $newPath);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ./CriarNews.php');
        exit;
    } else {
        echo "Erro ao alterar notícia.";
        print_r($stmt->errorInfo());
    }
}
?>