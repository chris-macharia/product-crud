
<?php

$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=magic-stores', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$productId =  $_POST['product-id'];
$productName = $_POST['product-name'];
$productQuantity = $_POST['product-quantity'];

$statement = $pdo->prepare("INSERT INTO phones (ID,QUANTITY)
                          VALUES($productId, $productQuantity)"); /* product name not working */
$statement->execute();                          

echo "SUBMITTED"                          
?>