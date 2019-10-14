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

/*Table structure for table `tbl_agency` */

DROP TABLE IF EXISTS `tbl_agency`;

CREATE TABLE `tbl_agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(256) NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `geo_location` varchar(256) NOT NULL,
  `activated` int(11) NOT NULL,
  `ordernumber` int(11) NOT NULL,
  `membertypeid` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membertypeid` (`membertypeid`),
  CONSTRAINT `tbl_agency_ibfk_1` FOREIGN KEY (`membertypeid`) REFERENCES `tbl_membertype` (`MemberTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_agency` */

insert  into `tbl_agency`(`id`,`region_id`,`name`,`code`,`description`,`website`,`contact`,`address`,`geo_location`,`activated`,`ordernumber`,`membertypeid`) values (1,3,'DOST-I','R1','DOST Region I','http://region1.dost.gov.ph/','','','16.607972, 120.315835',1,1,1),(2,4,'DOST-II','R2','DOST Region II','http://region2.dost.gov.ph/','','','17.652242, 121.752502',1,2,1),(3,5,'DOST-III','R3','DOST Region III','http://region3.dost.gov.ph/','','','15.066352, 120.657300',1,3,1),(4,6,'DOST-IVA-L1','R4AL1','DOST Region IVA-L1','http://region4a.dost.gov.ph/','RSTL : (049) 536-4390\nRML : (049) 536-8091','','14.172264, 121.223556',1,4,1),(5,6,'DOST-IVA-L2','R4AL2','DOST Region IVA-L2','http://region4a.dost.gov.ph/','(046) 419-2533','','14.278183, 120.868458',1,5,1),(6,7,'DOST-IVB','R4B','DOST Region IVB','http://region4b.dost.gov.ph/','','','9.784145, 118.734071',1,8,1),(7,8,'DOST-V','R5','DOST Region V','http://region5.dost.gov.ph/','','','13.167125, 123.751951',1,9,1),(8,9,'DOST-VI','R6','DOST Region VI','http://region6.dost.gov.ph/','','','10.711773, 122.563898',1,10,1),(9,10,'DOST-VII','R7','DOST Region VII','http://region7.dost.gov.ph/','','','10.326021, 123.896707',1,11,1),(10,11,'DOST-VIII','R8','DOST Region VIII','http://region8.dost.gov.ph/','','','11.179108, 125.003762',1,12,1),(11,12,'DOST-IX','R9','DOST Region IX','http://region9.dost.gov.ph/','','','8.578809, 123.339708',1,13,1),(12,13,'DOST-X','R10','DOST Region X','http://region10.dost.gov.ph/','','','8.482154, 124.627571',1,14,1),(13,14,'DOST-XI','R11','DOST Region XI','http://region11.dost.gov.ph/','','','7.100831, 125.619313',1,15,1),(14,15,'DOST-XII-L1','R12L1','DOST Region XII-L1','http://region12.dost.gov.ph/','','','7.195893, 124.245030',1,16,1),(15,15,'DOST-XII-L2','R12L2','DOST Region XII-L2','http://region12.dost.gov.ph/','','','7.195893, 124.245030',1,17,1),(16,2,'DOST-CAR','CAR','DOST Cordillera Administrative Region','http://car.dost.gov.ph/','','','16.461068, 120.588391',1,18,1),(17,16,'DOST-CARAGA','R13','DOST Caraga Administrative Region','http://caraga.dost.gov.ph/','','','8.949169, 125.531068',1,19,1),(18,17,'DOST-ARMM','ARMM','DOST Autonomous Region for Muslim Mindanao','http://www.armm.dost.gov.ph/','','','',1,20,1),(19,1,'DOST-FNRI','FNRI','Food and Nutrition Research Institute (FNRI)','http://i.fnri.dost.gov.ph/','','','14.489892, 121.053114',1,21,2),(20,6,'DOST-FPRDI','FPRDI','Forest Products Research and Development Institute','http://www.fprdi.dost.gov.ph/','','','14.156966, 121.235461',1,22,2),(21,1,'DOST-ITDI','ITDI','Industrial Technology Development Institute (ITDI)','http://www.itdi.dost.gov.ph/','','','14.489730, 121.050719',1,23,2),(22,1,'DOST-MIRDC','MIRDC','Metal Industry Research and Development Center (MIRDC)','http://www.mirdc.dost.gov.ph/','','','14.486842, 121.049609',1,24,2),(23,1,'DOST-PTRI','PTRI','Philippine Textile Research Institute (PTRI)','http://www.ptri.dost.gov.ph/','','','14.487292, 121.047867',1,25,2),(24,1,'DOST-PNRI','PNRI','Philippine Nuclear Research Institute (PNRI)','http://www.pnri.dost.gov.ph/','','','14.661146, 121.055715',1,26,2),(25,6,'DOST-IVA-L3','R4AL3','DOST Region IVA-L3','http://region4a.dost.gov.ph/','(043) 425-4041','','13.7721064, 121.0611725',1,6,1),(26,6,'DOST-IVA-L4','R4AL4','DOST Region IVA-L4','http://region4a.dost.gov.ph/','','','',1,7,1),(27,21,'DOST-ADMATEL','ADMATEL','DOST ADMATEL','http://www.admatel.com/base/','','','',0,27,NULL),(101,3,'Food and Drug Administration','FDA','Food and Drug Administration','http://www.fda.gov.ph/','','','14.412591, 121.042491',0,28,3),(102,1,'National Reference Lab','NRL','Department of Health - National Reference Laboratory','http://www.nrleamcdoh.org/\r\n','','','14.641784, 121.047608',0,29,3),(103,1,'Fertilizer and Pesticide Authority','FPA','Fertilizer and Pesticide Authority','http://fpa.da.gov.ph/','','','14.656744, 121.046948',0,30,3),(104,1,'SGS Philippines','SGS','SGS Philippines','http://www.sgs.ph/\r\n','+63 (2) 784 9400','','14.547376, 121.015105',0,31,4),(105,1,'F.A.S.T. Laboratories - Cubao','FAST','First Analytical Services and Technical Cooperative (F.A.S.T. Lab) - Cubao','http://www.fastlaboratories.com.ph/\r\n','(02) 913-0240 to 41 (02) 912-6319','','14.623046, 121.062386',0,32,4),(106,1,'PIPAC','PIPAC','Philippine Institute of Pure and Applied Chemistry (PIPAC)','http://www.pipac.com.ph/','426 6072','','14.638871, 121.076784\r\n',0,33,4),(107,1,'National Institute of Health','NIH','UP Manila - National Institutes of Health','http://www.nih.gov/','','','14.575858, 120.987174',0,34,3),(108,1,'Bureau of Product Standards','BPS','Bureau of Product Standards','\r\nhttp://www.bps.dti.gov.ph/','(02) 890 5226\r\n','','14.562013, 121.026942',0,35,NULL),(109,1,'Philippine Accreditation Bureau\r\n','PAB','Philippine Accreditation Bureau\r\n','\r\n','','','14.561937, 121.026962',0,36,NULL),(110,1,'Mines and Geosciences Bureau','MGB','Mines and Geosciences Bureau','http://mgb.gov.ph/\r\n','','','7.069921, 125.618862',0,37,NULL),(111,1,'SentroTek','SENTROTEK','Sentro sa Pagsusuri, Pagsasanay at Pangasiwang Pang-agham at Teknolohiyang Corporation (Sentrotek)','http://www.sentrotek.com/','','','',0,38,4),(112,1,'Optimal Laboratories Inc.','OPTIMAL','Total Commitment to Quality and Service','http://optimallabinc.com/','','','',0,39,4),(113,1,'Jefcor Laboratories Inc.','JEFCOR','Jefcor Laboratories, Inc.','http://jefcorlabs.com/','','','',0,40,4),(114,1,'Intertek Philippines','INTERTEK','Intertek Testing Services Philippines, Inc.','http://www.intertek.com/','','','',0,41,4),(115,1,'ASTI','ASTI','Advanced Science and Technology Institute (ASTI)','https://asti.dost.gov.ph/','','','',0,42,NULL),(116,1,'Qualibet','QTSC','Qualibet Testing Services Corporation','http://qualibetlab.com/','','','',0,43,4),(117,1,'GCH Center for Food Safety and Quality, Inc.','GCH','GCH Center for Food Safety and Quality, Inc.','https://www.facebook.com/gchcenterfoodsafetylab/','','','',0,44,4);

/*Table structure for table `tbl_announcement` */

DROP TABLE IF EXISTS `tbl_announcement`;

CREATE TABLE `tbl_announcement` (
  `AnnouncementID` int(11) NOT NULL AUTO_INCREMENT,
  `AnnouncementTypeID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Announcement` longtext NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `lock` int(11) DEFAULT '0',
  PRIMARY KEY (`AnnouncementID`),
  UNIQUE KEY `StartDate` (`StartDate`,`EndDate`),
  KEY `tbl_announcement_ibfk_1` (`AnnouncementTypeID`),
  CONSTRAINT `tbl_announcement_ibfk_1` FOREIGN KEY (`AnnouncementTypeID`) REFERENCES `tbl_announcementtype` (`AnnouncementTypeID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_announcement` */

insert  into `tbl_announcement`(`AnnouncementID`,`AnnouncementTypeID`,`Title`,`Announcement`,`StartDate`,`EndDate`,`created_at`,`updated_at`,`created_by`,`updated_by`,`deleted_by`,`deleted_at`,`lock`) values (1,3,'Hastening Countryside Development','<h2>One-Stop Laboratory Services for Global Competitiveness (OneLab)</h2>\r\n<p><img src=\"../images/onelab-2.png\" alt=\"\" /></p>\r\n<p>The One-stop Laboratory Services for Global Competitiveness (OneLab) project is an IT-based solution envisioned to broaden public access to testing services of all the member-laboratories in the network at a single touch point. &nbsp;</p>\r\n<p>OneLab integrated the 21 DOST and 7 non-DOST laboratories all over the country through an IT-based <strong>Referral System</strong>.</p>\r\n<p>This allows for seamless handling of samples from receiving, referral,</p>\r\n<p>transport, analysis to the prompt delivery of calibration and testing reports, no matter where the customers are in the Philippines. The <strong>Referral Module</strong> &nbsp;is fully deployed to<strong> 7</strong> DOST laboratories (R6, R7, R8, R9, R10, R11 and ITDI) in <strong>October 2015</strong> &nbsp;while the other 5 DOST laboratories were on beta-testing stage.</p>\r\n<p>Since its launching in October, <strong>6 referrals were made for 14 samples requiring 17 tests</strong>.</p>\r\n<p>In tandem with the Referral System, the Unified Laboratory&nbsp;Information Management System (<strong><em>ULIMS</em></strong>) was enhanced and are fully deployed and adopted by <strong>DOST Research and Development Institutes</strong>&nbsp;</p>\r\n<p>(<strong>RDIs</strong>) and <strong>DOST Regional S&amp;T Laboratories</strong> (RSTLs) to improve its operational capability for efficient laboratory transaction management.</p>\r\n<ul style=\"list-style-type: square;\">\r\n<li>Sustained laboratory operations with 79,001 samples tested (124% accomplished vs target);</li>\r\n<li>106,647 test and calibration works undertaken (102% accomplished vs target);</li>\r\n<li>56,752 customers served (129%&nbsp; accomplished vs target);</li>\r\n<li>15,633 firms served (119% accomplished vs target);</li>\r\n<li>Php 66,605,116.96&nbsp; laboratory fees collected (138% accomplished vs. target)</li>\r\n</ul>','2017-11-20','2017-11-22','2017-08-04 14:32:50','2017-12-05 13:32:42',1,1,0,NULL,5);

/*Table structure for table `tbl_announcementtype` */

DROP TABLE IF EXISTS `tbl_announcementtype`;

CREATE TABLE `tbl_announcementtype` (
  `AnnouncementTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `AnnouncementType` varchar(30) DEFAULT NULL,
  `CSSClass` varchar(50) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`AnnouncementTypeID`),
  UNIQUE KEY `AnnouncementType` (`AnnouncementType`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_announcementtype` */

insert  into `tbl_announcementtype`(`AnnouncementTypeID`,`AnnouncementType`,`CSSClass`,`deleted_by`,`deleted_at`) values (1,'[Default]','alert alert-default',NULL,NULL),(2,'Danger','alert alert-danger',NULL,NULL),(3,'Information','alert alert-info',NULL,NULL),(4,'Success','alert alert-success',NULL,NULL),(5,'Warning','alert alert-warning',NULL,NULL),(6,'Important','alert alert-pastel-info',NULL,NULL);

/*Table structure for table `tbl_article_attachments` */

DROP TABLE IF EXISTS `tbl_article_attachments`;

CREATE TABLE `tbl_article_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `titleAttribute` text,
  `filename` varchar(255) NOT NULL,
  `extension` varchar(12) NOT NULL,
  `mimetype` varchar(255) NOT NULL,
  `size` int(32) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_article_attachments_item_id` (`item_id`),
  CONSTRAINT `fk_article_attachments_item_id` FOREIGN KEY (`item_id`) REFERENCES `tbl_article_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_article_attachments` */

insert  into `tbl_article_attachments`(`id`,`item_id`,`title`,`alias`,`titleAttribute`,`filename`,`extension`,`mimetype`,`size`,`hits`) values (3,1,'0ca34c_DOST-HVL',NULL,NULL,'0ca34c_DOST-HVL.jpg','jpg','image/jpeg',37576,0);

/*Table structure for table `tbl_article_categories` */

DROP TABLE IF EXISTS `tbl_article_categories`;

CREATE TABLE `tbl_article_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `access` varchar(64) NOT NULL,
  `language` char(7) NOT NULL DEFAULT 'all',
  `theme` varchar(12) NOT NULL DEFAULT 'blog',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `image` text,
  `image_caption` varchar(255) DEFAULT NULL,
  `image_credits` varchar(255) DEFAULT NULL,
  `params` text,
  `metadesc` text,
  `metakey` text,
  `robots` varchar(20) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `copyright` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_article_categories_access` (`access`),
  KEY `index_article_categories_parent_id` (`parent_id`),
  CONSTRAINT `fk_article_categories_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `tbl_article_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_article_categories` */

insert  into `tbl_article_categories`(`id`,`parent_id`,`name`,`alias`,`description`,`state`,`access`,`language`,`theme`,`ordering`,`image`,`image_caption`,`image_credits`,`params`,`metadesc`,`metakey`,`robots`,`author`,`copyright`) values (1,NULL,'News','extensions','<p>This is a news article Category</p>\r\n',1,'public','all','blog',0,'','','','{\"categoriesImageWidth\":\"extra\",\"categoriesIntroText\":\"No\",\"categoriesFullText\":\"No\",\"categoriesCreatedData\":\"No\",\"categoriesModifiedData\":\"No\",\"categoriesUser\":\"No\",\"categoriesHits\":\"No\",\"categoriesDebug\":\"No\",\"categoryImageWidth\":\"medium\",\"categoryIntroText\":\"Yes\",\"categoryFullText\":\"No\",\"categoryCreatedData\":\"Yes\",\"categoryModifiedData\":\"No\",\"categoryUser\":\"Yes\",\"categoryHits\":\"Yes\",\"categoryDebug\":\"No\",\"itemImageWidth\":\"small\",\"itemIntroText\":\"No\",\"itemFullText\":\"No\",\"itemCreatedData\":\"No\",\"itemModifiedData\":\"No\",\"itemUser\":\"No\",\"itemHits\":\"No\",\"itemDebug\":\"No\"}','','','index, follow','Gogodigital S.r.l.s.','Gogodigital S.r.l.s.'),(2,NULL,'Blog','blog','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',1,'public','it-IT','blog',0,'blog.png','','','{\"categoriesImageWidth\":\"extra\",\"categoriesIntroText\":\"No\",\"categoriesFullText\":\"No\",\"categoriesCreatedData\":\"No\",\"categoriesModifiedData\":\"No\",\"categoriesUser\":\"No\",\"categoriesHits\":\"No\",\"categoriesDebug\":\"No\",\"categoryImageWidth\":\"medium\",\"categoryIntroText\":\"Yes\",\"categoryFullText\":\"No\",\"categoryCreatedData\":\"Yes\",\"categoryModifiedData\":\"No\",\"categoryUser\":\"Yes\",\"categoryHits\":\"Yes\",\"categoryDebug\":\"No\",\"itemImageWidth\":\"small\",\"itemIntroText\":\"No\",\"itemFullText\":\"No\",\"itemCreatedData\":\"No\",\"itemModifiedData\":\"No\",\"itemUser\":\"No\",\"itemHits\":\"No\",\"itemDebug\":\"No\"}','','','index, follow','Gogodigital S.r.l.s.','Gogodigital S.r.l.s.'),(3,NULL,'Portfolio','portfolio','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n',1,'public','all','portfolio',0,'','','','{\"categoriesImageWidth\":\"extra\",\"categoriesIntroText\":\"No\",\"categoriesFullText\":\"No\",\"categoriesCreatedData\":\"No\",\"categoriesModifiedData\":\"No\",\"categoriesUser\":\"No\",\"categoriesHits\":\"No\",\"categoriesDebug\":\"No\",\"categoryImageWidth\":\"medium\",\"categoryIntroText\":\"Yes\",\"categoryFullText\":\"No\",\"categoryCreatedData\":\"Yes\",\"categoryModifiedData\":\"No\",\"categoryUser\":\"Yes\",\"categoryHits\":\"Yes\",\"categoryDebug\":\"No\",\"itemImageWidth\":\"small\",\"itemIntroText\":\"No\",\"itemFullText\":\"No\",\"itemCreatedData\":\"No\",\"itemModifiedData\":\"No\",\"itemUser\":\"No\",\"itemHits\":\"No\",\"itemDebug\":\"No\"}','','','index, follow','Gogodigital S.r.l.s.','Gogodigital S.r.l.s.'),(4,NULL,'Company Events','company-events','<p>This is category for company events</p>\r\n',1,'public','all','blog',0,'','','','{\"categoriesImageWidth\":\"small\",\"categoriesIntroText\":\"No\",\"categoriesFullText\":\"No\",\"categoriesCreatedData\":\"No\",\"categoriesModifiedData\":\"No\",\"categoriesUser\":\"No\",\"categoriesHits\":\"No\",\"categoriesDebug\":\"No\",\"categoryImageWidth\":\"small\",\"categoryIntroText\":\"No\",\"categoryFullText\":\"No\",\"categoryCreatedData\":\"No\",\"categoryModifiedData\":\"No\",\"categoryUser\":\"No\",\"categoryHits\":\"No\",\"categoryDebug\":\"No\",\"itemImageWidth\":\"small\",\"itemIntroText\":\"No\",\"itemFullText\":\"No\",\"itemCreatedData\":\"No\",\"itemModifiedData\":\"No\",\"itemUser\":\"No\",\"itemHits\":\"No\",\"itemDebug\":\"No\"}','','','index, follow','',''),(5,NULL,'System Support','system-support','<p>System Support related articles</p>\r\n',1,'public','all','blog',0,'','','','{\"categoriesImageWidth\":\"small\",\"categoriesIntroText\":\"No\",\"categoriesFullText\":\"No\",\"categoriesCreatedData\":\"No\",\"categoriesModifiedData\":\"No\",\"categoriesUser\":\"No\",\"categoriesHits\":\"No\",\"categoriesDebug\":\"No\",\"categoryImageWidth\":\"small\",\"categoryIntroText\":\"No\",\"categoryFullText\":\"No\",\"categoryCreatedData\":\"No\",\"categoryModifiedData\":\"No\",\"categoryUser\":\"No\",\"categoryHits\":\"No\",\"categoryDebug\":\"No\",\"itemImageWidth\":\"small\",\"itemIntroText\":\"No\",\"itemFullText\":\"No\",\"itemCreatedData\":\"No\",\"itemModifiedData\":\"No\",\"itemUser\":\"No\",\"itemHits\":\"No\",\"itemDebug\":\"No\"}','','','index, follow','',''),(6,NULL,'Announcement','announcement','',1,'public','all','blog',0,'','','','{\"categoriesImageWidth\":\"small\",\"categoriesIntroText\":\"No\",\"categoriesFullText\":\"No\",\"categoriesCreatedData\":\"No\",\"categoriesModifiedData\":\"No\",\"categoriesUser\":\"No\",\"categoriesHits\":\"No\",\"categoriesDebug\":\"No\",\"categoryImageWidth\":\"small\",\"categoryIntroText\":\"No\",\"categoryFullText\":\"No\",\"categoryCreatedData\":\"No\",\"categoryModifiedData\":\"No\",\"categoryUser\":\"No\",\"categoryHits\":\"No\",\"categoryDebug\":\"No\",\"itemImageWidth\":\"small\",\"itemIntroText\":\"No\",\"itemFullText\":\"No\",\"itemCreatedData\":\"No\",\"itemModifiedData\":\"No\",\"itemUser\":\"No\",\"itemHits\":\"No\",\"itemDebug\":\"No\"}','','','index, follow','','');

/*Table structure for table `tbl_article_items` */

DROP TABLE IF EXISTS `tbl_article_items`;

CREATE TABLE `tbl_article_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `introtext` text,
  `fulltext` text,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `access` varchar(64) NOT NULL,
  `language` char(7) NOT NULL,
  `theme` varchar(12) NOT NULL DEFAULT 'blog',
  `ordering` int(11) DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `image` text,
  `image_caption` varchar(255) DEFAULT NULL,
  `image_credits` varchar(255) DEFAULT NULL,
  `video` text,
  `video_type` varchar(20) DEFAULT NULL,
  `video_caption` varchar(255) DEFAULT NULL,
  `video_credits` varchar(255) DEFAULT NULL,
  `params` text,
  `metadesc` text,
  `metakey` text,
  `robots` varchar(20) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `copyright` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) DEFAULT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_article_items_access` (`access`),
  KEY `index_article_items_cat_id` (`cat_id`),
  KEY `index_article_items_user_id` (`user_id`),
  KEY `index_article_items_created_by` (`created_by`),
  KEY `index_article_items_modified_by` (`modified_by`),
  CONSTRAINT `fk_article_items_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `tbl_article_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_article_items_created_by` FOREIGN KEY (`created_by`) REFERENCES `tbl_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_article_items_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_article_items_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_article_items` */

insert  into `tbl_article_items`(`id`,`cat_id`,`title`,`alias`,`introtext`,`fulltext`,`state`,`access`,`language`,`theme`,`ordering`,`hits`,`image`,`image_caption`,`image_credits`,`video`,`video_type`,`video_caption`,`video_credits`,`params`,`metadesc`,`metakey`,`robots`,`author`,`copyright`,`user_id`,`created_by`,`created`,`modified_by`,`modified`) values (1,1,'DOST opens Halal Verification Lab in Laguna','Halal Verification','<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>LOS BAŇOS, Laguna -&nbsp;</strong>A Halal Verification Laboratory (<strong>HVL</strong>) is now open under the Department of Science and Technology (<strong>DOST</strong>) in <em><strong>CALABARZON region</strong></em>.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"\" src=\"/assets/images/33/33e654_DOST.jpg\" style=\"float:left; height:250px; margin:4px; width:200px\" /></p>\r\n\r\n<div style=\"text-align: justify;\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">Servicing</span></span>&nbsp;<span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">the provinces of Cavite, Laguna, Batangas, Rizal and Quezon, the CALABARZON Regional Standards and Testing Laboratory</span></span><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">(RSTL) was inaugurated and turned over Monday at the DOST regional science complex in Barangay Timugan here. DOST-CALABARZ</span></span><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">ON Director Dr. Alexander R. Madrigal led national and regional officials for the inauguration and tour of the new facility that uses the most advance technology in detection of haram (forbidden by Islamic law) and mushbooh (doubtful or suspect foods in Islam) food products. The inaugural and turnover ceremonies highlighted the DOST-CALABARZON 54th Anniversary Celebration themed &ldquo;Improving Lives and Sustaining Inclusive Regional Growth through Innovative Programs and Services.&rdquo;</span></span></div>\r\n\r\n<div>\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">The Halal verification lab was established through the financial support of the Philippine Council for Industry, Energy and Emerging Technology Research and Development (PCIEERD) in a bid to strengthen and promote the Halal industry in the country through Republic Act (RA) 10817 or the &ldquo;Philippine Halal Export Development and Promotion Act&rdquo;.</span></span></p>\r\n</div>\r\n','<p><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\"><strong>LOS BAŇOS, Laguna -&nbsp;</strong>A Halal Verification Laboratory (<strong>HVL</strong>) is now open under the Department of Science and Technology (<strong>DOST</strong>) in <em><strong>CALABARZON region</strong></em>.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\"><img alt=\"\" src=\"/assets/images/0c/0ca34c_DOST-HVL.jpg\" style=\"border-style:solid; border-width:3px; float:left; height:400px; margin:8px 3px; width:300px\" />&nbsp; &nbsp; &nbsp;Servicing the provinces of Cavite, Laguna, Batangas, Rizal and Quezon, the CALABARZON Regional Standards and Testing Laboratory (RSTL) was inaugurated and turned over Monday at the DOST regional science complex in Barangay Timugan here. DOST-CALABARZON Director Dr. Alexander R. Madrigal led national and regional officials for the inauguration and tour of the new facility that uses the most advance technology in detection of haram (forbidden by Islamic law) and mushbooh (doubtful or suspect foods in Islam) food products. The inaugural and turnover ceremonies highlighted the DOST-CALABARZON 54th Anniversary Celebration themed &ldquo;Improving Lives and Sustaining Inclusive Regional Growth through Innovative Programs and Services.&rdquo;</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp; &nbsp;The Halal verification lab was established through the financial support of the Philippine Council for Industry, Energy and Emerging Technology Research and Development (PCIEERD) in a bid to strengthen and promote the Halal industry in the country through Republic Act (RA) 10817 or the &ldquo;Philippine Halal Export Development and Promotion Act&rdquo;.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp;<img alt=\"\" src=\"/assets/images/5d/5d1f70_HVL.jpg\" style=\"border-style:solid; border-width:3px; float:right; height:300px; margin:8px 3px; width:400px\" /> &nbsp; &nbsp;&ldquo;Establishing the HVL was quite a challenge as these were new testing capabilities that we are unfamiliar with. To do that, the DOST had embarked on international collaboration and benchmarking with ASEAN countries like Malaysia and Singapore,&rdquo; Madrigal disclosed. Madrigal said that after the benchmarking, the DOST undertook major revamps on the line-up of equipment and back into the drawing board of the project implementation extending the timeline to two years to make sure they are doing it properly from the start. &ldquo;The growing demand for Halal certified products worldwide, estimated to rise by USD10 trillion in 2030, is an opportunity for us to showcase our local products in the international trade, more importantly that Halal development programs aim to address Islamic beliefs concerning food and non-food products of the Muslim community,&rdquo; Madrigal added. He assured that the DOST-CALABARZON is committed to spearhead not just in the conduct of quality analytical testing, but also in the noble cause of promoting awareness of Islamic culture. He added that the HVL is more than just complying with Islamic requirements, but more so to enhance camaraderie with the Muslim community to show and nourish respect towards Muslim beliefs. The regional director said that since DOST has already established competence on testing and calibration, it has further strengthened capability offerings of OneLab by crafting policies and programs like the Integrated Halal Science and Technology (S&amp;T) as a program platform that comprehensively provides an avenue for customers to meet their testing needs at a single touch point.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp;<img alt=\"\" src=\"/assets/images/6f/6f018a_HVL2.jpg\" style=\"border-style:solid; border-width:2px; float:left; height:300px; margin:4px 3px; width:400px\" /> &nbsp; &nbsp;He expressed optimism that the HVL will benefit and harmonize the needs among food manufacturers, Muslim consumers and business stakeholders such as the micro, small and medium enterprises (MSMEs). Madrigal and DOST officials also toured the lab facilities through DOST&rsquo;s Science Research Specialist I Jasmin Hamid who briefed Muslim officials Engr. Tana Macalandong of the National Commission on Muslim Filipinos (NCMF); Imam Haj Mohammad Atali, president of the Los Ba&ntilde;os Muslim Community; Sheikh Abdulrafih H. Sayedy, Grand Imam of the Maharlika Village Blue Mosque and Cultural Center and the Islamic Da&rsquo;wah Council of the Philippines (IDCP); and Norhamina E. Masulot, representative of the Mindanao Halal Board. Secretary Jose Maria Nicomedes F. Hernandez, Presidential Adviser for Southern Tagalog and National Economic Development Authority (NEDA) CALABARZON Regional Director Luis Banua also graced the occasion. During the tour, the officials viewed the DOST HVL technologies such as polymerase chain reaction (PCR); liquid chromatography-mass spectrophotometry (LC-MS); gas chromatography/mass spectrometry (GC/MS), ELISA and AAS.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp; &nbsp;Madrigal also assured that the equipment would ensure compliance with global standards while imparting technical knowledge in the conduct of laboratory analyses. PCIEERD through its Executive Director Dr. Carlos Primo C. David also turned over the symbolic key of the HVL to signal the start of the lab operations and received the plaque of appreciation from the DOST Calabarzon for the Halal project&rsquo;s acquisition of &ldquo;the most advance technology in Halal verification methods&rdquo;. (PNA)</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>TV Patrol Southern Tagalog December 11, 2017:</strong></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p class=\'col-lg-12\'><iframe frameborder=\"0\" name=\"TV Patrol December 11, 2017\" scrolling=\"no\" src=\"https://www.youtube.com/embed/zm8rmUpeg2w\"></iframe></p>\r\n',1,'admin','en','blog',0,0,'/assets/images/33/33e654_DOST.jpg','','','https://youtu.be/zm8rmUpeg2w','youtube','DOST opens Halal verification lab in Laguna','ABS-CBN TV Patrol December 11, 2017',NULL,'LOS BAŇOS, Laguna - A Halal Verification Laboratory (HVL) is now open under the Department of Science and Technology (DOST) in CALABARZON region. The Halal verification lab was established through the financial support of the Philippine Council for Industry, Energy and Emerging Technology Research and Development (PCIEERD) in a bid to strengthen and promote the Halal industry in the country through Republic Act (RA) 10817 or the “Philippine Halal Export Development and Promotion Act”.','Halal','index, follow','Admin','DOST',1,1,'2017-12-14 11:03:40',1,'2017-12-16 14:34:24'),(3,1,'Web Application Development Using Yii2 and NodeJS Training','Yii2 Training','<blockquote>\r\n<p style=\"text-align:justify\"><strong>Lahug, Cebu City -&nbsp;</strong>The Department of Science and Technology initiated a YII2 training hosted by DOST Region VII last November 6-13, 2017 and was participated by 16 representatives of DOST nationwide. The training was conducted by <a href=\"https://www.facebook.com/johnrey.goh\" target=\"_blank\"><em><strong>John Rey Goh</strong></em></a> of <strong><a href=\"https://www.facebook.com/pages/CORE360-ITSERVICES/1791917297760349?pnref=about.overview\" target=\"_blank\">Core 360 IT Services</a></strong> this is in lieu with the DOST Training program. An upgrading from Yii1 to Yii2&nbsp; a PHP Framework&nbsp; used by DOST-OneLab Projects. The &nbsp;7-day training held at Department of Science and Technology Region VII, Lahug, Cebu City, is a s<strong><img alt=\"Yii Framework\" src=\"/assets/images/7e/7ee123_yii-framework.png\" style=\"float:left; height:65px; margin:5px; width:300px\" /></strong>uccessful one, it is a tool for&nbsp;fastest development using the PHP framework, The YII stands for (Yes It Is) founded by&nbsp;<strong>Qiang Xue&nbsp;</strong>is an Open-Source, Object Oriented, Component-Based, MVC PHP Web Application Framework. YII is an MVC (Model View Controller) support design pattern for fastest and secured web application.</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n','<blockquote>\r\n<p style=\"text-align:justify\"><strong>Lahug, Cebu City -&nbsp;</strong>The Department of Science and Technology initiated a YII2 training hosted by DOST Region VII last November 6-13, 2017 and was participated by 16 representatives of DOST nationwide. The training was conducted by <a href=\"https://www.facebook.com/johnrey.goh\" target=\"_blank\"><em><strong>John Rey Goh</strong></em></a> of <strong><a href=\"https://www.facebook.com/pages/CORE360-ITSERVICES/1791917297760349?pnref=about.overview\" target=\"_blank\">Core 360 IT Services</a></strong> this is in lieu with the DOST Training program. An upgrading from Yii1 to Yii2&nbsp; a PHP Framework&nbsp; used by DOST-OneLab Projects. The &nbsp;7-day training held at Department of Science and Technology Region VII, Lahug, Cebu City, is a s<strong><img alt=\"Yii Framework\" src=\"/assets/images/7e/7ee123_yii-framework.png\" style=\"float:left; height:65px; margin:5px; width:300px\" /></strong>uccessful one, it is a tool for&nbsp;fastest development using the PHP framework, The YII stands for (Yes It Is) founded by&nbsp;<strong>Qiang Xue&nbsp;</strong>is an Open-Source, Object Oriented, Component-Based, MVC PHP Web Application Framework. YII is an MVC (Model View Controller) support design pattern for fastest and secured web application.</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>The Training covered 10 modules:</p>\r\n\r\n<ul>\r\n	<li><strong>Module 1</strong> - Setting up Composer, Configuration, Classes and Path Aliases</li>\r\n	<li><strong>Module 2&nbsp;</strong>- Console Commands and Applications</li>\r\n	<li><strong>Module 3&nbsp;</strong>- Migrations, DAO and Query Building</li>\r\n	<li><strong>Module 4&nbsp;</strong>- Active Record,&nbsp;Models and Forms</li>\r\n	<li><strong>Module 5</strong> - Modules, Widgets and Helpers</li>\r\n	<li><strong>Module 6</strong> - Asset Management</li>\r\n	<li><strong>Module 7</strong> - Authenticating and Authorizing Users</li>\r\n	<li><strong>Module 8</strong> - Configuring Role-Based Access Control (RBAC)</li>\r\n	<li><strong>Module 9</strong> -&nbsp; Routing, Responses and Events</li>\r\n	<li><strong>Module 10</strong> - RESTful APIs</li>\r\n</ul>\r\n</blockquote>\r\n\r\n<p style=\"text-align:justify\">&nbsp;During the 7-day training, IT participants from selected regional offices were able to understand the importance of a framework&nbsp; in web development as this lessen the need to redo specific modules as they can reuse the code in an entire Software Development Cycle (SDLC).&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/assets/images/d4/d4b19c_23592163-1586556891411808-3666236932472635529-o.jpg\" style=\"float:left; height:300px; width:400px\" /><img alt=\"\" src=\"/assets/images/24/24f109_23511302-1586556971411800-9000386456372212228-o.jpg\" style=\"height:300px; width:400px\" /></p>\r\n\r\n<p>https://www.youtube.com/watch?v=Y4-ax-VVvSk</p>\r\n',1,'public','en','blog',0,0,NULL,'','','','youtube','','',NULL,'','','index, follow','admin','',1,1,'2017-12-16 15:43:20',1,'2018-01-15 14:20:32'),(6,4,'Test Articles','Test Article','<p>fgfgggfgbnbnbnbnb</p>\r\n','<p>ffgggfgfgg</p>\r\n',0,'public','en','blog',0,0,NULL,'','','','youtube','','',NULL,'','','index, follow','Jane','',2,2,'2017-12-16 22:22:26',1,'2017-12-18 09:33:23');

/*Table structure for table `tbl_article_tags` */

DROP TABLE IF EXISTS `tbl_article_tags`;

CREATE TABLE `tbl_article_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_article_tags` */

insert  into `tbl_article_tags`(`id`,`name`,`alias`,`description`,`state`) values (1,'IT','IT Tags','<p>Information and Technology</p>\r\n',1),(2,'Training','Training','<p>Articles related to Trainings</p>\r\n',1),(3,'Seminar','Seminar','<p>Articles related Seminars</p>\r\n',1),(4,'News','News','<p>Article News</p>\r\n',1),(5,'FOS','FOS','<p>Field Operation Services</p>\r\n',1),(6,'PSTC','PSTC','<p>Provincial Science and Technology Center</p>\r\n',1),(7,'Announcement','Announcement','<p>Announcement and important issues</p>\r\n',1),(8,'System Development','System Development','<p>System Development Issues or announcement</p>\r\n',1);

/*Table structure for table `tbl_article_tags_assign` */

DROP TABLE IF EXISTS `tbl_article_tags_assign`;

CREATE TABLE `tbl_article_tags_assign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_article_tags_assign_tag_id` (`tag_id`),
  KEY `index_article_tags_assign_item_id` (`item_id`),
  CONSTRAINT `fk_article_tags_assign_item_id` FOREIGN KEY (`item_id`) REFERENCES `tbl_article_items` (`id`),
  CONSTRAINT `fk_article_tags_assign_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tbl_article_tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=869 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_article_tags_assign` */

insert  into `tbl_article_tags_assign`(`id`,`tag_id`,`item_id`) values (824,4,1),(825,4,1),(826,4,1),(827,4,1),(828,4,1),(829,4,1),(830,4,1),(831,4,1),(832,4,1),(833,4,1),(834,4,1),(835,4,1),(836,4,1),(837,4,1),(838,4,1),(839,4,1),(840,4,1),(841,4,1),(842,4,1),(843,4,1),(844,4,1),(845,4,1),(846,4,1),(847,4,1),(848,4,1),(849,4,1),(850,4,1),(851,4,1),(852,4,1),(853,4,1),(854,4,1),(855,4,1),(856,4,1),(857,4,1),(858,4,1),(859,4,1),(860,4,1),(861,4,1),(862,4,1),(865,4,6),(866,4,6),(867,4,6),(868,4,6);

/*Table structure for table `tbl_auth_assignment` */

DROP TABLE IF EXISTS `tbl_auth_assignment`;

CREATE TABLE `tbl_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_assignment` */

insert  into `tbl_auth_assignment`(`item_name`,`user_id`,`created_at`) values ('Admin Personnel..','3',1502178285),('editor','2',1513439418),('Super-Administrator','1',1501212237);

/*Table structure for table `tbl_auth_item` */

DROP TABLE IF EXISTS `tbl_auth_item`;

CREATE TABLE `tbl_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `tbl_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `tbl_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_item` */

insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/*',2,NULL,NULL,NULL,1501218014,1501218014),('/admin/assignment/*',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/assignment/assign',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/assignment/index',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/assignment/revoke',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/assignment/view',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/default/*',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/default/index',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/menu/*',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/menu/create',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/menu/delete',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/menu/index',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/menu/update',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/menu/view',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/permission/*',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/permission/assign',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/permission/create',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/permission/delete',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/permission/index',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/permission/remove',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/permission/update',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/permission/view',2,NULL,NULL,NULL,1501218012,1501218012),('/admin/role/*',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/role/assign',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/role/create',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/role/delete',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/role/index',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/role/remove',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/role/update',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/role/view',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/route/*',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/route/assign',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/route/create',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/route/index',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/route/refresh',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/route/remove',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/rule/*',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/rule/create',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/rule/delete',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/rule/index',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/rule/update',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/rule/view',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/user/*',2,NULL,NULL,NULL,1501218014,1501218014),('/admin/user/activate',2,NULL,NULL,NULL,1501218014,1501218014),('/admin/user/change-password',2,NULL,NULL,NULL,1501218014,1501218014),('/admin/user/delete',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/user/index',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/user/login',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/user/logout',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/user/reset-password',2,NULL,NULL,NULL,1501218014,1501218014),('/admin/user/signup',2,NULL,NULL,NULL,1501218013,1501218013),('/admin/user/update',2,NULL,NULL,NULL,1501807515,1501807515),('/admin/user/view',2,NULL,NULL,NULL,1501218013,1501218013),('/announcement/*',2,NULL,NULL,NULL,1501807537,1501807537),('/articles/*',2,NULL,NULL,NULL,1512694675,1512694675),('/articles/attachments/*',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/attachments/create',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/attachments/delete',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/attachments/deletemultiple',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/attachments/deleteonfly',2,NULL,NULL,NULL,1513390708,1513390708),('/articles/attachments/index',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/attachments/update',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/attachments/view',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/categories/*',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/categories/activemultiple',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/categories/changestate',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/categories/create',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/categories/deactivemultiple',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/categories/delete',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/categories/deleteimage',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/categories/deletemultiple',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/categories/index',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/categories/update',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/categories/view',2,NULL,NULL,NULL,1512694673,1512694673),('/articles/default/*',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/default/index',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/*',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/activemultiple',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/changestate',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/create',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/deactivemultiple',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/delete',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/deleteimage',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/deletemultiple',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/index',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/update',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/items/view',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/tags/*',2,NULL,NULL,NULL,1512694675,1512694675),('/articles/tags/activemultiple',2,NULL,NULL,NULL,1512694675,1512694675),('/articles/tags/changestate',2,NULL,NULL,NULL,1512694675,1512694675),('/articles/tags/create',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/tags/deactivemultiple',2,NULL,NULL,NULL,1512694675,1512694675),('/articles/tags/delete',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/tags/deletemultiple',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/tags/index',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/tags/update',2,NULL,NULL,NULL,1512694674,1512694674),('/articles/tags/view',2,NULL,NULL,NULL,1512694674,1512694674),('/dashboard/*',2,NULL,NULL,NULL,1513304855,1513304855),('/dashboard/disable',2,NULL,NULL,NULL,1513304855,1513304855),('/dashboard/enable',2,NULL,NULL,NULL,1513304855,1513304855),('/debug/*',2,NULL,NULL,NULL,1501218070,1501218070),('/debug/default/*',2,NULL,NULL,NULL,1501218070,1501218070),('/debug/default/db-explain',2,NULL,NULL,NULL,1501218070,1501218070),('/debug/default/download-mail',2,NULL,NULL,NULL,1501218070,1501218070),('/debug/default/index',2,NULL,NULL,NULL,1501218070,1501218070),('/debug/default/toolbar',2,NULL,NULL,NULL,1501218070,1501218070),('/debug/default/view',2,NULL,NULL,NULL,1501218070,1501218070),('/gii/*',2,NULL,NULL,NULL,1501218070,1501218070),('/gii/default/*',2,NULL,NULL,NULL,1501218070,1501218070),('/gii/default/action',2,NULL,NULL,NULL,1501218070,1501218070),('/gii/default/diff',2,NULL,NULL,NULL,1501218070,1501218070),('/gii/default/index',2,NULL,NULL,NULL,1501218070,1501218070),('/gii/default/preview',2,NULL,NULL,NULL,1501218070,1501218070),('/gii/default/view',2,NULL,NULL,NULL,1501218070,1501218070),('/gridview/*',2,NULL,NULL,NULL,1501807515,1501807515),('/gridview/export/*',2,NULL,NULL,NULL,1501807515,1501807515),('/gridview/export/download',2,NULL,NULL,NULL,1501807515,1501807515),('/help/*',2,NULL,NULL,NULL,1502269524,1502269524),('/help/access',2,NULL,NULL,NULL,1512953618,1512953618),('/help/create',2,NULL,NULL,NULL,1512953618,1512953618),('/help/delete',2,NULL,NULL,NULL,1512953618,1512953618),('/help/index',2,NULL,NULL,NULL,1512953617,1512953617),('/help/manual',2,NULL,NULL,NULL,1512953618,1512953618),('/help/postimage',2,NULL,NULL,NULL,1512953618,1512953618),('/help/search',2,NULL,NULL,NULL,1512953618,1512953618),('/help/show',2,NULL,NULL,NULL,1512953618,1512953618),('/help/update',2,NULL,NULL,NULL,1512953618,1512953618),('/help/view',2,NULL,NULL,NULL,1512953618,1512953618),('/imagemanager/*',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/default/*',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/default/index',2,NULL,NULL,NULL,1512963619,1512963619),('/imagemanager/manager/*',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/manager/crop',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/manager/delete',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/manager/get-original-image',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/manager/index',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/manager/upload',2,NULL,NULL,NULL,1512963620,1512963620),('/imagemanager/manager/view',2,NULL,NULL,NULL,1512963620,1512963620),('/maintenance/*',2,NULL,NULL,NULL,1512954238,1512954238),('/maintenance/maintenance/*',2,NULL,NULL,NULL,1512954238,1512954238),('/maintenance/maintenance/index',2,NULL,NULL,NULL,1512954238,1512954238),('/portal/*',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/about',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/customer',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/index',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/members',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/newsfeed',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/payment',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/referral',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/services',2,NULL,NULL,NULL,1501218070,1501218070),('/portal/support',2,NULL,NULL,NULL,1501218070,1501218070),('/post/*',2,NULL,NULL,NULL,1512542736,1512542736),('/post/create',2,NULL,NULL,NULL,1512542736,1512542736),('/post/delete',2,NULL,NULL,NULL,1512542736,1512542736),('/post/index',2,NULL,NULL,NULL,1512542735,1512542735),('/post/test',2,NULL,NULL,NULL,1513382157,1513382157),('/post/update',2,NULL,NULL,NULL,1512542736,1512542736),('/post/view',2,NULL,NULL,NULL,1512542736,1512542736),('/settings/*',2,NULL,NULL,NULL,1513396443,1513396443),('/settings/disable',2,NULL,NULL,NULL,1513396443,1513396443),('/settings/enable',2,NULL,NULL,NULL,1513396443,1513396443),('/settings/index',2,NULL,NULL,NULL,1513396443,1513396443),('/site/*',2,NULL,NULL,NULL,1502177684,1502177684),('/toplevel/*',2,NULL,NULL,NULL,1505361442,1505361442),('Access-Announcement',2,'This permission allow users to access announcement configuration module',NULL,NULL,1501807313,1508894282),('access-articles',2,'this permission allow users to access articles',NULL,NULL,1513428414,1513428414),('Access-GII',2,'This Permission allow users to view GII Tool',NULL,NULL,1501219266,1501219489),('Access-Image-Manager',2,'This Permission allow users to access Image manager',NULL,NULL,1513673232,1513673232),('Access-RBAC',2,'This permission allowed user to access RBAC',NULL,NULL,1501230603,1501230603),('admin',1,'Can create, publish all, update all, delete all, view and admin grid articles',NULL,NULL,1512694255,1512694255),('Admin Personnel..',1,'Accounting Personnel that will handles operation regarding Finance matter',NULL,NULL,1502178061,1511830698),('Administrator',1,'This is the adminstrator role',NULL,NULL,1501205000,1501205000),('Allow Maintenance',2,'This permission allow users to put the system to maintenance mode',NULL,NULL,1513304921,1513304921),('Allow-System-Settings',2,'This Permission allow users to access System Settings Page',NULL,NULL,1513651012,1513651012),('Articles-Change-State',2,'Allows user to change article State',NULL,NULL,1513411449,1513411449),('articles-create-categories',2,'Can create categories',NULL,NULL,1512694255,1512694255),('articles-create-items',2,'Can create articles',NULL,NULL,1512694255,1512694255),('articles-delete-all-items',2,'Can delete all articles',NULL,NULL,1512694255,1512694255),('articles-delete-categories',2,'Can delete all categories',NULL,NULL,1512694255,1512694255),('articles-delete-his-items',2,'Can delete his articles',NULL,NULL,1512694255,1512694255),('articles-index-all-items',2,'Can view all articles admin grid',NULL,NULL,1512694255,1512694255),('articles-index-categories',2,'Can view categories admin grid',NULL,NULL,1512694255,1512694255),('articles-index-his-items',2,'Can view his articles admin grid',NULL,NULL,1512694255,1512694255),('articles-publish-all-items',2,'Can publish all articles',NULL,NULL,1512694255,1512694255),('articles-publish-categories',2,'Can publish categories',NULL,NULL,1512694255,1512694255),('articles-publish-his-items',2,'Can publish his articles',NULL,NULL,1512694255,1512694255),('articles-update-all-items',2,'Can update all articles',NULL,NULL,1512694255,1512694255),('articles-update-categories',2,'Can update all categories',NULL,NULL,1512694255,1512694255),('articles-update-his-items',2,'Can update his articles',NULL,NULL,1512694255,1512694255),('articles-update-tags',2,'This Permission allow updates on tags',NULL,NULL,1512700161,1512700161),('articles-view-categories',2,'Can view categories',NULL,NULL,1512694255,1512694255),('articles-view-items',2,'Can view articles',NULL,NULL,1512694255,1512694255),('author',1,'Can create and update his articles and view',NULL,NULL,1512694255,1512694255),('Create-Items',1,'This role allow to create new article',NULL,NULL,1512978987,1512978987),('Developer',2,'This permission allows users to access Debug features for system',NULL,NULL,1502238873,1502239274),('editor',1,'Can create, publish all articles, update all articles, delete his articles, view and admin grid articles',NULL,NULL,1512694255,1512694255),('Guest',1,'This the Guest Role and the default role for unregistered users',NULL,NULL,1501205064,1502175279),('ImageManager-DeleteImage',2,'Can Remove/Delete image from Image Manager',NULL,NULL,1512964017,1512964017),('ImageManager-UploadImage',2,'This permission will allow user to upload image',NULL,NULL,1512964474,1512964474),('public',1,'User not Logged',NULL,NULL,1512694255,1512694255),('publisher',1,'Can create, publish his articles, update all articles, view and admin grid his articles',NULL,NULL,1512694255,1512694255),('registered',1,'User Logged',NULL,NULL,1512694255,1512694255),('Super-Administrator',1,'This is the Super Administrator role',NULL,NULL,1501205040,1513411553),('Top Level Personnel',1,'This role can view all data analytics for all the OneLab applications',NULL,NULL,1505361502,1505361502),('Writer',2,'This permission allows user to write post for news feed',NULL,NULL,1512520920,1512520920);

/*Table structure for table `tbl_auth_item_child` */

DROP TABLE IF EXISTS `tbl_auth_item_child`;

CREATE TABLE `tbl_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `tbl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_item_child` */

insert  into `tbl_auth_item_child`(`parent`,`child`) values ('Access-RBAC','/admin/*'),('Super-Administrator','/admin/*'),('Guest','/admin/user/request-password-reset'),('Access-Announcement','/announcement/*'),('articles-delete-all-items','/articles/attachments/deleteonfly'),('articles-delete-his-items','/articles/attachments/deleteonfly'),('articles-create-items','/articles/attachments/index'),('articles-create-items','/articles/attachments/update'),('articles-create-items','/articles/attachments/view'),('articles-create-categories','/articles/categories/create'),('articles-delete-categories','/articles/categories/delete'),('articles-delete-categories','/articles/categories/deleteimage'),('articles-delete-categories','/articles/categories/deletemultiple'),('articles-index-categories','/articles/categories/index'),('articles-update-categories','/articles/categories/index'),('articles-update-categories','/articles/categories/update'),('articles-index-categories','/articles/categories/view'),('articles-update-categories','/articles/categories/view'),('Articles-Change-State','/articles/items/changestate'),('articles-create-items','/articles/items/create'),('Create-Items','/articles/items/create'),('articles-delete-all-items','/articles/items/delete'),('articles-delete-his-items','/articles/items/delete'),('articles-delete-all-items','/articles/items/deleteimage'),('articles-delete-all-items','/articles/items/deletemultiple'),('articles-index-all-items','/articles/items/index'),('articles-index-his-items','/articles/items/index'),('articles-update-all-items','/articles/items/update'),('articles-view-items','/articles/items/update'),('articles-view-items','/articles/items/view'),('Guest','/articles/tags/*'),('articles-update-tags','/articles/tags/index'),('articles-update-tags','/articles/tags/update'),('articles-update-tags','/articles/tags/view'),('Developer','/debug/*'),('Access-GII','/gii/*'),('Guest','/gridview/export/*'),('Guest','/help/*'),('Super-Administrator','/help/*'),('Access-Image-Manager','/imagemanager/default/*'),('Access-Image-Manager','/imagemanager/default/index'),('Access-Image-Manager','/imagemanager/manager/crop'),('ImageManager-DeleteImage','/imagemanager/manager/delete'),('Access-Image-Manager','/imagemanager/manager/get-original-image'),('Access-Image-Manager','/imagemanager/manager/index'),('ImageManager-UploadImage','/imagemanager/manager/upload'),('Access-Image-Manager','/imagemanager/manager/view'),('Guest','/maintenance/*'),('Admin Personnel..','/portal/*'),('Guest','/portal/*'),('Guest','/portal/index'),('Guest','/portal/newsfeed'),('Allow Maintenance','/settings/*'),('Allow-System-Settings','/settings/*'),('Guest','/site/*'),('Super-Administrator','/site/*'),('Top Level Personnel','/toplevel/*'),('Admin Personnel..','Access-Announcement'),('Administrator','Access-Announcement'),('Super-Administrator','Access-Announcement'),('admin','access-articles'),('Administrator','access-articles'),('author','access-articles'),('editor','access-articles'),('publisher','access-articles'),('admin','Access-GII'),('Developer','Access-GII'),('Super-Administrator','Access-GII'),('Administrator','Access-Image-Manager'),('Administrator','Access-RBAC'),('Super-Administrator','Access-RBAC'),('Super-Administrator','Administrator'),('Super-Administrator','Allow Maintenance'),('admin','Allow-System-Settings'),('author','Allow-System-Settings'),('editor','Allow-System-Settings'),('admin','articles-create-categories'),('Administrator','articles-create-categories'),('editor','articles-create-categories'),('admin','articles-create-items'),('Administrator','articles-create-items'),('author','articles-create-items'),('editor','articles-create-items'),('publisher','articles-create-items'),('admin','articles-delete-all-items'),('Administrator','articles-delete-all-items'),('admin','articles-delete-categories'),('Administrator','articles-delete-categories'),('admin','articles-index-all-items'),('Administrator','articles-index-all-items'),('Guest','articles-index-all-items'),('admin','articles-index-categories'),('Administrator','articles-index-categories'),('author','articles-index-categories'),('editor','articles-index-categories'),('publisher','articles-index-categories'),('author','articles-index-his-items'),('editor','articles-index-his-items'),('publisher','articles-index-his-items'),('admin','articles-publish-all-items'),('Administrator','articles-publish-all-items'),('admin','articles-publish-categories'),('Administrator','articles-publish-categories'),('publisher','articles-publish-his-items'),('admin','articles-update-all-items'),('Administrator','articles-update-all-items'),('admin','articles-update-categories'),('Administrator','articles-update-categories'),('editor','articles-update-categories'),('author','articles-update-his-items'),('editor','articles-update-his-items'),('publisher','articles-update-his-items'),('Administrator','articles-update-tags'),('editor','articles-update-tags'),('admin','articles-view-categories'),('Administrator','articles-view-categories'),('author','articles-view-categories'),('publisher','articles-view-categories'),('admin','articles-view-items'),('Administrator','articles-view-items'),('author','articles-view-items'),('editor','articles-view-items'),('Guest','articles-view-items'),('publisher','articles-view-items'),('Super-Administrator','author'),('Super-Administrator','Developer'),('Administrator','ImageManager-DeleteImage'),('editor','ImageManager-DeleteImage'),('Administrator','ImageManager-UploadImage'),('editor','ImageManager-UploadImage'),('Super-Administrator','Top Level Personnel'),('Super-Administrator','Writer');

/*Table structure for table `tbl_auth_rule` */

DROP TABLE IF EXISTS `tbl_auth_rule`;

CREATE TABLE `tbl_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_rule` */

/*Table structure for table `tbl_category` */

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_category` */

insert  into `tbl_category`(`CategoryID`,`Category`) values (1,'Login'),(2,'Permission');

/*Table structure for table `tbl_documentation` */

DROP TABLE IF EXISTS `tbl_documentation`;

CREATE TABLE `tbl_documentation` (
  `DocumentationID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `DocumentContent` text NOT NULL,
  `CategoryID` int(11) NOT NULL,
  PRIMARY KEY (`DocumentationID`),
  KEY `CategoryID` (`CategoryID`),
  CONSTRAINT `tbl_documentation_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `tbl_category` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_documentation` */

insert  into `tbl_documentation`(`DocumentationID`,`Title`,`DocumentContent`,`CategoryID`) values (1,'How to Login','<p><strong>To edit the hosts file follow the instructions below.&nbsp;</strong></p>\r\n\r\n<ol>\r\n	<li>Open notepad as administrator.&nbsp;<br />\r\n	-&nbsp;Windows 7&nbsp;click on your start menu then search for notepad. Right click on notepad and choose run as administrator.<br />\r\n	-&nbsp;Windows 8&nbsp;use your windows key + Q on your keyboard. Search for notepad and then right click on it and choose run as administrator.&nbsp;</li>\r\n	<li>After notepad has opened click on ctrl + O to open a file.&nbsp;</li>\r\n	<li>Next to file name click on the drop down and change the type to Any Files (*).&nbsp;</li>\r\n	<li>Navigate to&nbsp;C:\\Windows\\System32\\Drivers\\etc and open the &quot;hosts&quot; file.&nbsp;</li>\r\n</ol>\r\n\r\n<p><img alt=\"\" src=\"/assets/images/c6/c68cc0_110.jpg\" style=\"float:left; height:150px; width:200px\" /></p>\r\n',2),(2,'Profile','How to update Profile Entry',1);

/*Table structure for table `tbl_highchart_theme_user` */

DROP TABLE IF EXISTS `tbl_highchart_theme_user`;

CREATE TABLE `tbl_highchart_theme_user` (
  `theme_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `highchart_theme_id` int(11) NOT NULL,
  PRIMARY KEY (`theme_user_id`),
  KEY `user_id` (`user_id`),
  KEY `highchart_theme_id` (`highchart_theme_id`),
  CONSTRAINT `tbl_highchart_theme_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `tbl_highchart_theme_user_ibfk_2` FOREIGN KEY (`highchart_theme_id`) REFERENCES `tbl_highchart_themes` (`highchart_theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_highchart_theme_user` */

insert  into `tbl_highchart_theme_user`(`theme_user_id`,`user_id`,`highchart_theme_id`) values (1,1,8);

/*Table structure for table `tbl_highchart_themes` */

DROP TABLE IF EXISTS `tbl_highchart_themes`;

CREATE TABLE `tbl_highchart_themes` (
  `highchart_theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`highchart_theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_highchart_themes` */

insert  into `tbl_highchart_themes`(`highchart_theme_id`,`theme`) values (1,'avocado'),(2,'dark-blue'),(3,'dark-green'),(4,'dark-unica'),(5,'gray'),(6,'grid-light'),(7,'grid'),(8,'sand-signika'),(9,'skies'),(10,'sunset');

/*Table structure for table `tbl_imagemanager` */

DROP TABLE IF EXISTS `tbl_imagemanager`;

CREATE TABLE `tbl_imagemanager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fileName` varchar(128) NOT NULL,
  `fileHash` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `createdBy` int(10) unsigned DEFAULT NULL,
  `modifiedBy` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_imagemanager` */

insert  into `tbl_imagemanager`(`id`,`fileName`,`fileHash`,`created`,`modified`,`createdBy`,`modifiedBy`) values (3,'110.jpg','XaMuJNmqzy79rA5betNIdUJgiA6Dg-cf','2017-12-11 12:02:07','2017-12-11 12:02:07',NULL,NULL),(4,'DOST HVL.jpg','PFcdhq1N_-10BRLl_bfakNmxJJpVeL9y','2017-12-14 13:51:55','2017-12-14 13:51:55',NULL,NULL),(5,'HVL.jpg','y3dS7-4tBAy8c8C5227j8OrA3tdPwpps','2017-12-14 13:53:35','2017-12-14 13:53:35',NULL,NULL),(6,'HVL2.jpg','STxwekWXM3EPhlDuoH8n9ACimpYihVdb','2017-12-14 13:56:42','2017-12-14 13:56:42',NULL,NULL),(7,'DOST HVL_crop_576x768.jpg','dniYytWmj26eed2vcegiJGzBlVRrq8iy','2017-12-14 17:07:05','2017-12-14 17:07:05',NULL,NULL),(8,'23511302-1586556971411800-9000386456372212228-o.jpg','2QdMLjmsw0hCkFhtpvdTHxE8y_LeB4-D','2017-12-19 14:14:35','2017-12-19 14:14:35',NULL,NULL),(9,'23592163-1586556891411808-3666236932472635529-o.jpg','5hPrKQvNt52i5BQ_NuDuC94DznX3nmf3','2017-12-19 14:14:37','2017-12-19 14:14:37',NULL,NULL),(10,'yii-framework.png','sRE026eq94dPdakK6Uf54nRfWqkudNEe','2017-12-19 14:14:37','2017-12-19 14:14:37',NULL,NULL),(17,'yii-framework.png','X6YYWANrI4IRTCPOVbYUAvZiEgHZlc1q','2017-12-20 12:42:02','2017-12-20 12:42:02',NULL,NULL),(18,'doh.png','Ep_mAtESkl4bPtlUO0h-kVwYgErzS5AS','2017-12-20 12:43:35','2017-12-20 12:43:35',NULL,NULL),(19,'WIN-20171113-15-00-12-Pro.jpg','djEU21-QlX8Ycj6CUXj23f7cSXvjl77V','2018-01-11 09:54:23','2018-01-11 09:54:23',NULL,NULL),(20,'WIN-20171113-15-00-12-Pro_crop_457x427.jpg','EbOT85bb7K_RkeAgmIeaZAdj3Z_Or5Ws','2018-01-11 09:55:06','2018-01-11 09:55:06',NULL,NULL);

/*Table structure for table `tbl_membertype` */

DROP TABLE IF EXISTS `tbl_membertype`;

CREATE TABLE `tbl_membertype` (
  `MemberTypeID` int(1) NOT NULL AUTO_INCREMENT,
  `MemberType` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`MemberTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_membertype` */

insert  into `tbl_membertype`(`MemberTypeID`,`MemberType`) values (1,'DOST-RSTL'),(2,'Research and Development Institutes'),(3,'Private Laboratories'),(4,'Other Government Agencies');

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `tbl_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_menu` */

/*Table structure for table `tbl_migration` */

DROP TABLE IF EXISTS `tbl_migration`;

CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_migration` */

insert  into `tbl_migration`(`version`,`apply_time`) values ('m000000_000000_base',1501134820),('m140602_111327_create_menu_table',1501135028),('m151021_200401_create_article_categories_table',1512694242),('m151021_200427_create_article_items_table',1512694247),('m151021_200518_create_article_attachments_table',1512694249),('m151105_204528_create_article_tags_table',1512694255),('m160312_050000_create_user',1501135028),('m160622_085710_create_ImageManager_table',1512963717),('m170223_113221_addBlameableBehavior',1512963719),('m170616_185620_insert_article_data_demo',1512694255),('m170626_185620_insert_article_auth_permissions',1512694255);

/*Table structure for table `tbl_post` */

DROP TABLE IF EXISTS `tbl_post`;

CREATE TABLE `tbl_post` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `PostTitle` varchar(100) NOT NULL,
  `DateCreated` datetime NOT NULL,
  `PostContent` text NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`PostID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `tbl_post_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_post` */

insert  into `tbl_post`(`PostID`,`PostTitle`,`DateCreated`,`PostContent`,`UserID`) values (1,'August-September Activities','2017-12-06 15:00:00','<p style=\"text-align: justify;\">OneLab attends Business Continuity Meeting Phase 1 at Acacia Hotel Alabang, Muntinlupa City last <strong>August 30-Sept 2, 2017</strong></p>\r\n<p>&nbsp;<img src=\"../../images/newsfeed/bcp-1.jpg\" width=\"460\" height=\"345\" /></p>\r\n<p style=\"text-align: justify;\">OneLab Team conducts Year 2 Planning Workshop at FNRI Training Room last <strong>September 11-12, 2017</strong></p>\r\n<p style=\"text-align: justify;\"><img src=\"../../images/newsfeed/y2-planning.jpg\" alt=\"\" width=\"460\" height=\"345\" /></p>\r\n<p style=\"text-align: justify;\">OneLab attends the last leg of Business Continuity Meeting Phase 2 at Acacia Hotel Alabang, Muntinlupa City last <strong>September 13-16, 2017</strong></p>\r\n<p style=\"text-align: justify;\"><strong><img src=\"../../images/newsfeed/continuity.jpg\" alt=\"\" width=\"460\" height=\"345\" /></strong></p>',1);

/*Table structure for table `tbl_posted_info` */

DROP TABLE IF EXISTS `tbl_posted_info`;

CREATE TABLE `tbl_posted_info` (
  `PostedInfoID` int(11) NOT NULL AUTO_INCREMENT,
  `AgencyID` int(11) NOT NULL,
  `PostedDateTime` datetime DEFAULT NULL,
  `PostedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PostedInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_posted_info` */

insert  into `tbl_posted_info`(`PostedInfoID`,`AgencyID`,`PostedDateTime`,`PostedBy`) values (1,1,'2017-09-18 15:13:05','Nolan'),(2,1,'2017-09-19 15:27:43','Nolan');

/*Table structure for table `tbl_profile` */

DROP TABLE IF EXISTS `tbl_profile`;

CREATE TABLE `tbl_profile` (
  `id` int(11) NOT NULL,
  `ProfileID` int(11) NOT NULL AUTO_INCREMENT,
  `AgencyID` int(11) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ProfileID`),
  UNIQUE KEY `fk-profile-user` (`id`),
  KEY `AgencyID` (`AgencyID`),
  CONSTRAINT `fk-profile-user` FOREIGN KEY (`id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_profile_ibfk_1` FOREIGN KEY (`AgencyID`) REFERENCES `tbl_agency` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_profile` */

insert  into `tbl_profile`(`id`,`ProfileID`,`AgencyID`,`LastName`,`FirstName`,`MiddleName`,`Address`) values (1,1,11,'Sunico','Nolan','Francisco','Zamcelco Road, Recodo'),(2,3,11,'Ma. Regina','Sunico','Cabeltes','Zamcelco Road, Recodo');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values (1,'admin','udpHTN8vozaoCdTfBappzI9Q_NNxdf5X','$2y$13$YG/GVTGUiYQiqdEowAsOZuj1zmX.9zUbPMXFgMdgKw8iDNOCNcm96','jFx8-aLB15A1iS3YR0OVrD7w0aR3yn32_1505360897','nolansunico@gmail.com',1,1501135252,1513233409),(2,'Jane','s3NZxQT2zauRNNFzEqNY7WsIPtmTbOzg','$2y$13$VLXGDPr964dAKoDV16a65u2xyhyfCtNZzfJxQiVwXN6qORIWeIWb2',NULL,'janesunico2015@gmail.com',1,1501229758,1501229758);

/* Procedure structure for procedure `spGenerateRSTL` */

/*!50003 DROP PROCEDURE IF EXISTS  `spGenerateRSTL` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spGenerateRSTL`(
	RegionID int(11))
    READS SQL DATA
BEGIN
	-- Stored Prodecure created by Eng'r Nolan F. Sunico
	-- October 26, 2017 10:57 AM
	-- This Procedure generates RSTL by Region
	if RegionID=0 then
	   (SELECT 0 AS `id`, 'All Agencies' AS `name`) UNION ALL 
	   (SELECT -1 AS `id`, 'Summary' AS `name`) UNION ALL 
           (SELECT `id`, `name` FROM `tbl_agency` 
            ORDER BY `ordernumber`);
        elseif RegionID=-1 then
           (SELECT -1 AS `id`, 'All Agencies' AS `name`);
        else
           (SELECT 0 AS `id`, 'All Agencies' AS `name`) UNION ALL 
           (SELECT -1 AS `id`, 'Summary' AS `name`) UNION ALL 
           (SELECT `id`, `name` FROM `tbl_agency` 
           WHERE `region_id`=RegionID ORDER BY `ordernumber`);
        end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `spGenerateYears` */

/*!50003 DROP PROCEDURE IF EXISTS  `spGenerateYears` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spGenerateYears`(
	StartYear int(11),
	EndYear int(11))
    MODIFIES SQL DATA
BEGIN
	-- Stored Prodecure created by Eng'r Nolan F. Sunico
	-- October 26, 2017 10:15 AM
	-- This Procedure generates Years
	-- Declaration Variables
	DECLARE ExitLoop TINYINT DEFAULT 0;
	DECLARE counter INT(11); -- Use in Details Iteration
	-- Drop Table if Exist
	drop table if exists `tmp_year`;
	-- Create the Temporary Table
	CREATE temporary TABLE `tmp_year` (
	   `ID` int(11) NOT NULL AUTO_INCREMENT,
	   `Year` int(11),
	   PRIMARY KEY (`id`)
	)ENGINE=memory;
	-- Set Init Counter to StartYear
	set counter=StartYear;
	-- Loop through Input Variables
	StartLoop: LOOP
	   IF counter>=EndYear THEN
	      LEAVE StartLoop;
	   END IF;
	   -- Insert Years	
	   insert into tmp_year(`year`) 
	   values (counter);
	   SET counter=counter +1; -- Increment counter variable
        END LOOP StartLoop;
        -- Return Rows
        select `ID`, `Year` from `tmp_year` order by `Year`;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `spRSTLPosting` */

/*!50003 DROP PROCEDURE IF EXISTS  `spRSTLPosting` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spRSTLPosting`()
    MODIFIES SQL DATA
BEGIN
	-- Procedure created by: Nolan Sunico
	-- September 19, 2017 - 3:15 PM
	-- This procedure gets info of postings
	SELECT `name` AS Agency, cast(MAX(IFNULL(`PostedDateTime`, NULL)) as datetime ) AS `PostedDateTime`, `PostedBy` 
	FROM `tbl_agency` LEFT JOIN `tbl_posted_info` ON(`tbl_posted_info`.`AgencyID`=`tbl_agency`.`id`) 
	WHERE `tbl_agency`.`activated`=1 and (`PostedDateTime`<=now() OR IFNULL(`PostedDateTime`,'0000-00-00')='0000-00-00')
	GROUP BY `id` order by `ordernumber`;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
