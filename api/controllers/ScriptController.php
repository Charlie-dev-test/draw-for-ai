<?php


namespace api\controllers;

use yii\rest\Controller;
use api\models\resources\TaskResource;
use api\models\resources\ClientResource;
use Yii;

class ScriptController extends Controller
{
    public function actionTasks(){
        $status = TaskResource::find()
            ->indexBy('id')
            ->asArray()
            ->all();
        $arr = [];
        for($i = 1; $i<count($status)+1; $i++){
            $temp = [];
            $temp['batch'] = $status[$i]['id'];
            $temp['user_id'] = $status[$i]['user_id'];
            $temp['status'] = $status[$i]['status'];
            if($status[$i]['user_id'] != 0 ){
                $temp['fullname'] = ClientResource::findOne($status[$i]['user_id'])->fullname;
            $format = 'Y-m-d H:i:s';
            $time = date($format);
            $str = 'PT' . $status[$i]['duration'] . 'H';
            $time_take_db = date($status[$i]['start_task']);
            $now = \DateTime::createFromFormat($format, $time);
            $task_taken = \DateTime::createFromFormat($format, $time_take_db);
            $interval = new \DateInterval($str);
            $task_ends = $task_taken->add($interval);
            $temp['isOutdated'] = $now > $task_ends;
            }
            array_push($arr, $temp);
        }
        return $arr;
    }

    public function actionUpdate(){
        $params = Yii::$app->request->bodyParams;
        Yii::$app->mailer->compose('@common/mail/script-letter', ['params' => $params])
            ->setFrom(\Yii::$app->params["contactEmails"])
            ->setTo('charlie61@yandex.ru')
            ->setSubject('Test script')
            ->send();
        return true;
    }

    public function actionFix()
    {
    	$cmd = "UPDATE `usertask` SET `status`=6
				WHERE NOW() > DATE_ADD(`start_task`, INTERVAL `duration` HOUR)
				AND `status`=2";
    	$result = Yii::$app->db->createCommand($cmd)->execute();
    	
    	return (int)$result;
    }
}