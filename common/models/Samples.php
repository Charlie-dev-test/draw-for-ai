<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "samples".
 *
 * @property int $id ID
 * @property string $title Title
 */
class Samples extends \yii\db\ActiveRecord
{
    /**
     *
     */
    public static function tableName()
    {
        return 'samples';
    }

    /**
     *
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     *
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
						'title' => 'Название',
        ];
    }

    public static function getSamples()
    {
        return self::find()->all();
    }

}
