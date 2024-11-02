<?php
namespace api\models;

use common\models\User;
use yii\behaviors\TimestampBehavior;

class Client extends User
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function(){ return date('Y-m-d');},
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->andWhere(['access_token' => $token])->one();
    }

    public static function findByUsername($username)
    {
        return self::find()->andWhere(['username' => $username])->one();
    }
    public function fields(){
        return [
            'id' => 'id',
            'username' => 'username',
            'email' => 'email',
        ];
    }
}