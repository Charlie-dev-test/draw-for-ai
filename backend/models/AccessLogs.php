<?php

namespace backend\models;

use Yii;
use backend\models\User;
use backend\validators\EscapeValidator;

class AccessLogs extends AbstractModel
{
    const CACHE_KEY = 'SIGNIN_TRIES';

    /**
     * Property: $_user bool
     */
    private $_user = false;
    /**
     * Property: $id int
     */
    public $id;

    public static function tableName()
    {
        return 'access_logs';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], EscapeValidator::className()],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('backend', 'Username'),
            'password' => Yii::t('backend', 'Password'),
            //'remember' => Yii::t('backend', 'Remember me'),
            "id" => "ID",
            "ip" => "IP",
            "user_agent" => "USER AGENT",
            "time" => "Дата",
            "success" => "Статус",
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('backend', 'Incorrect username or password.'));
            }
        }
    }

    public function login()
    {
        $cache = Yii::$app->cache;

        if(($tries = (int)$cache->get(self::CACHE_KEY)) > 5){
            $this->addError('username', Yii::t('backend', 'You tried to login too often. Please wait 5 minutes.'));
            return false;
        }

        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->time = time();

        if ($this->validate()) {
            $this->password = '******';
            $this->success = 1;
        } else {
            $this->success = 0;
            $cache->set(self::CACHE_KEY, ++$tries, 300);
        }
        $this->insert(false);

        return $this->success ? Yii::$app->user->login($this->getUser(), Settings::get('auth_time') ?: null ) : false;

    }

    public function getUser()
    {
        if ($this->_user === false) {
//            $this->_user = Admin::findByUsername($this->username);
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
