<?php
  $hostname = "localhost";
  $user = "root";
  $password = "";
  $bd = "bd_soccer";

  $mysqli = new mysqli($hostname, $user, $password,$bd);
  

  if ($mysqli->connect_errno) {
    die("Erro na conexão! (" . $mysqli->connect_errno . ")" . $mysqli->connect_error);
  }
  
?>
