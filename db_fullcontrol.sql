-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_fullcontrol
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_fullcontrol
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_fullcontrol` DEFAULT CHARACTER SET utf8 ;
USE `db_fullcontrol` ;

-- -----------------------------------------------------
-- Table `db_fullcontrol`.`unidade_comercial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_fullcontrol`.`unidade_comercial` (
  `id_unidade_comercial` INT NOT NULL AUTO_INCREMENT,
  `nome_fantasia` VARCHAR(80) NOT NULL,
  `razao_social` VARCHAR(80) NOT NULL,
  `CNPJ` VARCHAR(15) NULL,
  `CPF` VARCHAR(14) NULL,
  `CNAE` VARCHAR(120) NULL,
  `CNAE_COD` VARCHAR(20) NULL,
  `observacao` VARCHAR(30) NULL,
  `abertura` datetime NULL,
  `telefone` VARCHAR(12) NULL,
  `email` VARCHAR(80) NULL,
  `logradouro` VARCHAR(80) NULL,
  `numero` VARCHAR(10) NULL,
  `complemento` VARCHAR(80) NULL,
  `bairro` VARCHAR(80) NULL,
  `municipio` VARCHAR(30) NULL,
  `UF` VARCHAR(2) NULL,
  `cep` VARCHAR(9) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id_unidade_comercial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_fullcontrol`.`dispositivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_fullcontrol`.`dispositivo` (
  `id_ispositivo` INT NOT NULL AUTO_INCREMENT,
  `unidade_comercial_id_unidade_comercial` INT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `localizacao` VARCHAR(80) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id_ispositivo`),
  CONSTRAINT `fk_dispositivo_unidade_comercial1`
    FOREIGN KEY (`unidade_comercial_id_unidade_comercial`)
    REFERENCES `db_fullcontrol`.`unidade_comercial` (`id_unidade_comercial`)
    )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_fullcontrol`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_fullcontrol`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(80) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `ativo` BOOLEAN NOT NULL,
  `admin_level` VARCHAR(45) NOT NULL,
  `reset_hash` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`idusers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_fullcontrol`.`nobreak`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_fullcontrol`.`nobreak` (
  `id_nobreak` INT NOT NULL AUTO_INCREMENT,
  `dispositivo_id_ispositivo` INT NOT NULL,
  `quantia_bateria` INTEGER NULL,
  `pontencia` INT NOT NULL,
  `maquina` VARCHAR(45) NULL,
  PRIMARY KEY (`id_nobreak`),
  CONSTRAINT `fk_nobreak_dispositivo`
    FOREIGN KEY (`dispositivo_id_ispositivo`)
    REFERENCES `db_fullcontrol`.`dispositivo` (`id_ispositivo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_fullcontrol`.`troca_bateria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_fullcontrol`.`troca_bateria` (
  `id_troca_bateria` INT NOT NULL AUTO_INCREMENT,
  `nobreak_id_nobreak` INT NOT NULL,
  `quantia_troca` INTEGER NOT NULL,
  `descricao` VARCHAR(80) NOT NULL,
  `previsao_troca` INTEGER NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id_troca_bateria`),
  CONSTRAINT `fk_troca_bateria_nobreak1`
    FOREIGN KEY (`nobreak_id_nobreak`)
    REFERENCES `db_fullcontrol`.`nobreak` (`id_nobreak`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_fullcontrol`.`bateria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_fullcontrol`.`bateria` (
  `id_bateria` INT NOT NULL,
  `troca_bateria_id_troca_bateria` INT NOT NULL,
  `identificador` VARCHAR(45) NULL,
  `imagem` VARCHAR(255) NULL,
  PRIMARY KEY (`id_bateria`),
  CONSTRAINT `fk_bateria_troca_bateria1`
    FOREIGN KEY (`troca_bateria_id_troca_bateria`)
    REFERENCES `db_fullcontrol`.`troca_bateria` (`id_troca_bateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;