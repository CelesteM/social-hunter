-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: notfacebook
-- ------------------------------------------------------
-- Server version	5.7.16

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
-- Table structure for table `Advertisements`
--

DROP TABLE IF EXISTS `Advertisements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Advertisements` (
  `AdvertisementID` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` int(10) NOT NULL,
  `Category` varchar(45) NOT NULL,
  `AdvertisedDate` datetime NOT NULL,
  `Company` varchar(45) NOT NULL,
  `ItemName` char(45) NOT NULL,
  `Content` varchar(200) DEFAULT NULL,
  `UnitPrice` double NOT NULL,
  `AvailableUnits` int(11) NOT NULL,
  PRIMARY KEY (`AdvertisementID`)
) ENGINE=InnoDB AUTO_INCREMENT=10000007 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Advertisements`
--

LOCK TABLES `Advertisements` WRITE;
/*!40000 ALTER TABLE `Advertisements` DISABLE KEYS */;
INSERT INTO `Advertisements` VALUES (10000000,346892478,'Skin Care','2016-01-10 00:00:00','Jurlique','Rose Deep Moisturizer','Helps rebalance oiliness\n \n			Helps to hydrate, soothe and calm skin\n\n            Helps provide protection against environmental aggressors',60,100),(10000001,757714949,'Food','2016-01-10 00:00:00','Mango A','Dried Mango Slices','Organic dried mango slices',5,100),(10000002,673308526,'Food','2016-02-10 00:00:00','Berrry!','Super Berries',NULL,5,100),(10000003,506871233,'Office','2016-02-10 00:00:00','NoteNote','Planner',NULL,15,100),(10000004,506871233,'Food','2016-03-10 00:00:00','Hey Chips','Chip',NULL,1,100),(10000005,757714949,'Food','2016-03-10 00:00:00','Mango A','Organic Dried Mango',NULL,2,100),(10000006,673308526,'Clothing','2016-04-10 00:00:00','Forever 21','Shiny Earring',NULL,20,100);
/*!40000 ALTER TABLE `Advertisements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-09 13:40:59
