<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=magic-stores', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['id'] ?? null;

if(!$id){ //if there is no ID on the url, then redirect to the index page.
  header('location: /magic-stores/index.php');
  exit;
}
$statement = $pdo->prepare('DELETE FROM laptops WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('location: /magic-stores/index.php');
?>