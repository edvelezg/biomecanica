-- MySQL dump 10.11
--
-- Host: localhost    Database: biomecanica
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt

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
-- Current Database: `biomecanica`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `biomecanica` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `biomecanica`;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE `citas` (
  `nro_cita` int(11) NOT NULL auto_increment,
  `mom_impresion` time NOT NULL,
  `fecha` date NOT NULL,
  `ocupacion` varchar(300) NOT NULL,
  `deporte` varchar(300) NOT NULL,
  `consulta` text NOT NULL,
  `podograma` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `diagnostico` text NOT NULL,
  `huellas` tinyint(1) NOT NULL,
  `peso` float NOT NULL,
  `nro_doc` varchar(50) NOT NULL,
  `doctor` varchar(200) default NULL,
  `institucion` varchar(200) NOT NULL,
  `ant_tipo1` varchar(50) NOT NULL,
  `ant_tipo2` varchar(50) NOT NULL,
  `arco_trans` varchar(50) NOT NULL,
  `ant_notas` varchar(100) NOT NULL,
  `art_tipo` varchar(50) NOT NULL,
  `art_lado` varchar(50) NOT NULL,
  `art_notas` varchar(100) NOT NULL,
  `cad_desnivel` tinyint(1) NOT NULL,
  `cad_lado` varchar(50) NOT NULL,
  `cad_cantidad` varchar(50) NOT NULL,
  `cad_notas` varchar(100) NOT NULL,
  `escoliosis` tinyint(1) NOT NULL,
  `esco_lado` varchar(50) NOT NULL,
  `cifosis` tinyint(1) NOT NULL,
  `hiperlordosis` tinyint(1) NOT NULL,
  `col_otro` varchar(50) NOT NULL,
  `col_notas` text NOT NULL,
  `ep_tipo` varchar(50) NOT NULL,
  `ep_grado` float NOT NULL,
  `ep_notas` text NOT NULL,
  `tamano` varchar(50) NOT NULL,
  `arcolong` varchar(50) NOT NULL,
  `boton` varchar(50) NOT NULL,
  `cunas` varchar(50) NOT NULL,
  `taloneras` varchar(50) NOT NULL,
  `med_otro` varchar(200) NOT NULL,
  `tam_mod` varchar(100) NOT NULL,
  `arc_mod` varchar(100) NOT NULL,
  `bot_mod` varchar(100) NOT NULL,
  `tal_mod` varchar(100) NOT NULL,
  `cun_mod` varchar(100) NOT NULL,
  `rod_tipo` varchar(50) NOT NULL,
  `rod_notas` text NOT NULL,
  `tib_tipo` varchar(50) NOT NULL,
  `tib_notas` text NOT NULL,
  `zap_tipo` varchar(50) NOT NULL,
  `zap_desc` varchar(200) NOT NULL,
  `zap_alt` float NOT NULL,
  `zap_punta` varchar(50) NOT NULL,
  `tob_tipo` varchar(50) NOT NULL,
  `tob_notas` text NOT NULL,
  `plantillas` text NOT NULL,
  `notas` text NOT NULL,
  `piel_callos` varchar(200) NOT NULL,
  PRIMARY KEY  (`nro_cita`),
  KEY `nro_doc` (`nro_doc`),
  KEY `doctor` (`doctor`),
  KEY `fecha` (`fecha`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`nro_doc`) REFERENCES `paciente` (`nro_doc`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
CREATE TABLE `logins` (
  `id` int(11) NOT NULL auto_increment,
  `customer_id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` (`id`, `customer_id`, `username`, `password`) VALUES (1,1,'joaquin','biomec');
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE `medicos` (
  `id_med` varchar(30) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `institucion` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  UNIQUE KEY `nombre` (`nombre`),
  KEY `institucion` (`institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `tipo_doc` varchar(50) NOT NULL,
  `nro_doc` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre2` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `tel_casa` varchar(20) NOT NULL,
  `tel_trab` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`nro_doc`),
  KEY `nombre` (`nombre`),
  KEY `nombre2` (`nombre2`),
  KEY `apellido1` (`apellido1`),
  KEY `apellido2` (`apellido2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2007-12-10  0:39:23
