CREATE DATABASE  IF NOT EXISTS `tcc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tcc`;
-- MySQL dump 10.13  Distrib 5.6.11, for osx10.7 (x86_64)
--
-- Host: 127.0.0.1    Database: tcc
-- ------------------------------------------------------
-- Server version	5.6.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `idcomment` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idmovie` int(11) NOT NULL,
  `comment` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`idcomment`),
  KEY `fk_comments_users1_idx` (`iduser`),
  KEY `fk_comments_movies1_idx` (`idmovie`),
  CONSTRAINT `fk_comments_movies1` FOREIGN KEY (`idmovie`) REFERENCES `movies` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,2,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','2013-08-29 23:36:02'),(2,3,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','2013-08-30 11:08:47'),(3,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','2013-08-30 11:08:57'),(4,1,2,'A testament for the good in all of us.','2013-08-30 11:08:52');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genres` (
  `idgenre` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(100) NOT NULL,
  PRIMARY KEY (`idgenre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,'Ação'),(2,'Drama'),(3,'Aventura'),(4,'Terror'),(5,'Romance'),(6,'Comédia'),(7,'Crime'),(8,'Assassinato'),(9,'Fantasia'),(10,'Ficção Científica');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movies` (
  `idmovie` int(11) NOT NULL AUTO_INCREMENT,
  `director` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `synopses` text NOT NULL,
  `logo` varchar(100) DEFAULT 'movie/no_image.jpg',
  `year` int(4) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`idmovie`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (1,'Andy Wachowski, Lana Wachowski','Matrix','Thomas A. Anderson is a man living two lives. By day he is an average computer programmer and by night a hacker known as Neo. Neo has always questioned his reality, but the truth is far beyond his imagination. Neo finds himself targeted by the police when he is contacted by Morpheus, a legendary computer hacker branded a terrorist by the government. Morpheus awakens Neo to the real world, a ravaged wasteland where most of humanity have been captured by a race of machines that live off of the humans\' body heat and electrochemical energy and who imprison their minds within an artificial reality known as the Matrix. As a rebel against the machines, Neo must return to the Matrix and confront the agents: super-powerful computer programs devoted to snuffing out Neo and the entire human rebellion.','movie/the_matrix.jpg',1999,'matrix'),(2,'Steven Spielberg','A Lista de Schindler','Oskar Schindler is a vainglorious and greedy German businessman who becomes unlikely humanitarian amid the barbaric Nazi reign when he feels compelled to turn his factory into a refuge for Jews. Based on the true story of Oskar Schindler who managed to save about 1100 Jews from being gassed at the Auschwitz concentration camp. A testament for the good in all of us.','movie/schindlers_list.jpg',1993,'a-lista-de-schindler'),(3,'Stephen Sommers','A Múmia','An English librarian called Evelyn Carnahan becomes interested in starting an archaeological dig at the ancient city of Hamunaptra. She gains the help of Rick O\'Connell, after saving him from his death. What Evelyn, her brother Jonathan and Rick are unaware of is that another group of explorers are interested in the same dig. Unfortunately for everyone, this group ends up unleashing a curse which been laid on the dead High Priest Imhotep. Now \'The Mummy\' is awake and it\'s going to take a lot more than guns to send him back from where he came from.','movie/the_mummy.jpg',1999,'a-mumia'),(4,'Brad Bird','Missão: Impossível - Protocolo Fantasma','In the fourth installment of the Mission Impossible series, Ethan Hunt and a new team race against time to track down Hendricks, a dangerous terrorist who has gained access to Russian nuclear launch codes and is planning a strike on the United States. An attempt by the team to stop him at the Kremlin ends in a disaster, with an explosion causing severe damage to the Kremlin and the IMF being implicated in the bombing, forcing the President to invoke Ghost Protocol, under which the IMF is disavowed, and will be offered no help or backup in any form. Undaunted, Ethan and his team chase Hendricks to Dubai, and from there to Mumbai, but several spectacular action sequences later, they might still be too late to stop a disaster.','movie/mission_impossible_ghost_protocol.jpg',2011,'missao:-impossivel-protocolo-fantasma'),(5,'Marc Forster','007: Quantum of Solace','Is there solace in revenge? Bond and \"M\" sniff a shadowy international network of power and corruption reaping billions. As Bond pursues the agents of an assassination attempt on \"M,\" all roads lead to Dominic Greene, a world-renowned developer of green technology. Greene, a nasty piece of work, is intent on securing a barren area of Bolivia in exchange for assisting a strongman stage a coup there. The CIA looks the other way, and only Bond, with help from a retired spy and from a mysterious beauty, stands in Greene\'s way. \"M\" wonders if she can trust Bond, or if vengeance possesses him. Beyond that, can anyone drawn to Bond live to tell the tale?','movie/007_quantum_of_solace.jpg',2008,'007:-quantum-of-solace'),(6,'Ridley Scott','Hannibal','The continuing saga of Hannibal Lecter, the murdering cannibal. He is presently in Italy and works as a curator at a museum. Clarice Starling, the FBI agent whom he aided to apprehend a serial killer, was placed in charge of an operation but when one of her men botches it, she\'s called to the mat by the Bureau. One high ranking official, Paul Krendler has it in for her. But she gets a reprieve because Mason Verger, one of Lecter\'s victims who is looking to get back at Lecter for what Lecter did to him, wants to use Starling to lure him out. When Lecter sends her a note she learns that he\'s in Italy so she asks the police to keep an eye out for him. But a corrupt policeman who wants to get the reward that Verger placed on him, tells Verger where he is. But they fail to get him. Later Verger decides to frame Starling which makes Lecter return to the States. And the race to get Lecter begins.','movie/hannibal.jpg',2001,'hannibal'),(7,'Steven Spielberg','Indiana Jones e o Reino da Caveira de Cristal','During the Cold War, Soviet agents watch Professor Henry Jones when a young man brings him a coded message from an aged, demented colleague, Harold Oxley. Led by the brilliant Irina Spalko, the Soviets tail Jones and the young man, Mutt, to Peru. With Oxley\'s code, they find a legendary skull made of a single piece of quartz. If Jones can deliver the skull to its rightful place, all may be well; but if Irina takes it to its origin, she\'ll gain powers that could endanger the West. Aging professor and young buck join forces with a woman from Jones\'s past to face the dangers of the jungle, Russia, and the supernatural.','movie/indiana_jones_and_the_kingdom_of_the_crystal_skull.jpg',2008,'indiana-jones-e-o-reino-da-caveira-de-cristal'),(8,'asdf','asdf','df','movie/no_image.jpg',1234,'asdf'),(9,'zxcv','zxcv','zxcv','movie/no_image.jpg',1234,'zxcv');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies_has_genres`
--

DROP TABLE IF EXISTS `movies_has_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movies_has_genres` (
  `idmovie` int(11) NOT NULL,
  `idgenre` int(11) NOT NULL,
  PRIMARY KEY (`idmovie`,`idgenre`),
  KEY `fk_movies_has_genre_genre1_idx` (`idgenre`),
  KEY `fk_movies_has_genre_movies1_idx` (`idmovie`),
  CONSTRAINT `fk_movies_has_genre_genre1` FOREIGN KEY (`idgenre`) REFERENCES `genres` (`idgenre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_movies_has_genre_movies1` FOREIGN KEY (`idmovie`) REFERENCES `movies` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies_has_genres`
--

LOCK TABLES `movies_has_genres` WRITE;
/*!40000 ALTER TABLE `movies_has_genres` DISABLE KEYS */;
INSERT INTO `movies_has_genres` VALUES (1,1),(3,1),(4,1),(5,1),(7,1),(8,1),(2,2),(6,2),(1,3),(3,3),(5,3),(7,3),(9,3),(9,6),(5,7),(6,7),(4,8),(6,8),(9,8),(3,9),(1,10),(9,10);
/*!40000 ALTER TABLE `movies_has_genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `iduser` int(11) NOT NULL,
  `idmovie` int(11) NOT NULL,
  `value` int(1) NOT NULL,
  PRIMARY KEY (`iduser`,`idmovie`),
  KEY `fk_ratings_users_idx` (`iduser`),
  KEY `fk_ratings_posts1_idx` (`idmovie`),
  CONSTRAINT `fk_ratings_posts1` FOREIGN KEY (`idmovie`) REFERENCES `movies` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratings_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,3,2),(1,5,4),(2,1,4),(2,6,3),(4,5,3),(6,1,5),(6,5,3),(6,7,5);
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(40) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'felipe@gmail.com','Felipe','3da541559918a808c2402bba5012f6c60b27661c',NULL),(2,'belchior@outlook.com','Belchior Oliveira','3da541559918a808c2402bba5012f6c60b27661c',NULL),(3,'ana@gmail.com','Ana','3da541559918a808c2402bba5012f6c60b27661c',NULL),(4,'joao@gmail.com','João','3da541559918a808c2402bba5012f6c60b27661c',NULL),(6,'marcia@gmail.com','Marcia','3da541559918a808c2402bba5012f6c60b27661c',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_has_genres`
--

DROP TABLE IF EXISTS `users_has_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_has_genres` (
  `iduser` int(11) NOT NULL,
  `idgenre` int(11) NOT NULL,
  PRIMARY KEY (`iduser`,`idgenre`),
  KEY `fk_users_has_genres_genres1_idx` (`idgenre`),
  KEY `fk_users_has_genres_users1_idx` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_has_genres`
--

LOCK TABLES `users_has_genres` WRITE;
/*!40000 ALTER TABLE `users_has_genres` DISABLE KEYS */;
INSERT INTO `users_has_genres` VALUES (1,1),(4,1),(6,1),(2,2),(3,2),(6,2),(2,3),(1,4),(2,4),(3,5);
/*!40000 ALTER TABLE `users_has_genres` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-30 15:51:27
