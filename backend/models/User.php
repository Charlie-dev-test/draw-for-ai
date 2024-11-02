<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
//use yii\web\User;
use yii\web\IdentityInterface;
use frontend\models\Post;

use backend\models\AuthItem;
use backend\models\AuthItemChild;
//use yii\rbac\DbManager;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */

class User extends AbstractModel implements IdentityInterface
{

  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 10;

  const ROLE_ROOT = 'root';
  const ROLE_EDITOR = 'editor';
  const ROLE_MANAGER = 'manager';
  const ROLE_USER = 'user';

  public $code;
  public $title;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
  	return 'user';
  }

  public static function getListOfRoles()
  {
  	return [
  		self::ROLE_ROOT => "Администратор (root)",
  		self::ROLE_EDITOR => "Редактор (editor)",
  		self::ROLE_MANAGER => "Менеджер (manager)",
  		self::ROLE_USER => "Пользователь (user)",
  	];
  }
    
	public static function getRolesPairs()
  {
		$rolesPairs = [];
		
		$allRoles = array_keys(self::getListOfRoles());
		foreach($allRoles as $role) {
			$rolesPairs[$role] = $role;
		}

		return $rolesPairs;
	}
	public static function getRolesDependencies()
  {
  	$allRoles = array_keys(self::getListOfRoles());
  	
  	$rolesDependencies = [
  		//-- can work with any users
  		self::ROLE_ROOT => $allRoles,
  		self::ROLE_EDITOR => [],
  		self::ROLE_MANAGER => [
  			//-- can work with all users, who the ROLE_USER are
  			self::ROLE_USER,
  		],
  		self::ROLE_USER => [],
  	];

  	return $rolesDependencies;
  }

    
  /**
   * @inheritdoc
   */
  public function behaviors() {
      return [
          TimestampBehavior::className(),
      ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    $globalControllerId = Yii::$app->controller->id;
		$globalActionId = Yii::$app->controller->action->id;
    $rules = [
      ['username', 'required'],
      ['username', 'unique'],
      ['fullname', 'required'],
      ['email', 'email'],
      [['role'], 'trim'],
      //['password_hash', 'required', 'on' => 'create'],
      //['password_hash', 'safe'],
      ['status', 'default', 'value' => self::STATUS_ACTIVE],
      ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
    ];
    if($globalActionId === "create") {
    	//$rules[] = ['openpasswordfield', 'required'];
    }
    return $rules;
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'username'          => 'Логин',
      'fullname'          => 'Полное имя',
      'title'             => 'Заголовок',
      'password_hash'     => 'Пароль',
      'email'             => 'Электронная почта',
      'role'              => 'Роль',
      'openpasswordfield' => 'Новый пароль',
      "active"            => "Активность",
    ];
  }

  public function beforeSave($insert)
  {
      if(parent::beforeSave($insert)) {
      	if(!empty($_POST["User"]["openpasswordfield"])) {
      		$this->openpasswordfield = $_POST["User"]["openpasswordfield"];
      		$this->password_hash = $this->hashPassword($this->openpasswordfield);
      	}
        if($this->isNewRecord) {
          $maxId = (int)$this->getMaxId('id');
      		$this->id = $maxId + 1;
          $this->auth_key = $this->generateAuthKey();
          $this->created_at = date("Y-m-d", time());
          //if(!empty($this->openpasswordfield)) {
          //	$this->password_hash = $this->hashPassword($this->openpasswordfield);
          //}
        } else {
        	//if(!empty($this->openpasswordfield)) {
          //	$this->password_hash = $this->hashPassword($this->openpasswordfield);
          //}
          //$this->password_hash = !empty($this->openpasswordfield) != '' ? $this->hashPassword($this->password_hash) : $this->oldAttributes['password_hash'];
        }
        $this->password_reset_token = !empty($this->password_reset_token) ? $this->password_reset_token : "";
        $this->pass_reset_date = !empty($this->pass_reset_date) ? $this->pass_reset_date : "0000-00-00";
        $this->pass_reset_count = !empty($this->pass_reset_count) ? $this->pass_reset_count : "0";
        $this->updated_at = date("Y-m-d", time());

        return true;
      } else {
        return false;
      }
  }

  public function afterSave($insert, $changedAttributes)
  {
  	$add = $this->addRole($this->id, $this->role);
  }

  private function addRole($usersId, $role)
  {
    if(!empty($usersId) && !empty($role)) {
      $row = 	AuthAssignment::find()->where(['user_id' => $usersId])->one();
      if(!empty($row->id)) {
      	//-- found => delete!
      	$row->delete();
      }
      $authAssignment = new AuthAssignment();
      $authAssignment->item_name = $role;
      $authAssignment->user_id = $usersId;
      $authAssignment->save();
      
      return true;
    }
    return false;
  }

  private function hashPassword($password) {
      return Yii::$app->security->generatePasswordHash($password);
  }

  /**
   * @inheritdoc
   */
  public static function findIdentity($id)
  {
      //return self::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
      return self::findOne(['id' => $id]);
  }

  /*
  public function findOneModel($id)
  {
  	return self::findOne($id);
	}
	*/

  /**
   * @inheritdoc
   */
  public static function findIdentityByAccessToken($token, $type = null) {
      throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
  }

  /**
   * Finds user by username
   *
   * @param string $username
   * @return static|null
   */
  public static function findByUsername($username) {
      return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
  }

  /**
   * Finds user by password reset token
   *
   * @param string $token password reset token
   * @return static|null
   */
  public static function findByPasswordResetToken($token) {
      if (!static::isPasswordResetTokenValid($token)) {
          return null;
      }

      return static::findOne([
                  'password_reset_token' => $token,
                  'status' => self::STATUS_ACTIVE,
      ]);
  }

  /**
   * Finds out if password reset token is valid
   *
   * @param string $token password reset token
   * @return bool
   */
  public static function isPasswordResetTokenValid($token) {
      if (empty($token)) {
          return false;
      }

      $timestamp = (int) substr($token, strrpos($token, '_') + 1);
      $expire = Yii::$app->params['access_users.passwordResetTokenExpire'];
      return $timestamp + $expire >= time();
  }

  /**
   * @inheritdoc
   */
  public function getId() {
      return $this->getPrimaryKey();
  }

  /**
   * @inheritdoc
   */
  public function getAuthKey() {
      return $this->auth_key;
  }

  /**
   * @inheritdoc
   */
  public function validateAuthKey($authKey) {
      return $this->getAuthKey() === $authKey;
  }

  /**
   * Validates password
   *
   * @param string $password password to validate
   * @return bool if password provided is valid for current user
   */
  public function validatePassword($password) {
      return Yii::$app->security->validatePassword($password, $this->password_hash);
  }

  /**
   * Generates password hash from password and sets it to the model
   *
   * @param string $password
   */
  public function setPassword($password) {
      $this->password_hash = Yii::$app->security->generatePasswordHash($password);
  }

  /**
   * Generates "remember me" authentication key
   */
  private function generateAuthKey() {
      return Yii::$app->security->generateRandomString();
  }

  /**
   * Generates new password reset token
   */
  public function generatePasswordResetToken() {
      $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
  }

  /**
   * Removes password reset token
   */
  public function removePasswordResetToken() {
      $this->password_reset_token = null;
  }

  public static function getUserRole()
  {
  	return Yii::$app->getUser()->identity->role;
  }

  public static function getUserName()
  {
  	return Yii::$app->user->identity->username;
  }

  public function isRoot() {
      $id = Yii::$app->user->identity->id;
      return array_key_exists('root', Yii::$app->authManager->getRolesByUser($id));
  }

  public static function getUserCode($user)
  {
  	$userCode = $user->username;
  	if($npos = strpos($userCode, "-")) {
  		$userCode = substr($userCode, 0, $npos);
  	}
  	return $userCode;
  }


	public static function getRoleIdByName($name)
	{
		$row = AuthItem::find()->select('id')
			->where(['name' => $name, 'type' => 1])
			->one()
		;
  	return !empty($row->id) ? $row->id : 0;
	}
    
	public static function getUsersByRole($role)
	{
		$rows = self::find()->select('*')
			->where(['role' => $role])
			->all()
		;
  	return $rows;
	}

	public static function getPermissionByRoleId($role_id, $name)
	{
		$row = AuthItemChild::find()->select('id')
			->where(['parent' => $role_id, 'child' => $name])
			->one()
		;
  	return !empty($row->id);
	}
    
  public static function can($permissionName, $params = [], $allowCaching = true)
  {
  	$roleId = self::getRoleIdByName(self::getUserRole());
  	$flag = false;
  	if(!empty($roleId)) {
  		return self::getPermissionByRoleId($roleId, $permissionName);
  	}
  }

}
