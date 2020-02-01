CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255),
  `email` VARCHAR(255),
  `password` VARCHAR(255),
  `isadmin` BIT(1),
  PRIMARY KEY `pk_id`(`id`)
) ENGINE = InnoDB;