CREATE TABLE `u670004846_tradebot`.`operations` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(16) NOT NULL,
    `amount` DOUBLE NOT NULL,
    `bitcoin` DOUBLE NOT NULL,
    `date` DATE NOT NULL,
    `unit_price` DOUBLE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `u670004846_tradebot`.`wallet` (
    `balance` DOUBLE NOT NULL,
    `bitcoins` DOUBLE NULL
) ENGINE = InnoDB;
INSERT INTO `wallet` (`balance`, `bitcoins`)
VALUES ('5000', NULL)