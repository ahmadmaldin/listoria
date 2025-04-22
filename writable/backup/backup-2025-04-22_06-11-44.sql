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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment`
--

LOCK TABLES `attachment` WRITE;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
INSERT INTO `attachment` VALUES (1,1,'photo',NULL,NULL,'apayaaa\r\n'),(2,2,'link',NULL,NULL,'12345678'),(4,1,'photo',NULL,NULL,'xfyhtg'),(5,NULL,'file',NULL,'uploads/attachment/1745260886_5c3638bf397c54e1fd88.docx',NULL),(6,NULL,'file',NULL,'uploads/attachment/1745287416_fbe1996f05ede4a0955a.accdb',NULL),(7,NULL,'file',NULL,'uploads/attachment/1745287946_93bbcb2834fba95caa12.docx',NULL),(8,16,'photo',NULL,'1745289372_12e4a41710f27446d625.jpg','w12we12');
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friendships`
--

DROP TABLE IF EXISTS `friendships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friendships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` enum('pending','accepted','declined') DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friendships`
--

LOCK TABLES `friendships` WRITE;
/*!40000 ALTER TABLE `friendships` DISABLE KEYS */;
/*!40000 ALTER TABLE `friendships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupmembers`
--

DROP TABLE IF EXISTS `groupmembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupmembers` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_groups` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupmembers`
--

LOCK TABLES `groupmembers` WRITE;
/*!40000 ALTER TABLE `groupmembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `groupmembers` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'nyeri beteng',1,'2025-04-16 08:29:44','1744776822_bf166642ff662b0efc0f.jpg','$2y$10$TK2Df9XPJ5AuIpenJjz6DOXjHJ0j0LO5JoL3DKw.JGJ/320mViGfa','privatt in public'),(2,'kentangg',3,'2025-04-16 09:02:09','1744854394_12fff5261e47f0de124f.png','$2y$10$I/vLN2OCnSJBMxhyyjOTqe0IkJUPAufLPrnGWBmgMJc2YMMm5XoRm','q2c4 ft'),(4,'indihome',2,'2025-04-16 10:35:39','1744776881_442c618916e79b42027f.png','$2y$10$PCYQ/khvll.hTpkaua3bhe13IOV7PWnmlEjvNkqCAz3/taDH0vhDy','apaajainimah'),(6,'bakteri',1,'2025-04-17 08:39:03','1744854381_ed7763d492b4a57c61ec.png','$2y$10$IwS2jfsTDuV7xF.GAYbGauwiTl63EYyYxhfVkxhx05OHMogQ6U4G2','rwghtrj6utlk'),(7,'apaaja',4,'2025-04-22 00:16:33','1745255793_35cb54c4aeb7aab7cd82.jpg','$2y$10$qXJHzVXKE2DMUX944oxVS.BJh5SPyl.IvTNVIUO9xE0L4bwbViLbu','gtau ');
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
  `id_groups` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_level` enum('admin','anggota') DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  KEY `id_groups` (`id_groups`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`id_groups`) REFERENCES `groups` (`id_groups`),
  CONSTRAINT `member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (3,1,2,'admin'),(4,1,3,'admin'),(8,6,5,'admin');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shared`
--

DROP TABLE IF EXISTS `shared`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shared` (
  `id_shared` int(11) NOT NULL AUTO_INCREMENT,
  `id_tugas` int(11) NOT NULL,
  `shared_type` int(11) NOT NULL,
  `shared_to` int(11) NOT NULL,
  `shared_by` int(11) NOT NULL,
  `accepted` enum('shared','todo','ongoing','done','canceled') DEFAULT NULL,
  `share_date` datetime DEFAULT NULL,
  `accept_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_shared`),
  UNIQUE KEY `idx_shared_info` (`id_tugas`,`shared_to`,`shared_by`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shared`
--

LOCK TABLES `shared` WRITE;
/*!40000 ALTER TABLE `shared` DISABLE KEYS */;
INSERT INTO `shared` VALUES (1,8,1,4,2,'shared','2025-04-21 16:58:30',NULL),(3,8,2,2,2,'shared','2025-04-21 17:05:51',NULL),(4,8,2,1,2,'shared','2025-04-21 17:05:58',NULL),(5,19,0,0,4,NULL,NULL,'2025-04-21 17:13:29'),(6,21,0,0,2,NULL,NULL,'2025-04-21 19:06:32'),(7,22,0,0,2,NULL,NULL,'2025-04-22 05:59:03'),(8,26,0,2,2,'todo',NULL,NULL);
/*!40000 ALTER TABLE `shared` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tugas`
--

DROP TABLE IF EXISTS `tugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tugas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tugas` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `status` enum('to do','berjalan','selesai','batal') NOT NULL,
  `alarm` enum('yes','no') NOT NULL,
  `date_due` date NOT NULL,
  `time_due` time(6) DEFAULT NULL,
  `date_finished` date DEFAULT NULL,
  `time_finished` time(6) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tugas`
--

LOCK TABLES `tugas` WRITE;
/*!40000 ALTER TABLE `tugas` DISABLE KEYS */;
INSERT INTO `tugas` VALUES (7,'belajar','2025-04-15','09:09:00','to do','yes','2025-04-18','15:03:00.000000','2025-04-15','05:09:00.000000',11,0),(8,'tidur siang','2025-04-23','21:24:00','','yes','2025-04-18','09:44:00.000000','2025-04-18','10:45:00.000000',NULL,0),(11,'bertemu ayang ojos','2025-04-18','14:30:00','to do','yes','2025-04-18','14:31:00.000000','2025-04-17','14:31:00.000000',NULL,0),(12,'ngaji asar','2025-04-18','16:00:00','to do','yes','2025-04-18','16:03:00.000000','2025-04-18','18:29:00.000000',NULL,0),(13,'go eat','2025-04-19','03:06:00','to do','yes','2025-04-19','13:54:00.000000','2025-04-19','03:35:00.000000',5,0),(14,'breafing','2025-04-18','21:00:00','to do','yes','2025-04-18','22:22:00.000000','2025-04-18','14:22:00.000000',4,0),(15,'ee','2025-04-18','15:00:00','to do','yes','2025-04-18','15:04:00.000000','2025-04-18','15:01:00.000000',11,0),(16,' dreaming','2025-04-19','13:00:00','to do','yes','2025-04-19','12:47:00.000000',NULL,NULL,2,0),(19,'tidurrrr','2025-04-22','02:15:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0),(20,'mandiii','2025-04-22','03:04:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0),(21,'mandiii','2025-04-22','03:04:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0),(22,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0),(23,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0),(24,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0),(25,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0),(26,'backup db plus delete di pc','2025-04-22','12:57:00','to do','yes','0000-00-00',NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `tugas` ENABLE KEYS */;
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
INSERT INTO `user` VALUES (2,'cecep','$2y$10$7ZTN17tMu9onZZUL85UWWO.J1G58XdDNAbyL9l02SVWMwwOHbP0H6','user','1745302032_aba1a66eefdbe99622eb.jpg'),(3,'nidia','$2y$10$2qyeWcW1Y22sKc/C/josieGxbxg1I0.jTH3ycybQxACEyPNtrWCRG','user','1744771868_28bc2e2a3b807748a4c7.jpg'),(4,'intan','$2y$10$97boWCc4VxasUL2vqajiXewq5ooNv.EWOln/kAic2GzX/hcH8Ipoe','admin','1744771897_5a979de6f9bb60c25966.png'),(5,'nura','$2y$10$2gP90FSuiOy5s8qADv81jueAC/9emNfp88Bvgpu8Eu.0xsZVirBna','user','1744853870_660861aab21cd524943c.png');
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

-- Dump completed on 2025-04-22 13:11:44
