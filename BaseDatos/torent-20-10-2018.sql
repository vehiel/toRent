/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.7.23-0ubuntu0.16.04.1 : Database - torent
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `torent`;

/*Table structure for table `tr02usu` */

DROP TABLE IF EXISTS `tr02usu`;

CREATE TABLE `tr02usu` (
  `nus_02in` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Número de Usuario',
  `idp_02in` int(10) NOT NULL COMMENT 'Id Persona',
  `con_02vc` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Contraseña',
  `est_02in` int(3) NOT NULL DEFAULT '0' COMMENT 'Estado',
  `idr_03in` int(3) DEFAULT NULL COMMENT 'Rol',
  `nom_02vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre',
  `ap1_02vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Apellido 1',
  `ap2_02vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Apellido 2',
  `tel_02vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Teléfono',
  `gen_02in` int(1) NOT NULL COMMENT 'Género',
  `ema_02vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `dir_02vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Dirección',
  `ncu_02vc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Número de Cuenta',
  `fna_02dt` date NOT NULL COMMENT 'Fecha Nacimiento',
  `nac_02vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nacionalidad',
  PRIMARY KEY (`idp_02in`,`nus_02in`),
  UNIQUE KEY `nus_02in` (`nus_02in`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr02usu` */

insert  into `tr02usu`(`nus_02in`,`idp_02in`,`con_02vc`,`est_02in`,`idr_03in`,`nom_02vc`,`ap1_02vc`,`ap2_02vc`,`tel_02vc`,`gen_02in`,`ema_02vc`,`dir_02vc`,`ncu_02vc`,`fna_02dt`,`nac_02vc`) values 
(6,504080760,'$2y$13$Z0Qs9gJ3nqKeuML6/JqC0OdpLz/USXg4D9fkeW/DhmZNiKfYsy.Hq',1,NULL,'pedro','pica','piedra','23-16-58-92',1,'vehiel@xd.com','ni idea','123','2018-11-07','CR'),
(7,504080761,'$2y$13$PRUy0M4TLWqk23zr0JrFUO5vCzNvy4BQIONPmSt.U5OohS2bpaE7.',1,NULL,'Vehiel','Alemán ','campos','87-22-18-59',0,'vehiel@xd.com','Nicoya','12365','2018-10-30','Cr'),
(5,504170086,'torent2018',0,NULL,'hellen','castillo','perez','6140-0569',0,'vehiel@xd.com','curime','12-563','2018-10-05','CR');

/*Table structure for table `tr04pri` */

DROP TABLE IF EXISTS `tr04pri`;

CREATE TABLE `tr04pri` (
  `idp_04in` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Id Privilegio',
  `pri_04vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Privilegio',
  `lis_04vc` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Menú nav bar',
  PRIMARY KEY (`idp_04in`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr04pri` */

/*Table structure for table `tr05usu_pri` */

DROP TABLE IF EXISTS `tr05usu_pri`;

CREATE TABLE `tr05usu_pri` (
  `nus_02in` int(10) NOT NULL COMMENT 'Número de Usuario',
  `idp_04in` int(3) NOT NULL COMMENT 'Id Privilegio',
  PRIMARY KEY (`nus_02in`,`idp_04in`),
  KEY `fk_privilegio` (`idp_04in`),
  CONSTRAINT `fk_privilegio` FOREIGN KEY (`idp_04in`) REFERENCES `tr04pri` (`idp_04in`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`nus_02in`) REFERENCES `tr02usu` (`nus_02in`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr05usu_pri` */

/*Table structure for table `tr06cli` */

DROP TABLE IF EXISTS `tr06cli`;

CREATE TABLE `tr06cli` (
  `idp_06in` int(10) NOT NULL COMMENT 'Cédula',
  `con_06vc` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Contraseña',
  `ncl_06in` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Número de Cliente',
  `emo_06in` int(1) NOT NULL COMMENT 'Estado de Morosidad',
  `obs_06vc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Observaciones',
  `nom_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre',
  `ap1_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Apellido 1',
  `ap2_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Apellido 2',
  `tel_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Teléfono',
  `gen_06in` int(1) NOT NULL COMMENT 'Género',
  `ema_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `dir_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Dirección',
  `ncu_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Número de Cuenta',
  `fna_06dt` date NOT NULL COMMENT 'Fecha Nacimiento',
  `nac_06vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nacionalidad',
  PRIMARY KEY (`idp_06in`,`ncl_06in`),
  UNIQUE KEY `ncl_06in` (`ncl_06in`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr06cli` */

insert  into `tr06cli`(`idp_06in`,`con_06vc`,`ncl_06in`,`emo_06in`,`obs_06vc`,`nom_06vc`,`ap1_06vc`,`ap2_06vc`,`tel_06vc`,`gen_06in`,`ema_06vc`,`dir_06vc`,`ncu_06vc`,`fna_06dt`,`nac_06vc`) values 
(504080760,'$2y$13$kVrC4BhVCSRPqMz/8n364u4jaZ60V9fPazd1om82hZNuKpZamqHLG',3,0,'','vehiel','aleman','campos','8722-1859',1,'vehiel@xd.com','aqui','100-200','2018-10-15','CR'),
(504080761,'123',1,0,'','ismael','reyes','diaz','8722-1859',1,'ismael@xd.com','ni idea','12345','1996-01-01','CR');

/*Table structure for table `tr08nhr` */

DROP TABLE IF EXISTS `tr08nhr`;

CREATE TABLE `tr08nhr` (
  `idn_08in` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id nombre herramienta',
  `nom_08vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre',
  `ima_08vc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Imagen',
  PRIMARY KEY (`idn_08in`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr08nhr` */

insert  into `tr08nhr`(`idn_08in`,`nom_08vc`,`ima_08vc`) values 
(1,'Taladro',NULL),
(2,'Patin',NULL),
(3,'Sander',NULL),
(4,'Batidora',NULL),
(5,'Rompedor',NULL),
(6,'Atornillador',NULL),
(7,'Esmeril',NULL);

/*Table structure for table `tr09mar` */

DROP TABLE IF EXISTS `tr09mar`;

CREATE TABLE `tr09mar` (
  `cgm_09in` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Código de marca',
  `nom_09vc` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre',
  `est_09in` int(11) NOT NULL COMMENT 'Estado',
  PRIMARY KEY (`cgm_09in`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr09mar` */

insert  into `tr09mar`(`cgm_09in`,`nom_09vc`,`est_09in`) values 
(1,'DeWalt',1),
(2,'Makita',1),
(3,'Truper',1),
(4,'Metabo',0),
(5,'Gladiator',1),
(6,'Black and Decker',1);

/*Table structure for table `tr10her` */

DROP TABLE IF EXISTS `tr10her`;

CREATE TABLE `tr10her` (
  `chr_10in` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Código de herramienta',
  `idn_08in` int(10) NOT NULL COMMENT 'Id nombre herramienta',
  `cgm_09in` int(10) NOT NULL COMMENT 'Código de marca',
  `vol_10in` int(5) NOT NULL COMMENT 'Voltaje',
  `des_10vc` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Descripcion',
  `vut_10in` int(5) NOT NULL COMMENT 'Vida util años',
  `gar_10in` int(5) NOT NULL COMMENT 'Garantía en meses',
  `tip_10in` int(5) NOT NULL COMMENT 'Tipo',
  `est_10in` int(5) NOT NULL COMMENT 'Estado de la herramienta',
  `alq_10in` int(5) NOT NULL COMMENT 'Alquilada',
  `ser_10vc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Serial',
  `ima_10vc` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Imagen',
  `can_10in` int(11) NOT NULL COMMENT 'Cantidad',
  `pre_10de` decimal(10,2) NOT NULL COMMENT 'Precio',
  PRIMARY KEY (`chr_10in`),
  KEY `fk_marca_herramienta` (`cgm_09in`),
  KEY `fk_nombreherramienta_herramienta` (`idn_08in`),
  CONSTRAINT `fk_marca_herramienta` FOREIGN KEY (`cgm_09in`) REFERENCES `tr09mar` (`cgm_09in`),
  CONSTRAINT `fk_nombreherramienta_herramienta` FOREIGN KEY (`idn_08in`) REFERENCES `tr08nhr` (`idn_08in`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr10her` */

insert  into `tr10her`(`chr_10in`,`idn_08in`,`cgm_09in`,`vol_10in`,`des_10vc`,`vut_10in`,`gar_10in`,`tip_10in`,`est_10in`,`alq_10in`,`ser_10vc`,`ima_10vc`,`can_10in`,`pre_10de`) values 
(1,1,1,1,'amarrillo con negro',5,12,1,1,0,'123qwerty','algo.jpg',0,0.00);

/*Table structure for table `tr11ord_alq` */

DROP TABLE IF EXISTS `tr11ord_alq`;

CREATE TABLE `tr11ord_alq` (
  `ido_11in` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Orden',
  `ncl_06in` int(11) NOT NULL COMMENT 'Número Cliente',
  `fso_11dt` datetime NOT NULL COMMENT 'Fecha Solicitud',
  `fre_11dt` datetime DEFAULT NULL COMMENT 'Fecha Retiro',
  `fde_11dt` datetime DEFAULT NULL COMMENT 'Fecha Devolución',
  `sto_11de` decimal(10,2) NOT NULL COMMENT 'Subtotal',
  `mto_11de` decimal(10,2) NOT NULL COMMENT 'Monto Total',
  `est_11in` int(11) NOT NULL COMMENT 'Estado',
  PRIMARY KEY (`ido_11in`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr11ord_alq` */

/*Table structure for table `tr12det_alq` */

DROP TABLE IF EXISTS `tr12det_alq`;

CREATE TABLE `tr12det_alq` (
  `idd_12in` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Detalle',
  `ido_11in` int(11) NOT NULL COMMENT 'Id Orden',
  `chr_10in` int(11) NOT NULL COMMENT 'Código de herramienta',
  `pre_12de` decimal(10,2) NOT NULL COMMENT 'Precio',
  `can_12in` int(11) NOT NULL COMMENT 'Cantidad',
  PRIMARY KEY (`idd_12in`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tr12det_alq` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
