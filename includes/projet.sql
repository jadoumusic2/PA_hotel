-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: projetA
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Reservations`
--

DROP TABLE IF EXISTS `Reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reservations` (
  `NumeroTelephone` varchar(20) NOT NULL,
  `NumeroChambre` int(11) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `NombrePersonnes` int(11) DEFAULT NULL,
  `DateArrivee` date DEFAULT NULL,
  `DateRetour` date DEFAULT NULL,
  PRIMARY KEY (`NumeroTelephone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservations`
--

LOCK TABLES `Reservations` WRITE;
/*!40000 ALTER TABLE `Reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `Reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `captcha` (
  `question` varchar(255) NOT NULL,
  `reponse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `captcha`
--

LOCK TABLES `captcha` WRITE;
/*!40000 ALTER TABLE `captcha` DISABLE KEYS */;
INSERT INTO `captcha` VALUES
('2*2','4');
/*!40000 ALTER TABLE `captcha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chambre_familial`
--

DROP TABLE IF EXISTS `chambre_familial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chambre_familial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arrival_days` date DEFAULT NULL,
  `depart_days` date DEFAULT NULL,
  `number` varchar(2) DEFAULT NULL,
  `phone_number` char(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambre_familial`
--

LOCK TABLES `chambre_familial` WRITE;
/*!40000 ALTER TABLE `chambre_familial` DISABLE KEYS */;
INSERT INTO `chambre_familial` VALUES
(4,'2024-04-25','2024-04-30','2','0620163013','Yanis ');
/*!40000 ALTER TABLE `chambre_familial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chambre_luxe`
--

DROP TABLE IF EXISTS `chambre_luxe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chambre_luxe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arrival_days` date DEFAULT NULL,
  `depart_days` date DEFAULT NULL,
  `number` varchar(2) DEFAULT NULL,
  `phone_number` char(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambre_luxe`
--

LOCK TABLES `chambre_luxe` WRITE;
/*!40000 ALTER TABLE `chambre_luxe` DISABLE KEYS */;
/*!40000 ALTER TABLE `chambre_luxe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chambre_romance`
--

DROP TABLE IF EXISTS `chambre_romance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chambre_romance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arrival_days` date DEFAULT NULL,
  `depart_days` date DEFAULT NULL,
  `number` varchar(2) DEFAULT NULL,
  `phone_number` char(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambre_romance`
--

LOCK TABLES `chambre_romance` WRITE;
/*!40000 ALTER TABLE `chambre_romance` DISABLE KEYS */;
INSERT INTO `chambre_romance` VALUES
(3,'2024-04-25','2024-04-30','4','0620163014','Enzo'),
(4,'2024-04-25','2024-04-28','2','0620163013','Yanis ');
/*!40000 ALTER TABLE `chambre_romance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connexion` (
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe_hash` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connexion`
--

LOCK TABLES `connexion` WRITE;
/*!40000 ALTER TABLE `connexion` DISABLE KEYS */;
INSERT INTO `connexion` VALUES
('yanisbonnin@gmail.com','$2y$10$pnRzRsyHHZuicvLZRLt3f.OwgbFVCmHs4hLyS.FOhzDgPPSjZ8ePO','d2b4f292d03b6bab05c76d03837f861f','2024-04-25 08:19:36'),
('yanihaouili@gmail.com','$2y$10$WezsjmlL9n1LEZJafRj8HOHOAb42u0tIqL3UuCSepOZABNBxi7Uyy','f6542bb1f3a8bf3ab885384b4617f7a1','2024-04-25 19:30:12');
/*!40000 ALTER TABLE `connexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `numero_telephone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES
(1,'bonninyanis2001@gmail.com','Yanis ESGI Bonnin','0620163013','coucou'),
(3,'vero-georges@hotmail.fr','papa rené','0215612318','salut');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `type_evenement` varchar(20) DEFAULT NULL,
  `date_evenement` date DEFAULT NULL,
  `prix_evenement` double DEFAULT NULL,
  PRIMARY KEY (`id_evenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenement`
--

LOCK TABLES `evenement` WRITE;
/*!40000 ALTER TABLE `evenement` DISABLE KEYS */;
/*!40000 ALTER TABLE `evenement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel` (
  `num_hotel` int(11) NOT NULL,
  `Nom` varchar(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `telephone` char(10) DEFAULT NULL,
  `Ville` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`num_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_midi`
--

DROP TABLE IF EXISTS `menu_midi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_midi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `entre` text DEFAULT NULL,
  `plat` text DEFAULT NULL,
  `fromage` text DEFAULT NULL,
  `dessert` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_midi`
--

LOCK TABLES `menu_midi` WRITE;
/*!40000 ALTER TABLE `menu_midi` DISABLE KEYS */;
INSERT INTO `menu_midi` VALUES
(2,'2024-04-25','Carotte râpée ','Couscous','Comté','Tarte au pomme');
/*!40000 ALTER TABLE `menu_midi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_soir`
--

DROP TABLE IF EXISTS `menu_soir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_soir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `entre` text DEFAULT NULL,
  `plat` text DEFAULT NULL,
  `fromage` text DEFAULT NULL,
  `dessert` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_soir`
--

LOCK TABLES `menu_soir` WRITE;
/*!40000 ALTER TABLE `menu_soir` DISABLE KEYS */;
INSERT INTO `menu_soir` VALUES
(3,'2024-04-25','Comcombre','Pates','Camembert','Ile flottante');
/*!40000 ALTER TABLE `menu_soir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` VALUES
(1,'jade.keina@gmail.com'),
(2,'inutilekt@gmail.com'),
(3,'inutilekt@gmail.com'),
(4,'inutilekt@gmail.com'),
(5,'inutilekt@gmail.com'),
(6,'bonninyanis2001@gmail.com'),
(7,'yanis.bonnin78@gmail.com'),
(8,'yanis.bonnin78@gmail.com'),
(9,'yanis.bonnin78@gmail.com'),
(10,'bonninedouard@gmail.com');
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestation` (
  `code_prestation` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `presentation` text DEFAULT NULL,
  PRIMARY KEY (`code_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestation`
--

LOCK TABLES `prestation` WRITE;
/*!40000 ALTER TABLE `prestation` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_resto`
--

DROP TABLE IF EXISTS `reservation_resto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation_resto` (
  `phone_number` varchar(10) NOT NULL,
  `days` date DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `hours` time DEFAULT NULL,
  PRIMARY KEY (`phone_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_resto`
--

LOCK TABLES `reservation_resto` WRITE;
/*!40000 ALTER TABLE `reservation_resto` DISABLE KEYS */;
INSERT INTO `reservation_resto` VALUES
('0215612318','2024-04-23','papa rené','3','13:25:00');
/*!40000 ALTER TABLE `reservation_resto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suites_a`
--

DROP TABLE IF EXISTS `suites_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suites_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arrival_days` date DEFAULT NULL,
  `depart_days` date DEFAULT NULL,
  `number` varchar(2) DEFAULT NULL,
  `phone_number` char(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suites_a`
--

LOCK TABLES `suites_a` WRITE;
/*!40000 ALTER TABLE `suites_a` DISABLE KEYS */;
INSERT INTO `suites_a` VALUES
(2,'2024-04-25','2024-05-08','3','0620163014','Enzo');
/*!40000 ALTER TABLE `suites_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suites_b`
--

DROP TABLE IF EXISTS `suites_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suites_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arrival_days` date DEFAULT NULL,
  `depart_days` date DEFAULT NULL,
  `number` varchar(2) DEFAULT NULL,
  `phone_number` char(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suites_b`
--

LOCK TABLES `suites_b` WRITE;
/*!40000 ALTER TABLE `suites_b` DISABLE KEYS */;
/*!40000 ALTER TABLE `suites_b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES
(3,'rayane','belkassi','','rayane2001.rb@icloud.com','onzezero4'),
(4,'Belkassi','Rayane','','test@gmail.com','1234567890'),
(5,'Belkassi','Rayane','','rayaneb@gmail.com','onzezero4'),
(6,'Belkassi','Rayane','','rayan@gmail.com','onzezero4'),
(7,'Belkassi','Rayane','','test1@gmail.com','$2y$10$94BxeeO4MiZlWWb6eBpe/ecC2v6FUUi/LdJpis6kPPjvFcodPUmt6'),
(8,'yanis','bonnin','','yanisbonnin@gmail.com','$2y$10$pnRzRsyHHZuicvLZRLt3f.OwgbFVCmHs4hLyS.FOhzDgPPSjZ8ePO'),
(9,'HAOUILI','Yani','','yanihaouili@gmail.com','$2y$10$WezsjmlL9n1LEZJafRj8HOHOAb42u0tIqL3UuCSepOZABNBxi7Uyy');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-25 19:49:59
