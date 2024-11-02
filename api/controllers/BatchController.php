<?php


namespace api\controllers;

use yii\rest\Controller;
use yii\filters\Cors;
use api\models\resources\TaskResource;
use api\models\Batch;
use yii\helpers\BaseFileHelper;
use Yii;

class BatchController extends Controller
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

    public function actionList(){
        $id = Yii::$app->user->getId();
        $list = TaskResource::getAvailableTasks($id);
        return $list;
    }

    public function actionBatch(){
        $batch = Yii::$app->request->bodyParams["id"];
        $user = Yii::$app->user->getId();

        if(!TaskResource::getTask($batch, $user)){
            Yii::$app->response->statusCode = 422;
            return [
                'errors' => 422
            ];
        }

        $storage = Yii::getAlias("@batches") . "/" . $batch;

        if (!file_exists($storage)){
            Yii::$app->response->statusCode = 403;
            return [
                'errors' => 403
            ];
        }
        return Batch::getList($storage);
    }

    public function actionImage(){
        $batch = Yii::$app->request->bodyParams["batch"];
        $filename = Yii::$app->request->bodyParams['img'];
        $storage = Yii::getAlias("@batches") . "/" . $batch;

        if (!file_exists($storage . "/" .$filename)){
            Yii::$app->response->statusCode = 403;
            return [
                'errors' => 403
            ];
        }
        $handle = fopen($storage . "/" .$filename, "rb");
        $fsize = filesize($storage . "/" .$filename);
        $contents = fread($handle, $fsize);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $contents;
    }

    public function actionData(){
        $batch = Yii::$app->request->bodyParams["batch"];
        $img = Yii::$app->request->bodyParams["img"];
        $img = substr($img, 0, strrpos($img,'.'));
        $polygons = Yii::$app->request->bodyParams["polygons"];
        $user = Yii::$app->user->getId();
        $storage = Yii::getAlias("@batches") . "/" . $batch;

        if(!TaskResource::getTask($batch, $user)){
            Yii::$app->response->statusCode = 422;
            return [
                'errors' => 422
            ];
        }
        return Batch::writeData($storage, $img, $polygons);

    }

}