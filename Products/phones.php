<?php 
  $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=magic-stores', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MAGIC STORES</title>
  <link rel="stylesheet" href="/magic-stores/products/phones.css">
</head>

<body>
  <div id="navbar">
    <h1>HELLO THERE</h1>
  </div>

  <form action="/magic-stores/products/phones-POST.php" method="POST">
    <div id="inputs">
      Product ID: <br>
      <input type="text" name="product-id"> <br>
      <br>
      Product Name: <br>
      <input type="text" name="product-name" id=""><br>
      <br>
      Quantity: <br>
      <input type="text" name="product-quantity" id=""><br>
    </div>
    <div>
      <input type="submit" id="submit-btn">
    </div>
  </form>
</body>

</html>