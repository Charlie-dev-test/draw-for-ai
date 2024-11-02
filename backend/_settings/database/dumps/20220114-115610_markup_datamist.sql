-- MariaDB dump 10.19  Distrib 10.6.5-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: markup_datamist
-- ------------------------------------------------------
-- Server version	10.6.5-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_logs`
--

DROP TABLE IF EXISTS `access_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `user_agent` varchar(1024) NOT NULL,
  `time` int(11) DEFAULT 0,
  `success` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_logs`
--

LOCK TABLES `access_logs` WRITE;
/*!40000 ALTER TABLE `access_logs` DISABLE KEYS */;
INSERT INTO `access_logs` VALUES (1,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640248683,1);
INSERT INTO `access_logs` VALUES (2,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640249536,1);
INSERT INTO `access_logs` VALUES (3,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640249981,1);
INSERT INTO `access_logs` VALUES (4,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640256458,1);
INSERT INTO `access_logs` VALUES (5,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640256468,1);
INSERT INTO `access_logs` VALUES (6,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640256491,1);
INSERT INTO `access_logs` VALUES (7,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640256512,1);
INSERT INTO `access_logs` VALUES (8,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0',1640258618,1);
INSERT INTO `access_logs` VALUES (9,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0',1640258631,1);
INSERT INTO `access_logs` VALUES (10,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640258733,1);
INSERT INTO `access_logs` VALUES (11,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 Edg/96.0.1054.62',1640259016,1);
INSERT INTO `access_logs` VALUES (12,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640259027,1);
INSERT INTO `access_logs` VALUES (13,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640259050,1);
INSERT INTO `access_logs` VALUES (14,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640259075,1);
INSERT INTO `access_logs` VALUES (15,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640259109,1);
INSERT INTO `access_logs` VALUES (16,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640259125,1);
INSERT INTO `access_logs` VALUES (17,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640259143,1);
INSERT INTO `access_logs` VALUES (18,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640272042,1);
INSERT INTO `access_logs` VALUES (19,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640272376,1);
INSERT INTO `access_logs` VALUES (20,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640278440,1);
INSERT INTO `access_logs` VALUES (21,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640278548,1);
INSERT INTO `access_logs` VALUES (22,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640291335,1);
INSERT INTO `access_logs` VALUES (23,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640293341,1);
INSERT INTO `access_logs` VALUES (24,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640293934,1);
INSERT INTO `access_logs` VALUES (25,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640294246,1);
INSERT INTO `access_logs` VALUES (26,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640294729,1);
INSERT INTO `access_logs` VALUES (27,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640294760,1);
INSERT INTO `access_logs` VALUES (28,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640294788,1);
INSERT INTO `access_logs` VALUES (29,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640294994,1);
INSERT INTO `access_logs` VALUES (30,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640295005,1);
INSERT INTO `access_logs` VALUES (31,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640295134,1);
INSERT INTO `access_logs` VALUES (32,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640295150,1);
INSERT INTO `access_logs` VALUES (33,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640295588,1);
INSERT INTO `access_logs` VALUES (34,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640330340,1);
INSERT INTO `access_logs` VALUES (35,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640332937,1);
INSERT INTO `access_logs` VALUES (36,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640362896,1);
INSERT INTO `access_logs` VALUES (37,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640363513,1);
INSERT INTO `access_logs` VALUES (38,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640792867,1);
INSERT INTO `access_logs` VALUES (39,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640793106,1);
INSERT INTO `access_logs` VALUES (40,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640794900,1);
INSERT INTO `access_logs` VALUES (41,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640796337,1);
INSERT INTO `access_logs` VALUES (42,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640796404,1);
INSERT INTO `access_logs` VALUES (43,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640796811,1);
INSERT INTO `access_logs` VALUES (44,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640797092,1);
INSERT INTO `access_logs` VALUES (45,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640797393,1);
INSERT INTO `access_logs` VALUES (46,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640797742,1);
INSERT INTO `access_logs` VALUES (47,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640803307,1);
INSERT INTO `access_logs` VALUES (48,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640803831,1);
INSERT INTO `access_logs` VALUES (49,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640803847,1);
INSERT INTO `access_logs` VALUES (50,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640804667,1);
INSERT INTO `access_logs` VALUES (51,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640804680,1);
INSERT INTO `access_logs` VALUES (52,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640804693,1);
INSERT INTO `access_logs` VALUES (53,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640804718,1);
INSERT INTO `access_logs` VALUES (54,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640805948,1);
INSERT INTO `access_logs` VALUES (55,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806007,1);
INSERT INTO `access_logs` VALUES (56,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806085,1);
INSERT INTO `access_logs` VALUES (57,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806096,1);
INSERT INTO `access_logs` VALUES (58,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806124,1);
INSERT INTO `access_logs` VALUES (59,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806147,1);
INSERT INTO `access_logs` VALUES (60,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806180,1);
INSERT INTO `access_logs` VALUES (61,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806214,1);
INSERT INTO `access_logs` VALUES (62,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806230,1);
INSERT INTO `access_logs` VALUES (63,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806293,1);
INSERT INTO `access_logs` VALUES (64,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806351,1);
INSERT INTO `access_logs` VALUES (65,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806374,1);
INSERT INTO `access_logs` VALUES (66,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640806412,1);
INSERT INTO `access_logs` VALUES (67,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640807108,1);
INSERT INTO `access_logs` VALUES (68,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640807199,1);
INSERT INTO `access_logs` VALUES (69,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640807309,1);
INSERT INTO `access_logs` VALUES (70,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640807328,1);
INSERT INTO `access_logs` VALUES (71,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640812425,1);
INSERT INTO `access_logs` VALUES (72,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640819153,1);
INSERT INTO `access_logs` VALUES (73,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1640847161,1);
INSERT INTO `access_logs` VALUES (74,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',1641900104,1);
INSERT INTO `access_logs` VALUES (75,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641970483,1);
INSERT INTO `access_logs` VALUES (76,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641976445,1);
INSERT INTO `access_logs` VALUES (77,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641976482,1);
INSERT INTO `access_logs` VALUES (78,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641976744,1);
INSERT INTO `access_logs` VALUES (79,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641976802,1);
INSERT INTO `access_logs` VALUES (80,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641977341,1);
INSERT INTO `access_logs` VALUES (81,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641978810,1);
INSERT INTO `access_logs` VALUES (82,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641978912,1);
INSERT INTO `access_logs` VALUES (83,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641979464,1);
INSERT INTO `access_logs` VALUES (84,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641979525,1);
INSERT INTO `access_logs` VALUES (85,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641980551,1);
INSERT INTO `access_logs` VALUES (86,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641980572,1);
INSERT INTO `access_logs` VALUES (87,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641980803,1);
INSERT INTO `access_logs` VALUES (88,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641982368,1);
INSERT INTO `access_logs` VALUES (89,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641985203,1);
INSERT INTO `access_logs` VALUES (90,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641985240,1);
INSERT INTO `access_logs` VALUES (91,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641985540,1);
INSERT INTO `access_logs` VALUES (92,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641985730,1);
INSERT INTO `access_logs` VALUES (93,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641985820,1);
INSERT INTO `access_logs` VALUES (94,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641985910,1);
INSERT INTO `access_logs` VALUES (95,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641985988,1);
INSERT INTO `access_logs` VALUES (96,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641986021,1);
INSERT INTO `access_logs` VALUES (97,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641986049,1);
INSERT INTO `access_logs` VALUES (98,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641986701,1);
INSERT INTO `access_logs` VALUES (99,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1641986754,1);
INSERT INTO `access_logs` VALUES (100,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642010501,1);
INSERT INTO `access_logs` VALUES (101,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642010650,1);
INSERT INTO `access_logs` VALUES (102,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642010710,1);
INSERT INTO `access_logs` VALUES (103,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642010813,1);
INSERT INTO `access_logs` VALUES (104,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642010819,1);
INSERT INTO `access_logs` VALUES (105,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642018027,1);
INSERT INTO `access_logs` VALUES (106,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642018045,1);
INSERT INTO `access_logs` VALUES (107,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642018076,1);
INSERT INTO `access_logs` VALUES (108,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642018089,1);
INSERT INTO `access_logs` VALUES (109,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642022828,1);
INSERT INTO `access_logs` VALUES (110,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642022836,1);
INSERT INTO `access_logs` VALUES (111,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642022859,1);
INSERT INTO `access_logs` VALUES (112,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642081598,1);
INSERT INTO `access_logs` VALUES (113,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642082799,1);
INSERT INTO `access_logs` VALUES (114,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642145978,1);
INSERT INTO `access_logs` VALUES (115,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642149544,1);
INSERT INTO `access_logs` VALUES (116,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642149833,1);
INSERT INTO `access_logs` VALUES (117,'editor','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642150228,1);
INSERT INTO `access_logs` VALUES (118,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642150238,1);
INSERT INTO `access_logs` VALUES (119,'user','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642150335,1);
INSERT INTO `access_logs` VALUES (120,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642150344,1);
INSERT INTO `access_logs` VALUES (121,'editor','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642150382,1);
INSERT INTO `access_logs` VALUES (122,'admin','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642150409,1);
INSERT INTO `access_logs` VALUES (123,'manager','******','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',1642150431,1);
/*!40000 ALTER TABLE `access_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `orderid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('editor','41',1640293462,22,0,22);
INSERT INTO `auth_assignment` VALUES ('empty','141',1576752047,7,0,7);
INSERT INTO `auth_assignment` VALUES ('manager','143',1640293462,24,0,24);
INSERT INTO `auth_assignment` VALUES ('root','39',1640293462,21,0,21);
INSERT INTO `auth_assignment` VALUES ('user','142',1640293462,23,0,23);
INSERT INTO `auth_assignment` VALUES ('user','144',1640847667,25,0,25);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `orderid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES (1,'root',1,'Имеет доступ ко всему',NULL,NULL,1572427408,1640803266,1,1);
INSERT INTO `auth_item` VALUES (3,'adduser',2,'Добавление пользователя',NULL,NULL,1572427533,1572429191,1,3);
INSERT INTO `auth_item` VALUES (2,'editor',1,'Редактор',NULL,NULL,1572427512,1572429201,1,2);
INSERT INTO `auth_item` VALUES (4,'view',2,'Просмотр содержимого',NULL,NULL,1572427554,1572427597,1,4);
INSERT INTO `auth_item` VALUES (5,'delete',2,'Удаление содержимого',NULL,NULL,1572427567,1572429216,1,6);
INSERT INTO `auth_item` VALUES (6,'update',2,'Изменение содержимого',NULL,NULL,1572427586,1572429216,1,5);
INSERT INTO `auth_item` VALUES (7,'empty',1,'Тестовый Юзер',NULL,NULL,1576751880,1576751936,1,7);
INSERT INTO `auth_item` VALUES (8,'user',1,'Закрыты все доступы, только личный кабинет!',NULL,NULL,1577368034,1640361152,1,8);
INSERT INTO `auth_item` VALUES (9,'manager',1,'Просмотр информации о пользователях',NULL,NULL,1640249203,1640806395,1,9);
INSERT INTO `auth_item` VALUES (10,'create',2,'Создание содержимого',NULL,NULL,1640797159,NULL,1,10);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `orderid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('9','update',3,0,3);
INSERT INTO `auth_item_child` VALUES ('9','delete',2,0,2);
INSERT INTO `auth_item_child` VALUES ('9','create',1,0,1);
INSERT INTO `auth_item_child` VALUES ('9','view',4,0,4);
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL DEFAULT 1,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `actions` blob DEFAULT NULL,
  `roles` blob DEFAULT NULL,
  `controllers` blob DEFAULT NULL,
  `menus` blob DEFAULT NULL,
  `sections` blob DEFAULT NULL,
  `ips` text COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `allow` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` VALUES (8,'manger_useroffer',3,'a:7:{s:7:\"actions\";a:6:{i:0;s:6:\"active\";i:1;s:6:\"create\";i:2;s:6:\"delete\";i:3;s:4:\"down\";i:4;s:2:\"up\";i:5;s:6:\"update\";}s:5:\"roles\";a:1:{i:0;s:7:\"manager\";}s:11:\"controllers\";N;s:3:\"ips\";N;s:5:\"menus\";N;s:8:\"sections\";a:1:{i:0;s:2:\"84\";}s:5:\"allow\";s:1:\"1\";}',1641979504,1642011203,1,8,'a:6:{i:0;s:6:\"active\";i:1;s:6:\"create\";i:2;s:6:\"delete\";i:3;s:4:\"down\";i:4;s:2:\"up\";i:5;s:6:\"update\";}','a:1:{i:0;s:7:\"manager\";}','N;','a:0:{}','a:1:{i:0;s:2:\"84\";}',NULL,1);
INSERT INTO `auth_rule` VALUES (7,'manger_common',3,'a:7:{s:7:\"actions\";a:3:{i:0;s:6:\"active\";i:1;s:5:\"index\";i:2;s:4:\"view\";}s:5:\"roles\";a:1:{i:0;s:7:\"manager\";}s:11:\"controllers\";s:40:\"s:32:\"s:24:\"s:16:\"s:9:\"s:2:\"N;\";\";\";\";\";\";s:3:\"ips\";N;s:5:\"menus\";s:6:\"a:0:{}\";s:8:\"sections\";a:4:{i:0;s:2:\"84\";i:1;s:2:\"55\";i:2;s:2:\"82\";i:3;s:2:\"83\";}s:5:\"allow\";s:1:\"1\";}',1641975374,1642150426,1,7,'a:3:{i:0;s:6:\"active\";i:1;s:5:\"index\";i:2;s:4:\"view\";}','a:1:{i:0;s:7:\"manager\";}','s:40:\"s:32:\"s:24:\"s:16:\"s:9:\"s:2:\"N;\";\";\";\";\";\";','a:0:{}','a:4:{i:0;s:2:\"84\";i:1;s:2:\"55\";i:2;s:2:\"82\";i:3;s:2:\"83\";}',NULL,1);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `pass_reset_date` date NOT NULL,
  `pass_reset_count` tinyint(3) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `role` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `access_token` varchar(1024) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (39,'admin','Website Administrator','mozolin@tillypad.ru','$2y$13$d63ma83WBwnTgBMNeehEiuL7gkBSnOkzEw7og397s5J3oasE57hjS','','evPEqEoDIuypALAs7aL8tUyfPtONoQ46','0000-00-00',0,'0000-00-00','2021-12-24','root',10,NULL,1);
