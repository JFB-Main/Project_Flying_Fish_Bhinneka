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
-- Table structure for table `service_logs`
--

DROP TABLE IF EXISTS `service_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `techlog_id` varchar(12) NOT NULL DEFAULT 'N/A',
  `date_in` date DEFAULT NULL,
  `received_from` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `SKU` varchar(255) DEFAULT NULL,
  `brand_type` varchar(255) DEFAULT NULL,
  `description_product` text DEFAULT NULL,
  `problem` text DEFAULT NULL,
  `pre_diagnostic` text DEFAULT NULL,
  `add_on` text DEFAULT NULL,
  `sales_order` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `warranty_status` varchar(255) NOT NULL,
  `create_by` int(10) unsigned NOT NULL,
  `service_type` int(10) unsigned DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL DEFAULT 1,
  `part_ready` date DEFAULT NULL,
  `completed_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_logs_techlog_id_unique` (`techlog_id`),
  KEY `service_logs_service_type_foreign` (`service_type`),
  KEY `service_logs_status_id_foreign` (`status_id`),
  KEY `service_logs_create_by_foreign` (`create_by`),
  CONSTRAINT `service_logs_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_logs_service_type_foreign` FOREIGN KEY (`service_type`) REFERENCES `service_type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_logs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_logs`
--

LOCK TABLES `service_logs` WRITE;
/*!40000 ALTER TABLE `service_logs` DISABLE KEYS */;
INSERT INTO `service_logs` VALUES (1,'TL250800001','2025-08-11','javier farel','73C No, Jl. Gn. Sahari 5–6, Gn. Sahari Sel., Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10610','0877563513','admin@gmail.com','javier farel','SN987654399','PN987654399','SKU99933781331','Lenovo','Desc1','Problem1','Pre Diagnostic1','Add-on1','SO67899','2025-08-11','2',3,1,7,NULL,NULL,NULL,'2025-08-11 01:48:58','2025-08-11 20:14:36'),(2,'TL250800002','2025-08-11','javier fareladda','73C No, Jl. Gn. Sahari 5–6, Gn. Sahdsadsaari Sel., Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10610','087756351334','admadadin@gmail.com','javier farelsadads','SN96538721HG39','PN987653E4690','SKU215471283','Dell','Desc1','Problem2','Pre Diagnostic2','Add-on2','SO67899333','2025-08-11','1',3,1,7,NULL,NULL,NULL,'2025-08-11 01:49:55','2025-08-11 20:13:01'),(3,'TL260800001','2026-08-11','aa','','12332456','','aa','','','','','','','','','',NULL,'',3,2,8,NULL,'2025-08-12','2025-08-12','2026-08-11 01:52:33','2025-08-11 20:11:59'),(4,'TL260800002','2026-08-11','adasd','adad2123ADAD#$@#$$@#@!(*&^%$#@','0877563513','admin@gmail.com','adadadad2123ADAD#$@#$$@#@!(*&^%$#@','adad2123ADAD#$@#$$@#@!(*&^%$#@','adad2123ADAD#$@#$$@#@!(*&^%$#@','ads2adad2123ADAD#$@#$$@#@!(*&^%$#@','adad2123ADAD#$@#$$@#@!(*&^%$#@','waawdwda1344@%&*E@$','waawdwda1344@%&*E@$','waawdwda1344@%&*E@$','waawdwda1344@%&*E@$','23ADAD#$@#$$@#@!(*&^%$#@','2025-08-13','3',3,2,3,'2025-08-12',NULL,NULL,'2026-08-11 01:54:28','2025-08-12 23:44:49'),(5,'TL270100001','2027-01-02','javier farel2027','73C No, Jl. Gn. Sahari 5–6, Gn. Sahari Sel., Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10610','123324562027','japir2027@gmail.com','ja2027','','','','','','','','','SO2027','2027-01-02','',3,1,7,NULL,NULL,NULL,'2027-01-02 01:55:51','2025-08-11 20:13:24'),(6,'TL250800003','2025-08-12','dadadaw','adawdwda','0877563513','admin@gmail.com','aawd','','','','','','','','','SO67899','2025-08-12','',3,1,7,NULL,NULL,NULL,'2025-08-11 20:14:01','2025-08-11 20:37:47'),(7,'TL250800004','2025-08-12','javier farel','','0877563513','dimas.ir@isasasasds.com','','','','','','','','','','098765dcf','2025-08-12','',3,1,7,NULL,NULL,NULL,'2025-08-11 20:15:19','2025-08-11 20:37:53'),(8,'TL250800005','2025-08-12','Test Memory Leak','Jl. Test Memory Leak','12332456','Test@Memory.Leak','Test Memory Leak CoPe','SNTML1','PNTML1','SKU09856','DELL','aTest Memory Leak','TML1','TML1','TML1','SO67899','2025-08-15','1',3,1,1,NULL,NULL,NULL,'2025-08-11 20:51:40','2025-08-11 20:51:40'),(9,'TL250800006','2025-08-12','javier farel','Jakarta Selatan','21234242','gggaming@gmail.com','javier farel','SN987654400','PN9111111111','SKU99933781331','DELL','xaSa','s','sa','as','SO67899','2025-08-12','3',3,2,1,NULL,NULL,NULL,'2025-08-11 20:53:30','2025-08-11 20:53:30'),(10,'TL250800007','2025-08-12','Kevin Winandra','','12332456','','Kevin Winandra','','','','','','','','','SO67899',NULL,'',11,2,1,NULL,NULL,NULL,'2025-08-11 21:37:59','2025-08-11 21:37:59'),(12,'TL250800009','2025-08-12','Bidi Wicaksono','','12332456','gggaming@gmail.com','Bidi Wicaksono','','','','','','','','','',NULL,'',11,1,2,NULL,NULL,NULL,'2025-08-11 21:41:28','2025-08-11 23:29:55');
/*!40000 ALTER TABLE `service_logs` ENABLE KEYS */;
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
