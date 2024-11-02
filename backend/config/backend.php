<?php

return [
    'modules' => [
        'admin' => [
            'class' => 'backend\AdminModule',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
                'resources/columns/<action:[\w-]+>/<id:\d+>' => 'resources/<controller>/<action>',
            ],
         ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 86400,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => '@npm/bootstrap/dist',
                    'baseUrl' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1',
                    'css' => [
                        'css/bootstrap.min.css',
                        'css/bootstrap-grid.css',
                        'css/bootstrap-reboot.min.css'
                    ],
                    'js' => [
                        'js/bootstrap.min.js',
                        'js/bootstrap.bundle.min.js'

                    ],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'backend' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@backend/messages',
                    'fileMap' => [
                        'backend' => 'admin.php',
                    ]
                ]
            ],
        ],
        'formatter' => [
            'sizeFormatBase' => 1000
        ],
    ],
    'bootstrap' => ['admin']
];