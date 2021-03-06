<?php

namespace Site\Models;

class Cy
{
    public $db;

    // Construct
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Get Category
    public function getGoodCategory($category)
    {
        $prepare = $this->db->prepare('
            SELECT
                *
            FROM
                artworks
            LEFT JOIN
                categories
            ON
                categories.id_artwork = artworks.id
            WHERE
                categories.category = :category
        ');
        $prepare->bindValue(':category', $category);
        $prepare->execute();
        $artworks = $prepare->fetchAll();
        return $artworks;

    }

    // Get Serie in the good category
    public function getGoodSerie($category, $serie)
    {
        $prepare = $this->db->prepare('
            SELECT
                *
            FROM
                artworks
            LEFT JOIN
                categories
            ON
                categories.id_artwork = artworks.id
            WHERE
                categories.category = :category
            AND
                categories.serie = :serie
        ');
        $prepare->bindValue(':category', $category);
        $prepare->bindValue(':serie', $serie);
        $prepare->execute();
        $artworks = $prepare->fetchAll();
        return $artworks;

    }

    // Get more informations about an artwork  
    public function getGoodArtwork($artwork)
    {
        $prepare = $this->db->prepare('
            SELECT
                *
            FROM
                artworks
            WHERE id = :id LIMIT 1
        ');
        $prepare->bindValue('id', $artwork);
        $prepare->execute();
        $result = $prepare->fetch();
        return $result;
    }

}
