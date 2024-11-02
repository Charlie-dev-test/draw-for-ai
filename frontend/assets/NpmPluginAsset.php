<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class NpmPluginAsset extends AssetBundle {

    public $sourcePath = '@npm';
    public $jsOptions = ['position' => View::POS_HEAD];
    public $js = [
//        "popper.js/dist/popper.min.js",
    ];

}
