

ALTER TABLE `userdata` CHANGE COLUMN `dob` `dob` DATE DEFAULT NULL COMMENT 'Дата рождения';

ALTER TABLE `userdata` ADD COLUMN `token` varchar(100) NOT NULL DEFAULT '' COMMENT 'Токен оферты' AFTER `bank_corr`;
