-- MySQL dump 10.13  Distrib 5.6.13, for osx10.8 (x86_64)
--
-- Host: localhost    Database: lattes
-- ------------------------------------------------------
-- Server version	5.6.13

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
-- Table structure for table `production`
--

DROP TABLE IF EXISTS `production`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `type` enum('Periódicos','Congresso','Capítulos de livros') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production`
--

LOCK TABLES `production` WRITE;
/*!40000 ALTER TABLE `production` DISABLE KEYS */;
/*!40000 ALTER TABLE `production` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production_has_teacher`
--

DROP TABLE IF EXISTS `production_has_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production_has_teacher` (
  `production_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`production_id`,`teacher_id`),
  KEY `fk_production_has_teacher_teacher1_idx` (`teacher_id`),
  KEY `fk_production_has_teacher_production1_idx` (`production_id`),
  CONSTRAINT `fk_production_has_teacher_production` FOREIGN KEY (`production_id`) REFERENCES `production` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_production_has_teacher_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production_has_teacher`
--

LOCK TABLES `production_has_teacher` WRITE;
/*!40000 ALTER TABLE `production_has_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `production_has_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qualis`
--

DROP TABLE IF EXISTS `qualis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qualis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isssn` varchar(9) NOT NULL,
  `title` varchar(20) NOT NULL,
  `extract` varchar(2) NOT NULL,
  `area` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualis`
--

LOCK TABLES `qualis` WRITE;
/*!40000 ALTER TABLE `qualis` DISABLE KEYS */;
/*!40000 ALTER TABLE `qualis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `lattes` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,'Camilo Cesar Perucci','http://lattes.cnpq.br/5812687200309236',NULL),(2,'Carlos Eduardo Liasch','http://lattes.cnpq.br/1155348824161559',NULL),(3,'Eduardo de Brito','http://lattes.cnpq.br/3929942929482246',NULL),(4,'Eric Augusto Paixão de Querioz','http://lattes.cnpq.br/1641964252508999',NULL),(5,'Erivelton Rodrigues Nunes','http://lattes.cnpq.br/6503269153478973',NULL),(6,'Fabiano Rodrigo da Silva Santos','http://lattes.cnpq.br/8841840830171267',NULL),(7,'Flávio Rubens Massaro Junior','http://lattes.cnpq.br/6581012116833368',NULL),(8,'Ivan José Lautenschleguer ','http://lattes.cnpq.br/0537601054260366',NULL),(9,'Lilian Saldanha Marroni','http://lattes.cnpq.br/4995205101828752',NULL),(10,'Marcelo Carlos Barbeli','http://lattes.cnpq.br/9182535209147578',NULL),(11,'Orlando Saraiva do Nascimento Junior','http://lattes.cnpq.br/5246678822563192',NULL),(12,'Pâmela Piovesan','http://lattes.cnpq.br/1376315663238484',NULL),(13,'Raphael Gava de Andrade','http://lattes.cnpq.br/1070291283812879',NULL),(14,'Renato Luciano Cagnin','http://lattes.cnpq.br/3864977515064821',NULL),(15,'Rogério Cardoso','http://lattes.cnpq.br/7580475626591643',NULL),(16,'Sergio Luis Antonello','http://lattes.cnpq.br/4034572067207920',NULL);
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titulation`
--

DROP TABLE IF EXISTS `titulation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titulation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('Especialização','Graduação','Mestrado','Doutorado','Pós-Doutorado') NOT NULL,
  `start` year(4) NOT NULL,
  `end` year(4) NOT NULL,
  `maximum` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_titulation_teacher_idx` (`teacher_id`),
  KEY `fk_titulation_titulation_idx` (`maximum`),
  CONSTRAINT `fk_titulation_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_titulation_titulation1` FOREIGN KEY (`maximum`) REFERENCES `titulation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titulation`
--

LOCK TABLES `titulation` WRITE;
/*!40000 ALTER TABLE `titulation` DISABLE KEYS */;
/*!40000 ALTER TABLE `titulation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-30 14:09:15
