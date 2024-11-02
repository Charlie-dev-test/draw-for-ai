<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use common\models\Samples;

class SampleController extends Controller
{
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \api\filters\CorsCustom::className(),
        ];
        return $behaviors;
    }

    private $_verbs = ['GET', 'OPTIONS'];

    public function actionOptions()
    {
        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            Yii::$app->getResponse()->setStatusCode(405);
        }
        $options = $this->_verbs;
        Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', $options));
    }

    public function actionSamples()
    {
        return Samples::getSamples();
    }

    public function actionImage(){
        $storage = Yii::getAlias("@batches");
        $filename = "test.jpeg";
        $handle = fopen($storage . "/" .$filename, "rb");
        $fsize = filesize($storage . "/" .$filename);
        $contents = fread($handle, $fsize);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $contents;
    }
}
