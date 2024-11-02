<?php

$params = array_merge(
	require(__DIR__ . '/params.php')
);

return [
  'language' => 'ru-RU',
  'sourceLanguage' => 'ru-RU',
  'timeZone' => 'Europe/Moscow',
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'components' => [
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
  ],
  'params' => $params,
];
