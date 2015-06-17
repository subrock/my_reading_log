-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: MY_READING_LOG
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `AdminTable`
--

DROP TABLE IF EXISTS `AdminTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AdminTable` (
  `admin_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_email` varchar(50) DEFAULT NULL,
  `admin_status` tinyint(1) DEFAULT NULL,
  `admin_autosave` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AdminTable`
--

LOCK TABLES `AdminTable` WRITE;
/*!40000 ALTER TABLE `AdminTable` DISABLE KEYS */;
INSERT INTO `AdminTable` VALUES (1,'admin','password','subrock@gmail.com',1,1);
/*!40000 ALTER TABLE `AdminTable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EntryTable`
--

DROP TABLE IF EXISTS `EntryTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EntryTable` (
  `entry_id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `entry_reader_id` smallint(8) DEFAULT NULL,
  `entry_date` varchar(250) DEFAULT NULL,
  `entry_title` varchar(250) DEFAULT NULL,
  `entry_author` varchar(250) DEFAULT NULL,
  `entry_level` varchar(25) DEFAULT NULL,
  `entry_genre` varchar(25) DEFAULT NULL,
  `entry_complete` varchar(25) DEFAULT NULL,
  `entry_start` smallint(8) DEFAULT NULL,
  `entry_end` smallint(8) DEFAULT NULL,
  `entry_minutes` smallint(8) DEFAULT NULL,
  `entry_real_date` datetime DEFAULT NULL,
  PRIMARY KEY (`entry_id`),
  UNIQUE KEY `entry_id` (`entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=255 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EntryTable`
--

LOCK TABLES `EntryTable` WRITE;
/*!40000 ALTER TABLE `EntryTable` DISABLE KEYS */;
INSERT INTO `EntryTable` VALUES (1,1,'2015-05-13','book title','book author','1','F','Yes',1,99,30,'0000-00-00 00:00:00'),(2,1,'2015-05-14','book title 2','book author 2','1','NF','',1,99,35,'0000-00-00 00:00:00'),(3,1,'2015-05-15','book title 3','book author 3','1','F','',1,99,60,'0000-00-00 00:00:00'),(4,1,'2015-05-16','book title 3','book author 3','1','F','',100,115,20,'0000-00-00 00:00:00'),(5,1,'2015-05-16','book title 3','book author 3','1','F','Yes',116,140,20,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `EntryTable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReaderTable`
--

DROP TABLE IF EXISTS `ReaderTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReaderTable` (
  `reader_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `reader_name` varchar(30) NOT NULL,
  `reader_password` varchar(30) NOT NULL,
  `reader_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`reader_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1020 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReaderTable`
--

LOCK TABLES `ReaderTable` WRITE;
/*!40000 ALTER TABLE `ReaderTable` DISABLE KEYS */;
INSERT INTO `ReaderTable` VALUES (1,'karls','testme','test@test.com'),(2,'karls','testme','test@test.com'),(1001,'karls','testme','test@test.com'),(1002,'karls','testme','test@test.com'),(1003,'karls','testme',''),(1004,'karls','testme','karls@subrock.org'),(1005,'karls','testme','karls@subrock.org'),(1006,'karls','testme','karls@subrock.org'),(1007,'karls','testme',''),(1008,'testu','password',''),(1009,'testy','password',''),(1010,'karls','testme',''),(1011,'karls','testme',''),(1012,'karls','testme',''),(1013,'karls','testme',''),(1014,'karls','testme',''),(1015,'karls','testme',''),(1016,'karls','testme',''),(1017,'karls','testme',''),(1018,'karls','testme',''),(1019,'Jerome','testme','jeromesch@outlook.com');
/*!40000 ALTER TABLE `ReaderTable` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-17 12:24:25
