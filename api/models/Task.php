<?php


namespace api\models;

use yii\db\ActiveRecord;

class Task extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%usertask}}';
    }
}