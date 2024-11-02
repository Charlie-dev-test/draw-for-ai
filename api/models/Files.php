<?php


namespace api\models;

use yii\db\ActiveRecord;

class Files extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%z_files}}';
    }

    public function rules()
    {
        return [
            ['parentid', 'number'],
            ['source_id', 'number'],
            ['lang_id', 'number'],
            ['country_id', 'number'],
            ['sid', 'string'],
            ['orderid', 'number'],
            ['title', 'string'],
            ['pics', 'number'],
            ['active', 'number'],
            ['user_id', 'number']
        ];
    }



}