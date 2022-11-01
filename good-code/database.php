<?php

namespace app;

use PDO; // Declaring here makes the PDO class accessible as it isn't in this namespace.

class Database
{
  public \PDO $pdo; //Declaring that the $pdo is an instance of the PDO class.
  public function __construct()
  {
    $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=magic-stores', 'root', ''); // connecting to the DB
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function getProducts($search = " ") //function for Reading the DB
  {
    if ($search) { //if user does a search
      $statement = $this->pdo->prepare('SELECT * FROM laptops WHERE title LIKE :title ORDER BY create_date DESC'); //fetching from a table in the DB 
      $statement->bindValue(':title', "%$search%"); //%% important for MYSQL
    } else {
      $statement = $this->pdo->prepare('SELECT * FROM laptops ORDER BY create_date DESC'); //fetching from a table in the DB
    }

    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}
