SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `lattes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `lattes` ;

-- -----------------------------------------------------
-- Table `lattes`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lattes`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `lattes` VARCHAR(100) NOT NULL,
  `max_titulation` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES (1,'Camilo Cesar Perucci','http://lattes.cnpq.br/5812687200309236',NULL),(2,'Carlos Eduardo Liasch','http://lattes.cnpq.br/1155348824161559',NULL),(3,'Eduardo de Brito','http://lattes.cnpq.br/3929942929482246',NULL),(4,'Eric Augusto Paixão de Querioz','http://lattes.cnpq.br/1641964252508999',NULL),(5,'Erivelton Rodrigues Nunes','http://lattes.cnpq.br/6503269153478973',NULL),(6,'Fabiano Rodrigo da Silva Santos','http://lattes.cnpq.br/8841840830171267',NULL),(7,'Flávio Rubens Massaro Junior','http://lattes.cnpq.br/6581012116833368',NULL),(8,'Ivan José Lautenschleguer ','http://lattes.cnpq.br/0537601054260366',NULL),(9,'Lilian Saldanha Marroni','http://lattes.cnpq.br/4995205101828752',NULL),(10,'Marcelo Carlos Barbeli','http://lattes.cnpq.br/9182535209147578',NULL),(11,'Orlando Saraiva do Nascimento Junior','http://lattes.cnpq.br/5246678822563192',NULL),(12,'Pâmela Piovesan','http://lattes.cnpq.br/1376315663238484',NULL),(13,'Raphael Gava de Andrade','http://lattes.cnpq.br/1070291283812879',NULL),(14,'Renato Luciano Cagnin','http://lattes.cnpq.br/3864977515064821',NULL),(15,'Rogério Cardoso','http://lattes.cnpq.br/7580475626591643',NULL),(16,'Sergio Luis Antonello','http://lattes.cnpq.br/4034572067207920',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

-- -----------------------------------------------------
-- Table `lattes`.`titulation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lattes`.`titulation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` TEXT NOT NULL,
  `type` ENUM('Especialização','Graduação','Mestrado','Doutorado','Pós-Doutorado') NOT NULL,
  `start` YEAR NOT NULL,
  `end` YEAR NULL,
  `weight` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_titulation_teacher_idx` (`user_id` ASC),
  CONSTRAINT `fk_titulation_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `lattes`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lattes`.`production`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lattes`.`production` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` TEXT NOT NULL,
  `year` YEAR NULL,
  `type` ENUM('Periódicos', 'Congresso','Livros', 'Capítulos de livros') NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_production_teacher1_idx` (`user_id` ASC),
  CONSTRAINT `fk_production_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `lattes`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lattes`.`professional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lattes`.`professional` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `workplace` VARCHAR(255) NOT NULL,
  `link` VARCHAR(255) NOT NULL,
  `start` INT NOT NULL,
  `end` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_professional_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_professional_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `lattes`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
