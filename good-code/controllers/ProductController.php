<?php

namespace app\controllers;

use app\Router;

class ProductController
{

  public static function index(Router $router)
  { //Router defines that the variable $router is an object of that class Router.
    $laptops = $router->db->getProducts();
    $router->renderView('laptops/index', ['laptops' => $laptops]);
  }

  public static  function create()
  {
    echo "create page";
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
