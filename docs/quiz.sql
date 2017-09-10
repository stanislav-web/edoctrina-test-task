-- MySQL Workbench Synchronization
-- Generated: 2017-09-05 12:32
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: WEB

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
SET FOREIGN_KEY_CHECKS = 0;

CREATE SCHEMA IF NOT EXISTS `quiz` DEFAULT CHARACTER SET utf8 ;

DROP TABLE IF EXISTS `quizzes`;
DROP TABLE IF EXISTS `questions`;
DROP TABLE IF EXISTS `variants`;

CREATE TABLE IF NOT EXISTS `quiz`.`quizzes` (
  `id` SMALLINT(128) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL DEFAULT '',
  `description` VARCHAR(256) NOT NULL DEFAULT '',
  `status` ENUM('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8 COMMENT 'Quizzes';

CREATE TABLE IF NOT EXISTS `quiz`.`questions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `quiz_id` SMALLINT(128) UNSIGNED NOT NULL,
  `title` VARCHAR(256) NOT NULL DEFAULT '',
  `status` ENUM('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `fk_questions_1_idx` (`quiz_id` ASC),
  CONSTRAINT `fk_questions_1`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quiz`.`quizzes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8 COMMENT 'Quiz questions';

CREATE TABLE IF NOT EXISTS `quiz`.`variants` (
  `id` INT(10) UNSIGNED NOT NULL,
  `question_id` INT(10) UNSIGNED NOT NULL,
  `title` VARCHAR(256) NOT NULL DEFAULT '',
  `right` ENUM('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`question_id`),
  INDEX `fk_variants_1_idx` (`question_id` ASC),
  CONSTRAINT `fk_variants_1`
  FOREIGN KEY (`question_id`)
  REFERENCES `quiz`.`questions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8 COMMENT 'Questions variants';

CREATE TABLE IF NOT EXISTS `quiz`.`users_score` (
  `quiz_id` SMALLINT(128) UNSIGNED NOT NULL,
  `user_id` SMALLINT(128) UNSIGNED NOT NULL,
  `status` ENUM('ok', 'fail') NOT NULL,
  INDEX `fk_questions_1_idx` (`quiz_id` ASC),
  INDEX `fk_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_quiz`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `quiz`.`quizzes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `quiz`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SET FOREIGN_KEY_CHECKS = 1;
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
