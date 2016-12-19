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
-- Table structure for table `Employees`
--

DROP TABLE IF EXISTS `Employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Employees` (
  `SSN` int(10) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `City` char(45) DEFAULT NULL,
  `State` char(45) DEFAULT NULL,
  `ZipCode` int(11) DEFAULT NULL,
  `Telephone` varchar(15) DEFAULT NULL,
  `StartDate` date NOT NULL,
  `HourlyRate` double NOT NULL,
  PRIMARY KEY (`SSN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employees`
--

LOCK TABLES `Employees` WRITE;
/*!40000 ALTER TABLE `Employees` DISABLE KEYS */;
INSERT INTO `Employees` VALUES (346892478,'Steven','Cunningham','3585 Jenifer Street','Saginaw','MI',29654,'269-782-9933','2016-01-01',45),(506871233,'Kenneth','Jordan','37539 Anderson Court','Glendale','AZ',68001,'345-973-1465','2016-01-01',60),(579886654,'Karen','Pollich','5 Shanahan Spring','Crooksfurt','Connecticut',74012,'268-779-8045','2016-02-01',45),(672330526,'Ottilie','Collier','926 Kian Glens','Crooksfurt','Connecticut',74012,'463-257-7634','2016-02-01',40),(673308526,'Jesse','Foster','6285 Almo Parkway','Nashville','TN',32006,'420-669-7650','2016-05-01',40),(757714949,'Jose','Peterson','06330 Sheridan Drive','Los Angeles','CA',45032,'127-247-2956','2016-03-01',65),(826977228,'Carl','Williamson','0882 Ramsey Park','El Paso','FL',32789,'823-281-2910','2016-02-01',45);
/*!40000 ALTER TABLE `Employees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-09 13:24:04
