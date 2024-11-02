<?php

namespace api\models;


use api\models\resources\ClientResource;
use Yii;

/**
 * Login form
 */
class LoginForm extends \common\models\LoginForm
{

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = ClientResource::findByUsername($this->username);
        }

        return $this->_user;
    }


    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }
}
