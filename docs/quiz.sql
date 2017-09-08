-- MySQL Workbench Synchronization
-- Generated: 2017-09-05 12:32
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: WEB

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `quiz` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `quiz`.`quizzes` (
  `id` SMALLINT(128) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `count` SMALLINT(30) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8 COMMENT 'Quizzes';


CREATE TABLE IF NOT EXISTS `quiz`.`questions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `quiz_id` SMALLINT(128) UNSIGNED NOT NULL,
  `descriotion` VARCHAR(255) NOT NULL,
  `status` ENUM('ok', 'fail') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `descriotion_UNIQUE` (`descriotion` ASC),
  INDEX `fk_questions_1_idx` (`quiz_id` ASC),
  CONSTRAINT `fk_questions_1`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quiz`.`quiz` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8 COMMENT 'Quiz questions';

CREATE TABLE IF NOT EXISTS `quiz`.`users_score` (
  `quiz_id` SMALLINT(128) UNSIGNED NOT NULL,
  `user_id` SMALLINT(128) UNSIGNED NOT NULL,
  `status` ENUM('ok', 'fail') NOT NULL,
  INDEX `fk_questions_1_idx` (`quiz_id` ASC),
  INDEX `fk_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_quiz`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quiz`.`quiz` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `quiz`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
