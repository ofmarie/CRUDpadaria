-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema BDpadaria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BDpadaria
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BDpadaria` DEFAULT CHARACTER SET utf8 COLLATE utf8_esperanto_ci ;
USE `BDpadaria` ;

-- -----------------------------------------------------
-- Table `BDpadaria`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDpadaria`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDpadaria`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDpadaria`.`categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `descricao` TEXT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDpadaria`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDpadaria`.`produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `descricao` TEXT NULL,
  `preco` DOUBLE NULL,
  `id_categoria` INT NOT NULL,
  PRIMARY KEY (`id_produto`),
  INDEX `fk_produto_categoria_idx` (`id_categoria` ASC) VISIBLE,
  CONSTRAINT `fk_produto_categoria`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `BDpadaria`.`categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDpadaria`.`pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDpadaria`.`pagamento` (
  `id_pagamento` INT NOT NULL AUTO_INCREMENT,
  `tipo_pagamento` VARCHAR(100) NULL,
  PRIMARY KEY (`id_pagamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDpadaria`.`encomenda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDpadaria`.`encomenda` (
  `id_encomenda` INT NOT NULL AUTO_INCREMENT,
  `data_pedido` TIMESTAMP NULL,
  `data_retirada` TIMESTAMP NULL,
  `id_cliente` INT NOT NULL,
  `id_pagamento` INT NOT NULL,
  PRIMARY KEY (`id_encomenda`),
  INDEX `fk_pedido_cliente1_idx` (`id_cliente` ASC) VISIBLE,
  INDEX `fk_pedido_pagamento1_idx` (`id_pagamento` ASC) VISIBLE,
  CONSTRAINT `fk_pedido_cliente1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `BDpadaria`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_pagamento1`
    FOREIGN KEY (`id_pagamento`)
    REFERENCES `BDpadaria`.`pagamento` (`id_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDpadaria`.`produto_has_encomenda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDpadaria`.`produto_has_encomenda` (
  `id_produto` INT NOT NULL,
  `id_encomenda` INT NOT NULL,
  `quantidade` INT NULL,
  PRIMARY KEY (`id_produto`, `id_encomenda`),
  INDEX `fk_produto_has_pedido_pedido1_idx` (`id_encomenda` ASC) VISIBLE,
  INDEX `fk_produto_has_pedido_produto1_idx` (`id_produto` ASC) VISIBLE,
  CONSTRAINT `fk_produto_has_pedido_produto1`
    FOREIGN KEY (`id_produto`)
    REFERENCES `BDpadaria`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_has_pedido_pedido1`
    FOREIGN KEY (`id_encomenda`)
    REFERENCES `BDpadaria`.`encomenda` (`id_encomenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
