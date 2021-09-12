-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 09 juin 2019 à 18:30
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `sigle` varchar(255) NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`, `sigle`, `date_creation`, `date_modification`) VALUES
(2, 'Sciences Mathematiques et Aide Decision', 'siad', '2019-06-05 13:16:46', '2019-06-05 13:16:46'),
(3, 'Sciences et Technologies Industrielles et Civiles', 'stic', '2019-06-05 13:16:46', '2019-06-05 13:16:46'),
(4, 'Telecom', 'telecom', '2019-06-05 13:16:46', '2019-06-05 13:16:46');

-- --------------------------------------------------------

--
-- Structure de la table `motif_reunion`
--

DROP TABLE IF EXISTS `motif_reunion`;
CREATE TABLE IF NOT EXISTS `motif_reunion` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `motif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `motif_reunion`
--

INSERT INTO `motif_reunion` (`ID`, `motif`) VALUES
(1, 'Réunion conseil etablissement'),
(2, 'Réunion commission pédagogique'),
(3, 'Réunion commission de recherche scientifique'),
(4, 'Réunion commisssion culturelle'),
(5, 'Réunion filière'),
(6, 'Réunion AG département'),
(7, 'Réunion syndicat et réunion délibérations');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `seen` enum('0','1') DEFAULT '0',
  `prof_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk1` (`prof_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `created_at`, `seen`, `prof_id`, `subject_id`) VALUES
(1, 'reservation_request_sent', '2019-06-06 16:57:01', '1', 2, 1),
(2, 'reservation_request_sent', '2019-06-06 16:57:15', '1', 2, 1),
(3, 'reservation_request_sent', '2019-06-06 16:57:47', '1', 2, 1),
(4, 'reservation_request_accepted', '2019-06-06 17:40:28', '1', 1, 2),
(5, 'reservation_request_accepted', '2019-06-08 00:32:24', '1', 1, 2),
(6, 'reservation_request_sent', '2019-06-08 01:52:09', '1', 2, 1),
(7, 'reservation_request_sent', '2019-06-08 02:34:40', '1', 2, 1),
(8, 'reservation_request_sent', '2019-06-08 15:50:17', '1', 2, 1),
(9, 'reservation_request_sent', '2019-06-09 03:40:32', '1', 2, 1),
(10, 'reservation_request_update', '2019-06-09 04:42:49', '1', 2, 1),
(11, 'reservation_request_waiting', '2019-06-09 04:56:58', '1', 1, 2),
(12, 'reservation_request_delete', '2019-06-09 04:59:39', '1', 2, 1),
(13, 'reservation_request_delete', '2019-06-09 05:08:59', '1', 1, 2),
(14, 'reservation_request_delete', '2019-06-09 05:16:45', '1', 2, 1),
(15, 'profile_update', '2019-06-09 06:30:53', '0', 1, 3),
(16, 'profile_update', '2019-06-09 06:56:29', '1', 2, 1),
(17, 'profile_update', '2019-06-09 07:04:13', '1', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `mot_de_pass` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `departement` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_ajout` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` enum('0','1') DEFAULT '0',
  `droit` enum('A','U') DEFAULT 'U',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id`, `login`, `mot_de_pass`, `nom`, `prenom`, `departement`, `telephone`, `email`, `date_ajout`, `date_modification`, `active`, `droit`) VALUES
(1, 'user1', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', 'Lamah', 'Michel Marie', 'gi', '0622757768', 'michelmarie@gmail.com', '2019-06-03 21:55:50', '2019-06-09 15:45:30', '1', 'A'),
(2, 'user2', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', 'Mike', 'Will', 'stic', '06-22-75-77-68', 'user2@gmail.com', '2019-06-05 03:57:39', '2019-06-09 07:04:13', '1', 'U'),
(3, 'user4', 'b789883e8fc4f034ff9b1626dea4b70a70222bd0', 'Foussoul', 'Hanane', 'siad', '06-25-85-78-98', 'hananefoussoul@gmail.com', '2019-06-08 15:56:12', '2019-06-09 06:30:53', '1', 'U'),
(4, 'amine', '20eabe5d64b0e216796e834f52d61fd0b70332fc', NULL, NULL, NULL, NULL, 'ssissine.amine@gmail.com', '2019-06-08 16:09:28', '2019-06-08 23:30:50', '0', 'U'),
(5, 'user3', 'b2ee60370ad57d9bc3877e9024c507ab99303a64', NULL, NULL, NULL, NULL, 'user3@gmail.com', '2019-06-08 16:39:50', '2019-06-08 23:30:50', '0', 'U');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_d` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_m` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `motif` varchar(255) DEFAULT NULL,
  `id_prof` int(11) DEFAULT NULL,
  `etat` enum('0','1','2') DEFAULT '0',
  `date_r` date DEFAULT NULL,
  `salle_r` varchar(255) DEFAULT NULL,
  `heure_d` time DEFAULT NULL,
  `heure_f` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `date_d`, `date_m`, `motif`, `id_prof`, `etat`, `date_r`, `salle_r`, `heure_d`, `heure_f`) VALUES
(1, '2019-06-06 16:57:01', '2019-06-08 02:58:34', 'Reunion conseil etablissement', 2, '1', '2019-06-04', 'salle de reunion 1', NULL, NULL),
(2, '2019-06-06 16:57:15', '2019-06-08 23:48:48', 'Réunion commission pédagogique', 2, '1', '2019-06-10', 'salle de reunion 1', '12:30:00', '14:00:00'),
(3, '2019-06-06 16:57:47', '2019-06-08 23:48:48', 'Réunion commission de recherche scientifique', 2, '2', '2019-06-13', 'salle de reunion 1', '14:20:40', '15:12:25');

-- --------------------------------------------------------

--
-- Structure de la table `salle_reunion`
--

DROP TABLE IF EXISTS `salle_reunion`;
CREATE TABLE IF NOT EXISTS `salle_reunion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle_reunion`
--

INSERT INTO `salle_reunion` (`id`, `intitule`) VALUES
(11, 'salle de reunion 4'),
(2, 'salle de reunion 3'),
(8, 'salle de reunion 2'),
(7, 'salle de reunion 1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
