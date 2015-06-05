

DROP DATABASE if EXISTS STAT16;
CREATE DATABASE IF NOT EXISTS STAT16;
USE STAT16;

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



DROP TABLE IF EXISTS `TeamTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TeamTable` (
  `team_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `team_name` varchar(30) NOT NULL,
  `team_contact` varchar(30) NOT NULL,
  `team_password` varchar(30) NOT NULL,
  `team_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;



