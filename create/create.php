<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=magic-stores', 'root', ''); // connecting to the DB
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errors = []; //This is to alert the user  to provide the required fields.

$title = ""; // this empty variables hold user input incase they fill out the form incorrectly
$description = "";
$price = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") { //this if statement prevents errors of empty variables from the unfilled forms
  $title = $_POST['title'];
  $image = "";
  $description = $_POST['description'];
  $price = $_POST['price'];
  $date = date('Y-M-d H:i:s');

  if (!$title) {
    $errors[] = "Please provide the product title";
  }
  if (!$price) {
    $errors[] = "Please provide a price";
  }

  if (empty($errors)) {
    //Image Uploading Section.
    if (!is_dir('images')) { //on the very initial start, the program will make a dir known as images, where images will be stored.
      mkdir('images');
    }

    $image = $_FILES['image'] ?? null; //this part of the code handels image uploads
    $imagePath = ""; // to ensure no errors incase the image isn't provided.
    if ($image && $image['tmp_name']) {  //part 2 of the logic ensures the file was actually uploaded.
      $n = 0;
      function randomString($n) //generates a random String
      {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
          $index = rand(0, strlen($characters) - 1);
          $randomString .= $characters[$index];
        }

        return $randomString;
      }


      $imagePath = 'images/' . randomString(8) . '/' . $image['name']; // creates a unique image path. 
      mkdir(dirname($imagePath));  //makes directories subsequently if the image is uploaded
      move_uploaded_file($image['tmp_name'], $imagePath); //moves the image file into a permanent location
    }

    $statement = $pdo->prepare("INSERT INTO laptops (title, description, image, price, create_date)
    VALUES(:title, :description, :image, :price, :create_date)");

    $statement->bindValue(':title', $title);  //this method is secure as it prevent SQL injection.
    $statement->bindValue(':description', $description);
    $statement->bindValue(':image', $imagePath);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':create_date', $date);
    $statement->execute();

    $title = ""; // this empty variables clear the form after WRITING into the DB
    $description = "";
    $price = "";
    $image = "";

    header('location:index.php'); //redirect user back to index page after creating a product
  }
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

  <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
      <?php foreach ($errors as $error) : ?>
        <div><?php echo $error; ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div>
    <form id="formDiv" action="" method="post" enctype="multipart/form-data">
      <!-- the enctype is responsible for image handling -->
      <div class="mb-3">
        <label class="form-label">Product Image</label>
        <br>
        <input type="file" name="image">
      </div>
      <div class="mb-3">
        <label class="form-label">Product Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Product Description</label>
        <textarea class="form-control" name="description" value="<?php echo $description ?>"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Product price</label>
        <input type="number" step=".01" class="form-control" name="price" value="<?php echo $price ?>">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>

</html>