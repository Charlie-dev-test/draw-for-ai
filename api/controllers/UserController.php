<?php


namespace api\controllers;

use api\models\Data;
use api\models\Offer;
use yii\filters\Cors;
use yii\rest\Controller;
use api\models\LoginForm;
use api\models\RegisterForm;
use Yii;


class UserController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'cors' => Cors::class
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {

            $offer = Offer::getOfferToken();
            $user = $model->getUser()->toArray();
            $data = Data::find()->andWhere(['user_id' => $user['id']])->exists();
            $check = 0;
            if($data && $user['active'] === 0){
                $check = 1;
            }
            if($data && $user['active'] === 1){
                $check = 2;
            }
            $res = array_merge($user, $offer);
            return array_merge($res, ['status' => $check]);
        }

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->register()) {
            $params = Yii::$app->request->bodyParams;

            $img = Yii::getAlias('@backend/web/data/storage/') . 'img/logo.png';
            Yii::$app->mailer->compose('@common/mail/register-letter', ['params' => $params, 'logo' => $img])
                ->setFrom($params["email"])
                ->setTo(\Yii::$app->params["contactEmails"])
                ->setSubject('Вы зарегистрировались на сайте markup.datamist.ru')
                ->send();

            return $model->user;
        }

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }
}