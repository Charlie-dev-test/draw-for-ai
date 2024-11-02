<?php


namespace api\models\resources;

use api\models\Task;

class TaskResource extends Task
{
    public function fields()
    {
        return [
          'id',
          'date',
        ];
    }

    public static function getAvailableTasks($id){
        return self::find()->andWhere(['user_id'=> $id, 'status'=> 2])->all();
    }

    public static function getTask($task, $user){
        return self::find()->andWhere(["id" => $task, "user_id" => $user])->exists();
    }
}