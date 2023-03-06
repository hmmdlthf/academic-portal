-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema student_management_database2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema student_management_database2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `student_management_database2` DEFAULT CHARACTER SET utf8 ;
USE `student_management_database2` ;

-- -----------------------------------------------------
-- Table `student_management_database2`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`admin` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(80) NOT NULL,
  `lname` VARCHAR(80) NULL,
  `email` VARCHAR(255) NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NULL,
  `unique_id` VARCHAR(255) NOT NULL,
  `no_attempts` INT NULL DEFAULT 0,
  `last_login` DATETIME NULL,
  PRIMARY KEY (`id`, `unique_id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  UNIQUE INDEX `unique_id_UNIQUE` (`unique_id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`country`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`country` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`state`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`state` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`state` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `country_id` INT NOT NULL,
  PRIMARY KEY (`id`, `country_id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE,
  INDEX `fk_state_country1_idx` (`country_id` ASC) VISIBLE,
  CONSTRAINT `fk_state_country1`
    FOREIGN KEY (`country_id`)
    REFERENCES `student_management_database2`.`country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`city` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`city` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `state_id` INT NOT NULL,
  `state_country_id` INT NOT NULL,
  PRIMARY KEY (`id`, `state_id`, `state_country_id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE,
  INDEX `fk_city_state1_idx` (`state_id` ASC, `state_country_id` ASC) VISIBLE,
  CONSTRAINT `fk_city_state1`
    FOREIGN KEY (`state_id` , `state_country_id`)
    REFERENCES `student_management_database2`.`state` (`id` , `country_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`officer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`officer` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`officer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(80) NULL,
  `lname` VARCHAR(80) NULL,
  `email` VARCHAR(80) NOT NULL,
  `username` VARCHAR(80) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NULL,
  `unique_id` VARCHAR(255) NOT NULL,
  `is_verified` TINYINT NOT NULL DEFAULT 0,
  `no_attempts` INT NULL DEFAULT 0,
  `last_login` DATETIME NULL,
  `created_date` DATETIME NOT NULL,
  `address` TEXT NULL,
  `phone` INT NULL,
  `nic` VARCHAR(15) NULL,
  `title` VARCHAR(5) NULL,
  `dob` DATE NULL,
  `gender` ENUM('m', 'f') NULL,
  `marital_status` TINYINT NULL,
  `city_id` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  UNIQUE INDEX `unique_id_UNIQUE` (`unique_id` ASC) VISIBLE,
  UNIQUE INDEX `nic_UNIQUE` (`nic` ASC) VISIBLE,
  INDEX `fk_officer_city1_idx` (`city_id` ASC) VISIBLE,
  CONSTRAINT `fk_officer_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `student_management_database2`.`city` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`grade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`grade` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`grade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`student` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`student` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(80) NULL,
  `lname` VARCHAR(80) NULL,
  `email` VARCHAR(80) NOT NULL,
  `username` VARCHAR(80) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `nic` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  `token` VARCHAR(255) NULL,
  `unique_id` VARCHAR(255) NOT NULL,
  `no_attemps` INT NULL DEFAULT 0,
  `last_login` DATETIME NULL,
  `is_verified` TINYINT NOT NULL DEFAULT 0,
  `created_date` DATETIME NOT NULL,
  `phone` INT NULL,
  `title` VARCHAR(5) NULL,
  `dob` DATE NULL,
  `gender` ENUM('m', 'f') NULL,
  `marital_status` TINYINT NULL,
  `officer_id` INT NOT NULL,
  `grade_id` INT NOT NULL,
  `city_id` INT NULL,
  PRIMARY KEY (`id`, `officer_id`, `grade_id`),
  INDEX `fk_student_officer_idx` (`officer_id` ASC) VISIBLE,
  INDEX `fk_student_grade1_idx` (`grade_id` ASC) VISIBLE,
  INDEX `fk_student_city1_idx` (`city_id` ASC) VISIBLE,
  CONSTRAINT `fk_student_officer`
    FOREIGN KEY (`officer_id`)
    REFERENCES `student_management_database2`.`officer` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_grade1`
    FOREIGN KEY (`grade_id`)
    REFERENCES `student_management_database2`.`grade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `student_management_database2`.`city` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '			';


-- -----------------------------------------------------
-- Table `student_management_database2`.`teacher`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`teacher` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`teacher` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(80) NULL,
  `lname` VARCHAR(80) NULL,
  `email` VARCHAR(80) NOT NULL,
  `username` VARCHAR(80) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NULL,
  `unique_id` VARCHAR(255) NOT NULL,
  `is_verified` TINYINT NOT NULL DEFAULT 0,
  `no_attempts` INT NULL DEFAULT 0,
  `last_login` DATETIME NULL,
  `created_date` DATETIME NOT NULL,
  `address` TEXT NULL,
  `phone` INT NULL,
  `nic` VARCHAR(15) NULL,
  `title` VARCHAR(5) NULL,
  `dob` DATE NULL,
  `gender` ENUM('m', 'f') NULL,
  `marital_status` TINYINT NULL,
  `city_id` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nic_UNIQUE` (`nic` ASC) VISIBLE,
  UNIQUE INDEX `unique_id_UNIQUE` (`unique_id` ASC) VISIBLE,
  INDEX `fk_teacher_city1_idx` (`city_id` ASC) VISIBLE,
  CONSTRAINT `fk_teacher_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `student_management_database2`.`city` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`subject`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`subject` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`subject` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `grade_id` INT NOT NULL,
  `teacher_id` INT NOT NULL,
  PRIMARY KEY (`id`, `grade_id`, `teacher_id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE,
  INDEX `fk_subject_grade1_idx` (`grade_id` ASC) VISIBLE,
  INDEX `fk_subject_teacher1_idx` (`teacher_id` ASC) VISIBLE,
  CONSTRAINT `fk_subject_grade1`
    FOREIGN KEY (`grade_id`)
    REFERENCES `student_management_database2`.`grade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subject_teacher1`
    FOREIGN KEY (`teacher_id`)
    REFERENCES `student_management_database2`.`teacher` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`lesson`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`lesson` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`lesson` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(80) NULL,
  `subject_id` INT NOT NULL,
  `subject_grade_id` INT NOT NULL,
  `subject_teacher_id` INT NOT NULL,
  PRIMARY KEY (`id`, `subject_id`, `subject_grade_id`, `subject_teacher_id`),
  INDEX `fk_lesson_subject1_idx` (`subject_id` ASC, `subject_grade_id` ASC, `subject_teacher_id` ASC) VISIBLE,
  CONSTRAINT `fk_lesson_subject1`
    FOREIGN KEY (`subject_id` , `subject_grade_id` , `subject_teacher_id`)
    REFERENCES `student_management_database2`.`subject` (`id` , `grade_id` , `teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`note`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`note` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`note` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `file` VARCHAR(1000) NULL,
  `lesson_id` INT NOT NULL,
  `lesson_subject_id` INT NOT NULL,
  `lesson_subject_grade_id` INT NOT NULL,
  `lesson_subject_teacher_id` INT NOT NULL,
  PRIMARY KEY (`id`, `lesson_id`, `lesson_subject_id`, `lesson_subject_grade_id`, `lesson_subject_teacher_id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE,
  INDEX `fk_note_lesson1_idx` (`lesson_id` ASC, `lesson_subject_id` ASC, `lesson_subject_grade_id` ASC, `lesson_subject_teacher_id` ASC) VISIBLE,
  CONSTRAINT `fk_note_lesson1`
    FOREIGN KEY (`lesson_id` , `lesson_subject_id` , `lesson_subject_grade_id` , `lesson_subject_teacher_id`)
    REFERENCES `student_management_database2`.`lesson` (`id` , `subject_id` , `subject_grade_id` , `subject_teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`assignment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`assignment` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`assignment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `file` VARCHAR(1000) NOT NULL,
  `lesson_id` INT NOT NULL,
  `lesson_subject_id` INT NOT NULL,
  `lesson_subject_grade_id` INT NOT NULL,
  `lesson_subject_teacher_id` INT NOT NULL,
  PRIMARY KEY (`id`, `lesson_id`, `lesson_subject_id`, `lesson_subject_grade_id`, `lesson_subject_teacher_id`),
  INDEX `fk_assignment_lesson1_idx` (`lesson_id` ASC, `lesson_subject_id` ASC, `lesson_subject_grade_id` ASC, `lesson_subject_teacher_id` ASC) VISIBLE,
  CONSTRAINT `fk_assignment_lesson1`
    FOREIGN KEY (`lesson_id` , `lesson_subject_id` , `lesson_subject_grade_id` , `lesson_subject_teacher_id`)
    REFERENCES `student_management_database2`.`lesson` (`id` , `subject_id` , `subject_grade_id` , `subject_teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`answer_sheet`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`answer_sheet` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`answer_sheet` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `file` VARCHAR(1000) NOT NULL,
  `marks` INT NULL,
  `is_released` TINYINT NOT NULL,
  `assignment_id` INT NOT NULL,
  `assignment_lesson_id` INT NOT NULL,
  `assignment_lesson_subject_id` INT NOT NULL,
  `assignment_lesson_subject_grade_id` INT NOT NULL,
  `assignment_lesson_subject_teacher_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  `student_officer_id` INT NOT NULL,
  `student_grade_id` INT NOT NULL,
  PRIMARY KEY (`id`, `assignment_id`, `assignment_lesson_id`, `assignment_lesson_subject_id`, `assignment_lesson_subject_grade_id`, `assignment_lesson_subject_teacher_id`, `student_id`, `student_officer_id`, `student_grade_id`),
  INDEX `fk_answer_sheet_assignment1_idx` (`assignment_id` ASC, `assignment_lesson_id` ASC, `assignment_lesson_subject_id` ASC, `assignment_lesson_subject_grade_id` ASC, `assignment_lesson_subject_teacher_id` ASC) VISIBLE,
  INDEX `fk_answer_sheet_student1_idx` (`student_id` ASC, `student_officer_id` ASC, `student_grade_id` ASC) VISIBLE,
  CONSTRAINT `fk_answer_sheet_assignment1`
    FOREIGN KEY (`assignment_id` , `assignment_lesson_id` , `assignment_lesson_subject_id` , `assignment_lesson_subject_grade_id` , `assignment_lesson_subject_teacher_id`)
    REFERENCES `student_management_database2`.`assignment` (`id` , `lesson_id` , `lesson_subject_id` , `lesson_subject_grade_id` , `lesson_subject_teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answer_sheet_student1`
    FOREIGN KEY (`student_id` , `student_officer_id` , `student_grade_id`)
    REFERENCES `student_management_database2`.`student` (`id` , `officer_id` , `grade_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`payment` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`payment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_date` DATETIME NULL,
  `payment_fee` REAL NULL,
  `is_verified` TINYINT NULL,
  `student_id` INT NOT NULL,
  `student_officer_id` INT NOT NULL,
  `student_grade_id` INT NOT NULL,
  PRIMARY KEY (`id`, `student_id`, `student_officer_id`, `student_grade_id`),
  INDEX `fk_payment_student1_idx` (`student_id` ASC, `student_officer_id` ASC, `student_grade_id` ASC) VISIBLE,
  CONSTRAINT `fk_payment_student1`
    FOREIGN KEY (`student_id` , `student_officer_id` , `student_grade_id`)
    REFERENCES `student_management_database2`.`student` (`id` , `officer_id` , `grade_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student_management_database2`.`emails`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `student_management_database2`.`emails` ;

CREATE TABLE IF NOT EXISTS `student_management_database2`.`emails` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `from` VARCHAR(80) NOT NULL,
  `to` VARCHAR(80) NOT NULL,
  `subject` MEDIUMTEXT NULL,
  `body` LONGTEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
