<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST["email"]) || empty($_POST["senha"])) {
        echo "<script>alert('Por favor, preencha todos os campos');</script>";
        echo "<script>location.href='index.html';</script>";
        exit();
    } else {
        include("../Config/conexao.php");

        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT * FROM user WHERE email = '{$email}' AND senha = '{$senha}'";
        $res = $mysqli->query($sql) or die($mysqli->error);

        $row = $res->fetch_object();
        $qtd = $res->num_rows;

        if ($qtd > 0) {
            $_SESSION["email"] = $email;
            $_SESSION["nome"] = $row->nome;
            $_SESSION["tipo"] = $row->tipo;

            // Verificar se as variáveis de sessão foram definidas corretamente
            error_log("Nome: " . $_SESSION["nome"]);
            error_log("Email: " . $_SESSION["email"]);

            // Define um valor no localStorage indicando que o usuário está logado
            echo "<script>
                    window.localStorage.setItem('isLoggedIn', 'true');
                    window.localStorage.setItem('userEmail', '" . addslashes($email) . "');
                    window.localStorage.setItem('userName', '" . addslashes($row->nome) . "');
                    console.log('Usuário salvo no localStorage:', '" . addslashes($row->nome) . "', '" . addslashes($email) . "');
                  </script>";
            echo "<script>window.location.href = '../pagAdm.html';</script>";
            exit();
        } else {
            echo "<script>alert('Email e/ou senha incorreto(s)');</script>";
            echo "<script>location.href='index.html';</script>";
            exit();
        }
    }
}
?>
