<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class DadataAsset extends AssetBundle {

    public $jsOptions = ['position' => View::POS_HEAD];

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://cdn.jsdelivr.net/npm/suggestions-jquery@19.4.2/dist/css/suggestions.min.css",
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@19.4.2/dist/js/jquery.suggestions.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
