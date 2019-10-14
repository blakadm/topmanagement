-- SELECT SUM(`tbl_analysis`.`Fee`-(`tbl_analysis`.`Fee`*(`tbl_discount`.`Rate`/100))) 
-- SELECT SUM(`tbl_analysis`.`Fee`*(`tbl_discount`.`Rate`/100))
SELECT SUM(`tbl_analysis`.`Fee`)
	FROM `tbl_request` INNER JOIN `tbl_samples` ON(`tbl_samples`.`Request_ID`=`tbl_request`.`Request_ID`) 
	INNER JOIN `tbl_analysis` ON(`tbl_analysis`.`Sample_ID`=`tbl_samples`.`Sample_ID`) 
	INNER JOIN `tbl_discount` ON(`tbl_discount`.`DiscountID`=`tbl_request`.`DiscountID`)
	WHERE `tbl_request`.`RSTLID`=11 AND YEAR(`RequestDateTime`)=2013 -- and `tbl_request`.`PaymentTypeID`=1
	AND `tbl_request`.`Cancelled`=0 AND `Deleted`=0 AND `tbl_analysis`.`Cancelled`=0
	AND `tbl_samples`.`Cancelled`=0 AND tbl_analysis.`Package` != 2;