<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class FontAwesomeAsset extends AssetBundle {

    public $sourcePath = '@npm/font-awesome';
    public $jsOptions = ['position' => View::POS_HEAD];
    public $css = [
        "css/font-awesome.min.css",
    ];

}
