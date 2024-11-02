<?php


namespace api\models;

use yii\db\ActiveRecord;

class Uploads extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%z_uploads}}';
    }

    public function rules()
    {
        return [
            ['user_id', 'number'],
            ['realname', 'string'],
            ['path', 'string'],
            ['name', 'string']
        ];
    }

}