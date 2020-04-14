-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 avr. 2020 à 12:19
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ebayece`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `IDAcheteur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CGU` tinyint(1) NOT NULL DEFAULT '0',
  `#IDAdresse` int(11) NOT NULL,
  `#IDEnchere` int(11) DEFAULT NULL,
  `#IDNego` int(11) DEFAULT NULL,
  `#IDCommande` int(11) DEFAULT NULL,
  `#IDTransaction` int(11) DEFAULT NULL,
  `#IDCB` int(11) DEFAULT NULL,
  `#IDPanier` int(11) NOT NULL,
  PRIMARY KEY (`IDAcheteur`),
  KEY `#IDAdresse` (`#IDAdresse`),
  KEY `#IDEnchere` (`#IDEnchere`),
  KEY `#IDNego` (`#IDNego`),
  KEY `#IDCommande` (`#IDCommande`),
  KEY `#IDTransaction` (`#IDTransaction`),
  KEY `#IDCB` (`#IDCB`),
  KEY `#IDPanier` (`#IDPanier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `IDAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `#IDArticle` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDAdmin`),
  KEY `#IDArticle` (`#IDArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `IDAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `AdrLigne1` varchar(255) NOT NULL,
  `AdrLigne2` varchar(255) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `CodePostal` int(11) NOT NULL,
  `Pays` varchar(255) NOT NULL,
  `NumTel` int(11) NOT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  `#IDCommande` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDAdresse`),
  KEY `#IDAcheteur` (`#IDAcheteur`),
  KEY `#IDCommande` (`#IDCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `IDArticle` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `TypeArticle` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL,
  `VenteEnchere` tinyint(1) NOT NULL DEFAULT '0',
  `VenteImmediat` tinyint(1) NOT NULL DEFAULT '0',
  `VenteBestOffer` tinyint(1) NOT NULL DEFAULT '0',
  `DateLim` date DEFAULT NULL,
  `#IDVendeur` int(11) NOT NULL,
  `#CheminVideo` varchar(255) DEFAULT NULL,
  `#CheminImage` varchar(255) DEFAULT NULL,
  `#IDEnchere` int(11) DEFAULT NULL,
  `#IDNego` int(11) DEFAULT NULL,
  `#IDCommande` int(11) DEFAULT NULL,
  `#IDPanier` int(11) DEFAULT NULL,
  `#IDAdmin` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDArticle`),
  KEY `#IDVendeur` (`#IDVendeur`),
  KEY `#IDVideo` (`#CheminVideo`),
  KEY `#IDImage` (`#CheminImage`),
  KEY `#IDEnchere` (`#IDEnchere`),
  KEY `#IDNego` (`#IDNego`),
  KEY `#IDCommande` (`#IDCommande`),
  KEY `#IDPanier` (`#IDPanier`),
  KEY `#IDAdmin` (`#IDAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cartebancaire`
--

DROP TABLE IF EXISTS `cartebancaire`;
CREATE TABLE IF NOT EXISTS `cartebancaire` (
  `IDCB` int(11) NOT NULL AUTO_INCREMENT,
  `NumCarte` int(11) NOT NULL,
  `DateExpiration` date NOT NULL,
  `NomAffiche` varchar(255) NOT NULL,
  `CodeSecur` int(11) NOT NULL,
  `TypeCarte` varchar(255) NOT NULL,
  `#IDTransaction` int(11) DEFAULT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  PRIMARY KEY (`IDCB`),
  KEY `#IDTransaction` (`#IDTransaction`),
  KEY `#IDAcheteur` (`#IDAcheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `IDCommande` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `FraisLivraison` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `#IDArticle` int(11) NOT NULL,
  `#IDVendeur` int(11) NOT NULL,
  `#IDAdresse` int(11) NOT NULL,
  `#IDTransaction` int(11) NOT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  PRIMARY KEY (`IDCommande`),
  KEY `#IDArticle` (`#IDArticle`),
  KEY `#IDVendeur` (`#IDVendeur`),
  KEY `#IDAdresse` (`#IDAdresse`),
  KEY `#IDTransaction` (`#IDTransaction`),
  KEY `#IDAcheteur` (`#IDAcheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `IDEnchere` int(11) NOT NULL AUTO_INCREMENT,
  `MontantMaxAch` int(11) NOT NULL,
  `DateProposition` date NOT NULL,
  `Accepte` tinyint(1) NOT NULL DEFAULT '0',
  `#IDAchteur` int(11) NOT NULL,
  `#IDArticle` int(11) NOT NULL,
  PRIMARY KEY (`IDEnchere`),
  KEY `#IDAchteur` (`#IDAchteur`),
  KEY `#IDArticle` (`#IDArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `CheminImg` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `#IDVendeur` int(11) NOT NULL,
  `#IDArticle` int(11) NOT NULL,
  PRIMARY KEY (`CheminImg`),
  KEY `#IDVendeur` (`#IDVendeur`),
  KEY `#IDArticle` (`#IDArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `negociation`
--

DROP TABLE IF EXISTS `negociation`;
CREATE TABLE IF NOT EXISTS `negociation` (
  `IDNego` int(11) NOT NULL AUTO_INCREMENT,
  `NBNego` int(11) NOT NULL,
  `DerniereOffre` int(11) NOT NULL,
  `Accepte` tinyint(1) NOT NULL DEFAULT '0',
  `#IDArticle` int(11) NOT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  PRIMARY KEY (`IDNego`),
  KEY `#IDArticle` (`#IDArticle`),
  KEY `#IDAcheteur` (`#IDAcheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `IDPanier` int(11) NOT NULL AUTO_INCREMENT,
  `SousTotal` int(11) NOT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  `#IDArticle` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDPanier`),
  KEY `#IDAcheteur` (`#IDAcheteur`),
  KEY `#IDArticle` (`#IDArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `IDTransaction` int(11) NOT NULL AUTO_INCREMENT,
  `Montant` int(11) NOT NULL,
  `Date` date NOT NULL,
  `#IDVendeur` int(11) NOT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  `#IDCommande` int(11) NOT NULL,
  `#IDCB` int(11) NOT NULL,
  PRIMARY KEY (`IDTransaction`),
  KEY `#IDVendeur` (`#IDVendeur`),
  KEY `#IDAcheteur` (`#IDAcheteur`),
  KEY `#IDCommande` (`#IDCommande`),
  KEY `#IDCB` (`#IDCB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `IDVendeur` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `#CheminImg` varchar(255) NOT NULL,
  `#IDArticle` int(11) NOT NULL,
  `#IDCommande` int(11) DEFAULT NULL,
  `#IDTransaction` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDVendeur`),
  KEY `#CheminImg` (`#CheminImg`),
  KEY `#IDArticle` (`#IDArticle`),
  KEY `#IDCommande` (`#IDCommande`),
  KEY `#IDTransaction` (`#IDTransaction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `CheminVideo` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `#IDArticle` int(11) NOT NULL,
  PRIMARY KEY (`CheminVideo`),
  KEY `#IDArticle` (`#IDArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD CONSTRAINT `acheteur_ibfk_1` FOREIGN KEY (`#IDCommande`) REFERENCES `commande` (`IDCommande`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `acheteur_ibfk_2` FOREIGN KEY (`#IDPanier`) REFERENCES `panier` (`IDPanier`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `acheteur_ibfk_3` FOREIGN KEY (`#IDAdresse`) REFERENCES `adresse` (`IDAdresse`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `acheteur_ibfk_4` FOREIGN KEY (`#IDCB`) REFERENCES `cartebancaire` (`IDCB`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `acheteur_ibfk_5` FOREIGN KEY (`#IDEnchere`) REFERENCES `enchere` (`IDEnchere`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `acheteur_ibfk_6` FOREIGN KEY (`#IDNego`) REFERENCES `negociation` (`IDNego`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `acheteur_ibfk_7` FOREIGN KEY (`#IDTransaction`) REFERENCES `transaction` (`IDTransaction`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adresse_ibfk_2` FOREIGN KEY (`#IDCommande`) REFERENCES `commande` (`IDCommande`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`#IDAdmin`) REFERENCES `administrateur` (`IDAdmin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`#IDCommande`) REFERENCES `commande` (`IDCommande`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_3` FOREIGN KEY (`#IDEnchere`) REFERENCES `enchere` (`IDEnchere`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_4` FOREIGN KEY (`#IDNego`) REFERENCES `negociation` (`IDNego`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_5` FOREIGN KEY (`#IDPanier`) REFERENCES `panier` (`IDPanier`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_6` FOREIGN KEY (`#IDVendeur`) REFERENCES `vendeur` (`IDVendeur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_7` FOREIGN KEY (`#CheminImage`) REFERENCES `image` (`CheminImg`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_8` FOREIGN KEY (`#CheminVideo`) REFERENCES `video` (`CheminVideo`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `cartebancaire`
--
ALTER TABLE `cartebancaire`
  ADD CONSTRAINT `cartebancaire_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartebancaire_ibfk_2` FOREIGN KEY (`#IDTransaction`) REFERENCES `transaction` (`IDTransaction`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`#IDAdresse`) REFERENCES `adresse` (`IDAdresse`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_3` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_4` FOREIGN KEY (`#IDTransaction`) REFERENCES `transaction` (`IDTransaction`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_5` FOREIGN KEY (`#IDVendeur`) REFERENCES `vendeur` (`IDVendeur`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`#IDAchteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `enchere_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `image_ibfk_2` FOREIGN KEY (`#IDVendeur`) REFERENCES `vendeur` (`IDVendeur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `negociation`
--
ALTER TABLE `negociation`
  ADD CONSTRAINT `negociation_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `negociation_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `panier` (`IDPanier`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`#IDCB`) REFERENCES `cartebancaire` (`IDCB`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`#IDCommande`) REFERENCES `commande` (`IDCommande`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`#IDVendeur`) REFERENCES `vendeur` (`IDVendeur`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD CONSTRAINT `vendeur_ibfk_1` FOREIGN KEY (`#CheminImg`) REFERENCES `image` (`CheminImg`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `vendeur_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `vendeur_ibfk_3` FOREIGN KEY (`#IDCommande`) REFERENCES `commande` (`IDCommande`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `vendeur_ibfk_4` FOREIGN KEY (`#IDTransaction`) REFERENCES `transaction` (`IDTransaction`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
