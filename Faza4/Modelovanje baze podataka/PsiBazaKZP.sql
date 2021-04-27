-- MySQL Workbench Synchronization
-- Generated: 2021-04-27 19:20
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Tina

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `psitest`.`Admin` 
DROP FOREIGN KEY `fk_Admin_User1`;

ALTER TABLE `psitest`.`Moderator` 
DROP FOREIGN KEY `fk_Moderator_User1`;

ALTER TABLE `psitest`.`Admin` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `User_User_id` `User_User_id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD INDEX `fk_Admin_User1_idx` (`User_User_id` ASC) VISIBLE,
DROP INDEX `fk_Admin_User1_idx` ;
;

ALTER TABLE `psitest`.`Moderator` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `Moderator_dateRegister` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `User_User_id`,
CHANGE COLUMN `Moderator_contact` `Moderator_contact` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `Moderator_email` `Moderator_email` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `Moderator_dateOfBirth` `Moderator_dateOfBirth` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `User_User_id` `User_User_id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD INDEX `fk_Moderator_Complex1_idx` (`Complex_Complex_id` ASC) VISIBLE,
DROP INDEX `fk_Moderator_Complex1_idx` ;
;

ALTER TABLE `psitest`.`Customer` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `Customer_dateRegister` DATETIME NULL DEFAULT CURRENT_TIMESTAMP AFTER `User_User_id`,
CHANGE COLUMN `Customer_contact` `Customer_contact` VARCHAR(45) NOT NULL ,
ADD INDEX `fk_Customer_User1_idx` (`User_User_id` ASC) VISIBLE,
DROP INDEX `fk_Customer_User1_idx` ;
;

ALTER TABLE `psitest`.`Court` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `Court_averageRating` `Court_averageRating` REAL NULL DEFAULT 0 ,
ADD INDEX `fk_Court_Complex_idx` (`Complex_Complex_id` ASC) VISIBLE,
ADD INDEX `fk_Court_Category1_idx` (`Category_Category_id` ASC) VISIBLE,
ADD INDEX `fk_Court_Reservation1_idx` (`Reservation_Reservation_id` ASC) VISIBLE,
DROP INDEX `fk_Court_Reservation1_idx` ,
DROP INDEX `fk_Court_Category1_idx` ,
DROP INDEX `fk_Court_Complex_idx` ;
;

ALTER TABLE `psitest`.`Complex` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `Complex_averageRating` `Complex_averageRating` VARCHAR(45) NOT NULL ;

ALTER TABLE `psitest`.`Working_Hours` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `Working_Hours_day` `Working_Hours_day` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `Working_Hours_openHour` `Working_Hours_openHour` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `Working_Hours_closeHour` `Working_Hours_closeHour` VARCHAR(45) NOT NULL ,
ADD INDEX `fk_Working_Hours_Complex1_idx` (`Complex_Complex_id` ASC) VISIBLE,
DROP INDEX `fk_Working_Hours_Complex1_idx` ;
;

ALTER TABLE `psitest`.`Reservation` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD COLUMN `Reservation_dateOfReservation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `Customer_Customer_id`,
CHANGE COLUMN `Reservation_id` `Reservation_id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD INDEX `fk_Reservation_Customer1_idx` (`Customer_Customer_id` ASC) VISIBLE,
DROP INDEX `fk_Reservation_Customer1_idx` ;
;

ALTER TABLE `psitest`.`Category` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `Category_type` `Category_type` VARCHAR(45) NOT NULL ;

ALTER TABLE `psitest`.`Appointment` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `Termin_date` `Termin_date` VARCHAR(45) NOT NULL ,
ADD INDEX `fk_Termin_Reservation1_idx` (`Reservation_Reservation_id` ASC) VISIBLE,
DROP INDEX `fk_Termin_Reservation1_idx` ;
;

ALTER TABLE `psitest`.`User` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
CHANGE COLUMN `User_id` `User_id` INT(11) NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `User_username` `User_username` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `Users_password` `Users_password` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `User_name` `User_name` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `Users_surname` `Users_surname` VARCHAR(45) NOT NULL ;

ALTER TABLE `psitest`.`Admin` 
ADD CONSTRAINT `fk_Admin_User1`
  FOREIGN KEY (`User_User_id`)
  REFERENCES `psitest`.`User` (`User_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `psitest`.`Moderator` 
ADD CONSTRAINT `fk_Moderator_User1`
  FOREIGN KEY (`User_User_id`)
  REFERENCES `psitest`.`User` (`User_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
