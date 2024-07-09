<?php

$hostname = "localhost"; // Replace with your database hostname
$user = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$bd = "bd_soccer"; // Replace with your database name

// Connect to the database
$mysqli = new mysqli($hostname, $user, $password,$bd);

// Check for connection errors
if ($mysqli->connect_errno) {
  die("Erro na conexão! (" . $mysqli->connect_errno . ")" . $mysqli->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : null; // Get news ID from URL parameter

if (empty($id)) {
  echo "Erro: ID da notícia não informado.";
  exit;
}

$sql = "DELETE FROM News WHERE id = ?"; // Prepare delete query with placeholder

$stmt = $mysqli->prepare($sql); // Prepare the statement
$stmt->bind_param('i', $id); // Bind the ID parameter

if ($stmt->execute()) {
  header('Location: ./CriarNews.php'); // Redirect back to CriarNews.php on success
} else {
  echo "Erro ao excluir notícia: " . $mysqli->error; // Display error message
}

$mysqli->close(); // Close connection
?>
