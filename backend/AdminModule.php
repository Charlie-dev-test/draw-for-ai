<?php

namespace backend;

use Yii;
use yii\web\View;
use yii\base\Application;
use yii\base\BootstrapInterface;
use backend\models\Module;
use backend\models\Setting;

class AdminModule extends \yii\base\Module implements BootstrapInterface {

    const VERSION = 0.1;

    public $settings;
    public $activeModules;
    public $controllerLayout = '@backend/views/layouts/main';
    private $_installed;

    public function init()
    {
        parent::init();
        /*
        if (Yii::$app->cache === null) {
            throw new \yii\web\ServerErrorHttpException('Please configure Cache component.');
        }

        $this->activeModules = Module::findAllActive();

        $modules = [];
        foreach ($this->activeModules as $name => $module) {
            $modules[$name]['class'] = $module->class;
            if (is_array($module->settings)) {
                $modules[$name]['settings'] = $module->settings;
            }
        }
        $this->setModules($modules);
        */
        if (Yii::$app instanceof yii\web\Application) {
            define('IS_ROOT', !Yii::$app->user->isGuest && Yii::$app->user->identity->isRoot());
        }
    }
    
    public function bootstrap($app)
    {


    }


}
