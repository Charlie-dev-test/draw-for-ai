<?php

namespace backend\models;

use backend\models\AbstractModel;
use backend\helpers\Form;
/**
 * Description of Usertask
 */
class Usertask extends AbstractModel
{
  const STATUS_AVAILABLE = 1;
  const STATUS_EXECUTING = 2;
  const STATUS_CHECKING = 3;
  const STATUS_PAID = 4;
  const STATUS_PENDING = 5;
  const STATUS_ARCHIVED = 6;

  public $token_length;
  /*
  * @return имя таблицы
  */
  public static function tableName()
  {
      return 'usertask';
  }

  /*
  * @return правила
  */
  public function rules()
  {
    $defaultAttrs = array_keys($this->attributeLabels());
    return [
      [$defaultAttrs, 'default'],
    ];
  }
  
  /*
  * @return атрибуты
  */
  public function attributeLabels()
  {
      return [
        "id"       => 'Номер задания',
				"date"     => 'Дата задания',
				"title"    => 'Название задания',
				"desc"     => 'Подробное описание задания',
				"num"      => 'Количество данных для разметки',
				"price"    => 'Стоимость',
        "duration" => 'Оценочная длительность',
        "status"   => 'Текущий статус',
        "user_id"  => "Пользователь",
        "active"   => "Активность",

      ];
  }

  public function beforeSave($insert)
  {
  	if($insert) {
  		$this->date = date("Y-m-d H:i:s");
    }
    return parent::beforeSave($insert);
	}

  public static function getStatus()
	{
		$listOptions = [
			self::STATUS_AVAILABLE => "Доступна",
  		self::STATUS_EXECUTING => "Выполняется",
  		self::STATUS_CHECKING  => "На проверку",
  		self::STATUS_PAID      => "Оплачена",
			self::STATUS_PENDING   => "В процессе",
			self::STATUS_ARCHIVED  => "Архивная",
		];
		return $listOptions;
	}

  public static function getStatusColor()
	{
		$listOptions = [
			self::STATUS_AVAILABLE => "#000",
  		self::STATUS_EXECUTING => "#00f",
  		self::STATUS_CHECKING  => "#e00",
  		self::STATUS_PAID      => "#0c0",
			self::STATUS_PENDING   => "#800080",
			self::STATUS_ARCHIVED  => "#999",
		];
		return $listOptions;
	}
    
  public static function getUserTasks()
	{
		$userId = null;
		if(!is_null(\Yii::$app->user->id)) {
			$userId = \Yii::$app->user->id;
		}
		
		$params = "`active`=1";
		if(!is_null($userId)) {
			//-- (user_id = 0) AND (status = self::STATUS_AVAILABLE) 
			//-- (user_id = $userId) AND (status <> self::STATUS_AVAILABLE)
			$params .= " AND ((`user_id`='".$userId."' AND `status`<>'".self::STATUS_AVAILABLE."') OR (`user_id`=0 AND `status`='".self::STATUS_AVAILABLE."'))";
		}
		$rows = self::find()->select('*')
			->where($params)
			->all()
		;
  	return $rows;
	}
    
  public static function getUserTask($id)
	{
		$userId = null;
		if(!is_null(\Yii::$app->user->id)) {
			$userId = \Yii::$app->user->id;
		}
		
		$params = "`active`=1";
		if(!is_null($userId)) {
			$params .= " AND `id`='".$id."'";
		}
		$row = self::find()->select('*')
			->where($params)
			->one()
		;
  	return $row;
	}
    
}