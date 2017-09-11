-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: quiz
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` smallint(3) unsigned NOT NULL,
  `title` varchar(512) NOT NULL DEFAULT '',
  `status` enum('pending','progress','done') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `fk_questions_1_idx` (`quiz_id`),
  CONSTRAINT `fk_questions_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Quiz questions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'Which of the following statement is valid to use a Node module http in a Node based application?','pending'),(2,1,'Which of the following is true about File I/O in Node applications?','pending'),(3,1,'6 - Is process a global object?&#13;&#10;&#13;&#10;','pending'),(4,1,'Which of the following module is required for exception handling in Node?&#13;&#10;&#13;&#10;','pending'),(5,1,'Duplex stream can be used for both read and write operation.','pending'),(6,2,'Is the framework sufficient for developing distributed systems?','pending'),(7,2,'Business is cruel ... The faster the project will see the light or will be updated - then more satisfied your customers will be ... But you understand that quality - and speed are not compatible?&#13;&#10;Isn&#39;t it ?','pending'),(8,2,'What do you want from the developer?','pending'),(9,2,'Why are you still making your system?','pending'),(10,2,'What do you think ? Do I have an opinion on the details in the project?','pending');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quizzes` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `description` varchar(512) NOT NULL DEFAULT '',
  `status` enum('pending','progress','done') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Quizzes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (1,'Node.js Online Quiz','Following quiz providesChoice Questions (CQs) related to Node.js Framework. You will have to read all the given answers and click over the correct answer. If you are not sure about the answer then you can check the answer using Show Answer button. You can use Next Quiz button to check new set of questions in the quiz.','pending'),(2,'Quiz for owner','There are a few questions on personal opinion regarding to the Development as a whole','pending');
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score`
--

DROP TABLE IF EXISTS `score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score` (
  `quiz_id` smallint(3) unsigned NOT NULL,
  `question_id` smallint(5) unsigned NOT NULL,
  `answer` tinyint(1) unsigned NOT NULL,
  `status` enum('ok','fail') NOT NULL,
  PRIMARY KEY (`quiz_id`,`question_id`),
  KEY `fk_quiz_1_idx` (`quiz_id`),
  KEY `fk_question_1_idx` (`question_id`),
  CONSTRAINT `fk_questions` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Quiz score table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score`
--

LOCK TABLES `score` WRITE;
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
/*!40000 ALTER TABLE `score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variants`
--

DROP TABLE IF EXISTS `variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variants` (
  `id` int(10) unsigned NOT NULL,
  `question_id` smallint(5) unsigned NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `right` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`question_id`),
  KEY `fk_variants_1_idx` (`question_id`),
  CONSTRAINT `fk_variants_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Questions variants';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variants`
--

LOCK TABLES `variants` WRITE;
/*!40000 ALTER TABLE `variants` DISABLE KEYS */;
INSERT INTO `variants` VALUES (0,1,'var http = require(&#34;http&#34;);','1'),(0,2,'Node File System (fs) module should be imported for File I/O opearations.','0'),(0,3,'true','1'),(0,4,'web module','0'),(0,5,'true','1'),(0,6,'yes','0'),(0,7,'Yes it is','1'),(0,8,'Quality','0'),(0,9,'Developers has not high-level - they are blamed for everything','0'),(0,10,'Yes','0'),(1,1,'var http = import(&#34;http&#34;);','0'),(1,2,'Node implements File I/O using simple wrappers around standard POSIX functions.','0'),(1,3,'false','0'),(1,4,'net module','0'),(1,5,'false','0'),(1,6,'no','1'),(1,7,'Not it is not','0'),(1,8,'Speed','0'),(1,9,'Do you have a new ideas for support ?','0'),(1,10,'No','0'),(2,1,'package http;','0'),(2,2,'Both of the above','0'),(2,4,'domain module','0'),(2,8,'Both of above','1'),(2,9,'Something holding on the project... Maybe - this is the fault of the company','1'),(2,10,'I am as an expert, often disagree with the opinion of the owner','1'),(3,1,'import http;','0'),(3,2,'None of the above','1'),(3,4,'error module','1');
/*!40000 ALTER TABLE `variants` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-11 16:42:33
