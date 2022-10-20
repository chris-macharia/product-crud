<?php
require_once "c:/xampp/htdocs/magic-stores/better-code/database.php";

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

<?php include_once "c:/xampp/htdocs/magic-stores/better-code/views/partials/header.php"?>

  <div id="navbar">
    <h1>Laptops</h1>
  </div>

  <div id="create-button">
    <a href="/magic-stores/better-code/create/create.php">
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
              <a href="/magic-stores/better-code/update/update.php?id=<?php echo $laptop['id'] ?>">
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