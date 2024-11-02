<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class PluginAsset extends AssetBundle {

    public $sourcePath = '@bower/bootstrap/dist';
    public $jsOptions = ['position' => View::POS_HEAD];
    public $js = [
//        "https://unpkg.com/popper.js/dist/umd/popper.min.js",
//        "js/popper.min.js",
//        "https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=870eeb7b-3515-4a77-b4b5-a57f172731e4",
    ];

}
