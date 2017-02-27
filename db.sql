CREATE TABLE `logs` ( `id` INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`), `name` VARCHAR(255) NOT NULL , `dob` VARCHAR(10) NOT NULL , `data` TEXT NOT NULL, `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `years` INT NOT NULL, `months` INT NOT NULL, `days` INT NOT NULL, `hours` INT NOT NULL) ENGINE = InnoDB;