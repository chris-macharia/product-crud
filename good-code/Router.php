<?php

namespace app;

class Router{

  public array $getRoute = [];
  public array $postRoute = [];
  
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
      call_user_func($fn);
    }else{
      echo "Page not found";
    }
  }

  

}