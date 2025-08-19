-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tl_test4
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `status_updatelog`
--

DROP TABLE IF EXISTS `status_updatelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_updatelog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_logs_id` varchar(255) NOT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `teknisi_id` int(10) unsigned DEFAULT NULL,
  `status_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `status_updatelog_service_logs_id_foreign` (`service_logs_id`),
  KEY `status_updatelog_status_id_foreign` (`status_id`),
  KEY `status_updatelog_teknisi_id_foreign` (`teknisi_id`),
  CONSTRAINT `status_updatelog_service_logs_id_foreign` FOREIGN KEY (`service_logs_id`) REFERENCES `service_logs` (`techlog_id`) ON DELETE CASCADE,
  CONSTRAINT `status_updatelog_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE,
  CONSTRAINT `status_updatelog_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_updatelog`
--

LOCK TABLES `status_updatelog` WRITE;
/*!40000 ALTER TABLE `status_updatelog` DISABLE KEYS */;
INSERT INTO `status_updatelog` VALUES (108,'TL270100001',2,3,'','2025-08-12 02:44:07'),(109,'TL270100001',3,3,'','2025-08-12 02:44:37'),(110,'TL260800002',2,3,'','2025-08-12 02:49:57'),(111,'TL260800002',3,3,'','2025-08-12 02:53:08'),(112,'TL260800002',4,3,'','2025-08-12 02:53:14'),(113,'TL260800002',5,3,'addaads','2025-08-12 02:54:08'),(114,'TL260800001',2,3,'jnajnaj','2025-08-12 03:10:42'),(115,'TL260800001',6,3,'Finish Order','2025-08-12 03:11:13'),(116,'TL260800001',8,3,'adwaw','2025-08-12 03:11:59'),(117,'TL270100001',4,3,'ss','2025-08-12 03:12:25'),(118,'TL260800002',3,3,'Revert to Pending\n','2025-08-12 03:12:35'),(119,'TL250800002',7,3,'awhhudawnhdwa','2025-08-12 03:13:01'),(120,'TL270100001',7,3,'addw','2025-08-12 03:13:24'),(121,'TL250800001',7,3,'','2025-08-12 03:14:36'),(122,'TL260800002',4,3,'','2025-08-12 03:36:00'),(123,'TL260800002',5,3,'','2025-08-12 03:36:32'),(124,'TL260800002',3,3,'','2025-08-12 03:36:35'),(125,'TL250800003',7,3,'','2025-08-12 03:37:47'),(126,'TL250800004',7,3,'','2025-08-12 03:37:53'),(127,'TL250800009',2,11,'ajbdboad','2025-08-12 06:29:55');
/*!40000 ALTER TABLE `status_updatelog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-18 11:57:52
