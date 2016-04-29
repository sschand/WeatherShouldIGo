-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: windstagram
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,4,1),(2,1,4),(3,2,1),(4,1,2),(5,3,1),(6,1,3),(7,NULL,1),(8,1,NULL);
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
  `description` text,
  `start_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips`
--

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;
INSERT INTO `trips` VALUES (2,'denver','Bring your boards and warm clothes, it is gonna be cold','2016-05-10 00:00:00','2016-04-29 01:12:39',NULL);
/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trips_users`
--

DROP TABLE IF EXISTS `trips_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trips_users` (
  `user_id` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_users_has_trips_trips1_idx` (`trip_id`),
  KEY `fk_users_has_trips_users_idx` (`user_id`),
  CONSTRAINT `fk_users_has_trips_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_trips_trips1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips_users`
--

LOCK TABLES `trips_users` WRITE;
/*!40000 ALTER TABLE `trips_users` DISABLE KEYS */;
INSERT INTO `trips_users` VALUES (1,2,2),(3,2,4),(2,2,5);
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
  `name` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'pegah keshavarz','pegah','pegah@reviveapp.com','ec4e656981fb30f38a5c3dad99326c9d','1987-01-15 00:00:00','4158252361','2016-04-28 17:56:17','2016-04-28 17:56:17'),(2,'howard jiang','howard','me@howardjiang.com','6a204bd89f3c8348afd5c77c717a097a','1989-12-12 00:00:00','4088988860','2016-04-28 18:01:53','2016-04-28 18:01:53'),(3,'vadim','vadim','vkutuyev@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99','1986-01-01 00:00:00','9492927463','2016-04-28 18:03:11','2016-04-28 18:03:11'),(4,'billy','billy','billy@gmail.com','6a204bd89f3c8348afd5c77c717a097a','1990-12-12 00:00:00','415555555','2016-04-28 18:03:46','2016-04-28 18:03:46'),(5,'ben aflec','ben','ben@gmail.com','6a204bd89f3c8348afd5c77c717a097a','1980-12-12 00:00:00','555555555','2016-04-28 18:04:15','2016-04-28 18:04:15'),(6,'alis lia','alis','alis@gmail.com','6a204bd89f3c8348afd5c77c717a097a','1980-12-12 00:00:00','444444444','2016-04-28 18:04:48','2016-04-28 18:04:48'),(7,'mike choi','mike','mike@gmail.com','6a204bd89f3c8348afd5c77c717a097a','1980-12-12 00:00:00','111111111','2016-04-28 18:05:19','2016-04-28 18:05:19'),(8,'oscar','oscar','oscar@gmail.com','6a204bd89f3c8348afd5c77c717a097a','1980-12-12 00:00:00','222222222','2016-04-28 18:05:48','2016-04-28 18:05:48'),(9,'jay','jay','jay@gmail.com','6a204bd89f3c8348afd5c77c717a097a','1988-12-12 00:00:00','333333333','2016-04-28 18:06:21','2016-04-28 18:06:21');
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

-- Dump completed on 2016-04-28 18:40:12
