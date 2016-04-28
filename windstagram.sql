-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: windstagram
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `friend_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,5,7),(2,3,8),(3,2,9),(5,1,10),(6,1,11),(6,2,12),(6,3,13),(1,6,14),(2,6,15),(3,6,16),(2,6,17),(6,2,18),(2,6,19),(6,2,20),(4,6,21),(6,4,22),(5,6,23),(6,5,24),(6,1,25),(6,2,26),(6,3,27),(6,4,28);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trips` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips`
--

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;
INSERT INTO `trips` VALUES (63,'sanjose','2016-04-08 00:00:00','2016-04-27 18:59:55',NULL,'this is my first event for san jose '),(64,'salina','2016-04-14 00:00:00','2016-04-27 20:47:54',NULL,'pack ur bag we r going to salina'),(68,'phoenix','2016-04-09 00:00:00','2016-04-27 21:46:39',NULL,'bal bal abla'),(69,'lasvegas','2016-04-15 00:00:00','2016-04-27 21:48:29',NULL,'knkdn/wd'),(70,'amarillo','2015-12-12 00:00:00','2016-04-28 01:53:04',NULL,'ready for amarillo'),(71,'amarillo','2015-12-12 00:00:00','2016-04-28 01:53:48',NULL,'ready for amarillo'),(72,'amarillo','2015-12-12 00:00:00','2016-04-28 01:54:52',NULL,'ready for amarillo'),(73,'amarillo','2015-12-12 00:00:00','2016-04-28 01:56:17',NULL,'ready for amarillo'),(74,'amarillo','2015-12-12 00:00:00','2016-04-28 01:57:04',NULL,'ready for amarillo'),(75,'dodgecity','2017-12-12 00:00:00','2016-04-28 03:02:32',NULL,'Dodgecity here we r going'),(77,'cedarcity','2015-12-12 00:00:00','2016-04-28 03:37:55',NULL,'for ben');
/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trips_users`
--

DROP TABLE IF EXISTS `trips_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trips_users` (
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`trip_id`,`user_id`),
  KEY `fk_trips_has_users_users1_idx` (`user_id`),
  KEY `fk_trips_has_users_trips_idx` (`trip_id`),
  CONSTRAINT `fk_trips_has_users_trips` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trips_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips_users`
--

LOCK TABLES `trips_users` WRITE;
/*!40000 ALTER TABLE `trips_users` DISABLE KEYS */;
INSERT INTO `trips_users` VALUES (75,1),(75,2),(63,3),(63,4),(63,5),(75,5);
/*!40000 ALTER TABLE `trips_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sharol','chand','asdfasdf','2016-04-26 17:13:31','1987-12-12 00:00:00',NULL,'sharol@yahoo.com',NULL),(2,'pegah','pegaaaaah','asdfasdf',NULL,NULL,NULL,'pegah@reviveapp.com',NULL),(3,'aaa','aa','asdfasdf','2016-04-26 18:51:57','1980-11-11 00:00:00','2016-04-26 18:51:57','manny@reviveapp.com',NULL),(4,'howard','ling','asdfasdf',NULL,NULL,NULL,'howard@gmail.com',NULL),(5,'vadim','vadim','asdfasdf',NULL,NULL,NULL,'vadim@yahoo.com',NULL),(6,'shrooooooool','sharooooooooli','6a204bd89f3c8348afd5c77c717a097a','2016-04-27 18:50:37','1987-12-12 00:00:00','2016-04-27 18:50:37','sh@gmail.com','4158252361');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-28  9:47:30
