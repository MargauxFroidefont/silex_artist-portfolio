<?php

namespace Site\Models;

class Cy
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

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
}
