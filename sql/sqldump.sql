-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: avia
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `flight_id` int NOT NULL,
  `added_at` datetime NOT NULL,
  `type` tinyint NOT NULL,
  `is_processed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_flight_id` (`flight_id`),
  CONSTRAINT `event_flight_id` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,3,'2020-05-24 12:50:43',1,1),(2,2,'2020-05-24 12:56:17',1,1),(3,1,'2020-05-24 12:57:05',2,1),(4,1,'2020-05-24 13:04:59',2,1),(5,3,'2020-05-24 13:05:18',1,1),(6,4,'2020-05-24 16:09:47',2,1),(7,4,'2020-05-24 16:10:28',1,1),(8,4,'2020-05-24 16:59:49',1,1),(9,4,'2020-05-24 17:02:06',1,1),(10,4,'2020-05-24 17:03:41',1,1),(11,7,'2020-05-25 05:38:15',1,1),(12,7,'2020-05-25 05:38:27',2,1);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flight` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `added_at` datetime NOT NULL,
  `flight_at` datetime NOT NULL,
  `is_sales_completed` tinyint(1) NOT NULL DEFAULT '0',
  `completion_at` datetime DEFAULT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT '0',
  `cancellation_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flight`
--

LOCK TABLES `flight` WRITE;
/*!40000 ALTER TABLE `flight` DISABLE KEYS */;
INSERT INTO `flight` VALUES (1,'Flight1','2020-05-24 12:22:16','1970-01-01 00:00:00',0,NULL,1,'2020-05-24 13:04:59'),(2,'Flight1','2020-05-24 12:23:38','1970-01-01 00:00:00',1,'2020-05-24 12:56:17',0,NULL),(3,'Flight1','2020-05-24 12:26:24','2020-05-24 12:23:22',1,'2020-05-24 13:05:18',0,NULL),(4,'Flight4','2020-05-24 13:05:44','2020-05-24 12:23:22',1,'2020-05-24 17:03:40',1,'2020-05-24 16:09:46'),(5,'Flight6','2020-05-25 05:31:36','2020-05-24 12:12:20',0,NULL,0,NULL),(6,'Flight7','2020-05-25 05:31:46','2020-05-24 12:12:20',0,NULL,0,NULL),(7,'Flight8','2020-05-25 05:31:49','2020-05-24 12:12:20',1,'2020-05-25 05:38:14',1,'2020-05-25 05:38:26'),(8,'Flight9','2020-05-25 05:38:55','2020-05-24 12:12:20',0,NULL,0,NULL),(9,'Flight10','2020-05-25 05:38:58','2020-05-24 12:12:20',0,NULL,0,NULL),(10,'Flight11','2020-05-25 05:39:07','2020-05-24 12:12:20',0,NULL,0,NULL);
/*!40000 ALTER TABLE `flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `reservation_id` int NOT NULL,
  `added_at` datetime NOT NULL,
  `is_processed` tinyint(1) NOT NULL DEFAULT '0',
  `processed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_event_id_index` (`event_id`),
  KEY `notification_reservation_id_index` (`reservation_id`),
  CONSTRAINT `notification_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `notification_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,7,1,'2020-05-24 16:15:37',1,'2020-05-25 05:43:16'),(2,7,2,'2020-05-24 16:15:38',1,'2020-05-25 05:43:17'),(3,7,3,'2020-05-24 16:15:38',1,'2020-05-25 05:43:17'),(4,7,4,'2020-05-24 16:15:38',1,'2020-05-25 05:43:17'),(5,7,5,'2020-05-24 16:15:38',1,'2020-05-25 05:43:17'),(6,7,6,'2020-05-24 16:15:38',1,'2020-05-25 05:43:18'),(7,7,7,'2020-05-24 16:15:38',1,'2020-05-25 05:43:18'),(8,7,11,'2020-05-24 16:15:38',1,'2020-05-25 05:43:18'),(9,6,8,'2020-05-24 16:17:57',1,'2020-05-25 05:43:18'),(10,6,9,'2020-05-24 16:17:57',1,'2020-05-25 05:43:18'),(11,6,10,'2020-05-24 16:17:57',1,'2020-05-25 05:43:18'),(12,6,12,'2020-05-24 16:17:57',1,'2020-05-25 05:43:18'),(13,6,13,'2020-05-24 16:17:57',1,'2020-05-25 05:43:18'),(14,6,14,'2020-05-24 16:17:57',1,'2020-05-25 05:43:19'),(15,8,1,'2020-05-24 17:03:11',1,'2020-05-25 05:43:19'),(16,8,2,'2020-05-24 17:03:11',1,'2020-05-25 05:43:19'),(17,8,3,'2020-05-24 17:03:11',1,'2020-05-25 05:43:19'),(18,8,4,'2020-05-24 17:03:11',1,'2020-05-25 05:43:19'),(19,8,5,'2020-05-24 17:03:11',1,'2020-05-25 05:43:19'),(20,8,6,'2020-05-24 17:03:11',1,'2020-05-25 05:43:19'),(21,8,7,'2020-05-24 17:03:11',1,'2020-05-25 05:43:20'),(22,8,11,'2020-05-24 17:03:11',1,'2020-05-25 05:43:20'),(23,9,1,'2020-05-24 17:03:11',1,'2020-05-25 05:43:20'),(24,9,2,'2020-05-24 17:03:11',1,'2020-05-25 05:43:20'),(25,9,3,'2020-05-24 17:03:11',1,'2020-05-25 05:43:20'),(26,9,4,'2020-05-24 17:03:11',1,'2020-05-25 05:43:20'),(27,9,5,'2020-05-24 17:03:11',1,'2020-05-25 05:43:21'),(28,9,6,'2020-05-24 17:03:11',1,'2020-05-25 05:43:21'),(29,9,7,'2020-05-24 17:03:11',1,'2020-05-25 05:43:21'),(30,9,11,'2020-05-24 17:03:11',1,'2020-05-25 05:43:21'),(31,10,1,'2020-05-24 17:03:49',1,'2020-05-25 05:43:21'),(32,10,2,'2020-05-24 17:03:49',1,'2020-05-25 05:43:22'),(33,10,3,'2020-05-24 17:03:49',1,'2020-05-25 05:43:22'),(34,10,4,'2020-05-24 17:03:49',1,'2020-05-25 05:43:22'),(35,10,5,'2020-05-24 17:03:49',1,'2020-05-25 05:43:22'),(36,10,6,'2020-05-24 17:03:49',1,'2020-05-25 05:43:23'),(37,10,7,'2020-05-24 17:03:49',1,'2020-05-25 05:43:23'),(38,10,11,'2020-05-24 17:03:49',1,'2020-05-25 05:43:23'),(39,11,15,'2020-05-25 05:39:30',1,'2020-05-25 05:43:23'),(40,11,16,'2020-05-25 05:39:31',1,'2020-05-25 05:43:24'),(41,12,17,'2020-05-25 05:39:31',1,'2020-05-25 05:43:24'),(42,12,18,'2020-05-25 05:39:31',1,'2020-05-25 05:43:24');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_at` datetime NOT NULL,
  `number` varchar(10) NOT NULL,
  `reservation_id` int NOT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT '0',
  `return_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_reservation_id` (`reservation_id`),
  KEY `purchase_number` (`number`),
  CONSTRAINT `purchase_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` VALUES (1,'2020-05-24 14:52:22','qZQYdCTfZp',8,0,NULL),(2,'2020-05-24 14:59:20','jQFpC9AU9Q',9,0,NULL),(3,'2020-05-24 14:59:46','V1SpnkHKXL',10,1,'2020-05-24 15:07:08'),(4,'2020-05-24 15:47:46','9jZCFIJVj2',12,0,NULL),(5,'2020-05-24 15:47:52','HexWrxiP6o',13,0,NULL),(6,'2020-05-24 15:47:56','TtPihMTvSV',14,0,NULL),(7,'2020-05-25 05:36:50','xl7mb2etfF',17,0,NULL),(8,'2020-05-25 05:37:02','PrY608iDdy',18,1,'2020-05-25 05:37:50');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `seat` int NOT NULL,
  `reservation_at` datetime NOT NULL,
  `flight_id` int NOT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT '0',
  `cancellation_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservation_seat_number_unique_index` (`number`,`seat`),
  KEY `reservation_flight_id_index` (`flight_id`),
  KEY `reservation_number_index` (`number`),
  CONSTRAINT `reservation_flight` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,'f5PJ1ze4qL','giselle@giselle.com',129,'2020-05-24 13:56:11',4,0,NULL),(2,'78slMsXH4a','giselle@giselle.com',147,'2020-05-24 13:56:40',4,0,NULL),(3,'2Uv53CvKrP','giselle@giselle.com',55,'2020-05-24 13:56:48',4,0,NULL),(4,'bFqep68xfz','giselle@giselle.com',92,'2020-05-24 14:06:48',4,0,NULL),(5,'j3j2opivMy','giselle@giselle.com',67,'2020-05-24 14:06:50',4,0,NULL),(6,'JVX9fmB4kX','giselle@giselle.com',26,'2020-05-24 14:06:53',4,0,NULL),(7,'5ttqcDuKkk','giselle@giselle.com',125,'2020-05-24 14:06:56',4,1,'2020-05-24 15:09:52'),(8,'aTk9RVJ9bb','giselle@giselle.com',28,'2020-05-24 14:15:46',4,1,'2020-05-24 14:16:24'),(9,'WArpr3r96p','giselle@giselle.com',19,'2020-05-24 14:59:09',4,0,NULL),(10,'MziTzDTkhZ','giselle@giselle.com',148,'2020-05-24 14:59:46',4,0,NULL),(11,'hLmmVCl14U','giselle@giselle.com',66,'2020-05-24 15:46:18',4,0,NULL),(12,'1W8UBIsbmJ','giselle@giselle.com',85,'2020-05-24 15:47:45',4,0,NULL),(13,'j1lWtquZpF','giselle@giselle.com',30,'2020-05-24 15:47:52',4,0,NULL),(14,'9gEiujfh3p','giselle@giselle.com',108,'2020-05-24 15:47:55',4,0,NULL),(15,'CFBbyiFZnk','giselle@giselle.com',113,'2020-05-25 05:32:34',7,0,NULL),(16,'cHFBc0QonQ','giselle@giselle.com',99,'2020-05-25 05:32:42',7,1,'2020-05-25 05:36:02'),(17,'eWVlRxsmCK','giselle@giselle.com',94,'2020-05-25 05:36:08',7,0,NULL),(18,'D9M2FeM2ZT','giselle@giselle.com',128,'2020-05-25 05:37:02',7,0,NULL);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-25  6:50:54
