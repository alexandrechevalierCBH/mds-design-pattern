CREATE TABLE `u670004846_tradebot`.`operations` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(16) NOT NULL,
    `amount` float NOT NULL,
    `bitcoin` float NOT NULL,
    `date` DATE NOT NULL,
    `unit_price` float NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `u670004846_tradebot`.`wallet` (
    `balance` float NOT NULL,
    `bitcoins` float NULL
) ENGINE = InnoDB;
INSERT INTO `wallet` (`balance`, `bitcoins`)
VALUES ('5000', NULL)
ALTER TABLE `wallet` CHANGE `bitcoins` `bitcoins` float NOT NULL;