/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.16-log : Database - api.onelab.gov.ph
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `api.onelab.gov.ph`;

/*Table structure for table `rstl` */

DROP TABLE IF EXISTS `rstl`;

CREATE TABLE `rstl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `rstl` */

insert  into `rstl`(`id`,`region_id`,`name`,`code`) values (1,3,'DOST-I','R1'),(2,4,'DOST-II','R2'),(3,5,'DOST-III','R3'),(4,6,'DOST-IVA-L1','R4AL1'),(5,6,'DOST-IVA-L2','R4AL2'),(6,7,'DOST-IVB','R4B'),(7,8,'DOST-V','R5'),(8,9,'DOST-VI','R6'),(9,10,'DOST-VII','R7'),(10,11,'DOST-VIII','R8'),(11,12,'DOST-IX','R9'),(12,13,'DOST-X','R10'),(13,14,'DOST-XI','R11'),(14,15,'DOST-XII-L1','R12L1'),(15,15,'DOST-XII-L2','R12L2'),(16,2,'DOST-CAR','CAR'),(17,17,'DOST-CARAGA','R13'),(18,18,'DOST-ARMM','ARMM'),(19,19,'DOST-FNRI','FNRI'),(20,20,'DOST-FPRDI','FPRDI'),(21,21,'DOST-ITDI','ITDI'),(22,22,'DOST-MIRDC','MIRDC'),(23,23,'DOST-PTRI','PTRI'),(24,24,'DOST-PNRI','PNRI'),(25,6,'DOST-IVA-L3','R4AL3'),(26,6,'DOST-IVA-L4','R4AL4'),(27,21,'DOST-ADMATEL','ADMATEL'),(28,0,'Customer-Portal','Cust-P'),(29,0,'Payment-Portal','Pay-P');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
