-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2020 at 12:48 PM
-- Server version: 5.7.19
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gedoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `boncommane`
--

DROP TABLE IF EXISTS `boncommane`;
CREATE TABLE IF NOT EXISTS `boncommane` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `qte` float NOT NULL,
  `unite` varchar(25) NOT NULL,
  `prixU` float NOT NULL,
  `tvaP` int(11) NOT NULL,
  `tva` float NOT NULL,
  `totalHT` float NOT NULL,
  `totalTTC` float NOT NULL,
  `anace` float NOT NULL,
  `idDoc` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `fk_bnC` (`idDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bonliv`
--

DROP TABLE IF EXISTS `bonliv`;
CREATE TABLE IF NOT EXISTS `bonliv` (
  `idBonLiv` int(11) NOT NULL AUTO_INCREMENT,
  `qteCom` float NOT NULL,
  `qtteLiv` float NOT NULL,
  `proid` float NOT NULL,
  `prix` float NOT NULL,
  `idDoc` int(11) NOT NULL,
  PRIMARY KEY (`idBonLiv`),
  KEY `fk_bonLiv` (`idDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `idContrat` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `duree` float NOT NULL,
  `objectif` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `idDoc` int(11) NOT NULL,
  PRIMARY KEY (`idContrat`),
  KEY `fk_contrat` (`idDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

DROP TABLE IF EXISTS `courier`;
CREATE TABLE IF NOT EXISTS `courier` (
  `idCourier` int(11) NOT NULL AUTO_INCREMENT,
  `objectifs` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `idDoc` int(11) NOT NULL,
  PRIMARY KEY (`idCourier`),
  KEY `fk_courier` (`idDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `idDoc` int(11) NOT NULL AUTO_INCREMENT,
  `nameDoc` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `tailleDoc` int(100) NOT NULL,
  `dateDoc` date NOT NULL,
  `creePar` int(11) NOT NULL,
  `extentionDoc` varchar(10) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idDoc`),
  KEY `id` (`idDoc`),
  KEY `fk_user` (`creePar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `droitacces`
--

DROP TABLE IF EXISTS `droitacces`;
CREATE TABLE IF NOT EXISTS `droitacces` (
  `iduser` int(11) NOT NULL,
  `iddoc` int(11) NOT NULL,
  `idrole` int(11) NOT NULL,
  `nomdroit` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iduser`,`iddoc`,`idrole`),
  KEY `iddoc` (`iddoc`),
  KEY `idrole` (`idrole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extrait`
--

DROP TABLE IF EXISTS `extrait`;
CREATE TABLE IF NOT EXISTS `extrait` (
  `idExtrait` int(11) NOT NULL AUTO_INCREMENT,
  `ref` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `solde` float NOT NULL,
  `idDoc` int(11) NOT NULL,
  PRIMARY KEY (`idExtrait`),
  KEY `fk_extrait` (`idDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `idFacture` int(11) NOT NULL AUTO_INCREMENT,
  `adress` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `modeP` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `idDoc` int(11) NOT NULL,
  PRIMARY KEY (`idFacture`),
  KEY `fk_facture` (`idDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameRole` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nameRole`) VALUES
(17, 'Administration'),
(18, 'responsable-g'),
(19, 'responsable'),
(20, 'employÃ©'),
(23, 'wiemmmm');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` int(8) NOT NULL,
  `CIN` int(8) NOT NULL,
  `idenUnique` int(20) NOT NULL,
  `service` enum('administration','production','achat','commercial','IT et telecommunication','marketing','developpement','ressource humaine','technique','transport et logestique','planning','magasin','comptabilité et finance') DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `adresse`, `email`, `telephone`, `CIN`, `idenUnique`, `service`, `login`, `motDePasse`) VALUES
(1, 'wassim', 'ze', 'hjghjghvfhgvj', 'jhjnn@gmail.com', 22563254, 25836912, 124523, NULL, 'admin', 'admin'),
(6, 'zeramdini', 'wiem', '10 rue med akber miled sayada 5053', 'wiem.zeramdini@gmail.com', 99329514, 14001251, 123456789, NULL, 'zeramdiniwiem', 'zeramdini@wiem');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boncommane`
--
ALTER TABLE `boncommane`
  ADD CONSTRAINT `fk_bnC` FOREIGN KEY (`idDoc`) REFERENCES `document` (`idDoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bonliv`
--
ALTER TABLE `bonliv`
  ADD CONSTRAINT `fk_bonLiv` FOREIGN KEY (`idDoc`) REFERENCES `document` (`idDoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `fk_contrat` FOREIGN KEY (`idDoc`) REFERENCES `document` (`idDoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courier`
--
ALTER TABLE `courier`
  ADD CONSTRAINT `fk_courier` FOREIGN KEY (`idDoc`) REFERENCES `document` (`idDoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`creePar`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `droitacces`
--
ALTER TABLE `droitacces`
  ADD CONSTRAINT `droitacces_ibfk_1` FOREIGN KEY (`iddoc`) REFERENCES `document` (`idDoc`),
  ADD CONSTRAINT `droitacces_ibfk_2` FOREIGN KEY (`idrole`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `droitacces_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`);

--
-- Constraints for table `extrait`
--
ALTER TABLE `extrait`
  ADD CONSTRAINT `fk_extrait` FOREIGN KEY (`idDoc`) REFERENCES `document` (`idDoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_facture` FOREIGN KEY (`idDoc`) REFERENCES `document` (`idDoc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
