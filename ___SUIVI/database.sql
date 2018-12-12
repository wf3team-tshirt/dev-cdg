SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

DROP TABLE IF EXISTS `devmyshirt`.`user` ;

 CREATE TABLE user (
    id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    is_active TINYINT(1) NOT NULL,
    roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)',
    PRIMARY KEY (id)
)  DEFAULT CHARACTER SET UTF8MB4 COLLATE UTF8MB4_UNICODE_CI ENGINE=INNODB;

ALTER TABLE `user` ADD COLUMN `createddate` DATETIME NOT NULL DEFAULT NOW() AFTER `roles`;

CREATE INDEX idx_user_email ON user (email);
CREATE INDEX idx_user_username ON user (username);

/*
INSERT INTO `devmyshirt`.`user` (`username`, `firstname`, `lastname`, `password`, `email`, `phone`, `is_active`, `roles`) VALUES ('admin', 'admin', 'admin', 'pwd', 'admin@beertime.fr', NULL, 0, 'admin,user,placer');
INSERT INTO `devmyshirt`.`user` (`username`, `firstname`, `lastname`, `password`, `email`, `phone`, `is_active`, `roles`) VALUES ('cdg', 'cdg', 'cdg', 'pwd', 'cdg@beertime.fr', NULL, 0, 'admin,user,placer');
INSERT INTO `devmyshirt`.`user` (`username`, `firstname`, `lastname`, `password`, `email`, `phone`, `is_active`, `roles`) VALUES ('buveur', 'buveur', 'buveur', 'pwd', 'buveur@beertime.fr', NULL, 0, 'admin,user,placer');
*/