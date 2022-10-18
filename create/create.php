<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=magic-stores', 'root', ''); // connecting to the DB
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] === "POST") { //this if statement prevents errors of empty variables from the unfilled forms
  $title = $_POST['title'];
  $image = "";
  $description = $_POST['description'];
  $price = $_POST['price'];
  $date = date('Y-M-d H:i:s');

  $statement = $pdo->prepare("INSERT INTO laptops (title, description, image, price, create_date)
              VALUES(:title, :description, :image, :price, :create_date)");

  $statement->bindValue(':title', $title);  //this method is secure as it prevent SQL injection.
  $statement->bindValue(':description', $description);
  $statement->bindValue(':image', $image);
  $statement->bindValue(':price', $price);
  $statement->bindValue(':create_date', $date);
  $statement->execute();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MAGIC STORES</title>
  <link rel="stylesheet" href="/magic-stores/bootstrap-5.1.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="/magic-stores/create/create.css">
</head>

<body>
  <div id="navbar">
    <h1>Create new record</h1>
  </div>

  <div>
    <form id="formDiv" action="" method="post">
      <div class="mb-3">
        <label class="form-label">Product Image</label>
        <br>
        <input type="file" name="image">
      </div>
      <div class="mb-3">
        <label class="form-label">Product Title</label>
        <input type="text" class="form-control" name="title">
      </div>
      <div class="mb-3">
        <label class="form-label">Product Description</label>
        <textarea class="form-control" name="description"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Product price</label>
        <input type="number" step=".01" class="form-control" name="price">
      </div>
      <div class="mb-3">
        <label class="form-label">Record create date</label>
        <input type="date" class="form-control" name="date">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>

</html>