INSERT INTO `user` VALUES (41,'editor','Test Editor','editor@editor.com.xyz','$2y$13$KIx...QsyizU6BEs0R3wz.ZQIlQVqX97OBS.RR4htoqXVIU3CySd.','','tE_dCvqqTi19gRiCmAuSwn14fBo6PTWq','0000-00-00',0,'0000-00-00','2021-12-24','editor',10,NULL,1);
INSERT INTO `user` VALUES (142,'user','Test User','user@user.net.xyz','$2y$13$UW1vUetpc4.WKuGkqfUQreuLD6h35GFKVTN1l/e7Pc3tX3iwQsX0K','','tBmzIZvETAJDSE8jpSLChk8nynfStoKP','0000-00-00',0,'0000-00-00','2021-12-24','user',10,NULL,1);
INSERT INTO `user` VALUES (143,'manager','Менеджер','manager@manager.com','$2y$13$KcU1ePZfYLSViW2ZXxtSQ.1Kn9JmmZDa/HPGUBgOvJs2ZiEameLpq','','UoKSTdgIH6xi2pwelVMFLzp9XcwDPR9k','0000-00-00',0,'2021-12-23','2021-12-24','manager',10,NULL,1);
INSERT INTO `user` VALUES (144,'petya_vasechkin','Петя Васечкин','peter_vasya@super.com','$2y$13$PTiWqL/9.57NrTIqHuGMsO61aWSXUbOJM/ax/KdRGPBt7lKGjvMSe','','aXvGa40FAGWyW2g68qUFBzPAlynQ-14S','0000-00-00',0,'2021-12-30','2021-12-30','user',10,NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userdata`
--

DROP TABLE IF EXISTS `userdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `citizenship` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'гражданство',
  `dob` date DEFAULT NULL COMMENT 'Дата рождения',
  `passport` text COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'паспортные данные',
  `address_reg` text COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'адрес места регистрации',
  `address_loc` text COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'адрес фактического проживания',
  `phone` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'номер мобильного телефона',
  `inn` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'номер ИНН',
  `snils` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'номер СНИЛС',
  `bank_card` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '№ банковской карты',
  `bank_account` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '№ счета, привязанного к карте',
  `bank_name` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'наименование банка',
  `bank_bik` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'БИК',
  `bank_corr` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'корр. счет',
  `token` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'Токен оферты',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `orderid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userdata`
--

LOCK TABLES `userdata` WRITE;
/*!40000 ALTER TABLE `userdata` DISABLE KEYS */;
INSERT INTO `userdata` VALUES (1,39,'Русский','1966-10-11','<p><span style=\"color:rgb(33, 37, 41)\">Паспортные данные</span></p>\r\n','<p><span style=\"color:rgb(33, 37, 41)\">Адрес места регистрации</span></p>\r\n','<p><span style=\"color:rgb(33, 37, 41)\">Адрес фактического проживания</span></p>\r\n','+79215838528','2123123','234234','123123123','234234','уцвцкцу','123123','1231вуйц','',1,1);
/*!40000 ALTER TABLE `userdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useroffer`
--

DROP TABLE IF EXISTS `useroffer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useroffer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '' COMMENT 'Токен оферты',
  `text` text COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Текст оферты',
  `date` datetime DEFAULT NULL COMMENT 'Дата создания оферты',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useroffer`
--

LOCK TABLES `useroffer` WRITE;
/*!40000 ALTER TABLE `useroffer` DISABLE KEYS */;
INSERT INTO `useroffer` VALUES (2,'WGp8OnkPllxRniXC','<h2>Пользовательское соглашение (Оферта)</h2>\r\n\r\n<p>Российская Федерация, г. Санкт-Петербург</p>\r\n\r\n<p>Дата размещения и вступления в силу - 17.12.2021г.</p>\r\n\r\n<p>Данное пользовательское соглашение заключается между Компанией и Вами, поскольку Вы являететсь интернет пользователем, проходящим регистрацию на Сайте. Вам предлагается возможность за плату оказывать Услуги Компании посредством Сайта в соответсвии с настоящим Пользовательским соглашением. ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ ЯВЛЯЕТСЯ ГРАЖДАНСКО-ПРАВОВЫМ ДОГОВОРОМ ОКАЗАНИЯ УСЛУГ МЕЖДУ ВАМИ И КОМПАНИЕЙ. ПОЖАЛУЙСТА, ВНИМАТЕЛЬНО ПРОЧИТАЙТЕ НАСТОЯЩЕЕ ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ И ПОЛИТИКУ КОНФИДЕНЦИАЛЬНОСТИ ПЕРЕД ТЕМ, КАК ПРИСТУПИТЬ К ПОЛЬЗОВАНИЮ САЙТОМ.</p>\r\n\r\n<p>Отметив чекбокс, &laquo;Я принимаю условия Пользовательского соглашения и Политики конфиденциальности&raquo;, нажимая кнопку &laquo;Принимаю изменения&raquo;, используя Сайт тем или иным образом, приступив к выполнению Задания, полученного через Сайт, ВЫ ВЫРАЖАЕТЕ СВОЁ СОГЛАСИЕ С УСЛОВИЯМИ НАСТОЯЩЕГО ПОЛЬЗОВАТЕЛЬСКОГО СОГЛАШЕНИЯ (в том числе с Политикой конфиденциальности) и БЕЗОГОВОРОЧНО ПРИНИМАЕТЕ ЭТИ УСЛОВИЯ, а также заверяете и гарантируете, что:</p>\r\n\r\n<ol>\r\n	<li>Вы внимательно прочитали и приняли настоящее Пользовательское соглашение, Политику конфиденциальности;</li>\r\n	<li>Вы вправе в соответсвии с применимым законадательством вступить в договорные отношения по настоящему Пользовательскому соглашению и не существует ничего, что ограничивало бы Вашу дееспособность;</li>\r\n	<li>Вам уже исполнилось 18 лет, и при этом Вы являетесь совершеннолетним в соответствии с законадательством страны Вашего гражданства и страны Вашего проживания. Вы уведомлены о том, что контент Сайта предназначен исключительно для совершеннолетних лиц;</li>\r\n	<li>Вы являетесь самозанятым лицом в соответсвии с законадательством Российской Федерации.</li>\r\n</ol>\r\n','2021-12-23 13:27:00',1);
INSERT INTO `useroffer` VALUES (7,'i87qWHdOOeJ1jjw2','<p>1234 356 546756 876789</p>\r\n','2021-12-23 13:46:48',0);
/*!40000 ALTER TABLE `useroffer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_files`
--

DROP TABLE IF EXISTS `z_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `source_id` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `sid` varchar(255) NOT NULL DEFAULT '',
  `orderid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `pics` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_files`
--

LOCK TABLES `z_files` WRITE;
/*!40000 ALTER TABLE `z_files` DISABLE KEYS */;
INSERT INTO `z_files` VALUES (1,0,2,2,0,'issue',2,'test','21',1,0);
INSERT INTO `z_files` VALUES (2,0,2,1,0,'issue',1,'Depositphotos','19',1,0);
INSERT INTO `z_files` VALUES (3,0,22,1,0,'help',26,'','26',1,0);
INSERT INTO `z_files` VALUES (4,0,25,1,0,'help',30,'','28',1,0);
INSERT INTO `z_files` VALUES (5,0,25,1,0,'help',31,'','29',1,0);
INSERT INTO `z_files` VALUES (6,0,25,1,0,'help',32,'','30',1,0);
INSERT INTO `z_files` VALUES (7,0,25,1,0,'help',33,'','31',1,0);
INSERT INTO `z_files` VALUES (8,0,25,1,0,'help',34,'','32',1,0);
INSERT INTO `z_files` VALUES (9,0,25,1,0,'help',35,'','33',1,0);
INSERT INTO `z_files` VALUES (10,0,25,1,0,'help',36,'','34',1,0);
INSERT INTO `z_files` VALUES (11,0,25,1,0,'help',37,'','35',1,0);
INSERT INTO `z_files` VALUES (12,0,33,1,0,'help',3,'Офис компании','36',1,0);
INSERT INTO `z_files` VALUES (13,0,33,1,0,'help',4,'','37',1,0);
INSERT INTO `z_files` VALUES (14,0,33,1,0,'help',7,'','38',1,0);
INSERT INTO `z_files` VALUES (15,0,33,1,0,'help',8,'','39',1,0);
INSERT INTO `z_files` VALUES (16,0,33,1,0,'help',9,'','40',1,0);
INSERT INTO `z_files` VALUES (17,0,33,1,0,'help',10,'','41',1,0);
INSERT INTO `z_files` VALUES (18,0,33,1,0,'help',11,'','42',1,0);
INSERT INTO `z_files` VALUES (19,0,34,1,0,'help',5,'','43',1,0);
INSERT INTO `z_files` VALUES (20,0,34,1,0,'help',6,'','44',1,0);
INSERT INTO `z_files` VALUES (21,0,34,1,0,'help',12,'','45',1,0);
INSERT INTO `z_files` VALUES (22,0,34,1,0,'help',13,'','46',1,0);
INSERT INTO `z_files` VALUES (23,0,35,1,0,'help',14,'','47',1,0);
INSERT INTO `z_files` VALUES (24,0,35,1,0,'help',15,'','48',1,0);
INSERT INTO `z_files` VALUES (25,0,35,1,0,'help',16,'','49',1,0);
INSERT INTO `z_files` VALUES (26,0,35,1,0,'help',17,'','50',1,0);
INSERT INTO `z_files` VALUES (27,0,35,1,0,'help',18,'','51',1,0);
INSERT INTO `z_files` VALUES (28,0,35,1,0,'help',19,'','52',1,0);
INSERT INTO `z_files` VALUES (29,0,36,1,0,'help',20,'','53',1,0);
INSERT INTO `z_files` VALUES (30,0,36,1,0,'help',21,'','54',1,0);
INSERT INTO `z_files` VALUES (31,0,36,1,0,'help',22,'','55',1,0);
INSERT INTO `z_files` VALUES (32,0,36,1,0,'help',23,'','56',1,0);
INSERT INTO `z_files` VALUES (33,0,36,1,0,'help',24,'','57',1,0);
INSERT INTO `z_files` VALUES (34,0,36,1,0,'help',25,'','58',1,0);
INSERT INTO `z_files` VALUES (35,0,36,1,0,'help',27,'','59',1,0);
INSERT INTO `z_files` VALUES (36,0,36,1,0,'help',28,'','60',1,0);
INSERT INTO `z_files` VALUES (37,0,36,1,0,'help',29,'','61',1,0);
INSERT INTO `z_files` VALUES (38,0,27,1,0,'help',38,'','62',1,0);
INSERT INTO `z_files` VALUES (39,0,27,1,0,'help',39,'','63',1,0);
INSERT INTO `z_files` VALUES (40,0,27,1,0,'help',40,'','64',1,0);
INSERT INTO `z_files` VALUES (41,0,27,1,0,'help',41,'','65',1,0);
INSERT INTO `z_files` VALUES (42,0,27,1,0,'help',42,'','66',1,0);
INSERT INTO `z_files` VALUES (43,0,27,1,0,'help',43,'','67',1,0);
INSERT INTO `z_files` VALUES (44,0,27,1,0,'help',44,'','68',1,0);
INSERT INTO `z_files` VALUES (45,0,27,1,0,'help',45,'','69',1,0);
INSERT INTO `z_files` VALUES (46,0,27,1,0,'help',46,'','70',1,0);
INSERT INTO `z_files` VALUES (47,0,27,1,0,'help',47,'','71',1,0);
INSERT INTO `z_files` VALUES (48,0,27,1,0,'help',48,'','72',1,0);
INSERT INTO `z_files` VALUES (49,0,27,1,0,'help',49,'','73',1,0);
INSERT INTO `z_files` VALUES (50,0,27,1,0,'help',50,'','74',1,0);
INSERT INTO `z_files` VALUES (51,0,27,1,0,'help',51,'','75',1,0);
INSERT INTO `z_files` VALUES (52,0,27,1,0,'help',52,'','76',1,0);
INSERT INTO `z_files` VALUES (53,0,27,1,0,'help',53,'','77',1,0);
INSERT INTO `z_files` VALUES (54,0,27,1,0,'help',54,'','78',1,0);
INSERT INTO `z_files` VALUES (55,0,25,1,0,'help',55,'','79',1,0);
INSERT INTO `z_files` VALUES (59,0,43,1,0,'help',56,'','85',1,0);
INSERT INTO `z_files` VALUES (60,0,43,1,0,'help',57,'','86',1,0);
INSERT INTO `z_files` VALUES (61,0,43,1,0,'help',58,'','87',1,0);
INSERT INTO `z_files` VALUES (62,0,43,1,0,'help',59,'','88',1,0);
INSERT INTO `z_files` VALUES (63,0,43,1,0,'help',60,'','89',1,0);
INSERT INTO `z_files` VALUES (64,0,43,1,0,'help',61,'','90',1,0);
INSERT INTO `z_files` VALUES (65,0,43,1,0,'help',62,'','91',1,0);
INSERT INTO `z_files` VALUES (66,0,43,1,0,'help',63,'','92',1,0);
INSERT INTO `z_files` VALUES (67,0,43,1,0,'help',64,'','93',1,0);
INSERT INTO `z_files` VALUES (68,0,43,1,0,'help',65,'','94',1,0);
INSERT INTO `z_files` VALUES (69,0,45,0,0,'help',66,'','95',1,0);
INSERT INTO `z_files` VALUES (70,0,45,0,0,'help',67,'','96',1,0);
INSERT INTO `z_files` VALUES (71,0,45,0,0,'help',68,'','97',1,0);
INSERT INTO `z_files` VALUES (72,0,45,0,0,'help',69,'','98',1,0);
INSERT INTO `z_files` VALUES (73,0,45,0,0,'help',70,'','99',1,0);
INSERT INTO `z_files` VALUES (74,0,45,0,0,'help',71,'','100',1,0);
INSERT INTO `z_files` VALUES (75,0,45,0,0,'help',72,'','101',1,0);
INSERT INTO `z_files` VALUES (76,0,45,0,0,'help',73,'','102',1,0);
INSERT INTO `z_files` VALUES (77,0,0,0,0,'frontend',74,'Петя Васечкин','106',1,144);
INSERT INTO `z_files` VALUES (78,0,0,0,0,'frontend',75,'Петя Васечкин','107',1,144);
INSERT INTO `z_files` VALUES (79,0,0,0,0,'frontend',76,'Петя Васечкин','108',1,144);
/*!40000 ALTER TABLE `z_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_helps`
--

DROP TABLE IF EXISTS `z_helps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_helps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT NULL COMMENT 'предок',
  `orderid` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL COMMENT 'сообщение',
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT '',
  `folder` tinyint(1) NOT NULL DEFAULT 1,
  `show` tinyint(1) NOT NULL DEFAULT 1,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `order_id` (`orderid`) USING BTREE,
  KEY `parent_id` (`parentid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_helps`
--

LOCK TABLES `z_helps` WRITE;
/*!40000 ALTER TABLE `z_helps` DISABLE KEYS */;
INSERT INTO `z_helps` VALUES (10,0,1,1,'','Общее описание','',1,1,0,'2020-07-13 17:31:11');
INSERT INTO `z_helps` VALUES (11,0,2,1,'','Система CMS','',1,1,1,'2020-03-31 12:11:12');
INSERT INTO `z_helps` VALUES (12,0,3,1,'','Работа с Ресурсами','',1,1,1,'2020-07-13 18:08:16');
INSERT INTO `z_helps` VALUES (13,0,5,1,'','Пример создания структуры сайта','',1,1,1,'2020-07-13 17:52:58');
INSERT INTO `z_helps` VALUES (14,0,4,1,'','Работа с GridView','',1,1,1,'2020-07-13 18:08:16');
/*!40000 ALTER TABLE `z_helps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_issues`
--

DROP TABLE IF EXISTS `z_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(100) NOT NULL DEFAULT '',
  `parentid` int(11) NOT NULL DEFAULT 0,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `catalog_id` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `extra_priority` tinyint(1) NOT NULL DEFAULT 0,
  `extra_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `title2` varchar(255) NOT NULL DEFAULT '',
  `smart_address` varchar(255) NOT NULL DEFAULT '',
  `small_text` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `tag` varchar(255) NOT NULL DEFAULT '',
  `seo_description` varchar(1024) DEFAULT '',
  `seo_keywords` varchar(1024) DEFAULT '',
  `pic` int(11) NOT NULL DEFAULT 0,
  `pic1` int(11) NOT NULL DEFAULT 0,
  `showfiles` tinyint(1) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_issues`
--

LOCK TABLES `z_issues` WRITE;
/*!40000 ALTER TABLE `z_issues` DISABLE KEYS */;
INSERT INTO `z_issues` VALUES (0,'',0,0,0,0,0,0,0,NULL,'','','',NULL,NULL,'',NULL,NULL,0,0,0,0,NULL);
INSERT INTO `z_issues` VALUES (2,'menu',0,1,20,1,0,0,0,'2020-02-20','Самая крутая новость этого Блога?!','','samaya_krutaya_novost_etogo_bloga',NULL,'<p><strong>Самая</strong> крутая новость этого <span style=\"color:#FF0000\"><strong>Блога</strong></span>!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;</p>\r\n\r\n<p>Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;</p>\r\n\r\n<p>Самая крутая новость этого Блога!&nbsp;</p>\r\n\r\n<p>Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;Самая крутая новость этого Блога!&nbsp;</p>\r\n','','just an issue of mine','just an issue of mine',0,0,1,0,'2021-12-23 23:57:04');
INSERT INTO `z_issues` VALUES (3,'translates',0,0,2,1,0,0,0,NULL,'СТАТЬЯ ПЕРЕВОДА СТАТЬИ :-)','','',NULL,NULL,'','','',0,0,1,1,NULL);
INSERT INTO `z_issues` VALUES (4,'translates',0,0,2,1,0,0,0,NULL,'СТАТЬЯ ПЕРЕВОДА СТАТЬИ №2 :-)','','',NULL,NULL,'','','',0,0,1,1,NULL);
INSERT INTO `z_issues` VALUES (5,'menu',0,0,0,1,0,0,0,'2019-08-23','new','','new',NULL,NULL,'',NULL,NULL,0,0,1,1,'2019-08-23 13:51:48');
INSERT INTO `z_issues` VALUES (6,'menu',0,2,20,1,0,0,0,'2020-02-11','Новая','','new',NULL,NULL,'',NULL,NULL,0,0,1,0,'2021-12-24 00:59:25');
INSERT INTO `z_issues` VALUES (7,'menu',0,3,20,2,0,0,0,'2019-09-19','test','','just_an_issue_of_mine',NULL,NULL,'',NULL,NULL,0,0,1,1,'2019-09-19 17:43:03');
INSERT INTO `z_issues` VALUES (8,'menu',0,4,20,2,0,0,0,'2020-02-19','About new issues2','','pro_novye_statji2',NULL,NULL,'',NULL,NULL,0,0,1,1,'2021-12-24 00:59:07');
INSERT INTO `z_issues` VALUES (9,'menu',0,0,20,1,0,0,0,'2020-02-11','Супер-новая','','super_new',NULL,NULL,'',NULL,NULL,0,0,1,1,'2020-02-11 14:42:50');
INSERT INTO `z_issues` VALUES (10,'menu',0,0,20,2,0,0,0,'2020-02-11','<b><font color=\"red\">Just test of HTML</font></b>','','just_an_issue_of_mine',NULL,'<p>$someCode = &quot;This is the code of mine!&quot;; $idx = 0; while(true) { echo &quot;while not, do the code below!&quot;; $cls = new stdClass(); $cls-&gt;id = $idx; $cls-&gt;title = &#39;test title&#39;; print_r($cls); $idx++; break; }</p>\r\n','',NULL,NULL,0,0,1,1,'2020-02-11 14:41:06');
INSERT INTO `z_issues` VALUES (12,'menu',0,5,20,1,0,0,0,'2020-02-19','Новая еще','','new',NULL,NULL,'',NULL,NULL,0,0,1,0,'2020-02-19 14:49:23');
INSERT INTO `z_issues` VALUES (21,'menu',0,6,25,1,0,0,0,'2019-09-20','О нашей компании','','o_nashej_kompanii',NULL,'Полная информация о нашей компании...','',NULL,NULL,0,0,1,1,'2019-09-20 11:42:04');
INSERT INTO `z_issues` VALUES (22,'help',0,13,10,1,0,0,0,'2020-03-05','CompleteCMS','','obshchee_opisanie','','<p>CompleteCMS - система&nbsp;управления контентом сайтов группы компаний &quot;Комплит&quot;</p>\r\n','','','',0,0,1,1,'2020-03-05 17:56:41');
INSERT INTO `z_issues` VALUES (23,'help',0,8,11,1,0,0,0,'2020-03-31','Системные таблицы','','vafyvafy',NULL,'<ul>\r\n	<li><strong>access_logs</strong> (модель: [@!MODEL_AccessLogs!@]) - лог входов в CMS</li>\r\n	<li><strong>auth_assignment</strong> (модель: [@!MODEL_AuthAssignment!@]) - связка пользователей и ролей</li>\r\n	<li><strong>auth_item</strong> (модель: [@!MODEL_AuthItem!@])&nbsp;- список ролей и разрешений&nbsp;для авторизации</li>\r\n	<li><strong>auth_item_child</strong> (модель: [@!MODEL_AuthItemChild!@])&nbsp;- разрешения для авторизации</li>\r\n	<li><strong>auth_rule</strong> (модель: [@!MODEL_AuthRule!@])&nbsp;- список правил&nbsp;для авторизации</li>\r\n	<li><strong>user</strong> (модель: [@!MODEL_User!@])&nbsp;- список пользователей&nbsp;</li>\r\n	<li><strong>z_helps</strong> (модель: [@!MODEL_Helps!@])&nbsp;- данный документ (&quot;Помощь&quot;)</li>\r\n	<li><strong>z_issues</strong> (модель: [@!MODEL_Issues!@])&nbsp;- список статей</li>\r\n	<li><strong>z_languages</strong> (модель: [@!MODEL_Languages!@])&nbsp;- список языков</li>\r\n	<li><strong>z_menus</strong> (модель: [@!MODEL_Menus!@]) -&nbsp;список меню</li>\r\n	<li><strong>z_files</strong> (модель: [@!MODEL_Files!@]) - список картинок</li>\r\n	<li><strong>z_resources</strong> (модель: [@!MODEL_Resources!@]) - ресурсы</li>\r\n	<li><strong>z_resources_columns</strong> (модель: [@!MODEL_ResourcesColumns!@]) - колонки для ресурсов</li>\r\n	<li><strong>z_resources_conditions</strong> (модель: [@!MODEL_ResourcesConditions!@]) -&nbsp;условия для ресурсов</li>\r\n	<li><strong>z_resources_forms</strong> (модель: [@!MODEL_ResourcesForms!@])&nbsp;- формы&nbsp;для ресурсов</li>\r\n	<li><strong>z_resources_forms_params</strong> (модель: [@!MODEL_ResourcesFormsParams!@])&nbsp;-&nbsp;параметры форм для ресурсов</li>\r\n	<li><strong>z_resources_joins</strong> (модель: [@!MODEL_ResourcesJoins!@])&nbsp;-&nbsp;связки для ресурсов</li>\r\n	<li><strong>z_resources_refers</strong> (модель: [@!MODEL_ResourcesRefers!@]) -&nbsp;отношения для ресурсов</li>\r\n	<li><strong>z_settings</strong> (модель: [@!MODEL_Settings!@])&nbsp;-&nbsp;список&nbsp;настроек</li>\r\n	<li><strong>z_translates</strong> (модель: [@!MODEL_Translates!@]) -&nbsp;список переводов</li>\r\n	<li><strong>z_uploads</strong> (модель: [@!MODEL_Uploads!@]) - список загрузок</li>\r\n</ul>\r\n\r\n<p>Каждой таблице, помимо собственной модели, соответствует еще модель *Search для создания DataProvider модели, который используется в представлении модели в CMS.</p>\r\n\r\n<p>Таблицы&nbsp;<strong>auth_assignment</strong>,&nbsp;<strong>auth_item</strong>,&nbsp;<strong>auth_item_child</strong>,&nbsp;<strong>auth_rule</strong> и&nbsp;<strong>user&nbsp;</strong> - &quot;родные&quot; для YII, но они немного расширены для более удобного использования.</p>\r\n\r\n<p>Таблицы&nbsp;<strong>z_issues</strong>,&nbsp;<strong>z_languages</strong>,&nbsp;<strong>z_menus</strong>,&nbsp;<strong>z_files</strong>,&nbsp;<strong>z_translates</strong>&nbsp;и&nbsp;<strong>z_uploads</strong> могут быть использованы в существующем виде, либо расширены под нужды конкретного сайта.</p>\r\n\r\n<p>Таблицы&nbsp;<strong>z_resources</strong>,&nbsp;<strong>z_resources_columns</strong>,&nbsp;<strong>z_resources_conditions</strong>,&nbsp;<strong>z_resources_forms</strong>,&nbsp;<strong>z_resources_forms_params</strong>,&nbsp;<strong>z_resources_joins</strong>&nbsp;и&nbsp;<strong>z_resources_refers</strong> призваны хранить всю информацию о сайте, включая структуру самой CMS, следовательно, изменение их структуры крайне нежелательно!</p>\r\n\r\n<p>Общий для всех моделей функционал располагается в модели&nbsp;[@!MODEL_AbstractModel!@], с которой связаны еще две модели:&nbsp;модель дополнительных полей [@!MODEL_AbstractModelExtraFields!@] и модель поиска&nbsp;[@!MODEL_AbstractModelSearch!@].</p>\r\n','',NULL,NULL,0,0,1,1,'2020-06-19 11:56:08');
INSERT INTO `z_issues` VALUES (24,'help',0,22,11,1,0,0,0,'2020-03-31','Системные утилиты','','cms_vklyuchaet_v_sebya_sistemnye_utility','','<p>CMS включает в себя системные утилиты:</p>\r\n\r\n<ul>\r\n	<li><strong>Очистка assets</strong><br />\r\n	Как следует из названия, эта утилита удаляет содержимое папки web/assets в папке backend.<br />\r\n	&nbsp;</li>\r\n	<li><strong>Хранилище</strong><br />\r\n	Утилита предназначена для проверки соответствия файловых ресурсов записям в базе данных. Проверка идет в двух направлениях:<br />\r\n	1) Наличие/отсутствие папок на диске, записи о которых содержатся в базе данных<br />\r\n	2)&nbsp;Наличие/отсутствие записей в базе данных, которые ссылаются на папки на диске<br />\r\n	Эта утилита может быть полезна для освобождения места на диске от неиспользуемых ресурсов и для проверки корректности записей в базе данных в результате сбоев в работе системы обработки сохранения/удаления файлов и записей в базе данных (см. раздел Помощи: &quot;Работа с Ресурсами&quot; -&nbsp;&quot;Ресурсы - основа CMS&quot;).<br />\r\n	&nbsp;</li>\r\n	<li><strong>Файлы экспорта</strong><br />\r\n	Эта утилита отображает список файлов экспорта, сохраненных в папке web/data/export, которые были созданы в результате работы скрипта экспорта/удаления структуры ресурсов: SQL-скрипты и ZIP-архивы папок/файлов. Естественно, представлены файлы могут скачаны для целей восстановления данных.<br />\r\n	&nbsp;</li>\r\n	<li><strong>Help</strong><br />\r\n	Собственно, это&nbsp;именно тот раздел CMS, который в данный момент просматривается.</li>\r\n</ul>\r\n','','','',0,0,1,1,'2020-03-31 14:38:11');
INSERT INTO `z_issues` VALUES (25,'help',0,9,12,1,0,0,0,'2020-03-31','Ресурсы - основа CMS','','resursy__osnova_cms',NULL,'<p>Раздел CMS &quot;<strong>Ресурсы</strong>&quot; представляет из себя дерево, включающее все основные разделы в качестве примера создания структуры сайта.</p>\r\n\r\n<p>Ветки дерева: &quot;<strong>Сайт</strong>&quot; (для создания структуры меню, статей, графического материала и переводов для сайта), &quot;<strong>Ресурсы</strong>&quot; (сам раздел &quot;Ресурсы&quot; - исключительно для отображения в меню CMS), &quot;<strong>Доступ</strong>&quot; (для создания списка пользователей, а также родей, правил и разрешений для их авторизации), &quot;<strong>Настройки</strong>&quot; (для создания списка &quot;глобальных&quot; параметров, которые могут быть использованы для сайта) и &quot;<strong>Помощь</strong>&quot; (собственно, этот документ, который сейчас открыт).</p>\r\n\r\n<p>Каждый ресурс имеет настройки:&nbsp;&quot;<strong>Колонки</strong>&quot; (для создания списка колонок Grid-а, который отображается в CMS), &quot;<strong>Форма</strong>&quot; (для создания списка полей формы, которая позволяет создавать&nbsp;новые или редактировать существующие записи), &quot;<strong>Условия</strong>&quot; (для создания списка полей со значениями по умолчанию), &quot;<strong>Связи</strong>&quot; (для создания связей между&nbsp;родительским и дочерними ресурсами) и &quot;<strong>Джойны</strong>&quot; (для связывания модели ресурса с другими моделями). Кроме того, &quot;<strong>Форма</strong>&quot; имеет настройку &quot;<strong>Параметры формы</strong>&quot; (для создания списков выбора на форме - выпадающих списков и списков чекбоксов).</p>\r\n\r\n<p>Записи ресурсов имеют предопределенные действия. Имеются следующие возможности:</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>[@!PICS_1!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Добавление нового дочернего уровня</strong>, то есть, создание ресурса, для которого текущий ресурс будет родителем.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_2!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Редактирование текущего ресурса</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_3!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Удаление текущего ресурса</strong>. При этом создается копия файлов и папок, которые прикреплены к статьям ресурса, и SQL-скрипт данных ресурса аналогично как и при экспорте текущего ресурса (см. описание &quot;Экспорт текущего ресурса&quot;).</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_4!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Экспорт текущего ресурса</strong>. При этом создается копия файлов и папок, которые прикреплены к статьям ресурса, и SQL-скрипт данных ресурса. Если в настройках баз данных указан параметр <em>exportDB</em> (<em>config[&#39;components&#39;][&#39;exportDB&#39;]</em>),то будет создан SQL-скрипт для добавления записей в базу данных из этого параметра. При этом будут учтены текущие ID в каждой эскпортируемой таблице, чтобы исключить возможность их перезаписи или дублирования. Естественно, SQL-скрипт экспорта будет актуален только на момент его создания, то есть, до тех пор, пока в таблицы базы данных из&nbsp;<em>exportDB</em> не будут внесены какие-либо изменения. Если же параметр&nbsp;<em>exportDB</em> не указан, будет создан SQL-скрипт как копия всех связанных с текущим ресурсом записей. И, опять же, актуальность скрипта экспорта будет реальной только до момента&nbsp;внесения какие-либо изменений в связанные таблицы.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_5!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Перемещение на одну позицию вверх</strong>. При этом текущий ресурс перемещается на том же уровне вверх по GRID-у. Может использоваться для сортировки пунктов в левом меню CMS.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_6!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Перемещение на одну позицию вниз</strong>. При этом текущий ресурс перемещается на том же уровне вниз по GRID-у. Может использоваться для сортировки пунктов в левом меню CMS.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_7!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Перемещение на один уровень вверх</strong>. При этом текущий ресурс, который до сих пор был дочерним предыдущему, становится ресурсом того же уровня, что и его бывший родитель. Если текущий ресурс находится на самом верхнем уровне, никаких изменений не происходит. Может использоваться для сортировки пунктов в левом меню CMS.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_8!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Перемещение на один уровень вниз</strong>. При этом текущий ресурс становится дочерним ресурсом предыдущего. Если предыдущий ресурс отсутствует, никаких изменений не происходит. Может использоваться для сортировки пунктов в левом меню CMS.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>[@!PICS_9!@]</td>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Установка активности записи</strong>. Если структура модели содержит поле &quot;active&quot;, которое используется для отображения или временного сокрытия записи (без удаления ее из БД!), появляется возможность установка флага активности записи в GridView. В модели необходимо предусмотреть возможность построения запросов с учетом флага &quot;active&quot;, чтобы изменения его статуса отображались как в GridView CMS, так и во Frontend-приложении.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n','',NULL,NULL,0,0,1,1,'2020-07-02 12:24:19');
INSERT INTO `z_issues` VALUES (26,'help',0,10,12,1,0,0,0,'2020-02-21','Создание ресурса','','sozdanie_resursa','','<p>Поля формы для заполнение ресурса снабжены подсказками и включают в себя:</p>\r\n\r\n<p>- Название<br />\r\n<span style=\"color:#A52A2A\"><em>Могут использоваться HTML-теги для форматирования.<br />\r\nПример:&nbsp;&lt;font color=&quot;red&quot;&gt;&lt;b&gt;Заголовок&lt;/b&gt;&lt;/font&gt;, результат:&nbsp;</em></span><strong><span style=\"color:#FF0000\"><em>Заголовок</em></span></strong></p>\r\n\r\n<p>- Идентификатор<br />\r\n<span style=\"color:#A52A2A\"><em>Правило заполнения Идентификатора ресурса:&nbsp;имямодели1-имямодели2-имямодели3<br />\r\nПример:&nbsp;menus-issues-translates&nbsp;(Меню-Статьи-Переводы)</em></span><br />\r\nДля заполнения Идентификаторов ресурсов существуют определенные правила. Имя идентификатора должно состоять из последовательности имен моделей:&nbsp;всех родительских и текущей. Пример для задания ресурса &quot;Перевод статей меню&quot;: <strong>menus-issues-translates</strong> (путь: Меню-Статьи-Переводы).</p>\r\n\r\n<p>- Родитель<br />\r\n<span style=\"color:#A52A2A\"><em>Привязка к родительскому ресурсу, если необходимо</em></span></p>\r\n\r\n<p>Видимый в меню?<br />\r\n<span style=\"color:#A52A2A\"><em>Если стоит галочка, то этот ресурс будет виден для всех разделов каталога. Иначе только для &quot;листьев&quot;</em></span></p>\r\n\r\n<p>- Модель (список моделей создается из имен файлов&nbsp;всех папок/подпапок с именем <strong>/models</strong>)<br />\r\n<span style=\"color:#A52A2A\"><em>Привязка к модели, если необходимо</em></span></p>\r\n\r\n<p>Иконка меню<br />\r\n<span style=\"color:#A52A2A\"><em>Иконка для меню CMS: см. список по ссылке ниже</em></span></p>\r\n\r\n<p>- Тип<br />\r\n<span style=\"color:#A52A2A\"><em>Лента&nbsp;- отображение записей в Grid-е,&nbsp;Каталог&nbsp;- отображение записей в TreeGrid-е</em></span></p>\r\n\r\n<p>- Родительское поле<br />\r\n<span style=\"color:#A52A2A\"><em>Используется, если вы хотите установить связь с родительской таблицей. В этом случае родительской таблицей является таблица модели родительского ресурса<br />\r\nПример: Текущая модель - Issues, родительская - Menus. &quot;Родительское поле&quot;&nbsp;catalog_id&nbsp;модели&nbsp;Issues&nbsp;будет принимать значение&nbsp;id&nbsp;модели&nbsp;Menus</em></span></p>\r\n\r\n<p>- Сортировка<br />\r\n<span style=\"color:#A52A2A\"><em>Список полей для сортировки, разделяемый запятыми<br />\r\nПример:&nbsp;orderid;id DESC</em></span></p>\r\n\r\n<p>- Постраничность<br />\r\n<span style=\"color:#A52A2A\"><em>Число записей на одной странице</em></span></p>\r\n','','','',0,0,1,1,'2020-02-21 10:29:51');
INSERT INTO `z_issues` VALUES (27,'help',0,11,12,1,0,0,0,'2020-02-21','Создание колонок ресурса','','sozdanie_kolonok_resursa',NULL,'<p>Колонки ресурса служат для создания списка колонок Grid-а, который отображается в CMS.</p>\r\n\r\n<p>Поля формы для заполнение колонок ресурса снабжены подсказками и включают в себя:</p>\r\n\r\n<p>- Название</p>\r\n\r\n<p>- Поле в БД (работает, если для ресурса была выбрана модель - см. &quot;Создание ресурса&quot;)<br />\r\n<span style=\"color:#A52A2A\"><em>Начните вводить имя поля или его наименование... и выберите поле из списка</em></span></p>\r\n\r\n<p>- Ширина<br />\r\n<span style=\"color:#A52A2A\"><em>Ширина колонки в процентах или пикселях.</em><br />\r\n<em>Пример:&nbsp;1%&nbsp;или&nbsp;50px</em></span></p>\r\n\r\n<p>-&nbsp;Сортировать?<br />\r\n<span style=\"color:#A52A2A\"><em>Показывать или нет ссылку сортировки для колонки</em></span></p>\r\n\r\n<p>- Фильтровать?<br />\r\n<span style=\"color:#A52A2A\"><em>Показывать или нет блок фильтров для колонки</em></span></p>\r\n\r\n<p>- Тип фильтра<br />\r\n<span style=\"color:#A52A2A\"><em>Построение выборки в GridView, исходя из устанавливаемых значений фильтров колонок.<br />\r\nПустой фильтр означает текстовое поле или выпадающий список (при заполнении массивом поля &quot;Список значений фильтра&quot;).</em></span></p>\r\n\r\n<p>- Список значений фильтра<br />\r\n<span style=\"color:#A52A2A\"><em>Возвращает список значений для фильтра (если необходимо) - обычно в виде массива.</em><br />\r\n<em>Пример:</em><br />\r\n<em>return [&quot;0&quot; =&gt; &quot;Inactive&quot;, &quot;1&quot; =&gt; &quot;Active&quot;];</em></span></p>\r\n\r\n<p>- Escape<br />\r\n<span style=\"color:#A52A2A\"><em>Экранирует значение для вывода в скрипте представления</em></span></p>\r\n\r\n<p>- Функция для eval<br />\r\n<span style=\"color:#A52A2A\"><em>Возвращает значение в поле для каждой записи, исходя из выполнения условия.<br />\r\nПример (здесь {{id}} заменяется значением поля &quot;id&quot;):<br />\r\n$trans = new backend\\models\\Translates();<br />\r\nreturn $trans-&gt;getSourceTranslatedList(&#39;{{id}}&#39;, &#39;menu&#39;);</em></span></p>\r\n\r\n<p>- Активность<br />\r\n<span style=\"color:#A52A2A\"><em>Отображать или нет колонку в GridView</em></span></p>\r\n\r\n<p>При создании колонок могут быть использованы алиасы полей, расширяющие набор полей модели - либо для большей наглядности, либо в случае невозможности использования существующих полей. Все алиасы должны быть объявлены в модели <strong>AbstractModelExtraFields</strong>! Во-первых, от этой модели наследуется <strong>AbstractModel</strong> (модель, на базе которой постороены все взаимосвязи CMS и которая содержит все общие методы и обработчики CMS), от которой, в свою очередь, наследуются все остальные модели CMS. Во-вторых, имена альясов с большой вероятностью могут повторяться (к примеру, <strong>langname</strong> - альяс для отображения имени языка вместо его ID, или <strong>langlist</strong> - альяс для отображения списка языков перевода&nbsp;вместо списка их ID), потому удобнее хранить их в одном и том же месте.</p>\r\n\r\n<p>Тип&nbsp;фильтра может быть выбран из списка:<br />\r\n- <strong>FILTER_CHECKBOX</strong><br />\r\n[@!PICS_1!@]<br />\r\nИмеет два состояния - &quot;Включен&quot; и &quot;Выключен&quot;. Возможно, его можно использовать для списков, где используется только один фильтр, потому как он не имеет нейтрального состояния и будет влиять на все остальные фильтры. Потому в качестве переключателя удобнее использовать следующий фильтр -&nbsp;FILTER_CHECKBOX_X.</p>\r\n\r\n<p>- <strong>FILTER_CHECKBOX_X</strong><br />\r\n[@!PICS_2!@]<br />\r\nИмеет три состояния - &quot;Включен&quot;,&nbsp;&quot;Выключен&quot; и &quot;Нейтраль&quot;. Его можно использовать для списков, где используется более одного фильтра, потому как он имеет&nbsp;нейтральное состояния (пустое или NULL) и не будет влиять на все остальные фильтры, как это делает FILTER_CHECKBOX.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_COLOR</strong><br />\r\n[@!PICS_3!@]<br />\r\nФильтр по имени цвета. В данный момент палитра цветов представляет из себя список:&nbsp;&quot;white&quot;, &quot;black&quot;, &quot;grey&quot;, &quot;silver&quot;, &quot;gold&quot;, &quot;brown&quot;, &quot;red&quot;, &quot;orange&quot;, &quot;yellow&quot;, &quot;indigo&quot;, &quot;maroon&quot;, &quot;pink&quot;,&nbsp;&quot;blue&quot;, &quot;green&quot;, &quot;violet&quot;, &quot;cyan&quot;, &quot;magenta&quot;, &quot;purple&quot;. Значения полей также должны иметь текстовые значения из этого списка.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_DATE</strong><br />\r\n[@!PICS_4!@]<br />\r\nДата выбирается во всплывающем окне календаря.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_DATETIME</strong><br />\r\n[@!PICS_5!@]<br />\r\nДата&nbsp;выбирается во всплывающем окне календаря, после чего выбирается время в часах и затем время уточняется с интервалом в 5 минут. В итоге, например, можно выбрать 1) 03.06.2020, 2) 10:00, 3) 10:15.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_DATE_RANGE</strong><br />\r\n[@!PICS_6!@]<br />\r\nДиапазон дат может быть выбран из предустановленного списка (&quot;Сегодня&quot;, &quot;Вчера&quot;, &quot;Последние 7 дней&quot;, &quot;Последние 30 дней&quot;, &quot;Этот месяц&quot;, &quot;Прошлый месяц&quot; или &quot;Свой диапазон&quot;). При выборе&nbsp;&quot;Свой диапазон&quot; всплывает календарь, где первым кликом можно выбрать начальную дату и вторым - конечную, после чего нажать &quot;Применить&quot; для построение фильтра в выбранном диапазоне.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_MONEY</strong><br />\r\n[@!PICS_7!@]<br />\r\nФильтр настроен на использование числовых значений, в качестве десятичного разделителя которых используется точка. В фильтре возможна установка отрицательных значений.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_NUMBER</strong><br />\r\n[@!PICS_8!@]<br />\r\nФильтр настроен на использование числовых значений, в качестве десятичного разделителя которых используется точка. В фильтре возможна установка отрицательных значений.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_RANGE</strong><br />\r\n[@!PICS_9!@]<br />\r\nМожет принимать целые значения от 0 до 100. Установка происходит путем смещения бегунка фильтра вправо-влево.&nbsp;Значения полей также должны иметь целые&nbsp;значения&nbsp;в указанном диапазоне.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_SELECT2</strong><br />\r\n[@!PICS_10!@]<br />\r\nИспользует список значений фильтра&nbsp;для создания выпадающего списка. Список значений фильтра представляет собой массив &quot;ключ-значение&quot; и может быть оформлен в виде PHP-кода, который возвращает этот массив..&nbsp;Значения полей также должны иметь значения ключей.<br />\r\nПример:<br />\r\n$testModel = new backend\\models\\Test();<br />\r\nreturn $testModel-&gt;fetchPairs([&#39;id&#39;,&#39;title&#39;],[],&#39;id DESC&#39;);</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_SLIDER</strong><br />\r\n[@!PICS_11!@]<br />\r\nМожет принимать целые значения от 0 до 10. Установка происходит путем смещения бегунка фильтра вправо-влево.&nbsp;Значения полей также должны иметь целые&nbsp;значения&nbsp;в указанном диапазоне.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_SPIN</strong><br />\r\n[@!PICS_12!@]<br />\r\nМожет принимать целые значения от 0 и более. Установка происходит путем клика на кнопки фильтра &quot;вправо&quot; (увеличение значения) и &quot;влево&quot;&nbsp;(увеличение значения).&nbsp;Значения полей также должны иметь целые&nbsp;значения.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_STAR</strong><br />\r\n[@!PICS_13!@]<br />\r\nМожет принимать целые значения от 1 до 5 или &quot;не определено&quot;. Установка происходит путем перемещения курсора мыши над фильтром вправо-влево.&nbsp;Значения полей также должны иметь целые&nbsp;значения в указанном диапазоне.</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_SWITCH</strong><br />\r\n[@!PICS_14!@]<br />\r\nИмеет два состояния - &quot;Включен&quot; и &quot;Выключен&quot;. Возможно, его можно использовать для списков, где используется только один фильтр, потому как он не имеет нейтрального состояния и будет влиять на все остальные фильтры. Потому в качестве переключателя удобнее использовать фильтр FILTER_CHECKBOX_X (см. выше).</p>\r\n\r\n<p>-&nbsp;<strong>FILTER_TYPEAHEAD</strong><br />\r\n[@!PICS_15!@]<br />\r\nПохож на AutoComplete: при вводе символов в поле осуществляет поиск среди предустановленных значений и отображает их в виде выпадающего списка.&nbsp;Список значений&nbsp; фильтра представляет собой массив &quot;ключ-значение&quot; и может быть оформлен в виде PHP-кода, который возвращает этот массив.<br />\r\nПример:<br />\r\nreturn [&quot;0&quot;=&gt;&quot;Nope&quot;, &quot;1&quot;=&gt;&quot;Yeah&quot;];</p>\r\n\r\n<p>Отображение блока фильтра для каждой колонки управляется полем &quot;Фильтровать?&quot;.</p>\r\n\r\n<p>Данный список предоставляется ресурсом GridView от Kartik. Кроме того, возможно создание &quot;пустых&quot; фильтров на базе тестового поля ввода:<br />\r\n- <strong>фильтр по подстроке</strong><br />\r\n[@!PICS_16!@]<br />\r\nФильтр ищет записи по части строки, введенной в поле фильтра.</p>\r\n\r\n<p>- <strong>фильтр по выбору из списка</strong><br />\r\n[@!PICS_17!@]<br />\r\nИспользует список значений фильтра&nbsp;для создания выпадающего списка. Список значений фильтра представляет собой массив &quot;ключ-значение&quot; и может быть оформлен в виде PHP-кода, который возвращает этот массив. Значения полей также должны иметь значения ключей.<br />\r\nПример:<br />\r\nreturn [&quot;0&quot;=&gt;&quot;No&quot;, &quot;1&quot;=&gt;&quot;Yes&quot;];</p>\r\n','',NULL,NULL,0,0,1,1,'2020-06-16 14:57:00');
INSERT INTO `z_issues` VALUES (28,'help',0,12,12,1,0,0,0,'2020-02-21','Создание формы ресурса','','sozdanij_formy_resursa',NULL,'<p>Форма ресурса служит для создания списка полей формы, которая позволяет создавать новые или редактировать существующие записи.</p>\r\n\r\n<p>Поля формы для заполнение формы ресурса снабжены подсказками и включают в себя:</p>\r\n\r\n<p>- Название (label)</p>\r\n\r\n<p>- Поле&nbsp;(работает, если для ресурса была выбрана модель - см. &quot;Создание ресурса&quot;)<br />\r\n<span style=\"color:#A52A2A\"><em>Начните вводить имя поля или его наименование... и выберите поле из списка</em></span></p>\r\n\r\n<p>- Тип<br />\r\n<span style=\"color:#A52A2A\"><em>Для каждого поля типа &quot;Файл&quot; в модели должны быть созданы атрибуты&nbsp;имяполя_saved_file&nbsp;и&nbsp;имяполя_remove_file!<br />\r\nПример:<br />\r\nclass Files {<br />\r\n&nbsp;&nbsp;&nbsp;public $pics_saved_file;<br />\r\n&nbsp;&nbsp;&nbsp;public $pics_remove_file;<br />\r\n}</em></span></p>\r\n\r\n<p>- Обязательное</p>\r\n\r\n<p>- Значение по умолчанию<br />\r\n<em><span style=\"color:#A52A2A\">Обычно используется для задания значений по умолчанию для полей типа Hidden</span></em></p>\r\n\r\n<p>- Описание<br />\r\n<span style=\"color:#A52A2A\"><em>Будет отображаться как комментарий на форме ниже поля ввода</em></span></p>\r\n\r\n<p>- Функция проверки доступности<br />\r\n<span style=\"color:#A52A2A\"><em>PHP функция. Если возвращает false, то поле будет недоступно<br />\r\nПример:<br />\r\n$id = (int)Yii::$app-&gt;getRequest()-&gt;getQueryParam(&#39;id&#39;);<br />\r\nreturn ($id &gt; 1);</em></span></p>\r\n\r\n<p>- Пакетная загрузка файлов<br />\r\n<span style=\"color:#A52A2A\"><em>Актуально только для данных типа &quot;Файл&quot;: дает возможность использования виджета одновременной загрузки нескольких файлов</em></span></p>\r\n\r\n<p>- Активность<br />\r\n<span style=\"color:#A52A2A\"><em>Отображать или нет поле в форме</em></span></p>\r\n','',NULL,NULL,0,0,1,1,'2020-07-08 10:26:16');
INSERT INTO `z_issues` VALUES (29,'help',0,14,12,1,0,0,0,'2020-02-20','Создание параметров формы ресурса','','sozdanie_parametrov_formy_resursa','','<p>Параметры формы используются для создания списков выбора на форме (выпадающих списков и&nbsp;списков чекбоксов).</p>\r\n\r\n<p>Поля формы для заполнение параметров формы ресурса снабжены подсказками и включают в себя:</p>\r\n\r\n<p>- Имя параметра (может принимать единственное значение <strong>multiOptions</strong>)<br />\r\n<span style=\"color:#A52A2A\"><em>Пример: multiOptions</em></span></p>\r\n\r\n<p>- Значение (PHP функция, которая возвращает массив списка ключей и значений)<br />\r\n<em><span style=\"color:#A52A2A\">Пример:</span></em><br />\r\n<span style=\"color:#A52A2A\"><em>return array(&#39;int&#39;=&gt;&#39;Число&#39;,&#39;bool&#39;=&gt;&#39;Да/Нет&#39;,&#39;string&#39;=&gt;&#39;Строка&#39;);</em><br />\r\n<em>или</em><br />\r\n<em>$langsModel = new backend\\models\\Languages();</em><br />\r\n<em>return $langsModel-&gt;fetchPairs(array(&#39;id&#39;,&#39;title&#39;),array(),&#39;orderid&#39;);</em></span></p>\r\n','','','',0,0,1,1,'2020-02-20 13:09:02');
INSERT INTO `z_issues` VALUES (30,'help',0,15,12,1,0,0,0,'2020-02-21','Создание джойнов (joins) ресурсов','','sozdanie_dzhojnov_joins_resursov','','<p>&quot;Джойны&quot; служат для связывания модели ресурса с другими моделями.</p>\r\n\r\n<p>Поля формы для заполнение джойнов ресурса снабжены подсказками и включают в себя:</p>\r\n\r\n<p>- Модель<br />\r\n<span style=\"color:#A52A2A\"><em>Присоединяемая модель, например,&nbsp;</em><em>backend/models/Languages</em></span></p>\r\n\r\n<p>- Условие<br />\r\n<em><span style=\"color:#A52A2A\">Условие присоединения в SQL синтаксисе. Возможно применение шаблона:<br />\r\n{{table}} - таблица текущей модели<br />\r\n{{jointable}} - таблица присоединяемой модели</span><br />\r\n<span style=\"color:#A52A2A\">Пример: {{table}}.lang_id={{jointable}}.id</span></em></p>\r\n\r\n<p>- Поля<br />\r\n<em><span style=\"color:#A52A2A\">Блоки разделяются символом &quot;|&quot;<br />\r\nКаждый блок содержит поле таблицы и алиас этого поля в запросе<br />\r\nНапример: title|langname</span><br />\r\n<span style=\"color:#A52A2A\"><strong>Все алиасы должны быть объявлены в backend\\models\\AbstractModelExtraFields!</strong></span></em></p>\r\n','','','',0,0,1,1,'2020-02-21 10:38:37');
INSERT INTO `z_issues` VALUES (31,'help',0,16,12,1,0,0,0,'2020-02-20','Создание условий ресурса','','sozdanie_uslovij_resursa','','<p>Условия используются для создания списка полей со значениями по умолчанию.</p>\r\n\r\n<p>Поля формы для заполнение условий ресурса снабжены подсказками и включают в себя:</p>\r\n\r\n<p>- Поле<br />\r\n<em><span style=\"color:#A52A2A\">Пример: sid</span></em></p>\r\n\r\n<p>- Значение<br />\r\n<em><span style=\"color:#A52A2A\">Пример: menu</span></em></p>\r\n','','','',0,0,1,1,'2020-02-20 13:57:07');
INSERT INTO `z_issues` VALUES (33,'help',0,18,13,1,0,0,0,'2020-02-25','Создание ресурса \"Помощь\"','','sozdanie_resursa','','<p>Создание ресурса. Добавляем новый ресурс на странице&nbsp;<strong>/resources</strong>, заполняем необходимые поля:</p>\r\n\r\n<p>-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Название:&nbsp;</span><strong>Помощь</strong><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Идентификатор: <strong>helps</strong> - должен соответствовать имени модели, но все буквы Идентификатора - строчные<br />\r\n-&nbsp;Родитель: <strong>Корень</strong> - поскольку это будет самый высокий уровень структуры<br />\r\n-&nbsp;Видимый в меню?: <strong>включаем галочку</strong>, чтобы ссылка на раздел появилась в левом меню CMS</span><br />\r\n- Модель:&nbsp;<strong>backend/models/Helps</strong><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Иконка меню: <strong>question-circle</strong> - можно выбрать любую из списка &quot;</span>Иконка меню: кликнуть для показа списка вариантов!<span style=\"color:rgb(33, 37, 41)\">&quot;<br />\r\n-&nbsp;Тип: <strong>Каталог</strong> - будет использоваться дерево TreeGrid</span><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Родительское поле:&nbsp;</span><strong>parentid</strong> - ссылается сам на себя, потому как дерево!<br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Сортировка:&nbsp;</span><strong>orderid</strong> - будет возможность менять местами&nbsp;разделы средствами&nbsp;<span style=\"color:rgb(33, 37, 41)\">TreeGrid</span><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Постраничность: <strong>1000</strong> - все дерево будет отображаться на одной странице, вряд ли, что Help может иметь более 1000 разделов и подразделов</span></p>\r\n\r\n<p>Добавляем колонки, которые будут отображаться в Grid-е как список разделов помощи. Для этих целей достаточно одной&nbsp;колонки - &quot;Название&quot;:</p>\r\n\r\n<p><span style=\"color:rgb(33, 37, 41)\">- Название:&nbsp;<strong>Название</strong></span><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Поле в БД:&nbsp;</span>title<br />\r\n[@!PICS_3!@]</p>\r\n\r\n<p>Добавляем поля формы для создания разделов. Тут будут поля: &quot;Название&quot;, &quot;Язык&quot; и &quot;Активность&quot;.</p>\r\n\r\n<p>Поле &quot;Название&quot;:<br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Название (label):&nbsp;</span><strong>Название</strong><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Поле:&nbsp;</span><strong>title</strong><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Тип: <strong>Строка</strong><br />\r\n-&nbsp;Обязательное: <strong>ставим&nbsp;галочку</strong></span></p>\r\n\r\n<p>Поле &quot;Язык&quot;:<br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Название (label):&nbsp;</span><strong>Язык</strong><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Поле: <strong>lang_id</strong><br />\r\n-&nbsp;Тип: <strong>Выпадающий список</strong></span></p>\r\n\r\n<p>Поле &quot;Активность&quot;:<br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Название (label):&nbsp;</span><strong>Активность</strong><br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Поле: </span><strong>active</strong><br />\r\n<span style=\"color:rgb(33, 37, 41)\">-&nbsp;Тип: <strong>Флажок</strong></span></p>\r\n\r\n<p>Добавляем параметр формы для поля &quot;Язык&quot;. Это необходимо для создания выпадающего списка языков, из которого будет выбираться требуемый нам:<br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Имя параметра:&nbsp;</span><strong>multiOptions</strong>&nbsp;(других пока нет)<br />\r\n-&nbsp;<span style=\"color:rgb(33, 37, 41)\">Значение: PHP функция, которая возвращает список пар (ключ =&nbsp;</span>id, значение =&nbsp;title) из таблицы&nbsp;Languages<br />\r\n<strong>$langsModel = new backend\\models\\Languages();<br />\r\nreturn $langsModel-&gt;fetchPairs(array(&#39;id&#39;,&#39;title&#39;),array(),&#39;orderid&#39;);</strong><br />\r\n[@!PICS_4!@]</p>\r\n\r\n<p>На этом создание ресурса &quot;Помощь&quot; завершается. В итоге, в списке ресурсов получаем:<br />\r\n[@!PICS_2!@]</p>\r\n\r\n<p>Внешний вид раздела &quot;Помощь&quot; (вызов по ссылке в левом меню CMS):<br />\r\n[@!PICS_5!@]</p>\r\n\r\n<p>Страница добавления/редактирования:<br />\r\n[@!PICS_6!@][@!PICS_7!@]</p>\r\n','','','',0,0,1,1,'2020-02-25 16:33:07');
INSERT INTO `z_issues` VALUES (34,'help',0,19,13,1,0,0,0,'2020-02-25','Создание ресурса \"Статьи Помощи\"','','sozdanie_resursa_stati','','<p>Добавляем новый уровень, нажимая на &quot;плюсик&quot; в строке&nbsp;ресурса &quot;Помощь&quot;:<br />\r\n[@!PICS_1!@]</p>\r\n\r\n<p>Создание ресурса. Заполняем необходимые поля:</p>\r\n\r\n<p>-&nbsp;Название:&nbsp;<strong>Статьи</strong><br />\r\n-&nbsp;Идентификатор:&nbsp;<strong>helps-issues</strong>&nbsp;- должен соответствовать имени модели текущей и родительской, но все буквы Идентификатора - строчные<br />\r\n-&nbsp;Родитель:&nbsp;<strong>Помощь</strong><br />\r\n-&nbsp;Видимый в меню?: <strong>выключаем галочку</strong>, чтобы не было ссылки&nbsp;в левом меню CMS<br />\r\n- Модель:&nbsp;<strong>backend/models/Issues</strong><br />\r\n-&nbsp;Иконка меню:&nbsp;<strong>Нет</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Лента</strong> - будет использоваться Grid<br />\r\n-&nbsp;Родительское поле:&nbsp;<strong>catalog_id</strong> - это поле модели&nbsp;Issues&nbsp;будет принимать значение&nbsp;id&nbsp;модели&nbsp;Menus<br />\r\n-&nbsp;Сортировка:&nbsp;<strong>orderid</strong>&nbsp;- будет возможность менять местами&nbsp;разделы средствами&nbsp;TreeGrid<br />\r\n-&nbsp;Постраничность:&nbsp;<strong>15</strong>&nbsp;- можно оставить по умолчанию, можно изменить</p>\r\n\r\n<p>Добавляем колонки, которые будут отображаться в Grid-е как список статей. Для этих целей достаточно одной&nbsp;колонки - &quot;Название&quot;:</p>\r\n\r\n<p>- Название:&nbsp;<strong>Название</strong><br />\r\n-&nbsp;Поле в БД:&nbsp;<strong>title</strong></p>\r\n\r\n<p>Добавляем поля формы для создания разделов. Тут будут поля: &quot;Название&quot;, &quot;Текст&quot; и &quot;Активность&quot;.</p>\r\n\r\n<p>Поле &quot;Название&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Название</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>title</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Строка</strong><br />\r\n-&nbsp;Обязательное:&nbsp;<strong>ставим&nbsp;галочку</strong></p>\r\n\r\n<p>Поле &quot;Текст&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Текст</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>text</strong><br />\r\n-&nbsp;Тип:&nbsp;HTML <strong>редактор</strong><br />\r\n-&nbsp;Обязательное:&nbsp;<strong>ставим&nbsp;галочку</strong></p>\r\n\r\n<p>Поле &quot;Активность&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Активность</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>active</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Флажок</strong><br />\r\n[@!PICS_3!@]</p>\r\n\r\n<p>Добавляем условия, которые будут использоваться&nbsp;как поля формы со значениями по умолчанию. Для этих целей испольхует два поля:</p>\r\n\r\n<p>Поле &quot;sid&quot;: идентификатор типа статьи для таблицы&nbsp;&quot;Статьи&quot;&nbsp;- будет всегда принимать значение <strong>help</strong> (то есть, все статьи и только они с <em>sid=help</em> будут являться статьями для раздела Помощь).</p>\r\n\r\n<p>Поле &quot;lang_id&quot;: ID языка для таблицы &quot;Статьи&quot;&nbsp;- будет всегда принимать значение&nbsp;<strong>1</strong> (русский язык). В принципе, вместо назначения этого условия, можно&nbsp;в список&nbsp;полей формы для статей добавить поле &quot;Язык&quot;, как это было сделано для родительского ресурса &quot;Помощь&quot;, и тогда пришлось бы выбирать язык из выпадающего списка языков при создании каждой статьи.<br />\r\n[@!PICS_4!@]</p>\r\n\r\n<p>На этом создание ресурса &quot;Статьи&quot; завершается. В итоге, в списке ресурсов получаем:<br />\r\n[@!PICS_2!@]</p>\r\n','','','',0,0,1,1,'2020-02-25 17:55:29');
INSERT INTO `z_issues` VALUES (35,'help',0,20,13,1,0,0,0,'2020-02-25','Создание ресурса \"Файлы Статей Помощи\"','','sozdanie_resursa_fajly','','<p>Добавляем новый уровень, нажимая на &quot;плюсик&quot; в строке&nbsp;ресурса &quot;Статьи&quot;:<br />\r\n[@!PICS_1!@]</p>\r\n\r\n<p>Создание ресурса. Заполняем необходимые поля:</p>\r\n\r\n<p>-&nbsp;Название:&nbsp;<strong>Файлы</strong><br />\r\n-&nbsp;Идентификатор:&nbsp;<strong>helps-issues-files</strong>&nbsp;- должен соответствовать имени модели текущей и всех родительских, но все буквы Идентификатора - строчные<br />\r\n-&nbsp;Родитель: <strong>- Статьи</strong><br />\r\n-&nbsp;Видимый в меню?: <strong>выключаем галочку</strong>, чтобы не было ссылки&nbsp;в левом меню CMS<br />\r\n- Модель: <strong>backend/models/Files</strong><br />\r\n-&nbsp;Иконка меню:&nbsp;<strong>Нет</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Лента</strong>&nbsp;- будет использоваться Grid<br />\r\n-&nbsp;Родительское поле:&nbsp;<strong>source_id</strong>&nbsp;- это поле модели Files будет принимать значение&nbsp;id&nbsp;модели&nbsp;Issues<br />\r\n-&nbsp;Сортировка:&nbsp;<strong>orderid</strong>&nbsp;- будет возможность менять местами&nbsp;разделы средствами&nbsp;TreeGrid<br />\r\n-&nbsp;Постраничность:&nbsp;<strong>15</strong>&nbsp;- можно оставить по умолчанию, можно изменить</p>\r\n\r\n<p>Добавляем колонки, которые будут отображаться в Grid-е как список файлов:</p>\r\n\r\n<p>Колонка &quot;Файл&quot;:<br />\r\n- Название:&nbsp;<strong>Файл</strong><br />\r\n-&nbsp;Поле в БД:&nbsp;<strong>pics</strong><br />\r\n- Функция для eval:<br />\r\n<strong>$uploads = new backend\\models\\Uploads();<br />\r\n$model = $uploads-&gt;getModel(&#39;{{pics}}&#39;);<br />\r\nif(!empty($model-&gt;realname)) {<br />\r\n&nbsp; $src = &quot;/&quot;.$model-&gt;getFullFileName();<br />\r\n&nbsp; return &quot;&lt;a class=\\&quot;admin_gallery\\&quot; href=\\&quot;&quot;.$src.&quot;\\&quot; data-fancybox=\\&quot;admin_gallery\\&quot;&gt;&lt;img src=\\&quot;&quot;.$src.&quot;\\&quot; width=\\&quot;24\\&quot;/&gt;&lt;/a&gt;&quot;;<br />\r\n}<br />\r\nreturn &#39;{{pics}}&#39;;</strong><br />\r\nПоле &quot;Функция для eval&quot; служит для создания более удобного отображения в списке записей того или иного поля. В частности, в этом примере для файла картинки создается иконка в Grid-е, клик по которой открывает&nbsp;файл целиком, то есть, предоставляет возможность просматривать картинки, не заходя в редактирование записи.</p>\r\n\r\n<p>Колонка &quot;Язык&quot;:<br />\r\n- Название:&nbsp;<strong>Язык</strong><br />\r\n-&nbsp;Поле в БД:&nbsp;<strong>langname</strong><br />\r\n<br />\r\nКолонка &quot;Название (комментарий)&quot;:<br />\r\n- Название:&nbsp;<strong>Название (комментарий)</strong><br />\r\n-&nbsp;Поле в БД:&nbsp;<strong>title</strong></p>\r\n\r\n<p>Колонка &quot;Переведено&quot;:<br />\r\n- Название:&nbsp;<strong>Переведено</strong><br />\r\n-&nbsp;Поле в БД:&nbsp;<strong>langlist</strong><br />\r\n- Функция для eval:<br />\r\n<strong>$trans = new backend\\models\\Translates();<br />\r\nreturn $trans-&gt;getSourceTranslatedList(&#39;{{id}}&#39;, &#39;file_help&#39;);</strong><br />\r\nДля этого поля &quot;Функция для eval&quot; используется для отображения&nbsp;списка аббревиатур языков, на которые переведена каждая запись.<br />\r\n[@!PICS_2!@]</p>\r\n\r\n<p>Добавляем поля формы для сохранения файлов. Тут будут поля: &quot;Файл&quot;, &quot;Язык&quot;, &quot;Название (комментарий)&quot; и &quot;Активность&quot;.</p>\r\n\r\n<p>Поле &quot;Файл&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Файл</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>pics</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Файл</strong></p>\r\n\r\n<p>Поле &quot;Язык&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Язык</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>lang_id</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Выпадающий список</strong></p>\r\n\r\n<p>Поле &quot;Название (комментарий)&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Название (комментарий)</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>title</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Текст</strong></p>\r\n\r\n<p>Поле &quot;Активность&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Активность</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>active</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Флажок</strong><br />\r\n[@!PICS_3!@]</p>\r\n\r\n<p>Добавляем параметр формы для поля &quot;Язык&quot;. Это необходимо для создания выпадающего списка языков, из которого будет выбираться требуемый нам:<br />\r\n-&nbsp;Имя параметра:&nbsp;<strong>multiOptions</strong>&nbsp;(других пока нет)<br />\r\n-&nbsp;Значение: PHP функция, которая возвращает список пар (ключ =&nbsp;id, значение =&nbsp;title) из таблицы&nbsp;Languages<br />\r\n<strong>$langsModel = new backend\\models\\Languages();<br />\r\nreturn $langsModel-&gt;fetchPairs(array(&#39;id&#39;,&#39;title&#39;),array(),&#39;orderid&#39;);</strong></p>\r\n\r\n<p>Добавляем условия, которые будут использоваться&nbsp;как поля формы со значениями по умолчанию. Для этих целей используется одно поле:<br />\r\nПоле &quot;<strong>sid</strong>&quot;: идентификатор типа статьи для таблицы&nbsp;Files - будет всегда принимать значение&nbsp;help&nbsp;(то есть, все файлы и только они с&nbsp;<em>sid=help</em>&nbsp;будут являться файлами для раздела &quot;Статьи&quot;, который в свою очередь имеет родителя&nbsp;&quot;Помощь&quot;).</p>\r\n\r\n<p>Добавляем джойны. Они необходимы для связывания с другими таблицами. Заполняем джойн:<br />\r\n<span style=\"color:rgb(33, 37, 41)\">-&nbsp;Модель:&nbsp;</span><strong>backend\\models\\Languages</strong> (связываем таблицу файлов с таблицей языков)<br />\r\n<span style=\"color:rgb(33, 37, 41)\">- Условие:&nbsp;</span><strong>{{table}}.lang_id={{jointable}}.id</strong> (поле lang_id файлов будет связываться с полей id таблицы&nbsp;языков)<br />\r\n<span style=\"color:rgb(33, 37, 41)\">- Поля:&nbsp;</span><strong>title|langname</strong> (в запрос вместо алиаса langname будет записано значение поля title из таблицы языков)<br />\r\n[@!PICS_6!@]<br />\r\n[@!PICS_5!@]</p>\r\n\r\n<p>На этом создание ресурса &quot;Файлы&quot; завершается. В итоге, в списке ресурсов получаем:<br />\r\n[@!PICS_4!@]</p>\r\n','','','',0,0,1,1,'2020-02-25 17:55:43');
INSERT INTO `z_issues` VALUES (36,'help',0,21,13,1,0,0,0,'2020-02-25','Создание ресурса \"Переводы Файлов Статей Помощи\"','','sozdanie_resursa_perevody','','<p>Добавляем новый уровень, нажимая на &quot;плюсик&quot; в строке&nbsp;ресурса &quot;Файлы&quot;:<br />\r\n[@!PICS_1!@]</p>\r\n\r\n<p>Создание ресурса. Заполняем необходимые поля:</p>\r\n\r\n<p>-&nbsp;Название:&nbsp;<strong>Переводы</strong><br />\r\n-&nbsp;Идентификатор:&nbsp;<strong>helps-issues-files-translates</strong>&nbsp;- должен соответствовать имени модели текущей и всех родительских, но все буквы Идентификатора - строчные<br />\r\n-&nbsp;Родитель:&nbsp;<strong>-- Файлы</strong><br />\r\n-&nbsp;Видимый в меню?:&nbsp;<strong>выключаем галочку</strong>, чтобы не было ссылки&nbsp;в левом меню CMS<br />\r\n- Модель:&nbsp;<strong>backend/models/Translates</strong><br />\r\n-&nbsp;Иконка меню:&nbsp;<strong>Нет</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Лента</strong>&nbsp;- будет использоваться Grid<br />\r\n-&nbsp;Родительское поле:&nbsp;<strong>source_id</strong>&nbsp;- это поле модели Translates&nbsp;будет принимать значение&nbsp;id&nbsp;модели&nbsp;Files&nbsp;<br />\r\n-&nbsp;Сортировка:&nbsp;<strong>orderid</strong>&nbsp;- будет возможность менять местами&nbsp;разделы средствами&nbsp;TreeGrid<br />\r\n-&nbsp;Постраничность:&nbsp;<strong>15</strong>&nbsp;- можно оставить по умолчанию, можно изменить</p>\r\n\r\n<p>Добавляем колонки, которые будут отображаться в Grid-е как список переводов:</p>\r\n\r\n<p>Колонка &quot;Название&quot;:<br />\r\n- Название:&nbsp;<strong>Название</strong><br />\r\n-&nbsp;Поле в БД:&nbsp;<strong>title</strong></p>\r\n\r\n<p>Колонка &quot;Язык&quot;:<br />\r\n- Название:&nbsp;<strong>Язык</strong><br />\r\n-&nbsp;Поле в БД:&nbsp;<strong>langname</strong><br />\r\n[@!PICS_2!@]<br />\r\n<br />\r\nДобавляем поля формы для сохранения файлов. Тут будут поля: &quot;Файл&quot;, &quot;Язык&quot;, &quot;Название (комментарий)&quot; и &quot;Активность&quot;.</p>\r\n\r\n<p>Поле &quot;Название&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Название</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>title</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Строка</strong></p>\r\n\r\n<p>Поле &quot;Язык&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Язык</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>lang_id</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Выпадающий список</strong></p>\r\n\r\n<p>Поле &quot;Активность&quot;:<br />\r\n-&nbsp;Название (label):&nbsp;<strong>Активность</strong><br />\r\n-&nbsp;Поле:&nbsp;<strong>active</strong><br />\r\n-&nbsp;Тип:&nbsp;<strong>Флажок</strong><br />\r\n[@!PICS_3!@]</p>\r\n\r\n<p>Добавляем параметр формы для поля &quot;Язык&quot;. Это необходимо для создания выпадающего списка языков, из которого будет выбираться требуемый нам:<br />\r\n-&nbsp;Имя параметра:&nbsp;multiOptions&nbsp;(других пока нет)<br />\r\n-&nbsp;Значение: PHP функция, которая возвращает список пар (ключ =&nbsp;id, значение =&nbsp;title) из таблицы&nbsp;Languages<br />\r\n<strong>$langsModel = new backend\\models\\Languages();<br />\r\nreturn $langsModel-&gt;fetchPairs(array(&#39;id&#39;,&#39;title&#39;),array(),&#39;orderid&#39;);</strong></p>\r\n\r\n<p>Добавляем условия, которые будут использоваться&nbsp;как поля формы со значениями по умолчанию. Для этих целей используется одно поле:<br />\r\nПоле &quot;<strong>sid</strong>&quot;: идентификатор типа статьи для таблицы&nbsp;Translates - будет всегда принимать значение file_help&nbsp;(то есть, все файлы и только они с&nbsp;sid=file_help&nbsp;будут являться переводами для раздела &quot;Файлы&quot;, который в свою очередь имеет родителя&nbsp;&quot;Помощь&quot;).<br />\r\n[@!PICS_4!@]</p>\r\n\r\n<p>Добавляем джойны. Они необходимы для связывания с другими таблицами. Заполняем джойн:<br />\r\n-&nbsp;Модель:&nbsp;<strong>backend\\models\\Languages</strong>&nbsp;(связываем таблицу файлов с таблицей языков)<br />\r\n- Условие:&nbsp;<strong>{{table}}.lang_id={{jointable}}.id</strong>&nbsp;(поле lang_id файлов будет связываться с полей id таблицы&nbsp;языков)<br />\r\n- Поля:&nbsp;<strong>title|langname</strong>&nbsp;(в запрос вместо алиаса langname будет записано значение поля title из таблицы языков)<br />\r\n[@!PICS_5!@]</p>\r\n\r\n<p>На этом создание ресурса &quot;Переводы&quot; завершается. В итоге, в списке ресурсов получаем:<br />\r\n[@!PICS_6!@]</p>\r\n\r\n<p>В принципе, переведен может быть любой контент сайта: заголовки, тексты, файлы. Для этого, как уже упоминалось используется модель Translates с набором полей, достаточным для хранения переводов большинства&nbsp;других моделей.</p>\r\n\r\n<p>Список файлов с указание переводов может выглядеть как-то так:<br />\r\n[@!PICS_7!@]</p>\r\n\r\n<p>При клике на иконку картинки, файл открывается в полном размере:<br />\r\n[@!PICS_8!@]</p>\r\n\r\n<p>Учитывая, что файл изначально был сохранен с русским языком, и, кроме того, имеет еще два перевода: на русский и на английский, то в запросе картинки для русского языка она отобразится дважды, а для&nbsp;английского - один раз:<br />\r\n[@!PICS_7!@]<br />\r\n[@!PICS_9!@]</p>\r\n','','','',0,0,1,1,'2020-02-25 18:29:30');
INSERT INTO `z_issues` VALUES (39,'menu',0,23,42,1,0,0,0,NULL,'Полезная информация','','useful_info',NULL,'<p>Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;</p>\r\n\r\n<p>Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;</p>\r\n\r\n<p>Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;Статья о&nbsp;Полезной информации.&nbsp;</p>\r\n\r\n<p>Статья о&nbsp;Полезной информации.&nbsp;</p>\r\n','','Полезная информация Description SEO','Полезная информация Keywords SEO',0,0,1,1,'2020-07-14 17:43:19');
INSERT INTO `z_issues` VALUES (40,'menu',0,24,43,1,0,0,0,NULL,'Статья №1 Главной страницы','','index1',NULL,'<p>Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;</p>\r\n\r\n<p>Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;</p>\r\n\r\n<p>Статья №1 Главной страницы.&nbsp;</p>\r\n\r\n<p>Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;Статья №1 Главной страницы.&nbsp;</p>\r\n','','Статья №1 Главной страницы Desc','Статья №1 Главной страницы Keys',0,0,1,1,'2020-07-14 23:55:45');
INSERT INTO `z_issues` VALUES (41,'menu',0,25,42,1,0,0,0,NULL,'Очень полезная информация','','very_useful_info',NULL,'<p>Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;</p>\r\n\r\n<p>Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;</p>\r\n\r\n<p>Очень полезная информация. Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;</p>\r\n\r\n<p>Очень полезная информация.&nbsp;Очень полезная информация.&nbsp;</p>\r\n','','Очень полезная информация Desc','Очень полезная информация Keys',0,0,1,0,'2020-07-15 12:37:43');
INSERT INTO `z_issues` VALUES (42,'menu',0,26,41,1,0,0,0,NULL,'наши контакты','','our_contacts',NULL,'<p>Статья:&nbsp;наши контакты</p>\r\n','','наши контакты Desc','наши контакты Keys',0,0,1,1,'2020-07-15 13:02:35');
INSERT INTO `z_issues` VALUES (43,'help',0,28,14,1,0,0,0,NULL,'Пакетная загрузка файлов','','paketnaya_zagruzka_fajlov',NULL,'<p>Если структура данных требует загрузки нескольких файлов одновременно, например, для создания галереи, предусмотрена возможность пакетной загрузки файлов. Для этого создается ресурс на базе модели Files, которая уже содержит два поля типа &quot;File&quot;, в частности, для хранения основной картинки (поле &quot;pics&quot;) и ее иконки (поле &quot;icon&quot;).<br />\r\n[@!PICS_1!@]</p>\r\n\r\n<p>Для включения функционала пакетной загрузки файлов необходимо включить галочку &quot;Пакетная загрузка файлов&quot; в ресурсе &quot;Форма&quot; для выбранного поля. Как указано в коментарии для этого поля,&nbsp;актуально только для данных типа &quot;Файл&quot;: дает возможность использования виджета одновременной загрузки нескольких файлов.<br />\r\n[@!PICS_2!@]</p>\r\n\r\n<p>В итоге, на странице cо списком файлов появится кнопка &quot;Пакетная загрузка файлов&quot;.<br />\r\n[@!PICS_3!@]</p>\r\n\r\n<p>Однако использовать для пакетной загрузки файлов можно только одно из полей типа &quot;File&quot; для исключения неоднозначности направления загрузки. Если&nbsp;функционал&nbsp;пакетной загрузки файлов был включен для более чем одного поля, к примеру, для модели Files - для полей &quot;pics&quot; и &quot;icon&quot;, появится предупреждение.<br />\r\n[@!PICS_4!@]</p>\r\n\r\n<p>При нажатии на кнопку &quot;Пакетная загрузка файлов&quot; появится модальное окно с полным функционалом выбора файлов, проверки корректности выбора и возможности одновременной загрузки нескольких файлов в базу данных.<br />\r\n[@!PICS_5!@]</p>\r\n\r\n<p>Существует возможность создания ограничений на загрузку файлов. Она задается в правилах модели. В частности, это касается ограничения на загрузку файлов только с заданными расширениями, размер загружаемого файла и количество одновременно загружаемых файлов.<br />\r\n[@!PICS_6!@]</p>\r\n\r\n<p>В этом примере превышено&nbsp;количество одновременно загружаемых файлов: в правилах модели указано &quot;не более двух&quot;, а здесь была попытка загрузки трех файлов.<br />\r\n[@!PICS_7!@]</p>\r\n\r\n<p>В этом примере была попытка загрузки файла с расширением, которое отсутствует в списке, указанном в&nbsp;правилах модели:&nbsp;отсутствует расширение&nbsp;TXT.<br />\r\n[@!PICS_8!@]</p>\r\n\r\n<p>В этом примере была попытка загрузки слишком большого файла: более 3 МБ, тогда как в&nbsp;правилах модели указано ограничение &quot;не более 3 МБ&quot;<br />\r\n[@!PICS_9!@]</p>\r\n\r\n<p>При соблюдении всех условий из правил модели произойдет успешная загрузка файлов на диск и будут созданы соответствующие записи в базе данных. Единственным ограничением при пакетной загрузке файлов на текущий момент является невозможность заполнения всех полей модели, поскольку отображение всех полей из существующей модели Files в модальном окне загрузки файлов может быть некорректным для требований конкретного функционала. Потому на данном этапе в окне выводится только поле &quot;active&quot; для указания активности/неактивности записей, создаваемых при пакетной загрузке файлов. Скорее всего, в будущих версия CMS может появиться возможность задания списка полей со значениями по умолчанию...<br />\r\nВ этом примере видно, что поле &quot;Язык&quot; не было задано.<br />\r\n[@!PICS_10!@]</p>\r\n','',NULL,NULL,0,0,1,1,'2020-08-19 13:34:56');
INSERT INTO `z_issues` VALUES (44,'help',0,29,14,1,0,0,0,NULL,'Создание статей','','sozdanie_statej',NULL,'<p>Для отображения на сайте файлов, привязанных к статье, можно в текст статьи добавлять конструкцию вида&nbsp;<strong>[@!PICS_N!@]</strong>, где <strong>N</strong> - порядковый номер файла из списка файлов, привязанных к статье. Пример для обработки таких конструкций на frontend может быть таким (показать третью картинку из списка файлов):<br />\r\n<span style=\"color:#A52A2A\"><em><strong>$idx = 3;</strong><br />\r\n$imgTag = &quot;&lt;img src=&#39;$url&#39;&gt;Рис.<strong>$idx</strong>&quot;;<br />\r\necho preg_replace(&quot;{\\<strong>[@</strong>\\<strong>!PICS_$idx</strong>\\<strong>!@</strong>\\<strong>]</strong>}&quot;, $imgTag, $text);</em></span></p>\r\n\r\n<p>&nbsp;</p>\r\n','',NULL,NULL,0,0,1,1,'2020-08-19 13:34:49');
INSERT INTO `z_issues` VALUES (45,'help',0,27,14,1,0,0,0,NULL,'Основной функционал GridView','','osnovnoj_funktsional_gridview',NULL,'<p>Основные элементы на странице GridView:</p>\r\n\r\n<ul>\r\n	<li>Заголовок в шапке, который показывает, где мы в данный момент находимся и какие действия выполняем: &quot;Помощь (Работа с Ресурсами). Статьи (Создание колонок ресурса). Файлы&quot;</li>\r\n	<li>&quot;Хлебные крошки&quot; (меню навигации между уровнями): &quot;Помощь - Статьи - Файлы&quot;</li>\r\n	<li>Кнопка добавления новой записи, при нажатии на которую откроется форма с полями, необходимыми для создания записи</li>\r\n	<li>Список записей в GridView</li>\r\n	<li>Навигация по страницам: &quot;Назад - 1 - 2 - Вперед&quot;</li>\r\n	<li>Если задан функционал пакетной загрузки файлов (см. &quot;Работа с GridView - Пакетная загрузка файлов&quot;), будет показана кнопка &quot;Пакетная загрузка файлов&quot;.</li>\r\n</ul>\r\n\r\n<p>[@!PICS_1!@]</p>\r\n\r\n<p>Справа над GridView расположены две кнопки:</p>\r\n\r\n<ul>\r\n	<li>Показать все записи</li>\r\n	<li>Экспорт</li>\r\n</ul>\r\n\r\n<p>При нажатии кнопки &quot;Показать все записи&quot; будут показаны все записи в GridView, элемент навигации по страницам в этом случае исчезнет. Повторное нажатие этой кнопки вернет на первую страницу GridView, элемент навигации по страницам&nbsp;появится вновь.<br />\r\n[@!PICS_2!@]</p>\r\n\r\n<p>При нажатии кнопки &quot;Экспорт&quot; будет показан список вариантов для экспорта: HTML, CSV, Text, Excel и Json.<br />\r\n[@!PICS_3!@]</p>\r\n\r\n<p>Также имеется возможность просмотра графических файлов, сохраненных в полях типа &quot;Файл&quot;, в увеличенном виде&nbsp;или в полном размере. Для этого при создании ресурса колонки следует указать примерно такой код:<br />\r\n<span style=\"color:#A52A2A\"><em>$uploads = new backend\\models\\Uploads();<br />\r\n$model = $uploads-&gt;getModel(&#39;{{pics}}&#39;);<br />\r\nif(!empty($model-&gt;realname)) {<br />\r\n&nbsp;&nbsp;$src = &quot;/&quot;.$model-&gt;getFullFileName();<br />\r\n&nbsp;&nbsp;return &quot;&lt;a class=\\&quot;admin_gallery\\&quot; href=\\&quot;&quot;.$src.&quot;\\&quot; data-fancybox=\\&quot;admin_gallery\\&quot;&gt;&lt;img src=\\&quot;&quot;.$src.&quot;\\&quot; width=\\&quot;24\\&quot;/&gt;&lt;/a&gt;&quot;;<br />\r\n}<br />\r\nreturn &#39;{{pics}}&#39;;</em></span><br />\r\nЕсли теперь кликнуть на иконку файла в GridView, он будет показан в увеличенном виде или в полном размере.<br />\r\n[@!PICS_4!@]</p>\r\n\r\n<p>Кроме того, предоставляется возможности выполнения множественных операций удаления и переключения активности записей. Если в последней колонке включить чекбокс у одной и более записей, вверху страницы появятся две дополнительные кнопки:</p>\r\n\r\n<ul>\r\n	<li>Удалить отмеченные</li>\r\n	<li>Сменить активность отмеченных</li>\r\n</ul>\r\n\r\n<p>Соответственно, эти&nbsp;действия будут применены ко всем отмеченным записям.<br />\r\n[@!PICS_5!@]</p>\r\n\r\n<p>Если же включить чекбокс в заголовке GridView, будут отмечены все записи. Если отключить этот чекбокс, отметки всех записей будут отключены.<br />\r\n[@!PICS_6!@]</p>\r\n\r\n<p>Действия, предлагаемые для работы с записями, следующие:</p>\r\n\r\n<ul>\r\n	<li>Редактировать</li>\r\n	<li>Удалить</li>\r\n	<li>Переместить на одну позицию вверх</li>\r\n	<li>Переместить на одну позицию вниз</li>\r\n	<li>Сменить флаг активности</li>\r\n</ul>\r\n\r\n<p>[@!PICS_7!@]</p>\r\n\r\n<p>Записи, отмеченные как &quot;неактивные&quot;, будут показаны в GridView розовым цветом.<br />\r\n[@!PICS_8!@]</p>\r\n','',NULL,NULL,0,0,1,1,'2020-08-19 14:28:49');
/*!40000 ALTER TABLE `z_issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_languages`
--

DROP TABLE IF EXISTS `z_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT 0,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_languages`
--

LOCK TABLES `z_languages` WRITE;
/*!40000 ALTER TABLE `z_languages` DISABLE KEYS */;
INSERT INTO `z_languages` VALUES (1,0,1,'Русский','ru',1);
INSERT INTO `z_languages` VALUES (2,0,2,'English','en',1);
/*!40000 ALTER TABLE `z_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_menus`
--

DROP TABLE IF EXISTS `z_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL COMMENT 'путь',
  `parentid` int(11) DEFAULT NULL COMMENT 'предок',
  `orderid` int(11) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL COMMENT 'сообщение',
  `smart_address` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `seo_description` varchar(1024) DEFAULT '',
  `seo_keywords` varchar(1024) DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `icon_hover` varchar(255) NOT NULL DEFAULT '',
  `pics` varchar(255) NOT NULL DEFAULT '',
  `folder` tinyint(1) NOT NULL DEFAULT 1,
  `show` tinyint(1) NOT NULL DEFAULT 1,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `url` (`url`) USING BTREE,
  KEY `order_id` (`orderid`) USING BTREE,
  KEY `parent_id` (`parentid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_menus`
--

LOCK TABLES `z_menus` WRITE;
/*!40000 ALTER TABLE `z_menus` DISABLE KEYS */;
INSERT INTO `z_menus` VALUES (20,'/#1',0,25,0,1,'','news','Новости','Новые технологии и их детальное описание','новые технологии детальное описание','','','',1,1,1,'2020-07-14 23:41:50');
INSERT INTO `z_menus` VALUES (21,'/news/dealers',20,21,0,1,'','news_dealers','Новости дилеров',NULL,NULL,'','','',1,1,1,'2020-07-14 11:19:04');
INSERT INTO `z_menus` VALUES (22,'/news/company',20,22,0,2,'','news_company','Company news',NULL,NULL,'','','',1,1,1,'2020-07-14 11:05:47');
INSERT INTO `z_menus` VALUES (25,'/#2',0,42,0,1,'','about','О нас',NULL,NULL,'','','',1,1,1,'2020-07-14 23:41:42');
INSERT INTO `z_menus` VALUES (41,'/contacts',25,41,1,1,'text','contacts','Контакты','Контакты для SEO-тега Description','Контакты для SEO-тега Keywords','','','',1,1,1,'2020-07-14 15:56:14');
INSERT INTO `z_menus` VALUES (42,'/info',0,43,0,1,'','info','Информация','Информация Description SEO','Информация Keywords SEO','','','',1,1,1,'2020-07-14 23:41:35');
INSERT INTO `z_menus` VALUES (43,'/',0,20,0,1,'','index','Главная','Главная Desc','Главная Keys','','','',1,1,1,'2020-07-15 11:51:07');
/*!40000 ALTER TABLE `z_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_resources`
--

DROP TABLE IF EXISTS `z_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resourceid` varchar(255) NOT NULL,
  `actionid` varchar(255) NOT NULL DEFAULT 'band',
  `parentid` int(11) DEFAULT 0,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `menu_icon` varchar(50) DEFAULT NULL,
  `datatype` varchar(255) NOT NULL DEFAULT '',
  `indexate` varchar(255) NOT NULL DEFAULT '',
  `default_field` varchar(255) NOT NULL DEFAULT '',
  `parent_field` varchar(255) NOT NULL DEFAULT '',
  `order` varchar(255) NOT NULL DEFAULT '',
  `group` varchar(255) NOT NULL DEFAULT '',
  `paginate` int(11) NOT NULL DEFAULT 15,
  `can_delete` int(1) NOT NULL DEFAULT 1,
  `can_edit` int(1) NOT NULL DEFAULT 1,
  `can_add` int(1) NOT NULL DEFAULT 1,
  `delete_confirm` int(1) NOT NULL DEFAULT 1,
  `delete_on_have_child` int(1) NOT NULL DEFAULT 0,
  `sortable` int(1) NOT NULL DEFAULT 0,
  `sortable_position` varchar(255) NOT NULL DEFAULT 'bottom',
  `visible` int(1) NOT NULL DEFAULT 1,
  `on_have_subcat` int(1) NOT NULL DEFAULT 1,
  `direct_link` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resourceid` (`resourceid`),
  KEY `parentid` (`parentid`),
  KEY `orderid` (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_resources`
--

LOCK TABLES `z_resources` WRITE;
/*!40000 ALTER TABLE `z_resources` DISABLE KEYS */;
INSERT INTO `z_resources` VALUES (1,'menus','list',5,1,'Меню','backend/models/Menus','th','catalog','','','parentid','orderid','',1000,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (3,'menus-issues','list',1,3,'Статьи','backend/models/Issues','-','band','','title','catalog_id','orderid,id DESC','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (4,'menus-issues-translates','list',3,4,'Переводы','backend/models/Translates','','band','','','source_id','','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (5,'site','list',0,27,'<b>Сайт</b>','-','globe','band','','','','','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (6,'menus-translates','list',1,4,'Переводы','backend/models/Translates','-','band','','title','source_id','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (29,'resources','list',0,19,'<font color=red><b>Ресурсы</b></font>','-','folder','catalog','','','','','',15,1,1,1,1,0,0,'bottom',1,1,0,1);
INSERT INTO `z_resources` VALUES (30,'languages','list',5,7,'Языки','backend/models/Languages','language','band','','title','','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (31,'menus-issues-files','band',3,8,'Файлы','backend/models/Files','','band','','title','source_id','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (53,'access','band',0,14,'<b>Доступ</b>','-','user','band','','','','','',15,1,1,1,1,0,0,'bottom',1,1,0,1);
INSERT INTO `z_resources` VALUES (54,'access_logs','band',53,22,'Логи','backend/models/AccessLogs','user-clock','band','','','','log_id desc','',15,1,1,1,1,0,0,'bottom',1,1,0,1);
INSERT INTO `z_resources` VALUES (55,'user','band',0,6,'Пользователи','backend/models/User','user-friends','band','','','id','','',15,1,1,1,1,0,0,'bottom',1,1,0,1);
INSERT INTO `z_resources` VALUES (56,'access_roles','band',53,16,'Роли','backend/models/AuthItem','user-check','band','','','','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (57,'access_permissions','band',53,17,'Разрешения','backend/models/AuthItem','user-check','band','','','','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (59,'settings','band',77,31,'Настройки','backend/models/Settings','cubes','band','','','','','',15,1,1,1,1,0,0,'bottom',0,1,0,1);
INSERT INTO `z_resources` VALUES (66,'auth_rule','band',53,18,'Правила','backend/models/AuthRule','user-lock','band','','','','orderid','',15,1,1,1,1,0,0,'bottom',1,1,0,1);
INSERT INTO `z_resources` VALUES (67,'helps','band',0,28,'<b>Помощь</b>','backend/models/Helps','question-circle','catalog','','','parentid','orderid','',1000,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (68,'helps-issues','band',67,24,'Статьи','backend/models/Issues','-','band','','','catalog_id','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (69,'helps-issues-files','band',68,25,'Файлы','backend/models/Files','-','band','','','source_id','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (70,'helps-issues-files-translates','band',69,26,'Переводы','backend/models/Translates','-','band','','','source_id','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (71,'helps-issues-translates','band',68,27,'Переводы','backend/models/Translates','-','band','','','source_id','orderid','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (75,'test','band',0,29,'Тест фильтров 1','backend/models/Test','check-double','band','','','','','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (76,'test2','band',0,38,'Тест фильтров 2','backend/models/Test2','check','band','','','','','',15,1,1,1,1,0,0,'bottom',0,1,0,0);
INSERT INTO `z_resources` VALUES (77,'-','band',0,15,'<b>Система</b>','-','hdd','band','','','','','',15,1,1,1,1,0,0,'bottom',1,1,0,1);
INSERT INTO `z_resources` VALUES (78,'/adm/clear-assets','band',77,32,'Очистка assets','-','eraser','band','','','','','',15,1,1,1,1,0,0,'bottom',0,1,1,1);
INSERT INTO `z_resources` VALUES (79,'/adm/wrong','band',77,33,'Хранилище','-','folder-open','band','','','','','',15,1,1,1,1,0,0,'bottom',1,1,1,1);
INSERT INTO `z_resources` VALUES (80,'/adm/getsql','band',77,34,'Файлы экспорта','-','file-export','band','','','','','',15,1,1,1,1,0,0,'bottom',0,1,1,1);
INSERT INTO `z_resources` VALUES (81,'/adm/help','band',77,35,'CompleteCMS Help','-','question','band','','','','','',15,1,1,1,1,0,0,'bottom',1,1,1,1);
INSERT INTO `z_resources` VALUES (82,'user-files','band',55,36,'Файлы','backend/models/Files','-','band','','','user_id','','',15,1,1,1,1,0,0,'bottom',0,1,0,1);
INSERT INTO `z_resources` VALUES (83,'user-userdata','band',55,37,'Данные','backend/models/Userdata','-','band','','','user_id','','',15,1,1,1,1,0,0,'bottom',0,1,0,1);
INSERT INTO `z_resources` VALUES (84,'useroffer','band',0,2,'Оферта','backend/models/Useroffer','file-alt','band','','','','','',15,1,1,1,1,0,0,'bottom',1,1,0,1);
/*!40000 ALTER TABLE `z_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_resources_columns`
--

DROP TABLE IF EXISTS `z_resources_columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_resources_columns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `resourceid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `width` varchar(255) NOT NULL DEFAULT '',
  `field` varchar(255) NOT NULL DEFAULT '',
  `orderlink` int(1) NOT NULL DEFAULT 0,
  `template` text NOT NULL,
  `filter_query` varchar(255) NOT NULL DEFAULT '',
  `filter_items` text NOT NULL,
  `eval` text NOT NULL,
  `escape` int(11) NOT NULL DEFAULT 0,
  `on_have_subcat` int(1) NOT NULL DEFAULT 1,
  `visible` int(1) NOT NULL DEFAULT 1,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `filter_type` varchar(50) NOT NULL DEFAULT '',
  `filter` varchar(255) NOT NULL DEFAULT '',
  `sort_flag` tinyint(1) NOT NULL DEFAULT 0,
  `filter_flag` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_resources_columns`
--

LOCK TABLES `z_resources_columns` WRITE;
/*!40000 ALTER TABLE `z_resources_columns` DISABLE KEYS */;
INSERT INTO `z_resources_columns` VALUES (1,0,1,'Заголовок','1%','title',0,'','','','',1,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (2,0,3,'Название','','title',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (3,0,4,'Название','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (4,0,6,'Название','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (7,1,30,'Заголовок','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (8,2,30,'Код языка','1%','code',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (9,3,1,'Язык','1%','langname',0,'','','','return (\"{{langname}}\" === \"English\") ? \"<b>eng</b>\" : \"<i>рус</i>\";',0,1,0,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (10,4,1,'Ссылка','','url',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (11,5,1,'Умный адрес','','smart_address',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (15,9,4,'Язык','','langname',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (16,10,6,'Язык','','langname',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (17,11,1,'Переведено','','langlist',0,'','','','$trans = new backend\\models\\Translates();\r\nreturn $trans->getSourceTranslatedList(\'{{id}}\', \'menu\');',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (20,12,3,'Язык','','langname',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (21,13,31,'Файл','','pics',0,'','','','$uploads = new backend\\models\\Uploads();\r\n$model = $uploads->getModel(\'{{pics}}\');\r\nif(!empty($model->realname)) {\r\n  $src = \"/\".$model->getFullFileName();\r\n  return \"<a class=\\\"admin_gallery\\\" href=\\\"\".$src.\"\\\" data-fancybox=\\\"admin_gallery\\\"><img src=\\\"\".$src.\"\\\" width=\\\"24\\\"/></a>\";\r\n}\r\nreturn \'{{pics}}\';',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (22,15,31,'Язык','','langname',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (23,16,31,'Название (комментарий)','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (25,18,3,'Переведено','','langlist',0,'','','','$trans = new backend\\models\\Translates();\r\nreturn \"<u>\".$trans->getSourceTranslatedList(\'{{id}}\', \'issue\').\"</u>\";',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (26,19,4,'Переведено','','langlist',0,'','','','$trans = new backend\\models\\Translates();\r\nreturn $trans->getSourceTranslatedList(\'{{id}}\', \'translate\');',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (39,27,54,'Пользователь','','username',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (40,31,54,'Пароль','','password',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (41,32,54,'IP','','ip',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (42,33,54,'User-Agent','','user_agent',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (43,34,54,'Дата','','time',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (44,35,54,'Статус','','success',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (45,36,55,'Имя','','username',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (46,37,55,'Полное имя','','fullname',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (47,38,55,'Email','','email',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (48,39,55,'Роль','','role',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (51,42,57,'Имя','','name',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (52,43,57,'Описание','','description',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (55,44,56,'Имя','','name',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (56,45,56,'Описание','','description',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (57,46,59,'Имя','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (58,47,59,'Значение','','value',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (59,48,59,'Описание','','description',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (67,57,66,'Имя','','name',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (68,60,66,'Действия','','actions',0,'','','','$fld = \'{{actions}}\';\r\nif(backend\\helpers\\Funcs::is_serial($fld)) {\r\n	return implode(\",\", unserialize($fld));\r\n}\r\nreturn \"\";',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (69,61,66,'Контроллеры','','controllers',0,'','','','$fld = \'{{controllers}}\';\r\nif(backend\\helpers\\Funcs::is_serial($fld)) {\r\n	return implode(\",\", unserialize($fld));\r\n}\r\nreturn \"\";',0,1,1,0,'','',0,0,0);
INSERT INTO `z_resources_columns` VALUES (70,63,66,'IP адреса','','ips',0,'','','','',0,1,1,0,'','',0,0,0);
INSERT INTO `z_resources_columns` VALUES (71,59,66,'Разрешение','','allow',0,'','','','return !empty(\'{{allow}}\') ? \"true\" : \"false\";',0,1,1,0,'','',0,0,0);
INSERT INTO `z_resources_columns` VALUES (72,58,66,'Роли','','roles',0,'','','','$fld = \'{{roles}}\';\r\nif(backend\\helpers\\Funcs::is_serial($fld)) {\r\n	return implode(\",\", unserialize($fld));\r\n}\r\nreturn \"\";',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (73,56,66,'Тип','','type',0,'','','','return backend\\models\\AuthRule::getListOfTypes()[{{type}}];',0,1,1,0,'','',0,0,0);
INSERT INTO `z_resources_columns` VALUES (74,62,66,'Меню','','menus',0,'','','','$fld = \'{{menus}}\';\r\n$fld = trim($fld);\r\nif(backend\\helpers\\Funcs::is_serial($fld)) {\r\n	$result = unserialize($fld);\r\n	if(!empty($result)) {\r\n		return \"Установлено\";\r\n	}\r\n}\r\nreturn \"-\";',0,1,1,0,'','',0,0,0);
INSERT INTO `z_resources_columns` VALUES (75,71,70,'Название','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (76,72,70,'Язык','','langname',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (77,67,69,'Файл','','pics',0,'','','','$uploads = new backend\\models\\Uploads();\r\n$model = $uploads->getModel(\'{{pics}}\');\r\nif(!empty($model->realname)) {\r\n  $src = \"/\".$model->getFullFileName();\r\n  return \"<a class=\\\"admin_gallery\\\" href=\\\"\".$src.\"\\\" data-fancybox=\\\"admin_gallery\\\"><img src=\\\"\".$src.\"\\\" width=\\\"24\\\"/></a>\";\r\n}\r\nreturn \'{{pics}}\';',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (78,68,69,'Язык','','langname',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (79,69,69,'Название (комментарий)','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (80,70,69,'Переведено','','langlist',0,'','','','$trans = new backend\\models\\Translates();\r\nreturn $trans->getSourceTranslatedList(\'{{id}}\', \'file_help\');',0,1,1,0,'','',0,0,0);
INSERT INTO `z_resources_columns` VALUES (81,73,71,'Название','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (82,74,71,'Язык','','langname',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (83,66,68,'Заголовок','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (84,64,67,'Название','','title',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (98,75,3,'Дата','','date',0,'','','','',0,1,1,0,'\\kartik\\date\\DatePicker','',1,1,0);
INSERT INTO `z_resources_columns` VALUES (99,76,3,'Дата изменения','','date_modified',0,'','','','',0,1,1,0,'\\kartik\\daterange\\DateRangePicker','',1,1,0);
INSERT INTO `z_resources_columns` VALUES (100,77,3,'ДатаВремя','','date_modified',0,'','','','',0,1,1,0,'\\kartik\\datetime\\DateTimePicker','',0,1,0);
INSERT INTO `z_resources_columns` VALUES (101,78,3,'Флаг','','active',0,'','','','',0,1,1,0,'checkbox','',1,1,0);
INSERT INTO `z_resources_columns` VALUES (102,79,3,'ФлагХ','','active',0,'','','','',0,1,1,0,'\\kartik\\checkbox\\CheckboxX','',1,1,0);
INSERT INTO `z_resources_columns` VALUES (104,81,75,'title','','title',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (105,82,75,'select','','select',0,'','','','return (\"{{select}}\" === \"0\") ? \"No\" : \"Yes\";',0,1,1,0,'','return [\"0\"=>\"No\", \"1\"=>\"Yes\"];',1,1,1);
INSERT INTO `z_resources_columns` VALUES (106,83,75,'filter_checkbox','','filter_checkbox',0,'','','','',0,1,1,0,'checkbox','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (124,86,75,'filter_color','','filter_color',0,'','','','',0,1,1,0,'\\kartik\\color\\ColorInput','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (125,87,75,'filter_date','','filter_date',0,'','','','$date = \"-\";\r\n$tm = strtotime(\'{{filter_date}}\');\r\nif($tm !== false) {\r\n	$date = date(\"d.m.Y\", $tm);\r\n}\r\nreturn $date;',0,1,1,0,'\\kartik\\date\\DatePicker','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (126,88,75,'filter_date_range','','filter_date_range',0,'','','','$date = \"\";\r\n$tm = strtotime(\'{{filter_date_range}}\');\r\nif($tm !== false) {\r\n	$date = date(\"d.m.Y\", $tm);\r\n}\r\nreturn $date;',0,1,1,0,'\\kartik\\daterange\\DateRangePicker','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (127,89,75,'filter_datetime','','filter_datetime',0,'','','','$date = \"\";\r\n$tm = strtotime(\'{{filter_datetime}}\');\r\nif($tm !== false) {\r\n	$date = date(\"d.m.Y H:i\", $tm);\r\n}\r\nreturn $date;',0,1,1,0,'\\kartik\\datetime\\DateTimePicker','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (128,90,75,'filter_money','','filter_money',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (129,91,76,'title','','title',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (130,92,76,'filter_number','','filter_number',0,'','','','',0,1,1,0,'\\kartik\\number\\NumberControl','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (131,93,76,'filter_range','','filter_range',0,'','','','',0,1,1,0,'\\kartik\\range\\RangeInput','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (132,94,76,'filter_select2','','filter_select2',0,'','','','$testModel = new backend\\models\\Test();\r\n$row = $testModel->find($id)->where([\'id\'=>\'{{id}}\'])->one();\r\nreturn \"<b>\".$row->title.\"</b>\";',0,1,1,0,'\\kartik\\select2\\Select2','$testModel = new backend\\models\\Test();\r\n$arr = $testModel->fetchPairs([\'id\',\'title\'],[],\'id DESC\');\r\nreturn $arr;',1,1,1);
INSERT INTO `z_resources_columns` VALUES (133,95,76,'filter_slider','','filter_slider',0,'','','','',0,1,1,0,'\\kartik\\slider\\Slider','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (134,96,76,'filter_spin','','filter_spin',0,'','','','',0,1,1,0,'\\kartik\\touchspin\\TouchSpin','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (135,97,76,'filter_star','','filter_star',0,'','','','',0,1,1,0,'\\kartik\\rating\\StarRating','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (136,98,76,'filter_switch','','filter_switch',0,'','','','',0,1,1,0,'\\kartik\\switchinput\\SwitchInput','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (138,99,76,'filter_typeahead','','filter_typeahead',0,'','','','',0,1,1,0,'\\kartik\\typeahead\\Typeahead','return [\"0\"=>\"Nope\", \"1\"=>\"Yeah\"];',1,1,1);
INSERT INTO `z_resources_columns` VALUES (139,85,75,'filter_checkbox_x','','filter_checkbox_x',0,'','','','',0,1,1,0,'\\kartik\\checkbox\\CheckboxX','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (140,101,82,'Название (комментарий)','','title',0,'','','','',0,1,1,0,'','',1,1,1);
INSERT INTO `z_resources_columns` VALUES (141,100,82,'Файл','','pics',0,'','','','$uploads = new backend\\models\\Uploads();\r\n$model = $uploads->getModel(\'{{pics}}\');\r\nif(!empty($model->realname)) {\r\n	//\\FB::log($model->realname);\r\n  $backendPath = Yii::getAlias(\'@backend\').\'/web/\';\r\n	$fullName = $backendPath.$model->getFullFileName();\r\n	//\\FB::error($fullName);\r\n	$src = \"/\".$model->getFullFileName();\r\n	if(@is_array(getimagesize($fullName))){\r\n  	return \"<a class=\\\"admin_gallery\\\" href=\\\"\".$src.\"\\\" data-fancybox=\\\"admin_gallery\\\"><img src=\\\"\".$src.\"\\\" width=\\\"24\\\"/></a>\";\r\n	} else {\r\n  	return \"<a href=\\\"\".$src.\"\\\" target=\\\"_blank\\\">\".$model->realname.\"</a>\";\r\n	}\r\n}\r\nreturn \'{{pics}}\';',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (142,103,83,'Гражданство','','citizenship',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (143,104,83,'Дата рождения','','dob',0,'','','','',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (144,102,83,'Имя','','user_id',0,'','','','use backend\\models\\User;\r\n$user = new User();\r\n$row = $user->findOneModel({{user_id}});\r\nreturn $row->fullname;',0,1,1,0,'','',0,0,1);
INSERT INTO `z_resources_columns` VALUES (145,105,84,'Дата создания','','date',0,'','','','',0,1,1,0,'','',1,0,1);
INSERT INTO `z_resources_columns` VALUES (146,106,84,'Токен','','token',0,'','','','',0,1,1,0,'','',0,0,1);
/*!40000 ALTER TABLE `z_resources_columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_resources_conditions`
--

DROP TABLE IF EXISTS `z_resources_conditions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_resources_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `resourceid` int(11) NOT NULL,
  `condition` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  `parentid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `recourceid` (`resourceid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_resources_conditions`
--

LOCK TABLES `z_resources_conditions` WRITE;
/*!40000 ALTER TABLE `z_resources_conditions` DISABLE KEYS */;
INSERT INTO `z_resources_conditions` VALUES (1,1,6,'sid','menu',0);
INSERT INTO `z_resources_conditions` VALUES (2,2,3,'sid','menu',0);
INSERT INTO `z_resources_conditions` VALUES (4,3,4,'sid','issue',0);
INSERT INTO `z_resources_conditions` VALUES (7,0,31,'sid','issue',0);
INSERT INTO `z_resources_conditions` VALUES (10,6,56,'type','1',0);
INSERT INTO `z_resources_conditions` VALUES (11,7,57,'type','2',0);
INSERT INTO `z_resources_conditions` VALUES (12,11,70,'sid','file_help',0);
INSERT INTO `z_resources_conditions` VALUES (13,10,69,'sid','help',0);
INSERT INTO `z_resources_conditions` VALUES (14,12,71,'sid','help',0);
INSERT INTO `z_resources_conditions` VALUES (15,8,68,'sid','help',0);
INSERT INTO `z_resources_conditions` VALUES (16,9,68,'lang_id','1',0);
INSERT INTO `z_resources_conditions` VALUES (17,13,66,'allow','1',0);
INSERT INTO `z_resources_conditions` VALUES (18,14,66,'type','3',0);
/*!40000 ALTER TABLE `z_resources_conditions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_resources_forms`
--

DROP TABLE IF EXISTS `z_resources_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_resources_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resourceid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL DEFAULT '',
  `field` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) NOT NULL DEFAULT '',
  `required` int(1) NOT NULL DEFAULT 0,
  `value` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `only_for_root` int(1) NOT NULL DEFAULT 0,
  `show_check` text NOT NULL,
  `is_file` int(1) NOT NULL DEFAULT 0,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `multiple_upload` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `resourceid` (`resourceid`),
  KEY `orderid` (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_resources_forms`
--

LOCK TABLES `z_resources_forms` WRITE;
/*!40000 ALTER TABLE `z_resources_forms` DISABLE KEYS */;
INSERT INTO `z_resources_forms` VALUES (1,1,0,'Text','title','Название',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (2,1,0,'Text','url','Путь',1,'123','Описание поля Path',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (7,30,1,'Text','title','Название',1,'','Название: обязательное поле!',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (8,30,2,'Text','code','Код языка',1,'','Код языка: тоже обязательное поле...',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (9,3,3,'Text','title','Название',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (10,3,4,'Select','lang_id','Язык',1,'1','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (11,4,5,'Text','title','Название',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (12,4,6,'Select','lang_id','Язык',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (13,1,7,'Select','lang_id','Язык',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (14,6,8,'Text','title','Название',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (15,6,9,'Select','lang_id','Язык',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (16,31,10,'File','pics','Файл',1,'','',0,'',0,0,1,1);
INSERT INTO `z_resources_forms` VALUES (17,31,11,'Select','lang_id','Язык',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (19,31,13,'Text','title','Название (комментарий)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (24,3,16,'Mce','text','Текст',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (25,1,17,'Text','seo_description','Description (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (26,1,18,'Text','seo_keywords','Keywords (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (27,3,19,'Text','seo_description','Description (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (28,3,20,'Text','seo_keywords','Keywords (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (29,4,22,'Text','seo_description','Description (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (30,4,23,'Text','seo_keywords','Keywords (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (31,6,25,'Text','seo_description','Description (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (32,6,26,'Text','seo_keywords','Keywords (SEO)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (33,1,51,'Text','smart_address','Умный адрес',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (34,3,52,'Text','smart_address','Умный адрес',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (61,55,53,'Text','username','Имя',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (62,55,54,'Text','fullname','Полное имя',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (63,55,55,'Password','password_hash','Пароль',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (64,55,56,'Text','email','Email',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (65,55,57,'Select','role','Роль',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (66,56,59,'Text','name','Имя',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (67,56,60,'Text','description','Описание',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (69,57,64,'Text','name','Имя',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (70,57,65,'Text','description','Описание',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (74,56,66,'MultiCheckbox','permissions','Разрешения',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (77,59,67,'Text','title','Имя',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (78,59,68,'Text','value','Значение',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (79,59,76,'Text','description','Описание',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (80,59,77,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (88,66,79,'Text','name','Имя',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (89,66,83,'MultiCheckbox','actions','Действия',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (90,66,80,'MultiCheckbox','roles','Роли',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (91,66,82,'MultiCheckbox','controllers','Контроллеры',0,'','',0,'',0,0,0,0);
INSERT INTO `z_resources_forms` VALUES (92,66,86,'Text','ips','IP адреса',0,'','Список, разделенный запятыми',0,'',0,0,0,0);
INSERT INTO `z_resources_forms` VALUES (94,66,78,'Select','type','Тип',1,'','',0,'',0,0,0,0);
INSERT INTO `z_resources_forms` VALUES (95,66,84,'MultiCheckbox','menus','Меню',0,'','',0,'',0,0,0,0);
INSERT INTO `z_resources_forms` VALUES (113,1,94,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (114,3,96,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (115,4,97,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (116,6,106,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (118,30,98,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (119,31,99,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (120,70,105,'Text','title','Название',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (121,70,107,'Select','lang_id','Язык',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (122,70,108,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (123,69,101,'File','pics','Файл',0,'','Файл для статей раздела \"Помощь\"',0,'',0,0,1,1);
INSERT INTO `z_resources_forms` VALUES (124,69,102,'Select','lang_id','Язык',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (125,69,103,'Text','title','Название (комментарий)',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (126,69,104,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (128,71,109,'Text','title','Название',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (129,71,110,'Select','lang_id','Язык',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (130,71,111,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (131,68,89,'Text','title','Заголовок',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (132,68,90,'Mce','text','Текст',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (133,68,92,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (134,67,87,'Text','title','Название',1,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (135,67,88,'Select','lang_id','Язык',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (136,67,91,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (137,75,112,'Text','title','title',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (138,75,113,'Text','select','select ',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (139,75,114,'Checkbox','filter_checkbox','filter_checkbox',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (140,75,115,'Checkbox','filter_checkbox_x','filter_checkbox_x',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (141,75,116,'Text','filter_color','filter_color',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (142,75,117,'Date','filter_date','filter_date',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (143,75,118,'Date','filter_date_range','filter_date_range',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (144,75,119,'Date','filter_datetime','filter_datetime',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (145,75,120,'Text','filter_money','filter_money',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (146,75,121,'Text','filter_number','filter_number',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (147,75,123,'Text','filter_range','filter_range',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (148,75,124,'Text','filter_select2','filter_select2',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (149,75,125,'Text','filter_slider','filter_slider',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (150,75,126,'Text','filter_sortable','filter_sortable',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (151,75,127,'Text','filter_spin','filter_spin',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (152,75,128,'Text','filter_star','filter_star',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (153,75,129,'Checkbox','filter_switch','filter_switch',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (154,75,122,'Checkbox','filter_radio','filter_radio',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (155,75,130,'Text','filter_time','filter_time',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (156,75,131,'Text','filter_typeahead','filter_typeahead',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (158,4,21,'Mce','text','Текст',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (159,4,93,'Text','smart_address','Умный адрес',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (160,76,133,'Text','title','title',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (161,83,134,'Text','citizenship','Гражданство',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (162,83,135,'Date','dob','Дата рождения',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (163,83,136,'Mce','passport','Паспортные данные',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (164,83,137,'Mce','address_reg','Адрес места регистрации',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (165,83,138,'Mce','address_loc','Адрес фактического проживания',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (166,83,139,'Text','phone','Номер мобильного телефона',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (167,83,140,'Text','inn','Номер ИНН',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (168,83,141,'Text','snils','Номер СНИЛС',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (169,83,142,'Text','bank_card','№ банковской карты',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (170,83,143,'Text','bank_account','№ счета, привязанного к карте',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (171,83,144,'Text','bank_name','Наименование банка',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (172,83,145,'Text','bank_bik','БИК',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (173,83,147,'Text','bank_corr','Корр. счет',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (174,83,148,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (176,84,149,'Mce','text','Текст',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (177,84,150,'UniqId','token','Токен',0,'16','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (179,84,151,'Checkbox','active','Активность',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (180,84,152,'Date','date','Дата создания',0,'','',0,'',0,0,1,0);
INSERT INTO `z_resources_forms` VALUES (182,66,85,'MultiCheckbox','sections','Разделы',0,'','',0,'',0,0,1,0);
/*!40000 ALTER TABLE `z_resources_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_resources_forms_params`
--

DROP TABLE IF EXISTS `z_resources_forms_params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_resources_forms_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `formid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `is_eval` int(1) NOT NULL DEFAULT 0,
  `parentid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `formid` (`formid`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_resources_forms_params`
--

LOCK TABLES `z_resources_forms_params` WRITE;
/*!40000 ALTER TABLE `z_resources_forms_params` DISABLE KEYS */;
INSERT INTO `z_resources_forms_params` VALUES (109,0,13,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (111,0,15,'MultiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (112,0,10,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (113,0,17,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (114,1,12,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (115,2,40,'multiOptions','$vendorsModel = new backend\\models\\Vendors();\r\nreturn $vendorsModel->fetchPairs(array(\'vendor_id\',\'name\'),array(),\'\');',1,0);
INSERT INTO `z_resources_forms_params` VALUES (116,3,43,'MultiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',1,0);
INSERT INTO `z_resources_forms_params` VALUES (117,4,45,'multiOptions','return array(\r\n	\"2\" => \"test2\",\r\n	\"4\" => \"test4\",\r\n	\"6\" => \"test6\",\r\n);',0,0);
INSERT INTO `z_resources_forms_params` VALUES (118,5,47,'multiOptions','$equipModel = new backend\\models\\EquipmentsTypes();\r\nreturn $equipModel->fetchPairs(array(\'equipment_type_id\',\'name\'),array(),\'\');',1,0);
INSERT INTO `z_resources_forms_params` VALUES (119,6,74,'multiOptions','$permitsModel = new backend\\models\\AuthItem();\r\nreturn $permitsModel->fetchValues(array(\'name\'),array(\"type\"=>2),\'name\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (120,7,65,'multiOptions','return backend\\models\\User::getRolesPairs();',0,0);
INSERT INTO `z_resources_forms_params` VALUES (121,8,84,'multiOptions','$cityModel = new backend\\models\\CityList();\r\nreturn $cityModel->fetchPairs(array(\'id\',\'city_list_name\'),array(),\'city_list_name\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (122,9,49,'multiOptions','$markerModel = new backend\\models\\ScGeoMarker();\r\nreturn $markerModel->fetchPairs(array(\'id\',\'sc_geo_box_alias\'),array(),\'sc_geo_box_alias\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (125,11,89,'multiOptions','$methodsList = backend\\controllers\\AbstractController::getAllActions();\r\n$allActions = [];\r\nforeach($methodsList as $controller => $actionsList) {\r\n	foreach($actionsList as $action) {\r\n		if(!empty($allActions[$action])) {\r\n			//$val = $allActions[$action].;\r\n			$allActions[$action] .= \", \".$controller;\r\n		} else {\r\n			$allActions[$action] = $action.\": \".$controller;\r\n		}\r\n	}\r\n}\r\nasort($allActions);\r\nreturn $allActions;',0,0);
INSERT INTO `z_resources_forms_params` VALUES (126,12,90,'multiOptions','$type = backend\\models\\AuthItem::TYPE_ROLE;\r\n$allRoles = backend\\models\\AuthItem::getRoles($type);\r\n$result = [];\r\nforeach($allRoles as $role) {\r\n	$name = $role[\"name\"];\r\n	$result[$name] = $name;\r\n}\r\nreturn $result;',0,0);
INSERT INTO `z_resources_forms_params` VALUES (127,13,91,'multiOptions','$methodsList = backend\\controllers\\AbstractController::getAllActions();\r\n$controllers = [];\r\nforeach($methodsList as $controller => $methodsItem) {\r\n	$controllers[$controller] = $controller;\r\n}\r\nreturn array_unique($controllers);',0,0);
INSERT INTO `z_resources_forms_params` VALUES (128,14,94,'multiOptions','return backend\\models\\AuthRule::getListOfTypes();',0,0);
INSERT INTO `z_resources_forms_params` VALUES (129,15,95,'multiOptions','$insertCode = \"\";\r\n$isHtml = false;\r\n$resourceAdminPairs = backend\\models\\Resources::getResourcesMenu($insertCode, $isHtml);\r\n\r\n$replaceStr = html_entity_decode(\"&nbsp;&nbsp;&nbsp;&nbsp;\");\r\n$result = [];\r\nforeach($resourceAdminPairs as $resourceAdminItem) {\r\n	$id = $resourceAdminItem[\"id\"];\r\n	$title = $resourceAdminItem[\"title\"];\r\n	$menuIcon = $resourceAdminItem[\"menu_icon\"];\r\n	$title = preg_replace(\'/\\G\\s|\\s(?=\\s*$)/\', $replaceStr, $title);\r\n	$title = backend\\helpers\\Mail::stripTags($title);\r\n	/*\r\n	$fontAwesomeIcons = backend\\helpers\\Admin::getFontAwesomeIcons();\r\n	if(!empty($menuIcon) && !empty($fontAwesomeIcons[$menuIcon])) {\r\n		$title .= \" (fa-\".$menuIcon.\")\";\r\n	}\r\n	*/\r\n	$result[$id] = $title;\r\n}\r\nreturn $result;',0,0);
INSERT INTO `z_resources_forms_params` VALUES (130,16,96,'multiOptions','$vendorModel = new backend\\models\\Vendors();\r\nreturn $vendorModel->fetchPairs(array(\'vendor_id\',\'name\'),array(),\'\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (133,19,58,'multiOptions','$cityModel = new backend\\models\\CityList();\r\nreturn $cityModel->fetchPairs(array(\'city_list_name\',\'city_list_name\'),array(),\'city_list_name\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (134,21,121,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (135,20,124,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (136,22,129,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (137,18,135,'multiOptions','$langsModel = new backend\\models\\Languages();\r\nreturn $langsModel->fetchPairs(array(\'id\',\'title\'),array(),\'orderid\');',0,0);
INSERT INTO `z_resources_forms_params` VALUES (139,23,182,'multiOptions','$resourcePairsData = backend\\models\\Resources::getRecursivePairs(backend\\models\\Resources::getResourcesTree());\r\n    \r\n$resourcePairs = array();\r\n//$resourcePairs[0] = \"Корень\";\r\n$insertCode = \"!space!\";\r\nforeach($resourcePairsData as $node) {\r\n	$id = (int)$node[\"id\"];\r\n	$level = $node[\"level\"];\r\n	$resourceid = $node[\"resourceid\"];\r\n	$title = $node[\"title\"];\r\n	$visible = $node[\"visible\"];\r\n	$active = $node[\"active\"];\r\n	if(!$active) {\r\n		continue;\r\n	}\r\n	$extraStr = \"\";\r\n	if($visible) {\r\n		$extraStr .= \'!v!\';\r\n	} else {\r\n		$extraStr .= \'!iv!\';\r\n	}\r\n	/*\r\n	if($active) {\r\n		$extraStr .= \' !a!\';\r\n	} else {\r\n		$extraStr .= \' !ia!\';\r\n	}\r\n	*/\r\n	$space = ($level === 0) ? \"\" : \" \";\r\n	$resourcePairs[$id] = str_repeat($insertCode, $level).$space.$title.\" (\".$resourceid.\"): \".$extraStr;\r\n}\r\nreturn $resourcePairs;',0,0);
INSERT INTO `z_resources_forms_params` VALUES (141,24,182,'oneColumn','return true;',0,0);
/*!40000 ALTER TABLE `z_resources_forms_params` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_resources_joins`
--

DROP TABLE IF EXISTS `z_resources_joins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_resources_joins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `resourceid` int(11) NOT NULL,
  `model` varchar(255) NOT NULL DEFAULT '',
  `condition` varchar(255) NOT NULL DEFAULT '',
  `fields` varchar(255) NOT NULL DEFAULT '',
  `parentid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `resourceid` (`resourceid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_resources_joins`
--

LOCK TABLES `z_resources_joins` WRITE;
/*!40000 ALTER TABLE `z_resources_joins` DISABLE KEYS */;
INSERT INTO `z_resources_joins` VALUES (1,0,1,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
INSERT INTO `z_resources_joins` VALUES (2,1,6,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
INSERT INTO `z_resources_joins` VALUES (3,2,3,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
INSERT INTO `z_resources_joins` VALUES (4,3,4,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
INSERT INTO `z_resources_joins` VALUES (5,4,31,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
INSERT INTO `z_resources_joins` VALUES (6,6,70,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
INSERT INTO `z_resources_joins` VALUES (7,5,69,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
INSERT INTO `z_resources_joins` VALUES (8,7,71,'backend/models/Languages','{{table}}.lang_id={{jointable}}.id','title|langname',0);
/*!40000 ALTER TABLE `z_resources_joins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_resources_refers`
--

DROP TABLE IF EXISTS `z_resources_refers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_resources_refers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `resourceid` int(11) NOT NULL,
  `field` varchar(255) NOT NULL DEFAULT '',
  `model` varchar(255) NOT NULL DEFAULT '',
  `field1` varchar(255) NOT NULL DEFAULT '',
  `field2` varchar(255) NOT NULL DEFAULT '',
  `parentid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `resourceid` (`resourceid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_resources_refers`
--

LOCK TABLES `z_resources_refers` WRITE;
/*!40000 ALTER TABLE `z_resources_refers` DISABLE KEYS */;
INSERT INTO `z_resources_refers` VALUES (3,2,56,'permissions','backend/models/AuthItemChild','child','parent',0);
/*!40000 ALTER TABLE `z_resources_refers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_settings`
--

DROP TABLE IF EXISTS `z_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `description` varchar(128) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_settings`
--

LOCK TABLES `z_settings` WRITE;
/*!40000 ALTER TABLE `z_settings` DISABLE KEYS */;
INSERT INTO `z_settings` VALUES (1,'backend_version','CMS','1.0',0);
INSERT INTO `z_settings` VALUES (2,'recaptcha_key','ReCaptcha key','recaptcha_key',1);
INSERT INTO `z_settings` VALUES (3,'password_salt','Password salt','HNGBUvfzYVUDKaynx-CfskNEi30Fxwt0',0);
INSERT INTO `z_settings` VALUES (4,'root_auth_key','Root authorization key','S-yk6oP3UG0NlhJQrQWg1KJgYwst_FOr',0);
INSERT INTO `z_settings` VALUES (5,'root_password','Root password','9bb0c3054527b782e4424f10acb573f5c7f427f7',1);
INSERT INTO `z_settings` VALUES (6,'auth_time','Auth time','86400',1);
INSERT INTO `z_settings` VALUES (7,'robot_email','Robot E-mail','1@yandex.ru',1);
INSERT INTO `z_settings` VALUES (8,'admin_email','Admin E-mail','2@yandex.ru',2);
INSERT INTO `z_settings` VALUES (9,'recaptcha_secret','ReCaptcha secret','',1);
INSERT INTO `z_settings` VALUES (11,'client_email','E-mail клиента','',2);
/*!40000 ALTER TABLE `z_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_test`
--

DROP TABLE IF EXISTS `z_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `select` varchar(255) DEFAULT NULL,
  `filter_checkbox` varchar(255) DEFAULT NULL,
  `filter_checkbox_x` varchar(255) DEFAULT NULL,
  `filter_color` varchar(255) DEFAULT NULL,
  `filter_date` date DEFAULT NULL,
  `filter_date_range` date DEFAULT NULL,
  `filter_datetime` datetime DEFAULT NULL,
  `filter_money` varchar(255) DEFAULT NULL,
  `filter_number` decimal(10,2) NOT NULL DEFAULT 0.00,
  `filter_radio` varchar(255) DEFAULT NULL,
  `filter_range` varchar(255) DEFAULT NULL,
  `filter_select2` varchar(255) DEFAULT NULL,
  `filter_slider` varchar(255) DEFAULT NULL,
  `filter_sortable` varchar(255) DEFAULT NULL,
  `filter_spin` varchar(255) DEFAULT NULL,
  `filter_star` decimal(3,1) NOT NULL DEFAULT 0.0,
  `filter_switch` varchar(255) DEFAULT NULL,
  `filter_time` varchar(255) DEFAULT NULL,
  `filter_typeahead` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_test`
--

LOCK TABLES `z_test` WRITE;
/*!40000 ALTER TABLE `z_test` DISABLE KEYS */;
INSERT INTO `z_test` VALUES (3,'protest','0','0','1','red','2020-06-03','2020-06-03','2020-06-03 10:00:00','1.23',123.00,NULL,'12','3','0',NULL,'0',4.0,'0',NULL,'Yeah');
INSERT INTO `z_test` VALUES (4,'qwerty','1','0','0','yellow',NULL,NULL,NULL,'123',234.00,NULL,NULL,'4','3',NULL,'3',3.5,'1',NULL,'This Is Yeah');
INSERT INTO `z_test` VALUES (5,'abcdefg','1','1','0','green',NULL,NULL,NULL,NULL,234.00,NULL,NULL,'5','5',NULL,'5',5.0,'1',NULL,'Just Nope');
INSERT INTO `z_test` VALUES (6,'test666','1','1','1','red','2020-06-03','2020-06-03','2020-06-03 10:00:00','1.23',123.00,NULL,'12','6','10',NULL,'10',2.0,'0',NULL,'Nope Again');
/*!40000 ALTER TABLE `z_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_translates`
--

DROP TABLE IF EXISTS `z_translates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_translates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT 0,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `sid` varchar(100) NOT NULL DEFAULT '',
  `source_id` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `title2` varchar(255) NOT NULL DEFAULT '',
  `smart_address` varchar(255) NOT NULL DEFAULT '',
  `small_text` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `tag` varchar(255) NOT NULL DEFAULT '',
  `seo_description` varchar(1024) DEFAULT '',
  `seo_keywords` varchar(1024) DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `sid` (`sid`),
  KEY `source_id` (`source_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_translates`
--

LOCK TABLES `z_translates` WRITE;
/*!40000 ALTER TABLE `z_translates` DISABLE KEYS */;
INSERT INTO `z_translates` VALUES (1,1,0,'menu',1,2,0,'Перевод на английский','','perevod_na_anglijskij','','','','','',1,'2020-07-15 08:36:45');
INSERT INTO `z_translates` VALUES (2,1,0,'issue',1,0,0,'перевод статьи','','',NULL,'<p>привет! как дела? :-)</p>','',NULL,NULL,1,'2019-08-23 13:46:29');
INSERT INTO `z_translates` VALUES (3,1,0,'issue',2,2,0,'The coolest news of the Blog!','','the_coolest_news_of_the_blog',NULL,NULL,'',NULL,NULL,1,'2020-02-11 14:45:41');
INSERT INTO `z_translates` VALUES (4,1,0,'issue',6,1,0,'ПЕРЕВОД на РУС #1','','translation_1',NULL,NULL,'',NULL,NULL,1,'2020-07-15 08:41:21');
INSERT INTO `z_translates` VALUES (5,1,0,'issue',6,2,0,'TRANSLATION #2','','translation_2',NULL,NULL,'',NULL,NULL,1,'2020-07-14 11:27:36');
INSERT INTO `z_translates` VALUES (6,2,0,'menu',20,2,0,'Main news #1','','translation_1',NULL,NULL,'',NULL,NULL,1,'2020-07-15 12:16:30');
INSERT INTO `z_translates` VALUES (7,3,0,'menu',20,2,0,'Main news #2','','translation_2',NULL,NULL,'',NULL,NULL,1,'2020-07-15 12:16:15');
INSERT INTO `z_translates` VALUES (8,26,0,'menu',20,1,0,'Новости. Перевод (рус)','','perevod_stati__aha',NULL,NULL,'',NULL,NULL,1,'2020-07-15 11:16:20');
INSERT INTO `z_translates` VALUES (9,1,0,'menu',22,1,0,'Новости компании','','perevod_stati',NULL,NULL,'',NULL,NULL,1,'2020-02-17 18:14:05');
INSERT INTO `z_translates` VALUES (17,1,0,'equip',1,1,0,'перевод оборудования','','111',NULL,NULL,'',NULL,NULL,1,'2020-07-15 12:16:30');
INSERT INTO `z_translates` VALUES (18,4,0,'issue',10,1,0,'<b><font color=\"red\">Просто проверка HTML</font></b>','','bfont_color_red_prosto_proverka_html_font_b',NULL,NULL,'',NULL,NULL,1,'2020-07-15 10:51:42');
INSERT INTO `z_translates` VALUES (19,9,0,'help',22,2,0,'CompleteCMS - content management system by the Complete Group Company','','completecms__content_management_system_by_the_complete_group_company','','','','','',1,'2020-07-15 10:51:48');
INSERT INTO `z_translates` VALUES (20,7,0,'file_help',12,1,0,'Перевод картинки на Рус','','perevod_kartinki_na_rus','','','','','',1,'2020-07-15 10:51:44');
INSERT INTO `z_translates` VALUES (21,8,0,'file_help',12,2,0,'Translation to Eng','','translation_to_eng','','','','','',1,'2020-07-15 10:51:46');
INSERT INTO `z_translates` VALUES (22,10,0,'menu',25,2,0,'About Us','','about_us',NULL,NULL,'',NULL,NULL,1,'2020-07-15 10:51:50');
INSERT INTO `z_translates` VALUES (23,11,0,'menu',42,2,0,'Information','','information',NULL,NULL,'','Information Description SEO','Information Keywords SEO',1,'2020-07-15 11:15:17');
INSERT INTO `z_translates` VALUES (24,12,0,'issue',39,2,0,'Useful information','','useful_info',NULL,'<p>Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;</p>\r\n\r\n<p>Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;</p>\r\n\r\n<p>Useful information Issue.&nbsp;Useful information Issue.&nbsp;</p>\r\n\r\n<p>Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;Useful information Issue.&nbsp;</p>\r\n','','Useful information Description SEO','Useful information Keywords SEO',1,'2020-07-15 11:15:19');
INSERT INTO `z_translates` VALUES (25,1,0,'menu',43,2,0,'Main','','main',NULL,'<p>Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;</p>\r\n\r\n<p>Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;</p>\r\n\r\n<p>Main page Text.&nbsp;Main page Text.&nbsp;</p>\r\n\r\n<p>Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;Main page Text.&nbsp;</p>\r\n','','Main Desc','Main Keys',1,'2020-07-15 08:36:45');
INSERT INTO `z_translates` VALUES (26,27,0,'menu',41,2,0,'Contacts','','contacts',NULL,NULL,'','Contacts Desc','Contacts Keys',1,'2020-07-15 11:18:46');
INSERT INTO `z_translates` VALUES (27,28,0,'issue',42,2,0,'our contacts','','our_contacts',NULL,'<p>Issue:&nbsp;our contacts</p>\r\n','','our contacts Desc','our contacts Keys',1,'2020-07-15 13:03:43');
/*!40000 ALTER TABLE `z_translates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `z_uploads`
--

DROP TABLE IF EXISTS `z_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `realname` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `exif` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `z_uploads`
--

LOCK TABLES `z_uploads` WRITE;
/*!40000 ALTER TABLE `z_uploads` DISABLE KEYS */;
INSERT INTO `z_uploads` VALUES (19,0,'Zodiaks-Sagittarius_woman_04.jpg','BcnmhILk','zodiaks_sagittarius_woman_04.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (20,0,'Zodiaks-Sagittarius_woman_05.jpg','TpzOKE1g','zodiaks_sagittarius_woman_05.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (21,0,'Zodiaks-Sagittarius_woman_06.jpg','ZI5vucHa','zodiaks_sagittarius_woman_06.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (22,0,'Zodiaks-Sagittarius_woman_09.jpg','AIRJrTBm','zodiaks_sagittarius_woman_09.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (25,0,'_help_make_res_02.png','jhdZb7SD','_help_make_res_02.png',0,NULL);
INSERT INTO `z_uploads` VALUES (26,0,'romashki.jpg','9oFZgEYz','romashki.jpg',0,'');
INSERT INTO `z_uploads` VALUES (27,0,'_office_01.png','SmubXYZs','_office_01.png',0,'');
INSERT INTO `z_uploads` VALUES (28,0,'01_admin_add.png','Zed3JhTL','01_admin_add.png',0,'');
INSERT INTO `z_uploads` VALUES (29,0,'02_admin_update.png','Ka1GZ0Bc','02_admin_update.png',0,'');
INSERT INTO `z_uploads` VALUES (30,0,'03_admin_delete.png','fNAG37Mj','03_admin_delete.png',0,'');
INSERT INTO `z_uploads` VALUES (31,0,'04_admin_export.png','0pVtIcnC','04_admin_export.png',0,'');
INSERT INTO `z_uploads` VALUES (32,0,'05_admin_up.png','My69BUCV','05_admin_up.png',0,'');
INSERT INTO `z_uploads` VALUES (33,0,'06_admin_down.png','4YczE7o8','06_admin_down.png',0,'');
INSERT INTO `z_uploads` VALUES (34,0,'07_admin_left.png','BFYGyX5J','07_admin_left.png',0,'');
INSERT INTO `z_uploads` VALUES (35,0,'08_admin_right.png','kMUiCG9j','08_admin_right.png',0,'');
INSERT INTO `z_uploads` VALUES (36,0,'office.jpg','MSiaPTrd','office.jpg',0,'');
INSERT INTO `z_uploads` VALUES (37,0,'_help_make_res_01.png','5380HD1p','_help_make_res_01.png',0,'');
INSERT INTO `z_uploads` VALUES (38,0,'_help_make_res_02.png','MZj8pTcI','_help_make_res_02.png',0,'');
INSERT INTO `z_uploads` VALUES (39,0,'_help_make_res_03.png','y6mh5sK9','_help_make_res_03.png',0,'');
INSERT INTO `z_uploads` VALUES (40,0,'_help_make_res_04.png','7bZNfT0r','_help_make_res_04.png',0,'');
INSERT INTO `z_uploads` VALUES (41,0,'_help_make_res_05.png','doVYhlUS','_help_make_res_05.png',0,'');
INSERT INTO `z_uploads` VALUES (42,0,'_help_make_res_06.png','5j1at9dM','_help_make_res_06.png',0,'');
INSERT INTO `z_uploads` VALUES (43,0,'_help_make_res_issues_01.png','muDLOsF4','_help_make_res_issues_01.png',0,'');
INSERT INTO `z_uploads` VALUES (44,0,'_help_make_res_issues_02.png','1o5Fjf6r','_help_make_res_issues_02.png',0,'');
INSERT INTO `z_uploads` VALUES (45,0,'_help_make_issues_01.png','5nPKrAxO','_help_make_issues_01.png',0,'');
INSERT INTO `z_uploads` VALUES (46,0,'_help_make_issues_02.png','haepNH7b','_help_make_issues_02.png',0,'');
INSERT INTO `z_uploads` VALUES (47,0,'_help_make_res_issues_01.png','hjl6IcL1','_help_make_res_issues_01.png',0,'');
INSERT INTO `z_uploads` VALUES (48,0,'_help_make_pics_02.png','C2XfdeFJ','_help_make_pics_02.png',0,'');
INSERT INTO `z_uploads` VALUES (49,0,'_help_make_pics_03.png','sDFj0L2I','_help_make_pics_03.png',0,'');
INSERT INTO `z_uploads` VALUES (50,0,'_help_make_pics_01.png','fLBrmS6l','_help_make_pics_01.png',0,'');
INSERT INTO `z_uploads` VALUES (51,0,'_help_make_pics_04.png','xCzZLB3R','_help_make_pics_04.png',0,'');
INSERT INTO `z_uploads` VALUES (52,0,'_help_make_pics_05.png','9a7bVFmr','_help_make_pics_05.png',0,'');
INSERT INTO `z_uploads` VALUES (53,0,'_help_make_res_issues_01.png','JFToBNYd','_help_make_res_issues_01.png',0,'');
INSERT INTO `z_uploads` VALUES (54,0,'_help_make_trans_01.png','dMECjBvz','_help_make_trans_01.png',0,'');
INSERT INTO `z_uploads` VALUES (55,0,'_help_make_trans_02.png','H8gLYG2S','_help_make_trans_02.png',0,'');
INSERT INTO `z_uploads` VALUES (56,0,'_help_make_trans_03.png','MdOCPuUf','_help_make_trans_03.png',0,'');
INSERT INTO `z_uploads` VALUES (57,0,'_help_make_trans_04.png','E2oYUdMC','_help_make_trans_04.png',0,'');
INSERT INTO `z_uploads` VALUES (58,0,'_help_make_trans_05.png','BtDy4zPS','_help_make_trans_05.png',0,'');
INSERT INTO `z_uploads` VALUES (59,0,'_files_01.png','MZOL04mr','_files_01.png',0,'');
INSERT INTO `z_uploads` VALUES (60,0,'_files_02.png','vnxEMsr1','_files_02.png',0,'');
INSERT INTO `z_uploads` VALUES (61,0,'_files_03.png','eJLGsA58','_files_03.png',0,'');
INSERT INTO `z_uploads` VALUES (62,0,'FILTER_CHECKBOX.jpg','Sd3gpUsn','filter_checkbox.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (63,0,'FILTER_CHECKBOX_X.jpg','yiDeoSPg','filter_checkbox_x.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (64,0,'FILTER_COLOR.jpg','dZXAJFcm','filter_color.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (65,0,'FILTER_DATE.jpg','7pTFB4Ku','filter_date.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (66,0,'FILTER_DATETIME.jpg','kDNxJy2R','filter_datetime.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (67,0,'FILTER_DATE_RANGE.jpg','HBPsIhK1','filter_date_range.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (68,0,'FILTER_MONEY.jpg','f0AG7Bx3','filter_money.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (69,0,'FILTER_NUMBER.jpg','UGvdRxc0','filter_number.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (70,0,'FILTER_RANGE.jpg','8Rfpr6Xh','filter_range.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (71,0,'FILTER_SELECT2.jpg','ljg5xp4S','filter_select2.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (72,0,'FILTER_SLIDER.jpg','KLhFXVyU','filter_slider.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (73,0,'FILTER_SPIN.jpg','pgMcoKbZ','filter_spin.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (74,0,'FILTER_STAR.jpg','GS9aHIhz','filter_star.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (75,0,'FILTER_SWITCH.jpg','YJ79kXgd','filter_switch.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (76,0,'FILTER_TYPEAHEAD.jpg','yN1BHx3l','filter_typeahead.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (77,0,'FILTER_0_TEXT.jpg','I6x5ScRL','filter_0_text.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (78,0,'FILTER_0_SELECT.jpg','3k047HZO','filter_0_select.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (79,0,'09_admin_active.png','sANZGeML','09_admin_active.png',0,NULL);
INSERT INTO `z_uploads` VALUES (85,0,'admin_gridview_01_file_types.png','9cCOMe0l','admin_gridview_01_file_types.png',0,NULL);
INSERT INTO `z_uploads` VALUES (86,0,'admin_gridview_02_file_types.png','0JRHNFkc','admin_gridview_02_file_types.png',0,NULL);
INSERT INTO `z_uploads` VALUES (87,0,'admin_gridview_03_multi_uploads.png','HI2FhOlv','admin_gridview_03_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (88,0,'admin_gridview_04_multi_uploads.png','UNFaVnTg','admin_gridview_04_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (89,0,'admin_gridview_05_multi_uploads.png','kXptsNOj','admin_gridview_05_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (90,0,'admin_gridview_06_multi_uploads.png','z2yKuH8e','admin_gridview_06_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (91,0,'admin_gridview_07_multi_uploads.png','0eCdoDpj','admin_gridview_07_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (92,0,'admin_gridview_08_multi_uploads.png','vOeUuMHh','admin_gridview_08_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (93,0,'admin_gridview_09_multi_uploads.png','e8xa69In','admin_gridview_09_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (94,0,'admin_gridview_10_multi_uploads.png','6xJ3khmc','admin_gridview_10_multi_uploads.png',0,NULL);
INSERT INTO `z_uploads` VALUES (95,0,'gridview_01.png','TmGNKXrg','gridview_01.png',0,NULL);
INSERT INTO `z_uploads` VALUES (96,0,'gridview_02.png','xauhIdo4','gridview_02.png',0,NULL);
INSERT INTO `z_uploads` VALUES (97,0,'gridview_03.png','Vd1iz4MX','gridview_03.png',0,NULL);
INSERT INTO `z_uploads` VALUES (98,0,'gridview_04.png','skLV96I3','gridview_04.png',0,NULL);
INSERT INTO `z_uploads` VALUES (99,0,'gridview_05.png','3JesUf51','gridview_05.png',0,NULL);
INSERT INTO `z_uploads` VALUES (100,0,'gridview_06.png','hH3FPucl','gridview_06.png',0,NULL);
INSERT INTO `z_uploads` VALUES (101,0,'gridview_07.png','UdbR4smc','gridview_07.png',0,NULL);
INSERT INTO `z_uploads` VALUES (102,0,'gridview_08.png','VCYGr0fM','gridview_08.png',0,NULL);
INSERT INTO `z_uploads` VALUES (103,0,'chk_conn.txt','3slZXtMp','chk_conn.txt',0,NULL);
INSERT INTO `z_uploads` VALUES (104,0,'city_01.jpg','gKH8uYn9','city_01.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (105,0,'MyTracks-user-info.pdf','3ZX26VNF','mytracks_user_info.pdf',0,NULL);
INSERT INTO `z_uploads` VALUES (106,0,'chk_conn.txt','1oLb05tJ','chk_conn.txt',0,NULL);
INSERT INTO `z_uploads` VALUES (107,0,'city_01.jpg','tXSE6eka','city_01.jpg',0,NULL);
INSERT INTO `z_uploads` VALUES (108,0,'MyTracks-user-info.pdf','cA2PvyFb','mytracks_user_info.pdf',0,NULL);
/*!40000 ALTER TABLE `z_uploads` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-14 11:56:10
