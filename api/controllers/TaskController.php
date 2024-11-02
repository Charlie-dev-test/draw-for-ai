<?php


namespace api\controllers;


use api\models\Uploads;
use api\models\Files;
use backend\models\Usertask;
use api\models\Task;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use Yii;

class TaskController extends Controller
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
        return Usertask::getUserTasks();
    }

    public function actionTask(){
        $task = Yii::$app->request->bodyParams['id'];
        $id = Yii::$app->user->getId();
        $result = Task::find()
        ->andWhere(['id' => $task, 'user_id' => [$id, 0]])
        ->one();
        $result = ArrayHelper::toArray($result);
            $files_list = Files::find()
                ->andWhere(['source_id' => $result['id'], 'sid' => 'usertask'])
                ->all();
            $arr = [];
            for($j = 0; $j<count($files_list); $j++){
                $files_names = Uploads::findOne($files_list[$j]['pics']);
                array_push($arr, $files_names);
            }
            $result = $result + ['files' => $arr];
        return $result;
    }

    public function actionTake(){
        $id = Yii::$app->user->getId();
        $task = Yii::$app->request->bodyParams['taskId'];
        $row = Task::findOne($task);
        $row->status = 2;
        $row->user_id = $id;
        $row->save();
        return Usertask::getUserTasks();
    }


    public function actionInspection(){
        $task = Yii::$app->request->bodyParams['taskId'];
        $row = Task::findOne($task);
        $row->status = 3;
        $row->save();
        return Usertask::getUserTasks();
    }

    public function actionRefuse(){
        $task = Yii::$app->request->bodyParams['taskId'];
        $row = Task::findOne($task);
        $row->status = 1;
        $row->user_id = 0;
        $row->start_task = null;
        $row->save();
        return Usertask::getUserTasks();
    }

    public function actionFinish(){
        $task = Yii::$app->request->bodyParams['taskId'];
        $row = Task::findOne($task);
        $row->status = 3;
        return $row->save();
    }

}