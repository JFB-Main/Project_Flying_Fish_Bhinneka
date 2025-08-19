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
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_logs_id` varchar(255) NOT NULL,
  `teknisi_id` int(10) unsigned DEFAULT NULL,
  `note_content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `notes_service_logs_id_foreign` (`service_logs_id`),
  KEY `notes_teknisi_id_foreign` (`teknisi_id`),
  CONSTRAINT `notes_service_logs_id_foreign` FOREIGN KEY (`service_logs_id`) REFERENCES `service_logs` (`techlog_id`) ON DELETE CASCADE,
  CONSTRAINT `notes_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (44,'TL260800001',3,'dsdada','2025-08-12 03:12:11'),(45,'TL260800001',11,'alkjhdvwgab','2025-08-12 04:29:43'),(46,'TL260800002',11,'adad','2025-08-13 05:00:27'),(47,'TL260800002',3,'1','2025-08-14 06:48:05'),(48,'TL260800002',3,'2','2025-08-14 06:48:08'),(49,'TL260800002',3,'\n3\n\n','2025-08-14 06:48:15'),(50,'TL260800002',3,'4','2025-08-14 06:48:18'),(51,'TL260800002',3,'5','2025-08-14 06:48:20'),(52,'TL260800002',3,'6','2025-08-14 06:48:23'),(53,'TL260800002',3,'7','2025-08-14 06:48:26'),(54,'TL260800002',3,'8','2025-08-14 06:48:29'),(55,'TL260800002',3,'9','2025-08-14 06:48:32'),(56,'TL260800002',3,'10\n','2025-08-14 06:48:36');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-18 11:57:51
