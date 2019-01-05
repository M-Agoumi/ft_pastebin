<?php
	//create users table
	$query="CREATE TABLE `rush`.`users` ( `userId` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `level` TINYINT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`userId`)) ENGINE = InnoDB;";
