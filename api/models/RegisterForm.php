<?php


namespace api\models;


use api\models\Offer;
use api\models\resources\ClientResource;
use yii\base\Model;
use api\models\Client;
use Yii;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $_user = null;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\api\models\Client', 'message' => 'Этот логин уже занят!'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\api\models\Client', 'message' => 'Этот Email уже используется!'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @return Token|null
     */
    public function auth()
    {
        return null;
        //todo: implement producing token
    }

    /**
     * Finds user by [[username]]
     *
     * @return Client|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = ClientResource::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function register()
    {
        if ($this->validate()) {
            $offer_token = Offer::getOfferToken();
            $security = \Yii::$app->security;
            $this->_user = new ClientResource();
            $this->_user->username = $this->username;
            $this->_user->password_hash = $security->generatePasswordHash($this->password);
            $this->_user->access_token = $security->generateRandomString(255);
            $this->_user->email = $this->email;
            $this->_user->fullname = '';
            $this->_user->password_reset_token = '';
            $this->_user->auth_key = '';
            $this->_user->pass_reset_date = '0000-00-00';
            $this->_user->pass_reset_count = 0;
            $this->_user->created_at = '';
            $this->_user->updated_at = '';
            $this->_user->role = 'user';
            $this->_user->status = 10;
            $this->_user->active = 0;
            $this->_user->offer_token = $offer_token['token'];
            if ($this->_user->save()) {
                return Yii::$app->user->login($this->getUser(), 0);
            }
            return false;
        }

        return false;
    }
}