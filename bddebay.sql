-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 avr. 2020 à 13:04
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`IDAcheteur`, `Nom`, `Prenom`, `Mail`, `Password`, `CGU`) VALUES
(1, 'SOARES', 'Alexandre', 'alexandre.soares@edu.ece.fr', '1234', 1),
(2, 'BESSIERES', 'Adrien', 'adrien.bessieres@edu.ece.fr', '1234', 1),
(3, 'Jean', 'Paul', 'jeanpaul@edu.ece.fr', '1234', 1);

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
(3, '28 rue louis', '', 'ROUBAIX', 59100, 'France', 988790, 3);

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
  `CheminVideo` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`IDArticle`),
  KEY `#IDCommande` (`#IDCommande`),
  KEY `#IDVendeur` (`#IDVendeur`),
  KEY `#IDAdmin` (`#IDAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`IDArticle`, `Nom`, `Description`, `TypeArticle`, `Prix`, `VenteEnchere`, `VenteImmediat`, `VenteBestOffer`, `DateLim`, `#IDCommande`, `#IDVendeur`, `#IDAdmin`, `CheminVideo`) VALUES
(1, 'Pièce de 2€ commémorative 2017', 'Cette pièce a été crée pour le 25ème anniversaire du ruban rose qui lutte contre le cancer du sein.', 'Ferraille', 50, 1, 0, 0, '2020-04-29', NULL, 1, NULL, NULL),
(2, 'Jeune fille devant un miroir ,Pablo Picasso', 'Ce tableau sur toile de Pablo Picasso est l\'un de ses plus grand chefs-d\'œuvre. Cette peinture a suscité diverses interprétations, c\'est ce qui fait son charme.', 'Musee', 100, 0, 1, 0, '2020-04-29', NULL, 1, NULL, NULL),
(3, 'Anneau Ancestral', 'Cet anneau est tout droit sorti d\'un film de science fiction.', 'VIP', 200, 0, 0, 1, '2020-04-21', NULL, 1, NULL, NULL),
(4, 'La nuit étoilée, Van Gogh', 'Le tableau est une huile sur toile, il représente ce que Van Gogh pouvait voir de sa chambre d’asile.', 'Musee', 1200, 0, 1, 1, '2020-04-21', NULL, 1, NULL, NULL),
(5, 'kylix, Vase Grec', 'Vase datant de 530 av J.-C fait en Céramique.', 'VIP', 350, 1, 0, 0, '2020-04-29', NULL, 5, NULL, NULL),
(6, 'Aiguière', 'Aiguière en émail peint. La panse de l’aiguière est ornée d’une frise en grisaille.', 'VIP', 800, 0, 0, 1, '2020-04-29', NULL, 4, NULL, NULL),
(7, 'IKB, Yves Klein', 'Ce bleu plus que bleu représente un ciel d’été. Il est d’une profondeur parfaite.', 'Musée', 750, 1, 0, 0, '2020-04-29', NULL, 3, NULL, NULL),
(8, 'St-Georges-Majeur au crépuscule, Claude Monet', 'Cette peinture a été faite pendant la visite de Claude Monet à Venise en automne 1908.', 'Musée', 900, 0, 0, 1, '2020-04-29', NULL, 2, NULL, NULL),
(9, 'Bague Saphira', 'Bague composé d’un saphir ovale de 6.90g sertie de cristaux de diamants blanc.', 'Ferraille', 250, 0, 1, 0, '2020-04-29', NULL, 5, NULL, NULL),
(10, 'Médaillon en or', 'Médaillon ancien rond datant du XVème siècle.', 'Ferraille', 50, 1, 0, 0, '2020-04-29', NULL, 4, NULL, NULL),
(11, 'Dinar en or Umayyad', 'Lot de deux pièces d’or fabriqué à Damas en 723.', 'Ferraille', 550, 0, 0, 1, '2020-04-29', NULL, 4, NULL, NULL),
(12, 'La persistance de la mémoire, Salvador Dalí', 'Cette toile aussi appelée Les Montres molles, est le plus grand chef-d’œuvre de Salvador Dalí.', 'Musée', 3200, 0, 1, 1, '2020-04-29', NULL, 4, NULL, NULL),
(13, 'L\'oiseau de ciel, René Magritte', 'La toile de René Magritte \"L\'Oiseau de Ciel\", représente un oiseau fait de nuages.', 'Musée', 2600, 0, 1, 0, '2020-04-29', NULL, 5, NULL, NULL),
(14, 'Les trois âge de la femme, Gustav Klimt', 'Ce tableau représente comme son nom l\'indique les trois âge de la femme par Klimt', 'Musée', 720, 1, 0, 0, '2020-04-29', NULL, 3, NULL, NULL),
(15, 'Le Déjeuner des canotiers, Auguste Renoir', 'Le Déjeuner des canotiers est une huile sur toile majeure du peintre impressionniste français Auguste Renoir.', 'Musée', 1480, 0, 0, 1, '2020-04-29', NULL, 2, NULL, NULL),
(16, 'Vega-Nor, Victor Vasarely', 'C\'est un excellent exemple de « l\'Op art » (ou art optique) de Vasarely.', 'Musée', 620, 1, 0, 0, '2020-04-29', NULL, 3, NULL, NULL),
(17, 'Infinity Mirror Room Fireflies on Water, Yayoi Kusama', 'Infinity Mirror Room Fireflies on Water est une installation réalisée par Yayoï Kusama', 'Musée', 3000, 0, 1, 0, '2020-04-29', NULL, 5, NULL, NULL),
(18, 'Vase de Soissons', 'Le vase de Soissons est un objet précieux, sujet du récit d\'un événement à caractère historique, qui se serait déroulé après la bataille de Soissons en 486', 'VIP', 2600, 1, 0, 0, '2020-04-29', NULL, 1, NULL, NULL),
(19, 'Jingdezhen Yu Hailin', 'Vase en céramique célèbre peint à la main pastel sculpté dans les règles des grands vases chinois', 'VIP', 250, 0, 1, 0, '2020-04-29', NULL, 4, NULL, NULL),
(20, 'Stamnos', 'Un stamnos est un vase antique qui servait principalement à mélanger et conserver le vin.', 'VIP', 400, 0, 0, 1, '2020-04-29', NULL, 3, NULL, NULL),
(21, 'Oxyde (III) scandium', 'Métal le plus cher au monde d\'une pureté incroyable.', 'Ferraille', 5600, 1, 0, 0, '2020-04-29', NULL, 3, NULL, NULL),
(22, 'Soupière Baroque', 'Cette Soupière Baroque en Argent date du 20ème Siècle ', 'Ferraille', 25, 0, 1, 0, '2020-04-29', NULL, 5, NULL, NULL),
(23, 'Bracelet ancien', 'Bracelet composé d\'or, de diamants et de perles.', 'Ferraille', 460, 0, 0, 1, '2020-04-29', NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cartebancaire`
--

DROP TABLE IF EXISTS `cartebancaire`;
CREATE TABLE IF NOT EXISTS `cartebancaire` (
  `IDCB` int(11) NOT NULL AUTO_INCREMENT,
  `NumCarte` varchar(255) NOT NULL,
  `DateExpiration` varchar(5) NOT NULL,
  `NomAffiche` varchar(255) NOT NULL,
  `CodeSecur` int(11) NOT NULL,
  `TypeCarte` varchar(255) NOT NULL,
  `Solde` int(11) NOT NULL,
  `#IDAcheteur` int(11) NOT NULL,
  PRIMARY KEY (`IDCB`),
  KEY `#IDAcheteur` (`#IDAcheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cartebancaire`
--

INSERT INTO `cartebancaire` (`IDCB`, `NumCarte`, `DateExpiration`, `NomAffiche`, `CodeSecur`, `TypeCarte`, `Solde`, `#IDAcheteur`) VALUES
(1, '1234567812345678', '04/21', 'SOARES Alexandre', 123, 'VISA', 300, 1),
(3, '1234567812345678', '04/21', 'BESSIERES Adrien', 123, 'VISA', 500, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `#IDCB` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDCommande`),
  KEY `#IDAcheteur` (`#IDAcheteur`),
  KEY `#IDAdresse` (`#IDAdresse`),
  KEY `#IDCB` (`#IDCB`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `CheminImg` varchar(700) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `#IDArticle` int(11) DEFAULT NULL,
  `#IDVendeur` int(11) DEFAULT NULL,
  PRIMARY KEY (`CheminImg`),
  KEY `#IDArticle` (`#IDArticle`),
  KEY `#IDVendeur` (`#IDVendeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`CheminImg`, `Nom`, `#IDArticle`, `#IDVendeur`) VALUES
('../img/Vendeur/collectionneur.jpg', 'Collectionneur', NULL, 1),
('../img/Vendeur/collectionneurBack.jpg', 'Magasin vendeur collectionneur', NULL, 1),
('data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxQTEhUTExMWFhUXGB4aGRgYGB4aGBkYGhoYGxcaGxgdHSggGBolHRcYITEiJSkrLi4uGh8zODMtNygtLisBCgoKDg0OGxAQGy0mICYtLS0rLTUrLS0tLS8tLS0tLS0tLS0tLS0tLS0tLS0tLy0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAMEBBQMBIgACEQEDEQH/xAAbAAACAgMBAAAAAAAAAAAAAAAFBgMEAAECB//EAD8QAAECAwYDBwMCBQMDBQEAAAECEQADIQQFEjFBUSJhcQYTMoGRobHB0fBC4RQjM1LxYnKCFSTSB0OSorI0/8QAGQEAAwEBAQAAAAAAAAAAAAAAAQIDBAAF/8QALBEAAgICAgEDAgUFAQAAAAAAAAECEQMhEjFBEyJRBDJhgZGhsUJScdHwI//aAAwDAQACEQMRAD8AWFEpUQEhQBORIfrHMyfshQ8wfrBO0f1FJGXzHJSKbkiMmj0Kfh+CgLXXNQ6gxJLtpGUwdDT5iwmU6iDp9IlkWR0ksH55tApWNbUb/wAfuRpt0xId8uY+ka/6u+YfzPwIltV1yy7JfKrN1jJF1S6s4YaE5wE0POMk3+FfubkX6lNO6B8vuY7VfpakhPm32iWXdqsKiF5aEA6dI', 'Renoir', 15, NULL),
('https://ae01.alicdn.com/kf/HTB1NsHsRXXXXXX1XVXXq6xXFXXXD/Jingdezhen-Yu-Hailin-c-ramique-c-l-bre-peint-la-main-pastel-sculpt-grand-vase-chinois.jpg', 'yu Hailin', 19, NULL),
('https://cdn.catawiki.net/assets/marketing/uploads-files/43483-ef5f6a7ae6499c8f2dd234af43b10b3e2ad74eaa-story_inline_image.jpg', 'Dinar', 11, NULL),
('https://i0.wp.com/www.banquedelimage.com/wp-content/uploads/2016/04/1-5537001_v1_redim.jpg?fit=800%2C618&ssl=1', 'Klimt', 14, NULL),
('https://images-na.ssl-images-amazon.com/images/I/51fN-fwrq2L._SX466_.jpg', 'Métal rare', 21, NULL),
('https://images.jeugeek.com/uploads/files/csgo-ranks.jpg', 'jeanvaljean', NULL, 2),
('https://live.staticflickr.com/3109/2828930118_b6bb3e3647_b.jpg', 'Kusama', 17, NULL),
('https://medias.gazette-drouot.com/prod/medias/mediatheque/25336.jpg', 'La nuit étoilée', 4, NULL),
('https://s3-eu-west-1.amazonaws.com/auctionmediaphotos/e/8/2/1500461407999070.jpg', 'Saphira', 9, NULL),
('https://static-www.elastic.co/v3/assets/bltefdd0b53724fa2ce/blt73c524420c2ba62c/5ca6896ee2a0d75e33470a83/sql-search.jpg', 'jeanvaljean', NULL, 2),
('https://upload.wikimedia.org/wikipedia/commons/d/d9/Clovis_Ier_et_le_vase_de_Soissons.jpg', 'Vase soisson', 18, NULL),
('https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Odysseus_Sirens_BM_E440.jpg/1200px-Odysseus_Sirens_BM_E440.jpg', 'Stamnos', 20, NULL),
('https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Claude_Monet%2C_Saint-Georges_majeur_au_cr%C3%A9puscule.jpg/1024px-Claude_Monet%2C_Saint-Georges_majeur_au_cr%C3%A9puscule.jpg', 'Monet Crépuscule', 8, NULL),
('https://webclasse.files.wordpress.com/2015/09/vasarely-vega-nor-improvisation2.jpg?w=848', 'Vasarely', 16, NULL),
('https://www.anticswiss.com/_img/10072/grande-zuppiera-centrotavola-argento-800-sec-xx-20186-10072.jpg', 'Soupière', 22, NULL),
('https://www.bijouxbaume.com/upload/image/pendentif-medaillon-ancien-en-or-cisele-p-image-67787-grande.jpg', 'Médaillon', 10, NULL),
('https://www.bijouxoccasions.com/14403-large_default/bracelet-ancien-en-or-argent-diamants-et-perles.jpg', 'Bracelet ancien', 23, NULL),
('https://www.centrepompidou.fr/media/picture/b7/40/b74000b2a938a9ec769f80beca98cb77/thumb_large.jpg', 'Klein Blue', 7, NULL),
('https://www.cinemalechambord.fr/evenement/MARATHON_SEIGNEUR_DES_ANNEAUX.jpg', 'Anneau', 3, NULL),
('https://www.kazoart.com/blog/wp-content/uploads/2019/05/Salvador-Dali-persistance-de-la-memoire-olivier.jpg', 'Dali', 12, NULL),
('https://www.louvre.fr/sites/default/files/imagecache/940x768/medias/medias_images/images/louvre-aiguiere-passage-mer-rouge.jpg', 'Aiguière', 6, NULL),
('https://www.musee-magritte-museum.be/uploads/pages/images/magritte_6667dig_h_1_large@2x.jpg', 'Magritte', 13, NULL),
('https://www.pauloeuvreart.com/couch/uploads/image/paintings/picasso/picasso-girl-before-a-mirror.jpg', 'Picasso', 2, NULL),
('https://www.smh-stockage.com/wp-content/uploads/2017/09/vase.jpg', 'Vase Grec', 5, NULL),
('https://www.yvert.com/I-Grande-137237-2-euro-commemorative-2017-france-lutte-cancer-sein.net.jpg', 'Pièce Rare', 1, NULL);

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
  `#IDVendeur` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDNego`),
  KEY `#IDArticle` (`#IDArticle`),
  KEY `#IDAcheteur` (`#IDAcheteur`),
  KEY `#IDVendeur` (`#IDVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`IDVendeur`, `Pseudo`, `Mail`, `Password`) VALUES
(1, 'Collectionneur', 'collectionneur@edu.ece.fr', '1234'),
(2, 'jeanvaljean', 'jeanvaljean@edu.ece.fr', '1234'),
(3, 'pierrequiroule', 'pierrequiroule@edu.ece.fr', '1234'),
(4, 'alaindain', 'alaindain@edu.ece.fr', '1234'),
(5, 'thomasdebateau', 'thomasdebateau@edu.ece.fr', '1234');

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
-- Contraintes pour la table `cartebancaire`
--
ALTER TABLE `cartebancaire`
  ADD CONSTRAINT `cartebancaire_ibfk_1` FOREIGN KEY (`#IDAcheteur`) REFERENCES `acheteur` (`IDAcheteur`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `commande_ibfk_3` FOREIGN KEY (`#IDCB`) REFERENCES `cartebancaire` (`IDCB`) ON DELETE RESTRICT ON UPDATE CASCADE;

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
  ADD CONSTRAINT `negociation_ibfk_2` FOREIGN KEY (`#IDArticle`) REFERENCES `article` (`IDArticle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `negociation_ibfk_3` FOREIGN KEY (`#IDVendeur`) REFERENCES `vendeur` (`IDVendeur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
