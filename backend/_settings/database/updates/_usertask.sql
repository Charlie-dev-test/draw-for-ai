

DROP TABLE IF EXISTS `usertask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usertask` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Номер задания',
	`date` datetime DEFAULT NULL COMMENT 'Дата задания',
	`title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Название задания',
	`desc` TEXT NOT NULL COMMENT 'Подробное описание задания',
	`num` INT NOT NULL DEFAULT '0' COMMENT 'Количество данных для разметки',
	`price` INT NOT NULL DEFAULT '0' COMMENT 'Стоимость',
  `duration` varchar(100) NOT NULL DEFAULT '' COMMENT 'Оценочная длительность',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Текущий статус',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

