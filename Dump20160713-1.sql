CREATE DATABASE  IF NOT EXISTS `poll_system_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `poll_system_db`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: poll_system_db
-- ------------------------------------------------------
-- Server version	5.7.12

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
-- Table structure for table `answer_submissions`
--

DROP TABLE IF EXISTS `answer_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer_submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `os` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `poll_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answer_submissions_answer_id_foreign` (`answer_id`),
  KEY `answer_submissions_poll_id_foreign` (`poll_id`),
  CONSTRAINT `answer_submissions_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `questions_answers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answer_submissions_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer_submissions`
--

LOCK TABLES `answer_submissions` WRITE;
/*!40000 ALTER TABLE `answer_submissions` DISABLE KEYS */;
INSERT INTO `answer_submissions` VALUES (1,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',2,1,'2016-07-11 06:34:35','2016-07-13 06:34:35'),(2,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',8,2,'2016-07-12 20:35:05','2016-07-13 06:35:05'),(3,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',11,3,'2016-07-10 06:35:11','2016-07-13 06:35:11'),(4,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',2,1,'2016-07-11 09:35:25','2016-07-13 06:35:25'),(5,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',3,1,'2016-07-13 06:35:32','2016-07-13 06:35:32'),(6,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',4,1,'2016-07-13 08:35:35','2016-07-13 06:35:35'),(7,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',2,1,'2016-07-12 06:35:39','2016-07-13 06:35:39'),(8,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',3,1,'2016-07-09 16:35:45','2016-07-13 06:35:45'),(9,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',2,1,'2016-07-10 06:35:49','2016-07-13 06:35:49'),(10,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',6,2,'2016-07-11 06:35:54','2016-07-13 06:35:54'),(11,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',7,2,'2016-07-13 06:36:00','2016-07-13 06:36:00'),(12,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',6,2,'2016-07-13 06:36:04','2016-07-13 06:36:04'),(13,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',7,2,'2016-07-10 06:36:07','2016-07-13 06:36:07'),(14,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',8,2,'2016-07-13 06:36:10','2016-07-13 06:36:10'),(15,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',7,2,'2016-07-10 06:36:15','2016-07-13 06:36:15'),(16,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',7,2,'2016-07-13 06:36:18','2016-07-13 06:36:18'),(17,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',4,1,'2016-07-12 06:36:23','2016-07-12 06:36:23'),(18,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',7,2,'2016-07-13 06:36:26','2016-07-13 06:36:26'),(19,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',4,1,'2016-07-13 06:36:38','2016-07-13 06:36:38'),(20,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',8,2,'2016-07-13 06:36:44','2016-07-13 06:36:44'),(21,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',8,2,'2016-07-15 06:36:50','2016-07-13 06:36:50'),(22,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',2,1,'2016-07-11 06:36:54','2016-07-13 06:36:54'),(23,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',2,1,'2016-07-14 06:37:00','2016-07-13 06:37:00'),(24,'192.168.5.1','a37c34e873a51ce7ff7cb7674f06638f3313d7c4','Firefox','Linux',6,2,'2016-07-10 06:37:05','2016-07-13 06:37:05');
/*!40000 ALTER TABLE `answer_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_06_29_124623_create_polls_table',1),('2016_07_11_111801_create_questions_answers_table',1),('2016_07_11_114132_create_answers_submissions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `is_open` tinyint(1) NOT NULL,
  `user_can_see_results` tinyint(1) NOT NULL,
  `total_poll_submissions` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `polls_user_id_foreign` (`user_id`),
  CONSTRAINT `polls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polls`
--

LOCK TABLES `polls` WRITE;
/*!40000 ALTER TABLE `polls` DISABLE KEYS */;
INSERT INTO `polls` VALUES (1,1,'Ronaldo vs Messi','2016-07-20 02:00:00',1,1,11,'2016-07-13 06:33:02','2016-07-13 06:37:00'),(2,1,'Messi retire',NULL,1,1,12,'2016-07-13 06:33:16','2016-07-13 06:37:05'),(3,1,'Brexit',NULL,1,0,1,'2016-07-13 06:33:43','2016-07-13 06:35:11'),(4,1,'t',NULL,0,0,0,'2016-07-13 06:33:57','2016-07-13 06:33:59');
/*!40000 ALTER TABLE `polls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions_answers`
--

DROP TABLE IF EXISTS `questions_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `poll_id` int(10) unsigned NOT NULL,
  `priority` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `submissions_counter` int(11) NOT NULL DEFAULT '0',
  `id_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_answers_poll_id_foreign` (`poll_id`),
  CONSTRAINT `questions_answers_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions_answers`
--

LOCK TABLES `questions_answers` WRITE;
/*!40000 ALTER TABLE `questions_answers` DISABLE KEYS */;
INSERT INTO `questions_answers` VALUES (1,'q',1,0,NULL,'Is Ronaldo Cr bettern than Messi?',0,'/1/','2016-07-13 06:33:02','2016-07-13 06:33:02'),(2,'a',1,0,1,'Yes',6,'/1/2/','2016-07-13 06:33:02','2016-07-13 06:37:00'),(3,'a',1,1,1,'No',2,'/1/3/','2016-07-13 06:33:02','2016-07-13 06:35:45'),(4,'a',1,2,1,'Who are they?',3,'/1/4/','2016-07-13 06:33:02','2016-07-13 06:36:38'),(5,'q',2,0,NULL,'Should Messi retire?',0,'/5/','2016-07-13 06:33:16','2016-07-13 06:33:16'),(6,'a',2,0,5,'Yes',3,'/5/6/','2016-07-13 06:33:16','2016-07-13 06:37:05'),(7,'a',2,1,5,'No',5,'/5/7/','2016-07-13 06:33:16','2016-07-13 06:36:26'),(8,'a',2,2,5,'Who is Messi?',4,'/5/8/','2016-07-13 06:33:16','2016-07-13 06:36:50'),(9,'q',3,0,NULL,'Should Britain vote to leave EU?',0,'/9/','2016-07-13 06:33:43','2016-07-13 06:33:43'),(10,'a',3,0,9,'Yes',0,'/9/10/','2016-07-13 06:33:43','2016-07-13 06:33:43'),(11,'a',3,1,9,'No',1,'/9/11/','2016-07-13 06:33:43','2016-07-13 06:35:11'),(12,'a',3,2,9,'Maybe Yes',0,'/9/12/','2016-07-13 06:33:43','2016-07-13 06:33:43'),(13,'a',3,3,9,'Maybe No',0,'/9/13/','2016-07-13 06:33:43','2016-07-13 06:33:43'),(14,'q',4,0,NULL,'q',0,'/14/','2016-07-13 06:33:57','2016-07-13 06:33:57'),(15,'a',4,0,14,'a1',0,'/14/15/','2016-07-13 06:33:57','2016-07-13 06:33:57'),(16,'a',4,1,14,'a2',0,'/14/16/','2016-07-13 06:33:57','2016-07-13 06:33:57'),(18,'a',4,3,14,'a4',0,'/14/18/','2016-07-13 06:33:57','2016-07-13 06:33:57');
/*!40000 ALTER TABLE `questions_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'efthimis','e.zeinis@darkpony.com','$2y$10$DamtJKk2TGsnbB7ArzoNLuvLxgXLZdkkr8txNM0Ln7p.NyNdqOveS',NULL,'2016-07-13 06:32:35','2016-07-13 06:32:35');
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

-- Dump completed on 2016-07-13  9:46:28
