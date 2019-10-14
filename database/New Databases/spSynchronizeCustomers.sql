DELIMITER $$

USE `api.onelab.gov.ph`$$

DROP PROCEDURE IF EXISTS `spSynchronizeCustomers`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spSynchronizeCustomers`()
    MODIFIES SQL DATA
BEGIN
	-- Stored Prodecure created by Eng'r Nolan F. Sunico
	-- May 03, 2018 3:36 PM
	-- This Procedure will synchronize customer from ULIMS to API
	SET FOREIGN_KEY_CHECKS=0;
	INSERT INTO `tbl_customer`(`customer_code`,`agency_id`,`OrigCustomerID`,`customer_name`,
		`head`,`municipalitycity_id`,`barangay_id`,`district`,`address`,`tel`,`fax`,`email`,
		`customer_type_id`,`business_nature_id`,`industrytype_id`,`created_at`)
	SELECT CONCAT(LPAD(`rstl_id`,2,'0'),'-',LPAD(`id`,6,'0')), `rstl_id`,`id`,`customerName`,`head`,
		`municipalitycity_id`,`barangay_id`,`district`,`address`,`tel`,`fax`,`email`,
		`typeId`,`natureId`,`industryId`,`created` 
	FROM `ulimslab`.`customer`;
	SET FOREIGN_KEY_CHECKS=1;
    END$$

DELIMITER ;