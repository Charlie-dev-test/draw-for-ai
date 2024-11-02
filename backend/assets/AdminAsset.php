<?php

namespace backend\assets;

class AdminAsset extends \yii\web\AssetBundle {

    public $sourcePath = '@backend/themes/web';
    public $css = [
        'css/admin.css',
    ];
    public $js = [
        'js/admin.js',
        'js/popper.min.js',
        'js/jquery.cookie.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap4\BootstrapAsset',
        'backend\assets\SwitcherAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
