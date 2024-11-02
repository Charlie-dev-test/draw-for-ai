<?php

namespace api\controllers;

use api\models\Client;
use api\models\ClientUploads;
use api\models\Data;
use yii\rest\Controller;
use Yii;

class PassportController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);


        $behaviors['corsFilter'] = [
            'class' => \api\filters\CorsCustom::className(),
        ];

        $behaviors['authenticator'] = $auth;
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    protected function verbs()
    {
        return [
        ];
    }

    private $_verbs = ['POST', 'OPTIONS'];

    public function actionOptions()
    {
        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            Yii::$app->getResponse()->setStatusCode(405);
        }
        $options = $this->_verbs;
        Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', $options));
    }

    public function actionPassport()
    {
//        if(Yii::$app->request->post()) {
//            $id = Client::findIdentityByAccessToken(Yii::$app->request->bodyParams['access_token']);
//            $client = Client::findOne($id->id);
////            Yii::$app->request->bodyParams['access_token'];
//            $client->fullname = Yii::$app->request->bodyParams['username'] . ' '
//                . Yii::$app->request->bodyParams['surname'] . ' '
//                . Yii::$app->request->bodyParams['patronymic'];
//            $client->save();
//            $userData = new Data();
//            $data = Data::setUp(Yii::$app->request->bodyParams, $id->id);
//            if ($userData->load($data, '')) {
//                $userData->save();
//            }
//            return ClientUploads::saveFiles($id->id);
//        }
    }
}