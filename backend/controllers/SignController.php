<?php
namespace backend\controllers;

use Yii;
use backend\models;

class SignController extends \yii\web\Controller
{
    public $layout = 'empty';
    public $enableCsrfValidation = false;

    public function actionIn()
    {
        $model = new models\AccessLogs;

        if(!Yii::$app->user->isGuest || ($model->load(Yii::$app->request->post()) && $model->login())) {
          $link = Yii::$app->user->getReturnUrl(['/']);
          $link = "/";
          return $this->redirect($link);
        } else {
          return $this->render('in', [
            'model' => $model,
          ]);
        }
    }

    public function actionOut()
    {
        Yii::$app->user->logout();
        $link = Yii::$app->user->getReturnUrl(['/']);
        $link = "/";
        return $this->redirect($link);
    }
}