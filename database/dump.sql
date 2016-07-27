-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: localhost    Database: triad
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2-log

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
-- Table structure for table `imei`
--

DROP TABLE IF EXISTS `imei`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imei` (
  `imei_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_current` int(11) NOT NULL,
  `warehouse_destiny` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `pallet_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`imei_id`,`warehouse_current`,`warehouse_destiny`,`master_id`,`pallet_id`,`status_id`,`product_id`),
  KEY `product_imei_fk` (`product_id`),
  KEY `warehouse_imei_fk` (`warehouse_current`),
  KEY `warehouse_imei_fk1` (`warehouse_destiny`),
  KEY `master_imei_fk` (`master_id`,`warehouse_current`,`warehouse_destiny`,`pallet_id`,`status_id`),
  CONSTRAINT `master_imei_fk` FOREIGN KEY (`master_id`, `warehouse_current`, `warehouse_destiny`, `pallet_id`, `status_id`) REFERENCES `master` (`master_id`, `warehouse_current`, `warehouse_destiny`, `pallet_id`, `status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `product_imei_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `warehouse_imei_fk` FOREIGN KEY (`warehouse_current`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `warehouse_imei_fk1` FOREIGN KEY (`warehouse_destiny`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imei`
--

LOCK TABLES `imei` WRITE;
/*!40000 ALTER TABLE `imei` DISABLE KEYS */;
INSERT INTO `imei` VALUES (1,2,2,2,2,2,1,'505050'),(2,2,2,2,2,2,1,'515151'),(3,2,2,2,2,2,1,'535353'),(4,3,3,3,5,2,1,'545454'),(5,3,3,3,5,2,1,'555555');
/*!40000 ALTER TABLE `imei` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master`
--

DROP TABLE IF EXISTS `master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master` (
  `master_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_current` int(11) NOT NULL,
  `warehouse_destiny` int(11) NOT NULL,
  `pallet_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`master_id`,`warehouse_current`,`warehouse_destiny`,`pallet_id`,`status_id`),
  KEY `status_master_fk` (`status_id`),
  KEY `warehouse_master_fk` (`warehouse_current`),
  KEY `warehouse_master_fk1` (`warehouse_destiny`),
  KEY `pallet_master_fk` (`pallet_id`),
  CONSTRAINT `pallet_master_fk` FOREIGN KEY (`pallet_id`) REFERENCES `pallet` (`pallet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status_master_fk` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `warehouse_master_fk` FOREIGN KEY (`warehouse_current`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `warehouse_master_fk1` FOREIGN KEY (`warehouse_destiny`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master`
--

LOCK TABLES `master` WRITE;
/*!40000 ALTER TABLE `master` DISABLE KEYS */;
INSERT INTO `master` VALUES (1,1,1,1,2,'3131'),(2,2,2,2,2,'3232'),(3,3,1,5,2,'3333');
/*!40000 ALTER TABLE `master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pallet`
--

DROP TABLE IF EXISTS `pallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pallet` (
  `pallet_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_current` int(11) NOT NULL,
  `warehouse_destiny` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`pallet_id`,`warehouse_current`,`warehouse_destiny`,`status_id`),
  KEY `status_pallet_fk` (`status_id`),
  KEY `warehouse_pallet_fk` (`warehouse_current`),
  KEY `warehouse_pallet_fk1` (`warehouse_destiny`),
  CONSTRAINT `status_pallet_fk` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `warehouse_pallet_fk` FOREIGN KEY (`warehouse_current`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `warehouse_pallet_fk1` FOREIGN KEY (`warehouse_destiny`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pallet`
--

LOCK TABLES `pallet` WRITE;
/*!40000 ALTER TABLE `pallet` DISABLE KEYS */;
INSERT INTO `pallet` VALUES (1,1,2,2,'2020'),(2,2,2,2,'2021'),(3,1,2,1,'2022'),(4,2,2,2,'2023'),(5,3,1,2,'2024');
/*!40000 ALTER TABLE `pallet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `comercial_name` varchar(100) NOT NULL,
  `unitary_price` decimal(10,3) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'1010','iPhone 6',200.000);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(200) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'In Transit'),(2,'In Stock');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transporter`
--

DROP TABLE IF EXISTS `transporter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transporter` (
  `transporter_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`transporter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transporter`
--

LOCK TABLES `transporter` WRITE;
/*!40000 ALTER TABLE `transporter` DISABLE KEYS */;
/*!40000 ALTER TABLE `transporter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse` (
  `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse`
--

LOCK TABLES `warehouse` WRITE;
/*!40000 ALTER TABLE `warehouse` DISABLE KEYS */;
INSERT INTO `warehouse` VALUES (1,'Warehouse 1'),(2,'Warehouse 2'),(3,'Warehouse 3');
/*!40000 ALTER TABLE `warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse_limits`
--

DROP TABLE IF EXISTS `warehouse_limits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse_limits` (
  `warehouse_limits_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_origin_id` int(11) NOT NULL,
  `warehouse_target_id` int(11) NOT NULL,
  `limitation` decimal(10,3) NOT NULL,
  PRIMARY KEY (`warehouse_limits_id`,`warehouse_origin_id`,`warehouse_target_id`),
  KEY `warehouse_warehouse_limits_fk` (`warehouse_origin_id`),
  CONSTRAINT `warehouse_warehouse_limits_fk` FOREIGN KEY (`warehouse_origin_id`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse_limits`
--

LOCK TABLES `warehouse_limits` WRITE;
/*!40000 ALTER TABLE `warehouse_limits` DISABLE KEYS */;
INSERT INTO `warehouse_limits` VALUES (1,1,2,1000.000),(2,2,1,1002.000),(3,1,3,1000.000);
/*!40000 ALTER TABLE `warehouse_limits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-27 15:42:37
