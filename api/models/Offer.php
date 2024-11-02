<?php


namespace api\models;

use yii\db\ActiveRecord;

class Offer extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%useroffer}}';
    }

    public static function getActiveOffer(){
        return self::find()->andWhere(['active' => 1])->one();
    }

    public static function getOfferToken(){
        return self::find()->andWhere(['active' => 1])->one()->toArray(['token']);
    }

}