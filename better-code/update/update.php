<?php
require_once "c:/xampp/htdocs/magic-stores/better-code/database.php";
require_once "c:/xampp/htdocs/magic-stores/better-code/functions.php";

$errors = []; //This is to alert the user  to provide the required fields.

$id = $_GET['id'] ?? null;
if (!$id) { //if there is no ID on the url, then redirect to the index page.
  header('location: /magic-stores/index.php');
  exit;
}

$statement = $pdo->prepare('SELECT * FROM laptops WHERE id = :id'); //selects all data from the table
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);


$title = $product['title']; // this empty variables autofill the form from records in the DB.
$description = $product['description'];
$price = $product['price'];

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
    $imagePath = $product['image']; // to ensure no errors incase the image isn't provided.

    if ($image && $image['tmp_name']) {  //part 2 of the logic ensures the file was actually uploaded.
      
      if($product['image']){
        unlink($product['image']); //unlink basically removes that image.
      }
      $imagePath = 'images/' . randomString(8) . '/' . $image['name']; // creates a unique image path. 
      mkdir(dirname($imagePath));  //makes directories subsequently if the image is uploaded
      move_uploaded_file($image['tmp_name'], $imagePath); //moves the image file into a permanent location
    }

    $statement = $pdo->prepare("UPDATE laptops SET title = :title, description = :description, 
                                                   image = :image, price = :price WHERE id = :id");
    $statement->bindValue(':title', $title);  //this method is secure as it prevent SQL injection.
    $statement->bindValue(':description', $description);
    $statement->bindValue(':image', $imagePath);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $title = ""; // this empty variables clear the form after WRITING into the DB
    $description = "";
    $price = "";
    $image = "";

    header('location:/magic-stores/index.php'); //redirect user back to index page after creating a product
  }
}

?>

<?php include_once "c:/xampp/htdocs/magic-stores/better-code/views/partials/header.php"?>

  <div id="navbar">
    <h1>Update product</h1>
  </div>
  
  <div>
    <a href="/magic-stores/better-code/index.php">
      <button type="button" class="btn btn-info">BACK</button>
    </a>
  </div>

<?php include_once "c:/xampp/htdocs/magic-stores/better-code/views/products/forms.php"?>
</body>

</html>