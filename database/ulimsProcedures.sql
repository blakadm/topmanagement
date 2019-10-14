/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.16-log : Database - ulimslab
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `ulimslab`;

/* Function  structure for function  `fnGetBarangayName` */

/*!50003 DROP FUNCTION IF EXISTS `fnGetBarangayName` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `fnGetBarangayName`(BarangayID int(11)) RETURNS varchar(250) CHARSET utf8
    READS SQL DATA
BEGIN
	-- Function created by Eng'r Nolan Sunico
	-- Created: September 27, 2017 - 11:46 AM
	-- this function gets the barangay name from 
	-- customer's `barangay_id`
	declare BarangayName varchar(50);
	-- query
	select `name` into BarangayName 
	from `phaddress`.`barangay`
	where `phaddress`.`barangay`.`id`=BarangayID;
	-- return 
	return ifnull(BarangayName,'');
    END */$$
DELIMITER ;

/* Function  structure for function  `fnGetMunicipalityName` */

/*!50003 DROP FUNCTION IF EXISTS `fnGetMunicipalityName` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `fnGetMunicipalityName`(MunicipalityID int(11)) RETURNS varchar(250) CHARSET utf8
    READS SQL DATA
BEGIN
	-- Function created by Eng'r Nolan Sunico
	-- Created: September 27, 2017 - 11:46 AM
	-- this function gets the Municipality name from 
	-- customer's `municipalitycity_id`
	declare MunicipalityName varchar(50);
	-- query
	select `name` into MunicipalityName 
	from `phaddress`.`municipality_city`
	where `phaddress`.`municipality_city`.`id`=MunicipalityID;
	-- return 
	return ifnull(MunicipalityName,'');
    END */$$
DELIMITER ;

/* Function  structure for function  `fnGetProvinceCode` */

/*!50003 DROP FUNCTION IF EXISTS `fnGetProvinceCode` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `fnGetProvinceCode`(MunicipalityID int(11)) RETURNS varchar(10) CHARSET utf8
    READS SQL DATA
BEGIN
	-- Function created by Eng'r Nolan Sunico
	-- Created: September 27, 2017 - 11:46 AM
	-- this function gets the province name from 
	-- customer's `municipalitycity_id`
	declare ProvCode varchar(10);
	-- query
	select `phaddress`.`province`.`code` into ProvCode 
	from `phaddress`.`province` 
	inner join `phaddress`.`municipality_city` on(`phaddress`.`municipality_city`.`provinceId`=`phaddress`.`province`.`id`)
	where `phaddress`.`municipality_city`.`id`=MunicipalityID;
	-- return 
	return ifnull(ProvCode,'');
    END */$$
DELIMITER ;

/* Function  structure for function  `fnGetProvinceID` */

/*!50003 DROP FUNCTION IF EXISTS `fnGetProvinceID` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `fnGetProvinceID`(MunicipalityID int(11)) RETURNS int(11)
    READS SQL DATA
BEGIN
	-- Function created by Eng'r Nolan Sunico
	-- Created: September 27, 2017 - 11:46 AM
	-- this function gets the provinceid from 
	-- customer's `municipalitycity_id`
	declare ProvID int(11);
	-- query
	select `provinceId` into ProvID 
	from `phaddress`.`municipality_city` 
	where `phaddress`.`municipality_city`.`id`=MunicipalityID;
	-- return 
	return ifnull(ProvID,0);
    END */$$
DELIMITER ;

/* Function  structure for function  `fnGetProvinceName` */

/*!50003 DROP FUNCTION IF EXISTS `fnGetProvinceName` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `fnGetProvinceName`(MunicipalityID int(11)) RETURNS varchar(50) CHARSET utf8
    READS SQL DATA
BEGIN
	-- Function created by Eng'r Nolan Sunico
	-- Created: September 27, 2017 - 11:46 AM
	-- this function gets the province name from 
	-- customer's `municipalitycity_id`
	declare ProvName varchar(50);
	-- query
	select `phaddress`.`province`.`name` into ProvName 
	from `phaddress`.`province` 
	inner join `phaddress`.`municipality_city` on(`phaddress`.`municipality_city`.`provinceId`=`phaddress`.`province`.`id`)
	where `phaddress`.`municipality_city`.`id`=MunicipalityID;
	-- return 
	return ifnull(ProvName,'');
    END */$$
