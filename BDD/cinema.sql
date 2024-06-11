-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 11 juin 2024 à 16:00
-- Version du serveur : 10.6.18-MariaDB
-- Version de PHP : 8.1.28
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de données : `cinema`
--
-- --------------------------------------------------------
--
-- Structure de la table `disponibilite`
--
CREATE TABLE `disponibilite` (
  `ID` int(10) UNSIGNED NOT NULL,
  `fk_id_film` int(10) UNSIGNED NOT NULL,
  `date_fin` date NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Déchargement des données de la table `disponibilite`
--
INSERT INTO
  `disponibilite` (`ID`, `fk_id_film`, `date_fin`)
VALUES
  (1, 1, '2033-04-15'),
  (2, 2, '2027-04-15'),
  (3, 3, '2032-04-15'),
  (4, 4, '2024-04-15'),
  (5, 5, '2030-04-15'),
  (6, 6, '2024-04-15'),
  (7, 7, '2028-04-15'),
  (8, 8, '2024-04-15'),
  (9, 9, '2033-04-15'),
  (10, 10, '2028-04-15');

-- --------------------------------------------------------
--
-- Structure de la table `film`
--
CREATE TABLE `film` (
  `ID` int(10) UNSIGNED NOT NULL,
  `titre_film` varchar(255) NOT NULL,
  `fk_id_rea` int(10) UNSIGNED DEFAULT NULL,
  `duree` int(11) NOT NULL,
  `synopsis` text DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `disponibilite` enum('a l''affiche', 'bientot') NOT NULL DEFAULT 'bientot',
  `image_path` varchar(255) DEFAULT NULL,
  `annee_sortie` year(4) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Déchargement des données de la table `film`
--
INSERT INTO
  `film` (
    `ID`,
    `titre_film`,
    `fk_id_rea`,
    `duree`,
    `synopsis`,
    `trailer_url`,
    `disponibilite`,
    `image_path`,
    `annee_sortie`,
    `image_slider`
  )
VALUES
  (
    1,
    'Dune',
    1,
    155,
    'Un film de science-fiction épique basé sur le roman du même nom de Frank Herbert, réalisé par Denis Villeneuve.',
    'https://www.youtube-nocookie.com/embed/gHt8tCHbB2M',
    'a l\'affiche',
    'images/m1.jpeg',
    '2021',
    'images/slider/dune.jpg'
  ),
  (
    2,
    'Spider-Man: No Way Home',
    2,
    148,
    'Un film de super-héros dans lequel Peter Parker cherche l\'aide du Docteur Strange pour faire oublier son identité de Spider-Man au monde, avec des conséquences inattendues.',
    'https://www.youtube-nocookie.com/embed/7w_w10HVa54',
    'a l\'affiche',
    'images/m2.jpeg',
    '2021',
    'images/slider/spider.jpg'
  ),
  (
    3,
    'Tenet',
    3,
    150,
    'Un film de science-fiction et d\'action réalisé par Christopher Nolan, explorant les concepts de voyage dans le temps et d\'inversion temporelle.',
    'https://www.youtube-nocookie.com/embed/NQ5p6WYYK-s',
    'a l\'affiche',
    'images/m3.jpeg',
    '2020',
    'images/slider/Tenet.jpg'
  ),
  (
    4,
    'Black Widow',
    4,
    134,
    'Un film de l\'univers Marvel centré sur le personnage de Natasha Romanoff, explorant son passé et ses aventures entre les événements des films précédents de l\'MCU.',
    'https://www.youtube-nocookie.com/embed/4l99M0zOEaA',
    'a l\'affiche',
    'images/m4.jpeg',
    '2021',
    'images/slider/black_widow.jpg'
  ),
  (
    5,
    'Luca',
    5,
    95,
    'Un film d\'animation de Pixar situé sur la Riviera italienne, racontant l\'histoire d\'un jeune garçon vivant un été inoubliable, avec un secret : c\'est un monstre marin d\'un autre monde.',
    'https://www.youtube-nocookie.com/embed/RA4s_BgzFII',
    'a l\'affiche',
    'images/m5.jpeg',
    '2021',
    'images/slider/luca.png'
  ),
  (
    6,
    'Top Gun: Maverick',
    6,
    131,
    'La suite tant attendue du classique de 1986, avec Tom Cruise reprenant son rôle iconique de pilote de chasse.',
    'https://www.youtube-nocookie.com/embed/RqoVqZXEpgc',
    'bientot',
    'images/coming1.jpeg',
    '2022',
    'images/slider/topgun.jpg'
  ),
  (
    7,
    'The Batman',
    7,
    176,
    'Une nouvelle interprétation du célèbre super-héros, avec Robert Pattinson dans le rôle principal.',
    'https://www.youtube-nocookie.com/embed/hWRSJlp50rQ',
    'bientot',
    'images/coming2.jpeg',
    '2022',
    'images/slider/batman.jpg'
  ),
  (
    8,
    'Minions: The Rise of Gru',
    8,
    90,
    'Ce film d\'animation explore les origines du personnage de Gru, le méchant adoré de la franchise Moi, Moche et Méchant, et son rêve de devenir le plus grand supervilain du monde.',
    'https://www.youtube-nocookie.com/embed/aGxyOwkwJyc',
    'bientot',
    'images/coming3.jpeg',
    '2022',
    'images/slider/minion.jpg'
  ),
  (
    9,
    'Avatar: The Way of Water',
    9,
    192,
    'La suite tant attendue du blockbuster de 2009, promettant de nouvelles avancées technologiques en matière d\'effets spéciaux.',
    'https://www.youtube-nocookie.com/embed/2UEkizpGKDU',
    'bientot',
    'images/coming4.jpeg',
    '2022',
    'images/slider/avatar.jpg'
  ),
  (
    10,
    'Jurassic World: Dominion',
    10,
    147,
    'Le dernier opus de la franchise Jurassic Park, promettant de l\'action et des dinosaures encore plus impressionnants.',
    'https://www.youtube-nocookie.com/embed/8UZ6NOLR9sQ',
    'bientot',
    'images/coming5.jpeg',
    '2022',
    'images/slider/jurassic.jpg'
  );

-- --------------------------------------------------------
--
-- Structure de la table `film_genre`
--
CREATE TABLE `film_genre` (
  `film_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Déchargement des données de la table `film_genre`
--
INSERT INTO
  `film_genre` (`film_id`, `genre_id`)
VALUES
  (1, 2),
  (1, 8),
  (1, 14),
  (2, 1),
  (2, 2),
  (2, 14),
  (3, 1),
  (3, 14),
  (3, 17),
  (4, 1),
  (4, 2),
  (4, 6),
  (5, 2),
  (5, 3),
  (5, 5),
  (6, 1),
  (6, 2),
  (6, 8),
  (7, 1),
  (7, 6),
  (7, 8),
  (8, 2),
  (8, 3),
  (8, 5),
  (9, 1),
  (9, 2),
  (9, 14),
  (10, 1),
  (10, 2),
  (10, 14);

-- --------------------------------------------------------
--
-- Structure de la table `genre`
--
CREATE TABLE `genre` (
  `ID` int(10) UNSIGNED NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Déchargement des données de la table `genre`
--
INSERT INTO
  `genre` (`ID`, `genre`)
VALUES
  (1, 'Action'),
  (2, 'Aventure'),
  (3, 'Animation'),
  (4, 'Biographie'),
  (5, 'Comedie'),
  (6, 'Crime'),
  (7, 'Documentaire'),
  (8, 'Drame'),
  (9, 'Fantasie'),
  (10, 'Historique'),
  (11, 'Horreur'),
  (12, 'Musical'),
  (13, 'Romance'),
  (14, 'Science-Fiction'),
  (15, 'Sport'),
  (16, 'Super-hero'),
  (17, 'Thriller'),
  (18, 'Guerre'),
  (19, 'Western');

-- --------------------------------------------------------
--
-- Structure de la table `realisateur`
--
CREATE TABLE `realisateur` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Déchargement des données de la table `realisateur`
--
INSERT INTO
  `realisateur` (`ID`, `nom`, `prenom`)
VALUES
  (9, 'Cameron', 'James'),
  (8, 'Balda', 'Kyle'),
  (7, 'Reeves', 'Matt'),
  (6, 'Kosinski', 'Joseph'),
  (5, 'Casarosa', 'Enrico'),
  (4, 'Shortland', 'Cate'),
  (3, 'Nolan', 'Christopher'),
  (2, 'Watts', 'Jon'),
  (1, 'Villeneuve', 'Denis'),
  (10, 'Trevorrow', 'Colin');

-- --------------------------------------------------------
--
-- Structure de la table `reservation`
--
CREATE TABLE `reservation` (
  `ID` int(10) UNSIGNED NOT NULL,
  `fk_id_film` int(10) UNSIGNED NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `reservation_temp` timestamp NULL DEFAULT current_timestamp(),
  `confirmation` tinyint(1) DEFAULT 0
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--
--
-- Index pour la table `disponibilite`
--
ALTER TABLE
  `disponibilite`
ADD
  PRIMARY KEY (`ID`),
ADD
  KEY `fk_id_film` (`fk_id_film`);

--
-- Index pour la table `film`
--
ALTER TABLE
  `film`
ADD
  PRIMARY KEY (`ID`),
ADD
  KEY `fk_id_rea` (`fk_id_rea`);

--
-- Index pour la table `film_genre`
--
ALTER TABLE
  `film_genre`
ADD
  PRIMARY KEY (`film_id`, `genre_id`),
ADD
  KEY `genre_id` (`genre_id`);

--
-- Index pour la table `genre`
--
ALTER TABLE
  `genre`
ADD
  PRIMARY KEY (`ID`);

--
-- Index pour la table `realisateur`
--
ALTER TABLE
  `realisateur`
ADD
  PRIMARY KEY (`ID`);

--
-- Index pour la table `reservation`
--
ALTER TABLE
  `reservation`
ADD
  PRIMARY KEY (`ID`),
ADD
  KEY `fk_id_film` (`fk_id_film`);

--
-- AUTO_INCREMENT pour les tables déchargées
--
--
-- AUTO_INCREMENT pour la table `disponibilite`
--
ALTER TABLE
  `disponibilite`
MODIFY
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE
  `film`
MODIFY
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE
  `genre`
MODIFY
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 20;

--
-- AUTO_INCREMENT pour la table `realisateur`
--
ALTER TABLE
  `realisateur`
MODIFY
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11120;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE
  `reservation`
MODIFY
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;