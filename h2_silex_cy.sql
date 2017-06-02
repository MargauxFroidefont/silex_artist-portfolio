-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Ven 02 Juin 2017 à 09:55
-- Version du serveur :  5.6.35
-- Version de PHP :  7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `h2_silex_cy`
--

-- --------------------------------------------------------

--
-- Structure de la table `artworks`
--

CREATE TABLE `artworks` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `serie` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `width` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `artworks`
--

INSERT INTO `artworks` (`id`, `name`, `serie`, `image`, `description`, `width`) VALUES
(67, 'Mermay', 'Mermaids', 'mermay.png', 'Illustrator', '1200px x 1900px'),
(68, 'Nott', 'Les endormies', 'nott.png', 'Crayon de couleur', '15 cm x 15 cm'),
(69, 'Xylogravure 1', 'Sérigraphie', 'xylogravure.png', 'Gravure sur bois 15 exemplaires', '21 cm x 29,7 cm'),
(70, 'Archimède', 'Les oiseaux', 'archimede.png', 'Crayon de couleur', '21 cm x 29,7 cm'),
(71, 'Pirange Ecarlate', 'Les oiseaux', 'pirange_ecarlate.png', 'Crayon de couleur', '15 cm x 15 cm'),
(72, 'Aegithalide', 'Les oiseaux', 'aegithalide.png', 'Crayon de couleur', '15 cm x 15 cm'),
(73, 'Mésange', 'Les oiseaux', 'mesange.png', 'Crayon de couleur', '15 cm x 15 cm'),
(74, 'Queen', 'Flower Power', 'queen.png', 'Crayon de couleur', '30 cm x 30 cm'),
(75, 'Motif floral', 'Flower Power', 'motif_floral.png', 'Crayon de couleur', '30 cm x 20 cm'),
(76, 'Éclosion', 'Flower Power', 'eclosion.png', 'Crayon de couleur', '20 cm x 20 cm'),
(77, 'Des fleurs plein les mains', 'Flower Power', 'des_fleurs_plein_les_mains.png', 'Crayon de couleur', '40 cm x 20 cm'),
(78, 'Éclosion 2', 'Flower Power', 'eclosion_2.png', 'Crayon de couleur', '25 cm x 17 cm'),
(79, 'Des fleurs plein les mains', 'Flower Power', 'des_fleurs_plein_les_mains_2.png', 'Crayon de couleur', '20 cm x 20 cm'),
(80, 'Gryffindor Place', 'Hogwart', 'gryffindor_room.png', 'Crayon de couleur', '29,7 cm x 21 cm'),
(81, 'Xylogravure 2', 'Sérigraphie', 'xylogravure_2.png', 'Gravure sur bois 15 exemplaires', '21 cm x 29,7 cm'),
(82, 'Expecto patronum', 'Hogwart', 'expecto_patronum.png', 'Crayon de couleur', '29,7 cm x 21 cm'),
(83, 'Neith', 'Les endormies', 'neith.png', 'Crayon de couleur', '15 cm x 15 cm'),
(84, 'Hufflepuff', 'Hogwart', 'hufflepuff.png', 'Illustrator', '1200px x 1900px'),
(85, 'Ravenclaw', 'Hogwart', 'ravenclaw.png', 'Illustrator', '1200px x 1900px'),
(86, 'Slytherin', 'Hogwart', 'slytherin.png', 'Illustrator', '1200px x 1900px'),
(87, 'Gryffindor', 'Hogwart', 'gryffindor.png', 'Illustrator', '1200px x 1900px'),
(88, 'Blanche', 'Les endormies', 'blanche.png', 'Crayon de couleur', '15 cm x 15 cm'),
(89, 'Nout', 'Les endormies', 'nout.png', 'Crayon de couleur', '15 cm x 15 cm'),
(90, 'Nyx', 'Les endormies', 'nyx.png', 'Crayon de couleur', '15 cm x 15 cm');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `id_artwork` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `serie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `id_artwork`, `category`, `serie`) VALUES
(25, 67, 'graphisme', 'mermaids'),
(26, 68, 'crayon', 'endormies'),
(27, 68, 'series', 'endormies'),
(28, 69, 'serigraphie', 'endormies'),
(29, 69, 'series', 'endormies'),
(30, 70, 'crayon', 'oiseaux'),
(31, 71, 'crayon', 'oiseaux'),
(32, 72, 'crayon', 'oiseaux'),
(33, 73, 'crayon', 'oiseaux'),
(34, 74, 'crayon', 'fleuries'),
(35, 75, 'crayon', 'fleuries'),
(36, 76, 'crayon', 'fleuries'),
(37, 77, 'crayon', 'fleuries'),
(38, 78, 'crayon', 'fleuries'),
(39, 79, 'crayon', 'fleuries'),
(40, 80, 'crayon', 'hogwart'),
(41, 80, 'series', 'hogwart'),
(42, 81, 'serigraphie', 'endormies'),
(43, 81, 'series', 'endormies'),
(44, 82, 'crayon', 'hogwart'),
(45, 82, 'series', 'hogwart'),
(46, 83, 'crayon', 'endormies'),
(47, 83, 'series', 'endormies'),
(48, 84, 'graphisme', 'hogwart'),
(49, 84, 'series', 'hogwart'),
(50, 85, 'graphisme', 'hogwart'),
(51, 85, 'series', 'hogwart'),
(52, 86, 'graphisme', 'hogwart'),
(53, 86, 'series', 'hogwart'),
(54, 87, 'graphisme', 'hogwart'),
(55, 87, 'series', 'hogwart'),
(56, 88, 'crayon', 'endormies'),
(57, 88, 'series', 'endormies'),
(58, 89, 'crayon', 'endormies'),
(59, 89, 'series', 'endormies'),
(60, 90, 'crayon', 'endormies'),
(61, 90, 'series', 'endormies');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `artworks`
--
ALTER TABLE `artworks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `artworks`
--
ALTER TABLE `artworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
