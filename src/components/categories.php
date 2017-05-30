<?php

  include 'config.php';

  $query = $pdo->query('SELECT * FROM artworks');
  $artworks = $query->fetchAll();

  echo "<pre>"; print_r($artworks); echo "</pre>";


  // $result = file_get_contents('categories.json');
  // $result= json_decode($result);
  // $response = $result->response;
  //
  // foreach ($response as $_response) {
  //             $id_artwork = $_response->id_artwork;
  //             $category = $_response->category;
  //             $serie = $_response->serie;
  //
  //             $prepare = $pdo->prepare('INSERT INTO categories (id_artwork, category, serie) VALUES (:id_artwork, :category, :serie)');
  //             $prepare->bindValue('id_artwork', $id_artwork);
  //             $prepare->bindValue('category', $category);
  //             $prepare->bindValue('serie', $serie);
  //             $prepare->execute();
  //
  // }
