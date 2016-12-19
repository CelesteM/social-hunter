-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: not_facebook
-- ------------------------------------------------------
-- Server version	5.7.15-log

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `City` char(45) DEFAULT NULL,
  `State` char(45) DEFAULT NULL,
  `ZipCode` int(11) DEFAULT NULL,
  `Telephone` int(11) DEFAULT NULL,
  `Email` char(45) NOT NULL,
  `AccountNumber` int(11) NOT NULL,
  `CreationDate` date NOT NULL,
  `CreditCardNumber` int(11) DEFAULT NULL,
  `Rating` varchar(45) DEFAULT NULL,
  `Preferences` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (100001,'Collins','Michael',NULL,'Washington DC','DC',12345,228807080,'Michael.Collins@cse305.sstonybrook.edu',900001,'2016-12-06',NULL,NULL,'Slacklining,Skateboarding,Surfing,Orienteering,Water sports'),(100002,'Rose','Aria',NULL,'New York','NY',10001,263303749,'Aria.Rose@cse305.stonybrook.edu',900002,'2016-12-06',NULL,NULL,'Topiary,Jogging'),(100003,'Black','Jase',NULL,'Washington DC','DC',12345,917443776,'Jase.Black@cse305.stonybrook.edu',900002,'2016-12-06',NULL,NULL,'Rugby,Roller skating,Life insurance,Rock climbing,Scouting'),(100004,'Franklin','Ellie',NULL,'Stony Brook','NY',11794,381870672,'Ellie.Franklin@cse305.stonybrook.edu',900004,'2016-12-06',NULL,NULL,'Cars,Skydiving,Bird watching,Sailing,Shopping,Skimboarding,Kayaking,Camping,Blacksmithing'),(100005,'Wells','Mackenzie',NULL,'New York','NY',10001,736594241,'Mackenzie.Wells@cse305.stonybrook.edu',900005,'2016-12-06',NULL,NULL,'Hunting,Topiary,Nordic skating,Foraging,Metal detecting,Camping,Astronomy'),(100006,'Armstrong','Cameron',NULL,'New York','NY',10001,182209299,'Cameron.Armstrong@cse305.stonybrook.edu',900006,'2016-12-06',NULL,NULL,'Skydiving,Topiary,Scuba diving,Sailing,Beekeeping,Tai chi,Brazilian jiu-jitsu,Astronomy,Jogging'),(100007,'Ross','Levi',NULL,'Stony Brook','NY',11794,127536938,'Levi.Ross@cse305.stonybrook.edu',900007,'2016-12-06',NULL,NULL,'Urban exploration,Freestyle football'),(100008,'West','Levi',NULL,'New York','NY',10001,699136094,'Levi.West@cse305.stonybrook.edu',900008,'2016-12-06',NULL,NULL,'BASE jumping,Letterboxing,Roller skating,Metal detecting,Swimming,Mountaineering,Sculling or Rowing,Basketball,Surfing'),(100009,'Christian','Davies',NULL,'Stony Brook','NY',11794,364390765,'Christian.Davies@cse305.stonybrook.edu',900009,'2016-12-06',NULL,NULL,'BASE jumping,Driving,Mountaineering'),(100010,'Davies','Kylie',NULL,'New York','NY',10001,562348521,'Kylie.Davies@cse305.stonybrook.edu',900010,'2016-12-06',NULL,NULL,'Toys,Graffiti,Skiing,Road biking,Kayaking'),(100011,'Long','Tyler',NULL,'Stony Brook','NY',11794,306139234,'Tyler.Long@cse305.stonybrook.edu',900011,'2016-12-06',NULL,NULL,'Topiary,Basketball'),(100012,'Stewart','Henry',NULL,'Washington DC','DC',12345,503422119,'Henry.Stewart@cse305.stonybrook.edu',900012,'2016-12-06',NULL,NULL,'Roller skating,Netball,Flag football,Water sports'),(100013,'Bennett','Isaiah',NULL,'Washington DC','DC',12345,929342276,'Isaiah.Bennett@cse305.stonybrook.edu',900013,'2016-12-06',NULL,NULL,'Walking,Baseball,Scuba diving,Running,Shopping'),(100014,'Dunn','Arianna',NULL,'New York','NY',10001,311083148,'Arianna.Dunn@cse305.stonybrook.edu',900014,'2016-12-06',NULL,NULL,'Shooting,Ghost hunting,Horseback riding,Netball,Astronomy'),(100015,'Powell','Victoria',NULL,'New York','NY',10001,854902993,'Victoria.Powell@cse305.stonybrook.edu',900015,'2016-12-06',NULL,NULL,'LARPing,Walking,Slacklining,Foraging,Rock climbing,Taekwondo,Inline skating'),(100016,'Blakely','Alexander',NULL,'Washington DC','DC',12345,140361398,'Alexander.Blakely@cse305.stonybrook.edu',900016,'2016-12-06',NULL,NULL,'Hooping,Bird watching,Shooting,Board sports,Graffiti,Sculling or Rowing'),(100017,'Collins','Connor',NULL,'New York','NY',10001,282433780,'Connor.Collins@cse305.stonybrook.edu',900017,'2016-12-06',NULL,NULL,'Rugby,Skiing,Snowboarding,Rock climbing,Swimming,Skimboarding,Scouting'),(100018,'Miller','Jeremiah',NULL,'New York','NY',10001,533130991,'Jeremiah.Miller@cse305.stonybrook.edu',900018,'2016-12-06',NULL,NULL,'Urban exploration,Roller skating,Bird watching,Skiing,Kayaking,Mushroom hunting/Mycology'),(100019,'Field','Riley',NULL,'New York','NY',10001,477174572,'Riley.Field@cse305.stonybrook.edu',900019,'2016-12-06',NULL,NULL,'Photography,LARPing,Shooting,Archery,Kayaking,Fishing ,Astronomy'),(100020,'Phillips','Lucy',NULL,'New York','NY',10001,995652638,'Lucy.Phillips@cse305.stonybrook.edu',900020,'2016-12-06',NULL,NULL,'Parkour,Rock climbing,Handball,Surfing');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-07  0:30:36
