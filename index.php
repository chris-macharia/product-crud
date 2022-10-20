<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=magic-stores', 'root', ''); // connecting to the DB
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search = $_GET['search'] ?? " ";
if ($search) { //if user does a search
  $statement = $pdo->prepare('SELECT * FROM laptops WHERE title LIKE :title ORDER BY create_date DESC'); //fetching from a table in the DB 
  $statement->bindValue(':title', "%$search%"); //%% important for MYSQL
} else {
  $statement = $pdo->prepare('SELECT * FROM laptops ORDER BY create_date DESC'); //fetching from a table in the DB
}

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

  <div id="create-button">
    <a href="/magic-stores/create/create.php">
      <button type="button" class="btn btn-success">Create</button>
    </a>
  </div>

  <form action="">
    <div id="search-bar">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search for product" 
        name="search" value="<?php echo $search?>"
        aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-dark" type="submit" id="button-addon2">Search</button>
      </div>
    </div>
  </form>


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
              <a href="/magic-stores/update/update.php?id=<?php echo $laptop['id'] ?>">
                <button type="button" class="btn btn-sm btn-primary">EDIT</button>
              </a>
              <form action="/magic-stores/delete/delete.php" method="POST" style="display:inline-block ;">
                <!-- used this form because we were making changes in the database -->
                <input type="hidden" name="id" value="<?php echo $laptop['id'] ?>">
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