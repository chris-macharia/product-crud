<?php

namespace app;

class Router{

  public array $getRoute = [];
  public array $postRoute = [];

  public Database $db;

  public function __construct()
  {
    $this->db = new Database();
  }
  
  public function get($url, $fn){
    $this->getRoute[$url] = $fn;
  }

  public function post($url, $fn){
    $this->postRoute[$url] = $fn;
  }

  public function resolve(){
    $currentUrl = $_SERVER['PATH_INFO'] ?? '/';  //path info doesn't change
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET'){
      $fn = $this->getRoute[$currentUrl] ?? null;
    }else{
      $fn = $this->postRoute[$currentUrl] ?? null;
    }

    if($fn){
      call_user_func($fn, $this);
    }else{
      echo "Page not found";
    }
  }

  public function renderView($view, $params = []){ //will get the file belonging to views/DIR/FILE as the $view

    foreach($params as $key=>$value){
      $$key = $value;
    }

    ob_start(); //start caching of the output. Saves the output in local buffer rather than sending it to the web-browser.
    include_once __DIR__."/views/$view.php"; //this file will be saved in the buffer.
    $content = ob_get_clean(); //returns that output to $content and clears the buffer.
    include_once __DIR__."/views/_layout.php";
  }

  

 }