SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

DROP TABLE IF EXISTS `devmyshirt`.`user` ;

CREATE TABLE IF NOT EXISTS `devmyshirt`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(25) DEFAULT NULL,
  `roles` LONGTEXT NOT NULL COMMENT '(DC2Type:array)',
  `createddate` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `devmyshirt`.`user` (`username`, `firstname`, `lastname`, `password`, `email`, `phone`, `roles`) VALUES ('admin', 'admin', 'admin', 'pwd', 'admin@beertime.fr', NULL, 'admin,user,placer');
INSERT INTO `devmyshirt`.`user` (`username`, `firstname`, `lastname`, `password`, `email`, `phone`, `roles`) VALUES ('cdg', 'cdg', 'cdg', 'pwd', 'cdg@beertime.fr', NULL, 'admin,user,placer');
INSERT INTO `devmyshirt`.`user` (`username`, `firstname`, `lastname`, `password`, `email`, `phone`, `roles`) VALUES ('buveur', 'buveur', 'buveur', 'pwd', 'buveur@beertime.fr', NULL, 'admin,user,placer');

