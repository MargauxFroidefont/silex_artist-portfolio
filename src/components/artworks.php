<?php

  include 'config.php';

  $query = $pdo->query('SELECT * FROM artworks');
  $artworks = $query->fetchAll();

  echo "<pre>"; print_r($artworks); echo "</pre>";


  // $result = file_get_contents('artworks.json');
  // $result= json_decode($result);
  // $response = $result->response;
  //
  // foreach ($response as $_response) {
  //             $name = $_response->name;
  //             $serie= $_response->serie;
  //             $image = $_response->image;
  //             $description = $_response->description;
  //             $width = $_response->dimension;
  //
  //             $prepare = $pdo->prepare('INSERT INTO artworks (name, serie, image, description, width) VALUES (:name, :serie, :image, :description, :width)');
  //             $prepare->bindValue('name', $name);
  //             $prepare->bindValue('serie', $serie);
  //             $prepare->bindValue('image', $image);
  //             $prepare->bindValue('description', $description);
  //             $prepare->bindValue('width', $width);
  //             $prepare->execute();
  //
  // }
