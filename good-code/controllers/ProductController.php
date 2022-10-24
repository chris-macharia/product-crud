<?php

namespace app\controllers;

use app\Router;

class ProductController
{

  public static function index(Router $router)
  { //Router defines that the variable $router is an object of that class Router.
    $products = $router->db->getProducts();
    $router->renderView('laptops/index', ['products' => $products]);
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
