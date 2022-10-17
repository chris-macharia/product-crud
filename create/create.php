<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=magic-stores', 'root', ''); // connecting to the DB
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    <form id="formDiv" action="" method="POST">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Product Image</label>
        <br>
        <input type="file">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Product Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Product Description</label>
        <textarea class="form-control" id="exampleInputEmail1"></textarea>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Product price</label>
        <input type="number" step=".01" class="form-control" id="exampleInputEmail1">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Record create date</label>
        <input type="date" class="form-control" id="exampleInputEmail1">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>

</html>