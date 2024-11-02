
DROP TABLE IF EXISTS `userdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  /*
  электронный адрес
	имя, фамилия;
	отчество (при наличии);
	*/
	`citizenship` varchar(100) DEFAULT NULL COMMENT 'гражданство',
	`dob` datetime DEFAULT NULL COMMENT 'дата рождения',
	`passport` TEXT NOT NULL COMMENT 'паспортные данные',
	`address_reg` TEXT NOT NULL COMMENT 'адрес места регистрации',
	`address_loc` TEXT NOT NULL COMMENT 'адрес фактического проживания',
	`phone` varchar(100) DEFAULT NULL COMMENT 'номер мобильного телефона',
	`inn` varchar(100) DEFAULT NULL COMMENT 'номер ИНН',
	`snils` varchar(100) DEFAULT NULL COMMENT 'номер СНИЛС',
	`bank_card` varchar(100) DEFAULT NULL COMMENT '№ банковской карты',
	`bank_account` varchar(100) DEFAULT NULL COMMENT '№ счета, привязанного к карте',
	`bank_name` varchar(100) DEFAULT NULL COMMENT 'наименование банка',
	`bank_bik` varchar(100) DEFAULT NULL COMMENT 'БИК',
	`bank_corr` varchar(100) DEFAULT NULL COMMENT 'корр. счет',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `orderid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

