

DROP DATABASE if EXISTS MY_READING_LOG;
CREATE DATABASE IF NOT EXISTS MY_READING_LOG;
USE MY_READING_LOG;

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

LOCK TABLES `AdminTable` WRITE;
/*!40000 ALTER TABLE `AdminTable` DISABLE KEYS */;
INSERT INTO `AdminTable` VALUES (1,'admin','password','subrock@gmail.com',1,1);
/*!40000 ALTER TABLE `AdminTable` ENABLE KEYS */;
UNLOCK TABLES;



DROP TABLE IF EXISTS `ReaderTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReaderTable` (
  `reader_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `reader_name` varchar(30) NOT NULL,
  `reader_password` varchar(30) NOT NULL,
  `reader_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`reader_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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



