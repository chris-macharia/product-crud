<?php

namespace app\controllers;

use app\models\Laptops;
use app\Router;

class ProductController
{

  public static function index(Router $router)
  { //Router defines that the variable $router is an object of that class Router.
    $search = $_GET['search'] ?? "";
    $laptops = $router->db->getProducts($search);
    $router->renderView('laptops/index', ['laptops' => $laptops, 'search' => $search]);
  }

  public static  function create(Router $router)
  {
    $errors = [];
    $laptopsData = [
      'title' => "",
      'description' => "",
      'image' => "",
      'price' => "",
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $laptopsData['title'] = $_POST['title'];
      $laptopsData['description'] = $_POST['description'];
      $laptopsData['image'] = $_POST['image'];
      $laptopsData['price'] = (float)$_POST['price'];
      $laptopsData['imageFile'] = $_FILES['image'] ?? null;

      $laptops = new Laptops; //create a new laptop object from the models class laptop.
      $laptops->load($laptopsData);
      $errors = $laptops->save();
      if(Empty($errors)){ //if errors is empty,then everything worked correctly.
        header("location: /products");
        exit;
      }
    }



    $search = $_GET['search'] ?? "";
    $laptops = $router->db->getProducts($search);
    $router->renderView('laptops/create', ['laptops' => $laptops, 'errors' => $errors]);
  }

  public static  function update()
  {
    echo "update page";
  }

  public static  function delete()
  {
    echo "delete page";
  }
}
