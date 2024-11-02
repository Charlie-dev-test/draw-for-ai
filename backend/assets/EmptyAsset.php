<?php
namespace backend\assets;

class EmptyAsset extends \yii\web\AssetBundle
{
    //public $basePath = '@webroot';
    public $basePath = '';
    public $baseUrl = '@web';
    public $sourcePath = '@backend/themes/web';
    public $css = [
        'css/empty.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