DELIMITER ;

/* Function  structure for function  `fnGetRegionCode` */

/*!50003 DROP FUNCTION IF EXISTS `fnGetRegionCode` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `fnGetRegionCode`(RegionID int(11)) RETURNS varchar(20) CHARSET utf8
    READS SQL DATA
BEGIN
	-- Function created by Eng'r Nolan Sunico
	-- Created: September 27, 2017 - 11:46 AM
	-- this function gets the Municipality name from 
	-- customer's `municipalitycity_id`
	declare RegionCode varchar(20);
	-- query
	select `code` into RegionCode 
	from `phaddress`.`region` 
	where `phaddress`.`region`.`id`=RegionID;
	-- return 
	return ifnull(RegionCode,'');
    END */$$
DELIMITER ;

/* Function  structure for function  `fnGetRegionName` */

/*!50003 DROP FUNCTION IF EXISTS `fnGetRegionName` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `fnGetRegionName`(RegionID int(11)) RETURNS varchar(200) CHARSET utf8
    READS SQL DATA
BEGIN
	-- Function created by Eng'r Nolan Sunico
	-- Created: September 27, 2017 - 11:46 AM
	-- this function gets the Municipality name from 
	-- customer's `municipalitycity_id`
	declare RegionName varchar(200);
	-- query
	select `name` into RegionName 
	from `phaddress`.`region` 
	where `phaddress`.`region`.`id`=RegionID;
	-- return 
	return ifnull(RegionName,'');
    END */$$
DELIMITER ;

/* Procedure structure for procedure `spGetCustomerHasBeenSync` */

/*!50003 DROP PROCEDURE IF EXISTS  `spGetCustomerHasBeenSync` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spGetCustomerHasBeenSync`()
    READS SQL DATA
BEGIN
	-- This Procedure will get the number of customers who 
	-- already have been sync
	SELECT COUNT(*) AS HasSync
	FROM `customer` 
	WHERE (`customerCode`<>'' OR `customerCode` <>NULL)
	AND `customer`.`id` IN (SELECT `customerId` FROM `request`);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `spGetCustomerNoTransactions` */

/*!50003 DROP PROCEDURE IF EXISTS  `spGetCustomerNoTransactions` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spGetCustomerNoTransactions`()
    READS SQL DATA
BEGIN
	-- This Procedure will get the number of customers who has no
	-- transaction for Customer Portal Synchronization
	SELECT COUNT(*) AS NoTrans 
	FROM `customer` 
	WHERE (`customerCode`='' OR `customerCode` =NULL)
	AND `customer`.`id` NOT IN (SELECT `customerId` FROM `request`);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `spGetCustomers` */

