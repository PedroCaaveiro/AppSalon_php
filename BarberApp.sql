-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: appsalon_mvc
-- ------------------------------------------------------
-- Server version	8.0.40

USE appsalon_mvc;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuarioID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioID_idx` (`usuarioID`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuarioID`) REFERENCES `usuarios` (`id`) ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'2025-04-04','17:02:00',21),(2,'2025-04-07','17:19:00',21),(5,'2025-04-09','10:16:00',21),(6,'2025-04-09','10:14:00',21),(7,'2025-04-14','11:24:00',21),(8,'2025-04-21','12:28:00',21),(10,'2025-04-15','11:30:00',21),(11,'2025-04-15','11:32:00',21),(12,'2025-04-28','11:40:00',21);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas_servicios`
--

DROP TABLE IF EXISTS `citas_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas_servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `citaID` int DEFAULT NULL,
  `servicioID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_citaID_idx` (`citaID`),
  KEY `FK_servicioID_idx` (`servicioID`),
  CONSTRAINT `citas_servicios_ibfk_1` FOREIGN KEY (`citaID`) REFERENCES `citas` (`id`) ON UPDATE SET NULL,
  CONSTRAINT `citas_servicios_ibfk_2` FOREIGN KEY (`servicioID`) REFERENCES `servicios` (`id`) ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas_servicios`
--

LOCK TABLES `citas_servicios` WRITE;
/*!40000 ALTER TABLE `citas_servicios` DISABLE KEYS */;
INSERT INTO `citas_servicios` VALUES (1,1,1),(2,2,3),(3,5,1),(4,6,1),(8,10,1),(9,11,1),(10,12,2);
/*!40000 ALTER TABLE `citas_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Corte de pelo hombre',15.00),(2,'Corte de pelo niño',10.00),(3,'Corte de pelo mujer',20.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(60)  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `telefono` varchar(9)  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(15)  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (21,'Pedro ','xxxxxx','correo@correo.com','$2y$10$/oBtHJQZtjBiaTsy.wWDQO/WKdStrCgAa6PoZPvaZ62iDUA5FSVby','618554433',1,1,'67e3eddac7140'),(22,'jose','pepito','admin@admin.com','$2y$10$MycaI5s29.9avVKzLVZ8auPQvYOvE..6r4B4RyH3xsPCcf8cnuezq','666777777',0,1,'NULL');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-16  8:11:14
