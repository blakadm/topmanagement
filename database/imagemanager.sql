/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.16-log : Database - onelab.ph
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `onelab.ph`;

/*Table structure for table `imagemanager` */

DROP TABLE IF EXISTS `imagemanager`;

CREATE TABLE `imagemanager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fileName` varchar(128) NOT NULL,
  `fileHash` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `createdBy` int(10) unsigned DEFAULT NULL,
  `modifiedBy` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `imagemanager` */

insert  into `imagemanager`(`id`,`fileName`,`fileHash`,`created`,`modified`,`createdBy`,`modifiedBy`) values (3,'110.jpg','XaMuJNmqzy79rA5betNIdUJgiA6Dg-cf','2017-12-11 12:02:07','2017-12-11 12:02:07',NULL,NULL),(4,'DOST HVL.jpg','PFcdhq1N_-10BRLl_bfakNmxJJpVeL9y','2017-12-14 13:51:55','2017-12-14 13:51:55',NULL,NULL),(5,'HVL.jpg','y3dS7-4tBAy8c8C5227j8OrA3tdPwpps','2017-12-14 13:53:35','2017-12-14 13:53:35',NULL,NULL),(6,'HVL2.jpg','STxwekWXM3EPhlDuoH8n9ACimpYihVdb','2017-12-14 13:56:42','2017-12-14 13:56:42',NULL,NULL),(7,'DOST HVL_crop_576x768.jpg','dniYytWmj26eed2vcegiJGzBlVRrq8iy','2017-12-14 17:07:05','2017-12-14 17:07:05',NULL,NULL),(8,'23511302-1586556971411800-9000386456372212228-o.jpg','2QdMLjmsw0hCkFhtpvdTHxE8y_LeB4-D','2017-12-19 14:14:35','2017-12-19 14:14:35',NULL,NULL),(9,'23592163-1586556891411808-3666236932472635529-o.jpg','5hPrKQvNt52i5BQ_NuDuC94DznX3nmf3','2017-12-19 14:14:37','2017-12-19 14:14:37',NULL,NULL),(10,'yii-framework.png','sRE026eq94dPdakK6Uf54nRfWqkudNEe','2017-12-19 14:14:37','2017-12-19 14:14:37',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