/*!50003 DROP PROCEDURE IF EXISTS  `spGetCustomers` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spGetCustomers`(
	RSTLID int(11),
	IncludeAll tinyint(1))
    READS SQL DATA
BEGIN
	-- Procedure created by: Nolan Sunico 9/8/2017
	-- This Procedure will get List of Customers
	if IncludeAll=1 then
	    select `customer`.`id` AS customer_id,`customerCode`,`customerName`,`head` as agencyHead,
	    `customer`.`rstl_id`,`rstl`.`region_id` as `region_id`,`barangay_id`,
	    fnGetProvinceID(`municipalitycity_id`) as `province_id`,`municipalityCity_id`,
	    fnGetBarangayName(`barangay_id`) as barangay_name, 
	    fnGetMunicipalityName(`municipalityCity_id`) as municipality,
	    fnGetRegionCode(`ulimsportal`.`rstl`.`region_id`) as region_code, 
	    fnGetRegionName(`ulimsportal`.`rstl`.`region_id`) as region_name, 
	    fnGetProvinceCode(`municipalitycity_id`) as province_code, 
	    fnGetProvinceName(`municipalitycity_id`) as province_name,
	    address as `houseNumber`,`tel`,`fax`,`email`,`typeId` as `type_id`,`natureId` as `nature_id`,
	    `industryId` as `industry_id`
	    from `customer` inner join `ulimsportal`.`rstl` on(`ulimsportal`.`rstl`.`id`=`customer`.`rstl_id`)
	    where `customer`.`rstl_id`=RSTLID AND `customer`.`id` IN (SELECT `customerId` FROM `request`)
	    order by `customerName`;
	else -- Select Customer that have only Transasctions
	    SELECT `customer`.`id` AS customer_id,`customerCode`,`customerName`,`head` AS agencyHead,
	    `customer`.`rstl_id`,`rstl`.`region_id` AS `region_id`,`barangay_id`,
	    fnGetProvinceID(`municipalitycity_id`) AS `province_id`,`municipalityCity_id`,
	    fnGetBarangayName(`barangay_id`) AS barangay_name, 
	    fnGetMunicipalityName(`municipalityCity_id`) AS municipality,
	    fnGetRegionCode(`ulimsportal`.`rstl`.`region_id`) AS region_code, 
	    fnGetRegionName(`ulimsportal`.`rstl`.`region_id`) AS region_name, 
	    fnGetProvinceCode(`municipalitycity_id`) AS province_code, 
	    fnGetProvinceName(`municipalitycity_id`) AS province_name,
	    address AS `houseNumber`,`tel`,`fax`,`email`,`typeId` AS `type_id`,`natureId` AS `nature_id`,
	    `industryId` AS `industry_id`
	    FROM `customer` INNER JOIN `ulimsportal`.`rstl` ON(`ulimsportal`.`rstl`.`id`=`customer`.`rstl_id`)
	    WHERE `customer`.`rstl_id`=RSTLID and `customerCode`='' 
	    and `customer`.`id` IN (SELECT `customerId` FROM `request`)
	    ORDER BY `customerName`;
	end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `spGetPendingSynch` */

/*!50003 DROP PROCEDURE IF EXISTS  `spGetPendingSynch` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spGetPendingSynch`()
    READS SQL DATA
BEGIN
	-- This Procedure will get the number of customers who has not yet 
	-- synchronized to API Portal
	SELECT distinctrow COUNT(*) AS PendingSynch 
	FROM `customer` 
	WHERE (`customerCode`='' OR `customerCode` =NULL)
	AND `customer`.`id` IN (SELECT `customerId` FROM `request`);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `spGetRequests` */

/*!50003 DROP PROCEDURE IF EXISTS  `spGetRequests` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `spGetRequests`(
	RSTLID INT(11))
    READS SQL DATA
BEGIN
	-- Procedure created by: Eng'r Nolan F. Sunico
	-- October 13, 2017 11:34 AM 
	-- This Procedure will Record from `request` table
	-- from Local ULIMS
	select `request`.`id` as OrigRequestID, `request`.`rstl_id` as RSTLID, `labId` as `LabID`, `requestRefNum` as `RequestRefNumber`, 
		STR_TO_DATE(CONCAT(`requestDate`,' ',STR_TO_DATE(`requestTime`, '%h:%i %p')),'%Y-%m-%d %H:%i') as `RequestDateTime`, 
		`CustomerCode`,`paymentType` as `PaymentTypeID`, `modeofreleaseId` as `ModeOfReleaseID`, `discount` as `DiscountID`, 
		`purposeId` as `PurposeID`, `total` as `Total`, `cancelled` as Cancelled, `completed` as Completed 
	from `request` inner join `customer` on(`customer`.`id`=`request`.`customerId`)
	WHERE `request`.`rstl_id`=RSTLID and `posted`=0;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
