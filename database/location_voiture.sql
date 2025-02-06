-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 06 fév. 2025 à 08:15
-- Version du serveur : 5.7.31
-- Version de PHP : 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location_voiture`
--

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `id_car` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `registration` varchar(10) NOT NULL,
  `name_car` varchar(255) NOT NULL,
  `mark` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price_day` varchar(10) NOT NULL,
  PRIMARY KEY (`id_car`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id_car`, `id_type`, `registration`, `name_car`, `mark`, `available`, `price_day`) VALUES
(2, 1, '2031 TAB', 'ITCA 2', 'Suzuki', 1, '4000'),
(3, 1, '2032 TAA', 'ITCA 2', 'Mitsubishi', 1, '2500'),
(4, 2, '2033 TAA', 'Tsy hay', 'Opel', 1, '5000'),
(7, 1, 'ABC-1234', 'Explorer X', 'Ford', 1, '75'),
(8, 1, 'ABC-1234', 'Explorer X', 'Ford', 1, '75'),
(9, 1, 'ABC-1234', 'Explorer X', 'Ford', 1, '75'),
(10, 2, '2030 TAA', 'tfuygjh', 'Mitsubishi', 1, '235'),
(11, 2, '2030 TAA', 'tfuygjh', 'Mitsubishi', 1, '235'),
(13, 2, '2030 TAA', 'tfuygjh', 'Mitsubishi', 1, '235'),
(14, 2, '2030 TAA', 'tfuygjh', 'Mitsubishi', 1, '235'),
(15, 2, '2030 TAA', 'tfuygjh', 'Mitsubishi', 1, '235');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adress_client` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `id_receipt` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `id_car` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reservation_date` date NOT NULL,
  `paiement_type` enum('Cheque','Mobile Money','Virement Bancaire','Espece') NOT NULL,
  `price` varchar(255) NOT NULL,
  PRIMARY KEY (`id_receipt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(3) NOT NULL AUTO_INCREMENT,
  `name_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `name_type`, `description`) VALUES
(1, 'Familial', 'Voiture pour la famille avec plus de 6 places'),
(2, 'Business', 'Voiture pour le travail avec moins de 6 places'),
(3, 'Tout terrain', 'Voiture pour la campagne');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'ITCA', 'contact@itconceptor.com', '12345678');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
