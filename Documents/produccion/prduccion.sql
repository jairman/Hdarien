CREATE DATABASE  IF NOT EXISTS `adminid` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `adminid`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: adminid
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `d89xz_ficha_tecnica`
--

DROP TABLE IF EXISTS `d89xz_ficha_tecnica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_ficha_tecnica` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'llave priemaria',
  `consecutivo` int(11) NOT NULL DEFAULT '0' COMMENT 'consecutivo orden del proceso calculado por el sistema',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del proceso',
  `descripcion` text NOT NULL COMMENT 'descripcion del preceso',
  `fecha_creacion` date NOT NULL COMMENT 'fecha de creacion de la ficha tecnica',
  `referencia` varchar(45) NOT NULL COMMENT 'refrencia campo que dihgita el usuario',
  `alternativa` varchar(45) NOT NULL COMMENT 'campo opcional',
  `n_piezas` varchar(45) NOT NULL,
  `tiempo_ciclo` varchar(45) NOT NULL COMMENT 'tiempo de duracion del proceso',
  `delete` tinyint(1) NOT NULL COMMENT 'campo indica eliminacion de la ficha tecnica',
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'fecha de creacion del proceso',
  `actualizado` varchar(45) NOT NULL COMMENT 'fecha en la cual s emodifica la actividad\n',
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1 COMMENT='Informacion general de la ficha tecnica de un producto tabla principal\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_ficha_tecnica`
--

