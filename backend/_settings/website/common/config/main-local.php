<?php

$host = 'localhost';
$port = 3307;
$dbname = 'markup_datamist';
$login = 'root';
$password = 'root';


return [
  'components' => [
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
    ],
    'db' => [
  		'class' => 'yii\db\Connection',
  		'dsn' => 'mysql:host='.$host.';port='.$port.';dbname='.$dbname,
  		'username' => $login,
  		'password' => $password,
  		'charset' => 'utf8',
  	],
  ],
];
