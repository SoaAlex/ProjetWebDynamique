-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 16 avr. 2020 à 20:39
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
-- Base de données :  `bddebay`
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
  PRIMARY KEY (`IDAcheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`IDAcheteur`, `Nom`, `Prenom`, `Mail`, `Password`, `CGU`) VALUES
(1, 'SOARES', 'Alexandre', 'alexandre.soares@edu.ece.fr', '1234', 1),
(2, 'BESSIERES', 'Adrien', 'adrien.bessieres@edu.ece.fr', '1234', 1),
(6, 'John', 'Cena', 'john.cena@edu.ece.fr', '1234', 1);

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `IDAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`IDAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`IDAdmin`, `Nom`, `Prenom`, `Mail`, `Password`) VALUES
(1, 'LE STANG', 'Paul', 'Paul.le-stang@edu.ece.fr', '1234');

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
  `NumTel` int(15) NOT NULL,
  `#IDAcheteur` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDAdresse`),
  KEY `#IDAcheteur` (`#IDAcheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`IDAdresse`, `AdrLigne1`, `AdrLigne2`, `Ville`, `CodePostal`, `Pays`, `NumTel`, `#IDAcheteur`) VALUES
(1, '37 Quai de Grenelle', 'Immeuble Pollux', 'PARIS', 75015, 'FRANCE', 303030303, 2),
(2, '9 RUE BOULARD', 'BAT B', 'PARIS', 75017, 'FRANCE', 606060606, 1),
(3, '29 rue des Dieux', 'Heaven', 'LeHavre', 12457, 'Paradis', 712457896, 6);

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
  `DateLim` date NOT NULL,
  `#IDCommande` int(11) DEFAULT NULL,
  `#IDVendeur` int(11) DEFAULT NULL,
  `#IDAdmin` int(11) DEFAULT NULL,
  `CheminVideo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`IDArticle`),
  KEY `#IDCommande` (`#IDCommande`),
  KEY `#IDVendeur` (`#IDVendeur`),
  KEY `#IDAdmin` (`#IDAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`IDArticle`, `Nom`, `Description`, `TypeArticle`, `Prix`, `VenteEnchere`, `VenteImmediat`, `VenteBestOffer`, `DateLim`, `#IDCommande`, `#IDVendeur`, `#IDAdmin`, `CheminVideo`) VALUES
(1, 'Piece rare', 'Je suis une description nulle d\'article. Je suis une description nulle d\'article. Je suis une description nulle d\'article. Je suis une description nulle d\'article.\r\nJe suis une description nulle d\'article.\r\nJe suis une description nulle d\'article.', 'Ferraille', 50, 1, 0, 0, '2020-04-29', NULL, 1, NULL, NULL),
(2, 'Picasso', 'Je suis une description nulle d\'article', 'Musee', 100, 0, 1, 0, '2020-04-29', NULL, 1, NULL, NULL),
(3, 'Anneau', 'Je suis une description nulle d\'article', 'VIP', 200, 0, 0, 1, '2020-04-21', NULL, 1, NULL, NULL),
(4, 'La nuit étoilée', 'Je suis une description nulle d\'article', 'Musee', 200, 0, 1, 1, '2020-04-21', NULL, 1, NULL, NULL),
(6, 'Houloucoptere', 'Un bel houloucoptere qui voule tres bien ', 'FerrailleOuTresor', 21, 0, 1, 0, '2020-05-18', NULL, 1, NULL, 'https://www.youtube.com/watch?v=Tmc2pksB-ao&t=1031s');

-- --------------------------------------------------------

--
-- Structure de la table `choixarticles`
--

DROP TABLE IF EXISTS `choixarticles`;
CREATE TABLE IF NOT EXISTS `choixarticles` (
  `IDChoix` int(11) NOT NULL AUTO_INCREMENT,
  `#IDAcheteur` int(11) NOT NULL,
  `#IDArticle` int(11) NOT NULL,
  PRIMARY KEY (`IDChoix`),
  KEY `#IDAcheteur` (`#IDAcheteur`),
  KEY `#IDArticle` (`#IDArticle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `choixarticles`
--

INSERT INTO `choixarticles` (`IDChoix`, `#IDAcheteur`, `#IDArticle`) VALUES
(1, 1, 1),
(2, 2, 3);

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
  `#IDAcheteur` int(11) NOT NULL,
  `#IDAdresse` int(11) NOT NULL,
  `#IDVendeur` int(11) NOT NULL,
  PRIMARY KEY (`IDCommande`),
  KEY `#IDAcheteur` (`#IDAcheteur`),
  KEY `#IDAdresse` (`#IDAdresse`),
  KEY `#IDVendeur` (`#IDVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`IDCommande`, `Date`, `FraisLivraison`, `Total`, `#IDAcheteur`, `#IDAdresse`, `#IDVendeur`) VALUES
(2, '2020-04-14', 10, 200, 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `IDEnchere` int(11) NOT NULL AUTO_INCREMENT,
  `MontantMaxAcheteur` int(11) NOT NULL,
  `DateProposition` date NOT NULL,
  `Accepte` tinyint(1) NOT NULL DEFAULT '0',
  `#IDArticle` int(11) NOT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  PRIMARY KEY (`IDEnchere`),
  KEY `#IDArticle` (`#IDArticle`),
  KEY `#IDAcheteur` (`#IDAcheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`IDEnchere`, `MontantMaxAcheteur`, `DateProposition`, `Accepte`, `#IDArticle`, `#IDAcheteur`) VALUES
(1, 400, '2020-04-15', 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `CheminImg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `#IDArticle` int(11) DEFAULT NULL,
  `#IDVendeur` int(11) DEFAULT NULL,
  KEY `#IDArticle` (`#IDArticle`),
  KEY `#IDVendeur` (`#IDVendeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`CheminImg`, `Nom`, `#IDArticle`, `#IDVendeur`) VALUES
('../img/Articles/anneau.jpg', 'Anneau', 3, NULL),
('../img/Articles/Picasso.jpg', 'Picasso', 2, NULL),
('../img/Articles/piecerare.jpg', 'Pièce Rare', 1, NULL),
('../img/Articles/tabVanGogh.jpg', 'La nuit étoilée', 4, NULL),
('../img/Vendeur/collectionneur.jpg', 'Collectionneur', NULL, 1),
('../img/Vendeur/collectionneurBack.jpg', 'Magasin vendeur collectionneur', NULL, 1),
('https://upload.wikimedia.org/wikipedia/commons/7/70/RAN_squirrel_helicopter_at_melb_GP_08.jpg', 'Houloucoptere', 6, NULL),
('https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Bell_206B_Jet_Ranger_III_at_Filton_Airfield_2006-06-10.jpg/1280px-Bell_206B_Jet_Ranger_III_at_Filton_Airfield_2006-06-10.jpg', 'Houloucoptere', 6, NULL),
('https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Helicoptere-pilote.JPG/1280px-Helicoptere-pilote.JPG', 'Houloucoptere', 6, NULL),
('http://fr.web.img6.acsta.net/r_1920_1080/pictures/19/10/02/09/29/2476575.jpg', 'Lelouch', NULL, 4),
('https://images3.alphacoders.com/474/thumb-1920-47417.jpg', 'Lelouch', NULL, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `negociation`
--

INSERT INTO `negociation` (`IDNego`, `NBNego`, `DerniereOffre`, `Accepte`, `#IDArticle`, `#IDAcheteur`) VALUES
(1, 1, 400, 0, 3, 2);

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
  PRIMARY KEY (`IDVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`IDVendeur`, `Pseudo`, `Mail`, `Password`) VALUES
(1, 'Collectionneur', 'collectionneur@edu.ece.fr', '1234'),
(2, 'pipo', 'pipo@gmail.com', '1234'),
(3, 'pipo2', 'pipo2@gmail.com', '1234'),
(4, 'Lelouch', 'lulu@edu.ece.fr', '1234');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`#IDAdmin`) REFERENCES `administrateur` (`IDAdmin`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`#IDCommande`) REFERENCES `commande` (`IDCommande`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_3` FOREIGN KEY (`#IDVendeur`) REFERENCES `vendeur` (`IDVendeur`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `choixarticles`
--
ALTER TABLE `choixarticles`
  ADD CONSTRAINT `choixarticles_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `choixarticles_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`#IDAdresse`) REFERENCES `adresse` (`IDAdresse`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_3` FOREIGN KEY (`#IDVendeur`) REFERENCES `vendeur` (`IDVendeur`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enchere_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `negociation_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `negociation_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;