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
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_updatelog`
--

LOCK TABLES `status_updatelog` WRITE;
/*!40000 ALTER TABLE `status_updatelog` DISABLE KEYS */;
INSERT INTO `status_updatelog` VALUES (1,'TL2507001153',3,3,'wdfgtdndgbsfvgzf','2025-07-21 07:42:34'),(2,'TL2507001154',3,3,'fclkeaywqedtfqeftyhudksdobascdvajkdla','2025-07-21 07:43:57'),(3,'TL2507001155',3,3,'w;hdgvfchvb nsdmxlawjhuigywavdjbnm','2025-07-21 07:49:23'),(4,'TL2507001156',3,3,'sSS','2025-07-21 07:53:47'),(5,'TL2507001157',3,3,';[poraszfdxcgbm','2025-07-21 08:54:00'),(6,'TL2507001162',3,3,'/l,mkjhvfghvbklljlhjgvfcvlkjbvccvbnm.knbvcvbnm,nbvcfxzcvb mn bnml,/mnbvc ,/m.n,bvcb','2025-07-21 09:03:17'),(7,'TL2507001157',4,3,NULL,'2025-07-21 09:09:03'),(8,'TL2507001157',6,3,'vefeaes','2025-07-21 09:30:11'),(9,'TL2507001158',4,3,'addwadw','2025-07-21 09:30:42'),(10,'TL2507001158',4,3,'addwadwadad','2025-07-21 09:30:48'),(11,'TL2507001158',5,3,'adadw','2025-07-21 09:31:00'),(12,'TL2507001158',5,3,'adadwadawwadada','2025-07-21 09:31:05'),(13,'TL2507001158',6,3,'addawdaw','2025-07-21 09:31:15'),(14,'TL2507001158',8,3,NULL,'2025-07-21 09:34:56'),(15,'TL2507001170',2,3,NULL,'2025-07-23 02:07:58'),(16,'TL2507001159',4,3,'opwqiygdbhko[jn','2025-07-23 02:38:02'),(17,'TL2507001159',5,3,'alkodowkowda','2025-07-23 02:38:52'),(18,'TL2507001160',4,3,'uhygtersdfxcvhbjkl','2025-07-23 02:39:45'),(19,'TL2507001160',4,3,'poaedvabhwekadwjkw','2025-07-23 02:39:58'),(20,'TL2507001161',4,3,'ammdamdmd','2025-07-23 02:41:06'),(21,'TL2507001163',2,3,'to on progress from open','2025-07-24 04:09:15'),(22,'TL2507001163',2,3,'to Pending from on progress','2025-07-24 04:09:37'),(23,'TL2507001163',2,3,'to Pending from on progress','2025-07-24 04:09:49'),(24,'TL2507001163',3,3,'from on progress to Pending','2025-07-24 04:10:42'),(25,'TL2507001163',3,3,'from Pending to RMA To Vendor\n\n','2025-07-24 04:10:54'),(26,'TL2507001163',4,3,'dasfcbvs','2025-07-24 04:15:12'),(27,'TL2507001163',4,3,'dasfcbvsadvssdac','2025-07-24 04:15:16'),(28,'TL2507001164',2,3,'dwfagsdnfjghkl','2025-07-24 04:23:05'),(29,'TL2507001164',3,3,'adefcgdx','2025-07-24 04:23:12'),(30,'TL2507001164',4,3,'From pending to RMA To Vendor','2025-07-24 04:23:43'),(31,'TL2507001164',5,3,'From RMA To Vendor to On-QC','2025-07-24 04:24:06'),(32,'TL2507001164',6,3,'From On-QC to Completed','2025-07-24 04:24:17'),(33,'TL2507001164',8,3,'From Completed to ','2025-07-24 04:24:42'),(34,'TL2507001165',2,3,'Open\n\nto ->\n\nOn Progress','2025-07-24 04:31:56'),(35,'TL2507001165',3,3,'On Progress\n\nto ->\n\nPending','2025-07-24 04:32:09'),(36,'TL2507001165',4,3,'Pending\n\nto ->\n\nRMA To Vend','2025-07-24 04:32:23'),(37,'TL2507001165',5,3,'RMA\n\nto ->\n\nOn-QC','2025-07-24 04:32:37'),(38,'TL2507001165',6,3,'On-QC\n\nto ->\n\nCompleted','2025-07-24 04:32:56'),(39,'TL2507001159',8,3,'tes completed date','2025-07-25 02:18:30'),(40,'TL2507001160',5,3,'on qc','2025-07-25 02:21:19'),(41,'TL2507001160',6,3,'test completed date','2025-07-25 02:21:41'),(42,'TL2507001160',8,3,'test return date','2025-07-25 02:22:19'),(43,'TL2507001163',5,3,'\';.nbhgxdfcvhjkl','2025-07-25 03:13:48'),(44,'TL2507001165',8,3,'','2025-07-25 03:17:37'),(45,'TL2507001166',2,3,'','2025-07-25 03:17:48'),(46,'TL2507001166',3,3,'','2025-07-25 03:18:04'),(47,'TL2507001167',2,3,'','2025-07-25 03:20:31'),(48,'TL2507001167',2,3,'','2025-07-25 03:20:31'),(49,'TL2507001167',3,3,'','2025-07-25 03:20:54'),(50,'TL2507001167',4,3,'','2025-07-25 03:21:23'),(51,'TL2507001167',5,3,'','2025-07-25 03:21:59'),(52,'TL2507001168',2,3,'.defer test','2025-07-25 03:34:10'),(53,'TL2507001167',3,3,'test revert','2025-07-25 03:40:39'),(54,'TL2507001167',4,3,'Pending\n\nto ->\n\nRMA To Vendor\n\n2','2025-07-25 03:42:05'),(55,'TL2507001167',5,3,'Pending\n\nto ->\n\nRMA To Vendor\n\n3','2025-07-25 03:42:12'),(56,'TL2507001167',3,3,'test revert 2','2025-07-25 03:42:24'),(57,'TL2507001170',3,3,'adg','2025-07-25 03:43:21'),(58,'TL2507001170',4,3,'wdadwad','2025-07-25 03:43:28'),(59,'TL2507001170',5,3,'RMA\n\nto ->\n\nOn-QC\n\n','2025-07-25 03:43:43'),(60,'TL2507001170',3,3,'test revert tl1170','2025-07-25 03:44:00'),(61,'TL2507001169',7,3,'','2025-07-25 03:45:53'),(62,'TL2507001171',7,3,'test confirm','2025-07-25 03:48:16'),(63,'TL2507001172',7,3,'test confirm','2025-07-25 03:48:36'),(64,'TL2507001173',7,3,'test confirm.prevent','2025-07-25 03:51:21'),(65,'TL2507001174',7,3,'.prevent()','2025-07-25 03:51:49'),(66,'TL2507001175',7,3,'type button and .prevent','2025-07-25 03:52:26'),(67,'TL2507001176',7,3,'test wire confirm','2025-07-25 03:58:07'),(68,'TL2507001177',2,3,'wsdw','2025-07-25 03:59:11'),(69,'TL2507001177',3,3,'adadw','2025-07-25 03:59:18'),(70,'TL2507001177',4,3,'adawdawd','2025-07-25 03:59:24'),(71,'TL2507001177',5,3,'ada','2025-07-25 03:59:33'),(72,'TL2507001177',3,3,'test revert wire confirm','2025-07-25 04:00:01'),(73,'TL2507001200',7,3,'','2025-07-28 08:44:56'),(74,'TL2507001202',2,3,'Open\n\nto ->\n\nOn Progress','2025-07-28 08:47:08'),(75,'TL2507001163',3,3,'On qc to pending','2025-07-28 08:49:19'),(76,'TL2507001203',2,3,'Open\n\nto ->\n\nOn Progress','2025-07-29 02:13:28'),(77,'TL2507001203',3,3,'On Progress\n\nto ->\n\nPending','2025-07-29 02:13:38'),(78,'TL2507001203',4,3,'Pending\n\nto ->\n\nRMA To Vendor','2025-07-29 02:13:57'),(79,'TL2507001203',5,3,'RMA\n\nto ->\n\nOn-QC','2025-07-29 02:14:11'),(80,'TL2507001203',3,3,'On-QC\n\nto ->\n\npending1\n\n','2025-07-29 02:15:07'),(81,'TL2507001203',4,3,'Pending\n\nto ->\n\nRMA To Vendor2','2025-07-29 02:15:29'),(82,'TL2507001203',5,3,'RMA\n\nto ->\n\nOn-QC\n\n2','2025-07-29 02:15:38'),(83,'TL2507001203',3,3,'On-QC\n\nto ->\n\npending3','2025-07-29 02:16:14'),(84,'TL2507001203',4,3,'Pending\n\nto ->\n\nRMA To Vendor\n\n3','2025-07-29 02:16:32'),(85,'TL2507001203',5,3,'RMA\n\nto ->\n\nOn-QC\n\n3','2025-07-29 02:16:38'),(86,'TL2507001203',3,3,'On-QC\n\nto ->\n\npending 4','2025-07-29 02:17:01'),(87,'TL2507001203',4,3,'','2025-07-29 02:17:32'),(88,'TL2507001203',5,3,'','2025-07-29 02:17:34'),(89,'TL2507001203',6,3,'','2025-07-29 02:17:36'),(90,'TL2507001203',8,3,'','2025-07-29 02:17:45'),(91,'TL2507001193',2,3,'Open\n\nto ->\n\nOn Progress','2025-07-29 02:31:56'),(92,'TL2507001193',6,3,'On Progress\n\nto ->\n\nCompleted','2025-07-29 02:32:16'),(93,'TL2507001193',8,3,'Completed\n\nto ->\n\nReturned\n\n','2025-07-29 02:32:54'),(94,'TL2507001204',2,3,'','2025-07-30 07:06:25'),(95,'TL2507001204',6,3,'ok','2025-07-30 07:07:22'),(96,'TL2507001204',8,3,'sudah diabil','2025-07-30 07:07:49'),(97,'TL2508001210',2,3,'asfafsdg','2025-08-01 06:42:09'),(98,'TL2508001210',2,3,'asfafsdgghdfhd','2025-08-01 06:42:11'),(99,'TL2508001210',2,3,'asfafsdgghdfhd','2025-08-01 06:42:11'),(100,'TL2508001210',2,3,'asfafsdgghdfhd','2025-08-01 06:42:11'),(101,'TL2508001210',2,3,'asfafsdgghdfhd','2025-08-01 06:42:11'),(102,'TL2508001210',3,3,'cfhfh','2025-08-01 06:47:37'),(103,'TL2508001210',4,3,'xfgxdfg','2025-08-01 06:47:48'),(104,'TL2508001210',5,3,'ddysts','2025-08-01 06:47:55'),(105,'TL2508001210',3,3,'gyf','2025-08-01 06:48:10'),(106,'TL2508001211',2,11,'www.bhinneka.com','2025-08-07 07:45:51'),(107,'TL2508001209',2,12,'Sedang running test','2025-08-07 07:52:27');
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

-- Dump completed on 2025-08-11  9:19:00
