<?php


namespace api\controllers;

use api\models\Client;
use api\models\ClientUploads;
use api\models\Data;
use api\models\Files;
use api\models\resources\ClientForm;
use api\models\Uploads;
use api\models\User;
use Faker\Core\File;
use yii\filters\Cors;
use yii\rest\Controller;
use api\models\resources\ClientResource;
use Yii;

class DataController extends Controller
{

    public function behaviors()
    {
        $updated = array_merge(parent::behaviors(), [
            'cors' => Cors::class
        ]);
        return array_merge($updated, [
            'bearerAuth' => [
                'class' => \yii\filters\auth\HttpBearerAuth::class,
            ],
        ]);
    }

    public function actionRemove(){
        $id = Yii::$app->user->getId();

        if(User::cleanAll($id)){
            $user = new User();
            $user->deleteAll(['id' => $id]);
            return true;
        }else return false;
    }

    public function actionAccount(){
        $id = Yii::$app->user->getId();
        $client = ClientForm::findOne($id)->toArray();
        $data = Data::find()->andWhere(['user_id' => $id])->one()->toArray();
        $img = Uploads::find()->andWhere(['user_id' => $id])->all();
        $result = array_merge($data, $client);
        return array_merge($result, ['img' => $img]);
    }

    public function actionTest(){
        $res = gettype(Data::find()->andWhere(['user_id' => 197])->one());
        if ($res !== 'NULL'){
            return true;
        }
       return false;
    }

    public function actionProfile(){
        $id = Yii::$app->user->getId();
        $client = Client::findOne($id);
        $fullname = Yii::$app->request->bodyParams['username'] . ' '
            . Yii::$app->request->bodyParams['patronymic'] . ' '
            . Yii::$app->request->bodyParams['surname'];
        $client->fullname = $fullname;
        $client->save();
        $old_data = Data::find()->andWhere(['user_id' => $id])->one();
        $data = Data::setUp(Yii::$app->request->bodyParams, $id);
        if ($old_data !== null){
            if ($old_data->load($data, '')) {
                $old_data->save();
            }else{
                return $old_data->errors;
            }
        }else{
            $userData = new Data();
            if ($userData->load($data, '')) {
                $userData->save();
                $img = Yii::getAlias('@backend/web/data/storage/') . 'img/logo.png';
                Yii::$app->mailer->compose('@common/mail/add-data-letter', ['params' => $fullname, 'logo' => $img])
                    ->setFrom(\Yii::$app->params["adminEmail"])
                    ->setTo(\Yii::$app->params["contactEmails"])
                    ->setSubject('Пользователь отправил данные на проверку с сайта markup.datamist.ru')
                    ->send();

            }else{
                return $userData->errors;
            }
        }
        if(User::cleanFiles($id)){
            if(ClientUploads::saveFiles($id)){
                return 'saved';
            }
        }else return 'error';
    }

    public function actionStatus(){
        $id = Yii::$app->user->getId();
        $data = Data::find()->andWhere(['user_id' => $id])->exists();
        $client = ClientResource::findOne($id);
        $check = 0;
        if($data && $client->active === 0){
            $check = 1;
        }
        if($data && $client->active === 1){
            $check = 2;
        }

        return ['offer_user' => $client->offer_token, 'status' => $check];
    }

    public function actionOffer(){
        $id = Yii::$app->user->getId();
        $client = Client::findOne($id);
        $client->offer_token = Yii::$app->request->bodyParams['offer_token'];
        $client->save();
        return Yii::$app->request->bodyParams['offer_token'];
    }

}