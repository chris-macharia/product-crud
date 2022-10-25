<?php

namespace app\models;


class Laptops
{
  public ?int $id = null; //the ? in ?int allows for the value to be null otherwise it's strictly an int.
  public ?string $title = null;
  public ?string $description = null;
  public ?float $price = null;
  public ?string $imagePath = null;
  public ?array $imageFile = null;

  public function load($data) //setter----gets the data from the form.
  {
    $this->id = $data['id'] ?? null;
    $this->title = $data['title'];
    $this->description = $data['description'] ?? "";
    $this->price = $data['price'];
    $this->imageFile = $data['imageFile'] ?? null;
    $this->imagePath = $data['image'] ?? null;
  }

  public function save()
  {
    $errors = [];

    if (!$this->title) {
      $errors[] = 'product title is required';
    }

    if (!$this->price) {
      $errors[] = 'product price is required';
    }

    if (!is_dir(__DIR__ . '/../public/images')) { //will execute at the very first time.
      mkdir(__DIR__ . '/../public/images');
    }

    if (empty($errors)) {
      //Image Uploading Section.
      if ($this->imageFile && $this->imageFile['tmp_name']) {  //part 2 of the logic ensures the file was actually uploaded.

        if ($this->imagePath) {
          unlink(__DIR__ . '/../public/' . $this->imagePath);
        }


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


        $this->imagePath = 'images/' . randomString(8) . '/' . $this->imageFile['name']; // creates a unique image path. 
        mkdir(dirname(__DIR__ . '/../public/' . $this->imagePath));  //makes directories subsequently if the image is uploaded
        move_uploaded_file($this->imageFile['tmp_name'], __DIR__ . '/../public/' . $this->imagePath); //moves the image file into a permanent location
      }
    }

    return $errors;
  }
}
