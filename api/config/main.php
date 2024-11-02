<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/xml' => 'yii\web\XmlParser',
            ],
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'api\models\Client',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'user/login' => 'user/login',
                'user/register' => 'user/register',
                'user/remove' => 'data/remove',
                'offer/token' => 'offer/token',
                'offer/set' => 'data/offer',
                'offer/last' => 'offer/last',
                'data/profile' => 'data/profile',
                'data/account' => 'data/account',
                'data/status' => 'data/status',
                'task/list' => 'task/list',
                'task/task' => 'task/task',
                'task/take' => 'task/take',
                'task/inspection' => 'task/inspection',
                'task/finish' => 'task/finish',
                'task/refuse' => 'task/refuse',
                'script/tasks' => 'script/tasks',
                'script/update' => 'script/update',
                'script/fix' => 'script/fix',
                'batch/list' => 'batch/list',
                'batch/batch'=> 'batch/batch',
                'batch/image' => 'batch/image',
                'batch/data' => 'batch/data'
            ],
        ],
    ],
    'params' => $params,
];
