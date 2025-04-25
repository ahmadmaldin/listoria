-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: todo1
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment` (
  `id_attachment` int(11) NOT NULL AUTO_INCREMENT,
  `id_tugas` int(11) DEFAULT NULL,
  `type` enum('file','photo','link','maps') DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id_attachment`),
  KEY `id_task` (`id_tugas`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment`
--

LOCK TABLES `attachment` WRITE;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
INSERT INTO `attachment` VALUES (1,1,'photo',NULL,NULL,'apayaaa\r\n'),(2,2,'link',NULL,NULL,'12345678'),(4,1,'photo',NULL,NULL,'xfyhtg'),(5,NULL,'file',NULL,'uploads/attachment/1745260886_5c3638bf397c54e1fd88.docx',NULL),(6,NULL,'file',NULL,'uploads/attachment/1745287416_fbe1996f05ede4a0955a.accdb',NULL),(7,NULL,'file',NULL,'uploads/attachment/1745287946_93bbcb2834fba95caa12.docx',NULL),(8,16,'photo',NULL,'1745289372_12e4a41710f27446d625.jpg','w12we12'),(9,16,'photo',NULL,'1745303632_e18599c51276700c635b.jpg','coba coba'),(10,16,'photo',NULL,'1745308349_ae965b3794123b6fd9da.jpg','qqqqq'),(11,2,'photo',NULL,'1745375536_0aa5f55460fd39494ae5.jpg','qwq'),(12,1,'photo',NULL,'1745378226_ebed11cc060c1dba3acf.jpg','dwef'),(13,5,'photo',NULL,'1745378352_fd954fd04e81b38718aa.jpg','hahahaha'),(14,2,'photo',NULL,'1745378692_e22ec523ae897958c4c3.jpg','wee'),(15,3,'photo',NULL,'1745380049_95763e49c841f44acc48.jpg','wrywe'),(16,11,'photo',NULL,'1745429245_74ba324baeec8c7a9d67.jpg','qqq'),(17,6,'photo',NULL,'1745485517_f1945cf570512da565e9.jpg','wwww'),(18,3,'photo',NULL,'1745489221_ba1d4ec99c3253acab26.jpg','');
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friendship`
--

DROP TABLE IF EXISTS `friendship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friendship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_friend` int(11) NOT NULL,
  `status` enum('pending','accepted','declined') DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friendship`
--

LOCK TABLES `friendship` WRITE;
/*!40000 ALTER TABLE `friendship` DISABLE KEYS */;
INSERT INTO `friendship` VALUES (19,2,3,'accepted'),(20,2,4,'pending'),(21,2,5,'accepted'),(22,5,3,'accepted'),(23,5,4,'pending');
/*!40000 ALTER TABLE `friendship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id_groups` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `photo` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id_groups`),
  KEY `created_by` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'nyeri beteng',1,'2025-04-16 08:29:44','1744776822_bf166642ff662b0efc0f.jpg','$2y$10$TK2Df9XPJ5AuIpenJjz6DOXjHJ0j0LO5JoL3DKw.JGJ/320mViGfa','privatt in public'),(2,'kentangg',3,'2025-04-16 09:02:09','1744854394_12fff5261e47f0de124f.png','$2y$10$I/vLN2OCnSJBMxhyyjOTqe0IkJUPAufLPrnGWBmgMJc2YMMm5XoRm','q2c4 ft'),(6,'bakteri',1,'2025-04-17 08:39:03','1744854381_ed7763d492b4a57c61ec.png','$2y$10$IwS2jfsTDuV7xF.GAYbGauwiTl63EYyYxhfVkxhx05OHMogQ6U4G2','rwghtrj6utlk'),(7,'apaaja',4,'2025-04-22 00:16:33','1745255793_35cb54c4aeb7aab7cd82.jpg','$2y$10$qXJHzVXKE2DMUX944oxVS.BJh5SPyl.IvTNVIUO9xE0L4bwbViLbu','gtau '),(8,'bakteri',2,'2025-04-22 14:20:57','1745306457_38746398371328111312.jpg','$2y$10$xbjP.X92J.5hNiP/jhcQgOF/RiP8Qwt/6WgUkTy6IVRyCbH56Elq.','jhjihsdhjujhsdhj'),(9,'diamond',2,'2025-04-22 14:43:31','1745307811_20bff453f03758548bae.jpg','$2y$10$7yf6OF5Oyg3XXHLEzRwzi.rYS9gFp1V7dvfDeqTVDEB7yOmfpWWRm','apapapap'),(10,'ujikom',2,'2025-04-25 09:22:08','1745547728_2b849a7c32d7c98903f9.png','$2y$10$fh1.WvcCK4SPirMTrITTXOqSoRsx07aYvc7fArZzn.IpZtPjwpVVO','buatt besokk gess'),(11,'glowpunk',3,'2025-04-25 15:34:06','1745570045_6a4b8eb6fe748cd14313.png','$2y$10$89wo8r/5bL8JRCfe27kOrObgs.VzoI3bcHszHJJWBZ7twWoencYzC','ciwi ciwi gemess dan sholehah');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `id_groups` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_level` enum('admin','anggota') DEFAULT 'anggota',
  PRIMARY KEY (`id_member`),
  KEY `id_groups` (`id_groups`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`id_groups`) REFERENCES `groups` (`id_groups`) ON DELETE CASCADE,
  CONSTRAINT `member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,11,2,'anggota');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member1`
--

DROP TABLE IF EXISTS `member1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member1` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `id_groups` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_level` enum('admin','anggota') DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  KEY `id_groups` (`id_groups`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `member1_ibfk_1` FOREIGN KEY (`id_groups`) REFERENCES `groups` (`id_groups`),
  CONSTRAINT `member1_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member1`
--

LOCK TABLES `member1` WRITE;
/*!40000 ALTER TABLE `member1` DISABLE KEYS */;
INSERT INTO `member1` VALUES (3,1,2,'admin'),(4,1,3,'admin'),(8,6,5,'admin'),(9,8,3,'anggota'),(10,8,4,'anggota'),(11,7,3,'anggota'),(12,7,5,'anggota');
/*!40000 ALTER TABLE `member1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shared`
--

DROP TABLE IF EXISTS `shared`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shared` (
  `id_shared` int(11) NOT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `shared_by_user_id` int(11) DEFAULT NULL,
  `accepted` enum('yes','no','pending') DEFAULT 'pending',
  `share_date` datetime DEFAULT current_timestamp(),
  `accept_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shared`
--

LOCK TABLES `shared` WRITE;
/*!40000 ALTER TABLE `shared` DISABLE KEYS */;
INSERT INTO `shared` VALUES (0,5,2,5,'pending','2025-04-25 01:42:54',NULL),(0,12,2,2,'pending','2025-04-25 07:18:25',NULL),(0,15,2,2,'pending','2025-04-25 07:49:24',NULL),(0,15,2,2,'pending','2025-04-25 07:53:30',NULL),(0,15,NULL,2,'pending','2025-04-25 08:20:46',NULL),(0,15,NULL,2,'pending','2025-04-25 08:21:27',NULL),(0,5,NULL,5,'pending','2025-04-25 08:21:56',NULL),(0,16,NULL,3,'pending','2025-04-25 08:24:52',NULL),(0,5,NULL,5,'pending','2025-04-25 08:26:28',NULL),(0,17,NULL,5,'pending','2025-04-25 08:31:18',NULL),(0,17,NULL,5,'pending','2025-04-25 08:31:24',NULL);
/*!40000 ALTER TABLE `shared` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shared1`
--

DROP TABLE IF EXISTS `shared1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shared1` (
  `id_shared` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `shared_type` int(11) NOT NULL,
  `shared_to` int(11) NOT NULL,
  `shared_by` int(11) NOT NULL,
  `accepted` enum('shared','todo','ongoing','done','canceled') DEFAULT NULL,
  `share_date` datetime DEFAULT NULL,
  `accept_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shared1`
--

LOCK TABLES `shared1` WRITE;
/*!40000 ALTER TABLE `shared1` DISABLE KEYS */;
/*!40000 ALTER TABLE `shared1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tugas`
--

DROP TABLE IF EXISTS `tugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tugas` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `status` enum('todo','berjalan','selesai','batal') DEFAULT 'todo',
  `alarm` enum('yes','no') DEFAULT 'no',
  `date_due` date DEFAULT NULL,
  `time_due` time DEFAULT NULL,
  `date_finished` date DEFAULT NULL,
  `time_finished` time DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id_user`),
  CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tugas`
--

LOCK TABLES `tugas` WRITE;
/*!40000 ALTER TABLE `tugas` DISABLE KEYS */;
INSERT INTO `tugas` VALUES (4,'belajar','2025-04-23','09:46:00','selesai','yes','2025-04-26','09:46:00',NULL,NULL,4,NULL),(5,'mupponnn','2025-04-23','10:18:00','selesai','yes','2025-04-23','10:18:00',NULL,NULL,5,NULL),(15,'ujikom','2025-04-25','14:47:00','berjalan','yes','2025-04-26','14:47:00',NULL,NULL,2,NULL),(16,'backup db plus delete di pc','2025-04-25','15:24:00','selesai','yes','2025-04-19','17:26:00',NULL,NULL,3,NULL),(17,'utbk 2025','2025-04-29','07:30:00','',NULL,NULL,NULL,NULL,NULL,5,NULL);
/*!40000 ALTER TABLE `tugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tugas1`
--

DROP TABLE IF EXISTS `tugas1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tugas1` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tugas` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `status` enum('to do','berjalan','selesai','batal') NOT NULL,
  `alarm` enum('yes','no') NOT NULL,
  `date_due` date NOT NULL,
  `time_due` time(6) NOT NULL,
  `date_finished` date NOT NULL,
  `time_finished` time(6) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tugas1`
--

LOCK TABLES `tugas1` WRITE;
/*!40000 ALTER TABLE `tugas1` DISABLE KEYS */;
INSERT INTO `tugas1` VALUES (7,'belajar','2025-04-15','09:09:00','to do','yes','2025-04-18','15:03:00.000000','2025-04-15','05:09:00.000000',11,0),(8,'tidur siang','2025-04-23','21:24:00','','yes','2025-04-18','09:44:00.000000','2025-04-18','10:45:00.000000',0,0),(11,'bertemu ayang ojos','2025-04-18','14:30:00','to do','yes','2025-04-18','14:31:00.000000','2025-04-17','14:31:00.000000',0,0),(12,'ngaji asar','2025-04-18','16:00:00','to do','yes','2025-04-18','16:03:00.000000','2025-04-18','18:29:00.000000',0,0),(13,'go eat','2025-04-19','03:06:00','to do','yes','2025-04-19','13:54:00.000000','2025-04-19','03:35:00.000000',5,0),(14,'breafing','2025-04-18','21:00:00','to do','yes','2025-04-18','22:22:00.000000','2025-04-18','14:22:00.000000',4,0),(15,'ee','2025-04-18','15:00:00','to do','yes','2025-04-18','15:04:00.000000','2025-04-18','15:01:00.000000',11,0),(16,' dreaming','2025-04-23','21:00:00','to do','yes','2025-04-19','12:47:00.000000','0000-00-00','00:00:00.000000',2,0),(19,'tidurrrr','2025-04-22','02:15:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(20,'mandiii','2025-04-22','03:04:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(21,'mandiii','2025-04-22','03:04:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(22,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(23,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(24,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(25,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(26,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(27,'backup db plus delete di pc','2025-04-22','14:19:00','selesai','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(28,'ujikom','2025-04-26','08:15:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(29,'ujikom','2025-04-26','08:15:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(30,'ujikom','2025-04-30','07:15:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(31,'ujikom','2025-04-30','07:15:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(32,'ujikom','2025-04-26','07:15:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(33,'ujikom','2025-04-26','07:15:00','to do','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0),(34,'kfyufhvo8t68bhyu','2025-04-23','08:45:00','berjalan','yes','0000-00-00','00:00:00.000000','0000-00-00','00:00:00.000000',0,0);
/*!40000 ALTER TABLE `tugas1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') DEFAULT 'user',
  `photo` text DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'intania','$2y$10$7ZTN17tMu9onZZUL85UWWO.J1G58XdDNAbyL9l02SVWMwwOHbP0H6','user','1745304711_1ae2a6d43da85b4c264c.jpg'),(3,'nidia','$2y$10$2qyeWcW1Y22sKc/C/josieGxbxg1I0.jTH3ycybQxACEyPNtrWCRG','user','1745304914_feb990361afb6c2b9c4c.png'),(4,'intan','$2y$10$97boWCc4VxasUL2vqajiXewq5ooNv.EWOln/kAic2GzX/hcH8Ipoe','admin','1745304902_9c442e59f01ca2c74346.png'),(5,'nura','$2y$10$2gP90FSuiOy5s8qADv81jueAC/9emNfp88Bvgpu8Eu.0xsZVirBna','user','1745304880_0c91ca8cdd7a0d5361c3.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-25 15:35:00
