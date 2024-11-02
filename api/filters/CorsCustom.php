<?php

namespace api\filters;


use Yii;

use yii\filters\Cors;


class CorsCustom extends Cors


{

    public function beforeAction($action)

    {

        parent::beforeAction($action);


        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {

            Yii::$app->getResponse()->getHeaders()->set('Allow', 'POST GET PUT');
            Yii::$app->getResponse()->getHeaders()->set('Access-Control-Allow-Origin',"*");

        }


        return true;

    }

}
