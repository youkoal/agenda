-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 07 Septembre 2015 à 11:39
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `agenda`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `pass` text NOT NULL,
  `mail` text,
  `tel1` text,
  `tel2` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id`, `pseudo`, `pass`, `mail`, `tel1`, `tel2`) VALUES
(1, 'yollo', '', 'potato@potatomail.fr', 'P-O-T-A-T-O-O23', 'P07470fr'),
(2, 'youk', 'swagg', NULL, NULL, NULL),
(3, 'moo', 'lavache', NULL, NULL, NULL),
(4, 'marco', 'swag', NULL, NULL, NULL),
(5, 'rolang', 'swag', NULL, NULL, NULL),
(6, 'jet', 'swag', NULL, NULL, NULL),
(7, 'grolang', 'swag', NULL, NULL, NULL),
(8, 'elswagitude le swag', 'swag', NULL, NULL, NULL),
(9, 'error_404', 'swag', NULL, NULL, NULL),
(10, 'si c''est pas swag sa', 'as', NULL, NULL, NULL),
(11, 'scroller', 'swag', NULL, NULL, NULL),
(12, 'oneMoreSwag', 'swag', NULL, NULL, NULL),
(13, '', '', NULL, NULL, NULL),
(14, 'scdqesz', 'qeszd', NULL, NULL, NULL),
(15, 'ytrytr', '', NULL, NULL, NULL),
(16, 'tryan', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE IF NOT EXISTS `taches` (
  `id` int(11) DEFAULT NULL,
  `clientId` int(11) DEFAULT NULL,
  `dateEntree` date DEFAULT NULL,
  `dateE` date DEFAULT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `texte` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `taches`
--

INSERT INTO `taches` (`id`, `clientId`, `dateEntree`, `dateE`, `titre`, `texte`) VALUES
(1, 8, '2015-05-11', '2015-11-10', 'Atwood', '5 Barnett Street'),
(2, 3, '2015-08-04', '2015-06-28', 'Manufacturers', '7 Manley Parkway'),
(3, 5, '2015-03-16', '2015-04-27', 'Drewry', '4173 Algoma Way'),
(4, 4, '2015-03-01', '2015-01-23', 'Independence', '0292 American Way'),
(5, 10, '2015-06-21', '2015-03-09', 'Carpenter', '6 Fairview Junction'),
(6, 4, '2015-09-04', '2015-05-20', 'Elka', '3058 Waxwing Terrace'),
(7, 10, '2015-07-04', '2015-07-23', 'Redwing', '1 Manitowish Way'),
(8, 10, '2015-01-18', '2015-08-24', 'Ronald Regan', '40593 Brown Drive'),
(9, 5, '2015-08-10', '2015-05-15', 'Spaight', '8817 Farmco Way'),
(10, 6, '2015-09-05', '2015-07-02', 'Namekagon', '821 Meadow Vale Way'),
(11, 9, '2015-06-18', '2015-12-28', 'Knutson', '2 Northwestern Court'),
(12, 9, '2015-01-04', '2015-10-21', 'Bellgrove', '6320 Lyons Alley'),
(13, 3, '2015-06-27', '2015-12-22', 'Artisan', '95 Golden Leaf Junction'),
(14, 5, '2015-01-07', '2015-01-14', 'Forest', '33 Oxford Way'),
(15, 1, '2015-03-03', '2015-12-04', 'Longview', '2241 Sundown Crossing'),
(16, 9, '2015-08-27', '2015-10-22', 'Lyons', '2 Stone Corner Lane'),
(17, 10, '2015-06-29', '2015-09-05', 'Kropf', '0 Loeprich Junction'),
(18, 9, '2015-03-05', '2015-02-22', 'Monterey', '6 Myrtle Plaza'),
(19, 5, '2015-08-28', '2015-12-30', 'Badeau', '0 Rowland Park'),
(20, 4, '2015-04-04', '2015-09-21', 'Fuller', '9 Schlimgen Circle'),
(21, 1, '2015-07-06', '2015-02-13', 'Ilene', '61 Fairview Park'),
(22, 2, '2015-03-16', '2015-11-14', 'Moulton', '1278 Union Lane'),
(23, 7, '2015-05-08', '2015-12-03', 'Buhler', '9323 Holmberg Court'),
(24, 6, '2015-05-21', '2015-06-20', 'Sherman', '491 Homewood Park'),
(25, 1, '2015-04-22', '2015-03-28', 'Fair Oaks', '78705 Londonderry Hill'),
(26, 8, '2015-08-02', '2015-05-16', 'Homewood', '4870 Jana Alley'),
(27, 3, '2015-04-06', '2015-04-02', 'Stoughton', '89724 Myrtle Trail'),
(28, 10, '2015-01-22', '2015-05-02', 'Main', '3822 Fallview Place'),
(29, 2, '2015-01-08', '2015-09-27', 'Ridgeview', '25 Johnson Circle'),
(30, 3, '2015-08-11', '2015-09-14', 'Melody', '26877 Arrowood Lane'),
(31, 2, '2015-01-17', '2015-12-07', 'Daystar', '77 Dottie Terrace'),
(32, 4, '2015-01-16', '2015-06-15', 'Sage', '65 Springs Hill'),
(33, 8, '2015-06-26', '2015-07-21', 'Garrison', '24 Mockingbird Circle'),
(34, 2, '2015-03-09', '2015-10-02', 'Green Ridge', '3 Fordem Drive'),
(35, 2, '2015-07-15', '2015-01-02', 'Blaine', '8366 Dapin Crossing'),
(36, 7, '2015-01-04', '2015-10-14', 'Manley', '05274 Dawn Circle'),
(37, 1, '2015-08-30', '2015-12-27', 'Charing Cross', '07 Haas Alley'),
(38, 2, '2015-01-10', '2015-07-20', 'Anniversary', '316 Lillian Trail'),
(39, 3, '2015-01-20', '2015-10-07', 'Pepper Wood', '7663 Emmet Terrace'),
(40, 3, '2015-05-07', '2015-10-23', 'Merry', '42 Basil Pass'),
(41, 3, '2015-07-22', '2015-04-27', 'Kenwood', '22298 Northland Avenue'),
(42, 3, '2015-08-28', '2015-11-27', 'Leroy', '10 Messerschmidt Court'),
(43, 4, '2015-06-22', '2015-10-20', 'Boyd', '4513 Commercial Terrace'),
(44, 3, '2015-08-24', '2015-03-07', 'Crest Line', '35366 Nevada Drive'),
(45, 10, '2015-05-15', '2015-03-03', 'Duke', '50 Thompson Hill'),
(46, 6, '2015-09-04', '2015-09-21', 'Bonner', '6677 Dakota Pass'),
(47, 6, '2015-06-28', '2015-11-16', 'Blue Bill Park', '58 Dahle Hill'),
(48, 6, '2015-02-20', '2015-04-03', 'Riverside', '5742 Fordem Alley'),
(49, 7, '2015-03-19', '2015-02-14', 'Gateway', '7 Riverside Alley'),
(50, 10, '2015-07-21', '2015-03-13', 'School', '15474 Birchwood Court');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
