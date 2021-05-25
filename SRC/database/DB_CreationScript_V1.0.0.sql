-- MySQL Script generated by MySQL Workbench
-- Mon May 10 16:23:24 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema elan
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `elan` ;

-- -----------------------------------------------------
-- Schema elan
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `elan` DEFAULT CHARACTER SET utf8 ;
USE `elan` ;

-- -----------------------------------------------------
-- Table `elan`.`Roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueRoles` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(20) NOT NULL,
  `lastname` VARCHAR(20) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(70) NOT NULL,
  `Roles_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Users_Roles1_idx` (`Roles_id` ASC) VISIBLE,
  UNIQUE INDEX `UniqueUsers` (`username` ASC) VISIBLE,
  CONSTRAINT `fk_Users_Roles1`
    FOREIGN KEY (`Roles_id`)
    REFERENCES `elan`.`Roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Stats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Stats` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Type` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueStats` (`Type` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Lans`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Lans` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT(500) NULL,
  `places` INT NOT NULL,
  `start` DATETIME NOT NULL,
  `end` DATETIME NOT NULL,
  `Stats_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueLans` (`name` ASC) VISIBLE,
  INDEX `fk_Lans_Stats1_idx` (`Stats_id` ASC) VISIBLE,
  CONSTRAINT `fk_Lans_Stats1`
    FOREIGN KEY (`Stats_id`)
    REFERENCES `elan`.`Stats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Locations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Locations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `Adress` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueLocations` (`Name` ASC, `Adress` ASC) INVISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Events` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(250) NULL,
  `type` VARCHAR(45) NOT NULL,
  `start` DATETIME NOT NULL,
  `end` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Teams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Teams` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `abbreviation` VARCHAR(5) NOT NULL,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueTeams` (`name` ASC) VISIBLE,
  INDEX `fk_Teams_Users1_idx` (`Users_id` ASC) VISIBLE,
  CONSTRAINT `fk_Teams_Users1`
    FOREIGN KEY (`Users_id`)
    REFERENCES `elan`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Tournaments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Tournaments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `game` VARCHAR(45) NOT NULL,
  `max_teams` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Matches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Matches` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `start` DATETIME NOT NULL,
  `end` DATETIME NOT NULL,
  `match_number` INT NOT NULL,
  `score_team1` INT NOT NULL,
  `score_team2` INT NOT NULL,
  `Teams_id` INT NOT NULL,
  `Teams_id1` INT NOT NULL,
  `Tournaments_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Matches_Teams_idx` (`Teams_id` ASC) VISIBLE,
  INDEX `fk_Matches_Teams1_idx` (`Teams_id1` ASC) INVISIBLE,
  INDEX `fk_Matches_Tournaments1_idx` (`Tournaments_id` ASC) VISIBLE,
  UNIQUE INDEX `UniqueMatches` (`match_number` ASC) VISIBLE,
  CONSTRAINT `fk_Matches_Teams`
    FOREIGN KEY (`Teams_id`)
    REFERENCES `elan`.`Teams` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Matches_Teams1`
    FOREIGN KEY (`Teams_id1`)
    REFERENCES `elan`.`Teams` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Matches_Tournaments1`
    FOREIGN KEY (`Tournaments_id`)
    REFERENCES `elan`.`Tournaments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Tournaments_has_Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Tournaments_has_Events` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Tournament_id` INT NOT NULL,
  `Event_id` INT NOT NULL,
  INDEX `fk_Tournaments_has_Events_Events1_idx` (`Event_id` ASC) VISIBLE,
  INDEX `fk_Tournaments_has_Events_Tournaments1_idx` (`Tournament_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Tournaments_has_Events_Tournaments1`
    FOREIGN KEY (`Tournament_id`)
    REFERENCES `elan`.`Tournaments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tournaments_has_Events_Events1`
    FOREIGN KEY (`Event_id`)
    REFERENCES `elan`.`Events` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Events_has_Lans`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Events_has_Lans` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Event_id` INT NOT NULL,
  `Lan_id` INT NOT NULL,
  INDEX `fk_Events_has_Lans_Lans1_idx` (`Lan_id` ASC) VISIBLE,
  INDEX `fk_Events_has_Lans_Events1_idx` (`Event_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Events_has_Lans_Events1`
    FOREIGN KEY (`Event_id`)
    REFERENCES `elan`.`Events` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Events_has_Lans_Lans1`
    FOREIGN KEY (`Lan_id`)
    REFERENCES `elan`.`Lans` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Tournaments_has_Teams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Tournaments_has_Teams` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Tournament_id` INT NOT NULL,
  `Team_id` INT NOT NULL,
  INDEX `fk_Tournaments_has_Teams_Teams1_idx` (`Team_id` ASC) VISIBLE,
  INDEX `fk_Tournaments_has_Teams_Tournaments1_idx` (`Tournament_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Tournaments_has_Teams_Tournaments1`
    FOREIGN KEY (`Tournament_id`)
    REFERENCES `elan`.`Tournaments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tournaments_has_Teams_Teams1`
    FOREIGN KEY (`Team_id`)
    REFERENCES `elan`.`Teams` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Events_has_Locations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Events_has_Locations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Event_id` INT NOT NULL,
  `Location_id` INT NOT NULL,
  INDEX `fk_Events_has_Locations_Locations1_idx` (`Location_id` ASC) VISIBLE,
  INDEX `fk_Events_has_Locations_Events1_idx` (`Event_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Events_has_Locations_Events1`
    FOREIGN KEY (`Event_id`)
    REFERENCES `elan`.`Events` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Events_has_Locations_Locations1`
    FOREIGN KEY (`Location_id`)
    REFERENCES `elan`.`Locations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Events_has_Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Events_has_Users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Event_id` INT NOT NULL,
  `User_id` INT NOT NULL,
  INDEX `fk_Events_has_Users_Users1_idx` (`User_id` ASC) VISIBLE,
  INDEX `fk_Events_has_Users_Events1_idx` (`Event_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Events_has_Users_Events1`
    FOREIGN KEY (`Event_id`)
    REFERENCES `elan`.`Events` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Events_has_Users_Users1`
    FOREIGN KEY (`User_id`)
    REFERENCES `elan`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `elan`.`Teams_has_Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `elan`.`Teams_has_Users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Team_id` INT NOT NULL,
  `User_id` INT NOT NULL,
  INDEX `fk_Teams_has_Users_Users1_idx` (`User_id` ASC) VISIBLE,
  INDEX `fk_Teams_has_Users_Teams1_idx` (`Team_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Teams_has_Users_Teams1`
    FOREIGN KEY (`Team_id`)
    REFERENCES `elan`.`Teams` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Teams_has_Users_Users1`
    FOREIGN KEY (`User_id`)
    REFERENCES `elan`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
