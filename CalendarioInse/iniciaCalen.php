<?php
  $servidor = "localhost";
  $bd = "bd_soccer";
  $usuario = "root";
  $senha = "";
  $conexao = mysqli_connect($servidor,$usuario,$senha) or die("Erro na conexaõ");

  $db= mysqli_select_db($conexao,$bd) or die("Erro na seleção do banco");
    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASS', "");
    define('DB_NAME', 'bd_soccer');

    ini_set('display_errors',true);
    error_reporting(E_ALL);

    date_default_timezone_set('America/Sao_Paulo');

// Conexão com o banco de dados usando PDO
try {
  $PDO = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);
  $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $PDO->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
  echo "Erro de conexão: " . $e->getMessage();
  exit;
}


require_once 'functionsCale.php';
?>
