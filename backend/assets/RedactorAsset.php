<?php
namespace backend\assets;

class RedactorAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@backend/assets/redactor';
    public $depends = ['yii\web\JqueryAsset'];

    public function init()
    {
        if (YII_DEBUG) {
            $this->js[] = 'redactor.js';
            $this->js[] = 'https://code.jquery.com/jquery-migrate-3.0.1.js';
            $this->css[] = 'redactor.css';
        } else {
            $this->js[] = 'redactor.min.js';
            $this->js[] = 'https://code.jquery.com/jquery-migrate-3.0.1.min.js';
            $this->css[] = 'redactor.min.css';
        }
    }

}