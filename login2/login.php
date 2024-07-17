<?php
session_start();

if (empty($_POST) || (empty($_POST["email"]) || empty($_POST["senha"]))) {
    echo "<script>alert('Por favor, preencha todos os campos');</script>";
    print "<script>location.href='index.html';</script>";
} else {
    include("../Config/conexao.php");
    
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM user
                    WHERE email = '{$email}'
                    AND senha = '{$senha}'";

    $res = $mysqli->query($sql) or die($mysqli->error);

    $row = $res->fetch_object();

    $qtd = $res->num_rows;

    if ($qtd > 0) {
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $row->nome;
        $_SESSION["tipo"] = $row->tipo;
        print "<script>location.href='../pagAdm.html';</script>";
    } else {
        print "<script>alert('email e/ou senha incorreto(s)');</script>";
        print "<script>location.href='./index.html';</script>";
        
    }
}
