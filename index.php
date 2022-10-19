<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=magic-stores', 'root', ''); // connecting to the DB
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM laptops ORDER BY create_date DESC'); //fetching from a table in the DB
$statement->execute();
$laptops = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MAGIC STORES</title>
  <link rel="stylesheet" href="/magic-stores/bootstrap-5.1.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="/magic-stores/index.css">
</head>

<body>
  <div id="navbar">
    <h1>Laptops</h1>
  </div>
  <div>
    <a href="/magic-stores/create/create.php">
      <button type="button" class="btn btn-success">Create</button>
    </a>
  </div>

  <div id="table-container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Title</th>
          <th scope="col">Price</th>
          <th scope="col">Create date</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($laptops as $i => $laptop) : ?>
          <!-- iterates over the array of the selected data and displays them in the table -->
          <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><img src="<?php echo $laptop['image'] ?>" alt=""></td><!-- output for the image -->
            <td> <?php echo $laptop['title'] ?></td>
            <td> <?php echo $laptop['price'] ?></td>
            <td> <?php echo $laptop['create_date'] ?></td>
            <td>
              <a href="">
                <button type="button" class="btn btn-sm btn-primary">EDIT</button>
              </a>
              <form action="/magic-stores/delete/delete.php" method="POST" style="display:inline-block ;"> <!-- used this form because we were making changes in the database -->
                <input type="hidden" name="id" value="<?php echo $laptop['id']?>">
                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
              </form>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>