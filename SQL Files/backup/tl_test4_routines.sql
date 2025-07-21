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
-- Dumping events for database 'tl_test4'
--

--
-- Dumping routines for database 'tl_test4'
--
/*!50003 DROP FUNCTION IF EXISTS `techlogIdGenerate` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `techlogIdGenerate`(input INT) RETURNS varchar(250) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
    DECLARE NumStr VARCHAR(250);
    DECLARE MonStr VARCHAR(250);
    DECLARE YearStr VARCHAR(250);
    DECLARE pad INT DEFAULT 6;
    DECLARE MonthPad INT DEFAULT 2;

    SET NumStr = CAST(input AS CHAR);  -- Convert input to string
    SET MonStr = LPAD(MONTH(NOW()), MonthPad, '0');  -- Pad month with zeros
    SET YearStr = SUBSTRING(YEAR(NOW()), 3, 2);  -- Get last two digits of the year

    IF (LENGTH(NumStr) < pad) THEN
        SET NumStr = CONCAT('TL', YearStr, MonStr, LPAD(NumStr, pad, '0'));
    ELSE
        SET NumStr = CONCAT('TL', YearStr, MonStr, NumStr);
    END IF;

    RETURN NumStr;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `InsertServiceLogs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertServiceLogs`()
BEGIN
    DECLARE x INT DEFAULT 1;
    DECLARE customer_name VARCHAR(255);

    WHILE x <= 50 DO
        SET customer_name = CONCAT('Customer ', x);
        INSERT INTO service_logs (
            date_in, received_from, alamat, mobile_number, email, contact_person, serial_number, part_number, SKU, brand_type,
            description_product, problem, pre_diagnostic, add_on, create_by, sales_order, invoice_date, warranty_status, service_type,
            part_ready, return_date, completed_date, created_at, updated_at
        ) VALUES (
            NOW(), customer_name, '123 Main St', '0812000001', 'customer1@example.com', 'John Doe1', CONCAT('SN12345678', 
            LPAD(x, 2, '0')),
            'PN987654301',
            CONCAT('SKU', LPAD(x, 3, '0')), CONCAT('BrandX', x), 'Product description C', 'No power', 'Checked motherboard', 'Add-on A',
            '3', 'SO67890', '2024-01-23', '1', '1', '2024-01-24', '2024-01-29', '2024-01-30', NOW(), NOW()
        );
        SET x = x + 1;
    END WHILE;
END ;;
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

-- Dump completed on 2025-07-16 16:51:21
