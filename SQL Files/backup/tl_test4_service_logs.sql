CREATE DATABASE  IF NOT EXISTS `tl_test4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `tl_test4`;
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
) ENGINE=InnoDB AUTO_INCREMENT=1203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_logs`
--

LOCK TABLES `service_logs` WRITE;
/*!40000 ALTER TABLE `service_logs` DISABLE KEYS */;
INSERT INTO `service_logs` VALUES (1153,'TL2507001153','2025-07-16','Customer 1','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567801','PN987654301','SKU001','BrandX1','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1154,'TL2507001154','2025-07-16','Customer 2','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567802','PN987654301','SKU002','BrandX2','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1155,'TL2507001155','2025-07-16','Customer 3','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567803','PN987654301','SKU003','BrandX3','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1156,'TL2507001156','2025-07-16','Customer 4','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567804','PN987654301','SKU004','BrandX4','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1157,'TL2507001157','2025-07-16','Customer 5','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567805','PN987654301','SKU005','BrandX5','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1158,'TL2507001158','2025-07-16','Customer 6','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567806','PN987654301','SKU006','BrandX6','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1159,'TL2507001159','2025-07-16','Customer 7','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567807','PN987654301','SKU007','BrandX7','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1160,'TL2507001160','2025-07-16','Customer 8','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567808','PN987654301','SKU008','BrandX8','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1161,'TL2507001161','2025-07-16','Customer 9','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567809','PN987654301','SKU009','BrandX9','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1162,'TL2507001162','2025-07-16','Customer 10','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567810','PN987654301','SKU010','BrandX10','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1163,'TL2507001163','2025-07-16','Customer 11','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567811','PN987654301','SKU011','BrandX11','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1164,'TL2507001164','2025-07-16','Customer 12','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567812','PN987654301','SKU012','BrandX12','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1165,'TL2507001165','2025-07-16','Customer 13','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567813','PN987654301','SKU013','BrandX13','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1166,'TL2507001166','2025-07-16','Customer 14','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567814','PN987654301','SKU014','BrandX14','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1167,'TL2507001167','2025-07-16','Customer 15','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567815','PN987654301','SKU015','BrandX15','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1168,'TL2507001168','2025-07-16','Customer 16','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567816','PN987654301','SKU016','BrandX16','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1169,'TL2507001169','2025-07-16','Customer 17','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567817','PN987654301','SKU017','BrandX17','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1170,'TL2507001170','2025-07-16','Customer 18','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567818','PN987654301','SKU018','BrandX18','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1171,'TL2507001171','2025-07-16','Customer 19','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567819','PN987654301','SKU019','BrandX19','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1172,'TL2507001172','2025-07-16','Customer 20','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567820','PN987654301','SKU020','BrandX20','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1173,'TL2507001173','2025-07-16','Customer 21','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567821','PN987654301','SKU021','BrandX21','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1174,'TL2507001174','2025-07-16','Customer 22','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567822','PN987654301','SKU022','BrandX22','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1175,'TL2507001175','2025-07-16','Customer 23','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567823','PN987654301','SKU023','BrandX23','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1176,'TL2507001176','2025-07-16','Customer 24','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567824','PN987654301','SKU024','BrandX24','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1177,'TL2507001177','2025-07-16','Customer 25','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567825','PN987654301','SKU025','BrandX25','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1178,'TL2507001178','2025-07-16','Customer 26','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567826','PN987654301','SKU026','BrandX26','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1179,'TL2507001179','2025-07-16','Customer 27','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567827','PN987654301','SKU027','BrandX27','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1180,'TL2507001180','2025-07-16','Customer 28','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567828','PN987654301','SKU028','BrandX28','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1181,'TL2507001181','2025-07-16','Customer 29','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567829','PN987654301','SKU029','BrandX29','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1182,'TL2507001182','2025-07-16','Customer 30','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567830','PN987654301','SKU030','BrandX30','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1183,'TL2507001183','2025-07-16','Customer 31','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567831','PN987654301','SKU031','BrandX31','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1184,'TL2507001184','2025-07-16','Customer 32','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567832','PN987654301','SKU032','BrandX32','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1185,'TL2507001185','2025-07-16','Customer 33','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567833','PN987654301','SKU033','BrandX33','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1186,'TL2507001186','2025-07-16','Customer 34','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567834','PN987654301','SKU034','BrandX34','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1187,'TL2507001187','2025-07-16','Customer 35','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567835','PN987654301','SKU035','BrandX35','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1188,'TL2507001188','2025-07-16','Customer 36','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567836','PN987654301','SKU036','BrandX36','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1189,'TL2507001189','2025-07-16','Customer 37','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567837','PN987654301','SKU037','BrandX37','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1190,'TL2507001190','2025-07-16','Customer 38','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567838','PN987654301','SKU038','BrandX38','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1191,'TL2507001191','2025-07-16','Customer 39','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567839','PN987654301','SKU039','BrandX39','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1192,'TL2507001192','2025-07-16','Customer 40','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567840','PN987654301','SKU040','BrandX40','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1193,'TL2507001193','2025-07-16','Customer 41','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567841','PN987654301','SKU041','BrandX41','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1194,'TL2507001194','2025-07-16','Customer 42','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567842','PN987654301','SKU042','BrandX42','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1195,'TL2507001195','2025-07-16','Customer 43','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567843','PN987654301','SKU043','BrandX43','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1196,'TL2507001196','2025-07-16','Customer 44','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567844','PN987654301','SKU044','BrandX44','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1197,'TL2507001197','2025-07-16','Customer 45','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567845','PN987654301','SKU045','BrandX45','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1198,'TL2507001198','2025-07-16','Customer 46','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567846','PN987654301','SKU046','BrandX46','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1199,'TL2507001199','2025-07-16','Customer 47','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567847','PN987654301','SKU047','BrandX47','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1200,'TL2507001200','2025-07-16','Customer 48','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567848','PN987654301','SKU048','BrandX48','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1201,'TL2507001201','2025-07-16','Customer 49','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567849','PN987654301','SKU049','BrandX49','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12'),(1202,'TL2507001202','2025-07-16','Customer 50','123 Main St','0812000001','customer1@example.com','John Doe1','SN1234567850','PN987654301','SKU050','BrandX50','Product description C','No power','Checked motherboard','Add-on A','SO67890','2024-01-23','1',3,1,1,'2024-01-24','2024-01-30','2024-01-29','2025-07-16 07:10:12','2025-07-16 07:10:12');
/*!40000 ALTER TABLE `service_logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER techlog_id_insertion
BEFORE insert ON service_logs
FOR EACH ROW
BEGIN
	  set @auto_id := ( SELECT AUTO_INCREMENT 
                    FROM INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_NAME='service_logs'
                      AND TABLE_SCHEMA='tl_test4' ); 

    IF (NEW.techlog_id = 'N/A') THEN
        SET NEW.techlog_id = techlogIdGenerate(@auto_id);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-16 16:51:20