LOCK TABLES `d89xz_ficha_tecnica` WRITE;
/*!40000 ALTER TABLE `d89xz_ficha_tecnica` DISABLE KEYS */;
INSERT INTO `d89xz_ficha_tecnica` VALUES (32,2,'camisa europea',' esta es una descripcion','2014-09-01','fref001','es opcional','campo','nombre',0,'2014-09-24 18:41:47','','',''),(31,3,'Billetera','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(33,4,'Calsetin','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(34,5,'zapato','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(35,6,'tenis','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(36,7,'reloj','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(37,8,'botones','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(38,19,'camisas','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(39,20,'abrigo',' esta es una descripcion','2014-09-01','fref001','es opcional','campo','nombre',0,'2014-09-24 18:41:47','','',''),(40,3,'corbata','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(41,4,'camizilla','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(42,5,'gorra','descripcion','2014-09-03','ref','','','',6,'2014-09-24 18:41:47','','',''),(43,6,'bufanda','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(44,7,'boxer','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(45,8,'botonepantalonetass','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(46,19,'sudaderas','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(47,0,'tacones','descripcion','2014-09-03','ref','','','',0,'2014-09-24 18:41:47','','',''),(48,19,'blusas','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(49,19,'brazier','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(50,19,'cacheteros','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(51,19,'hilo','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(52,19,'legüis','descripcion','2014-09-03','ref','','','',2,'2014-09-24 18:41:47','','',''),(53,0,'dfd','','0000-00-00','','','','',0,'2014-09-24 18:41:47','','',''),(54,0,'dfd','','0000-00-00','','','','',0,'2014-09-24 18:41:47','','',''),(55,0,'dfd','','0000-00-00','','','','',0,'2014-09-24 18:41:47','','',''),(56,0,'dfd','','0000-00-00','','','','',0,'2014-09-24 18:41:47','','',''),(57,0,'dfd','','0000-00-00','','','','',0,'2014-09-24 18:41:47','','','');
/*!40000 ALTER TABLE `d89xz_ficha_tecnica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_matriz_disenio`
--

DROP TABLE IF EXISTS `d89xz_matriz_disenio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_matriz_disenio` (
  `id` int(11) NOT NULL,
  `id_insumo_ficha` int(11) NOT NULL COMMENT 'insumo que se le agrega el color',
  `id_color` varchar(45) NOT NULL COMMENT 'color que   se le asiga a la ficha',
  `actualizado` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='informacion de la tabla de colores en un producto de tipo textil par acada tela';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_matriz_disenio`
--

LOCK TABLES `d89xz_matriz_disenio` WRITE;
/*!40000 ALTER TABLE `d89xz_matriz_disenio` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_matriz_disenio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_color_ficha`
--

DROP TABLE IF EXISTS `d89xz_color_ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_color_ficha` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `codigo_color` varchar(45) NOT NULL COMMENT 'hexadecimal del color',
  `delete` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actualizado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Colores registrados por el user para la matriz de diseño o de colores en productos textiles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_color_ficha`
--

LOCK TABLES `d89xz_color_ficha` WRITE;
/*!40000 ALTER TABLE `d89xz_color_ficha` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_color_ficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_procesos_ficha`
--

DROP TABLE IF EXISTS `d89xz_procesos_ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_procesos_ficha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` int(11) NOT NULL COMMENT 'esta tabla hace referecia a los procesos existenctes registrados por los usuarios del sistema, con el fin de calcular el costo en esta ficha de produccion',
  `id_produccion` int(11) NOT NULL COMMENT 'hace referencia a la ficha tecnica a la acual se pertenece este proceso',
  `id_proveedor` varchar(45) NOT NULL COMMENT 'id del proveedor que se prevee sea que el ejecute el proceso',
  `orden` int(11) NOT NULL COMMENT 'indica el orden en el cual s erealizará el proceso',
  `costo` int(11) NOT NULL COMMENT 'costo del proceso en la ficha tecnica',
  `delete` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actualizado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='inofrmacion de los procesos de la ficha tecnica de un producto';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_procesos_ficha`
--

LOCK TABLES `d89xz_procesos_ficha` WRITE;
/*!40000 ALTER TABLE `d89xz_procesos_ficha` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_procesos_ficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_costo_produccion`
--

DROP TABLE IF EXISTS `d89xz_costo_produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_costo_produccion` (
  `id` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  `id_orden_produccion` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `valor` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='esta tabla contiene la infomaion de los costos de la ficha tecnica y de las ordenes de pruccion';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_costo_produccion`
--

LOCK TABLES `d89xz_costo_produccion` WRITE;
/*!40000 ALTER TABLE `d89xz_costo_produccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_costo_produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_insumos_ficha`
--

DROP TABLE IF EXISTS `d89xz_insumos_ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_insumos_ficha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL COMMENT 'relacion con tabla de insumos',
  `id_ficha` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL COMMENT 'proveedor que se presume ejecute la produccion',
  `costo` decimal(10,0) NOT NULL COMMENT 'costo aproximado registrado por el user',
  `cantidad` varchar(45) NOT NULL COMMENT 'cantidad del insumko requerido regustrado por user',
  `comentario` text NOT NULL,
  `delete` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actualizado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COMMENT='insumos de una ficha tecnica';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_insumos_ficha`
--

LOCK TABLES `d89xz_insumos_ficha` WRITE;
/*!40000 ALTER TABLE `d89xz_insumos_ficha` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_insumos_ficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_procesos`
--

DROP TABLE IF EXISTS `d89xz_procesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_procesos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actualizado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` tinyint(1) NOT NULL,
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Esta tabla guarda la inofrmacion de los procesos de la empresa para produccion';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_procesos`
--

LOCK TABLES `d89xz_procesos` WRITE;
/*!40000 ALTER TABLE `d89xz_procesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_procesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_disenio_ficha`
--

DROP TABLE IF EXISTS `d89xz_disenio_ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_disenio_ficha` (
  `id` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL COMMENT 'ficha a la cual pertenece esta diseño',
  `imagen` varchar(45) NOT NULL COMMENT 'Imagen de diseño',
  `talla` varchar(45) NOT NULL,
  `ref_top` varchar(45) NOT NULL,
  `combinado_color` varchar(45) NOT NULL COMMENT 'si combina color "si " o "no"',
  `tiene_proceso` varchar(45) NOT NULL,
  `tiene_accesorio` varchar(45) NOT NULL,
  `muestra` varchar(45) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actualizado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` tinyint(1) NOT NULL,
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='informacion del diseño de productos textiles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_disenio_ficha`
--

LOCK TABLES `d89xz_disenio_ficha` WRITE;
/*!40000 ALTER TABLE `d89xz_disenio_ficha` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_disenio_ficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d89xz_orden_produccion`
--

DROP TABLE IF EXISTS `d89xz_orden_produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d89xz_orden_produccion` (
  `id` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL COMMENT 'fhca tecnica a la cual s eobtiene la orden de produccion',
  `fecha_inicio` date NOT NULL COMMENT 'fecha incio del proceso',
  `fecha_fin` date NOT NULL COMMENT 'fecha de fin del proceso',
  `cantidad` int(11) NOT NULL COMMENT 'cantidad de producto a producir',
  `costo` varchar(45) NOT NULL COMMENT 'costo de la orden de produccion',
  `user` varchar(45) NOT NULL,
  `punto_venta` varchar(45) NOT NULL,
  `actualizado` tinyint(1) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='esta tabla almacena la infomacion de las ordenes de produccion';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d89xz_orden_produccion`
--

LOCK TABLES `d89xz_orden_produccion` WRITE;
/*!40000 ALTER TABLE `d89xz_orden_produccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `d89xz_orden_produccion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-24 14:49:56
