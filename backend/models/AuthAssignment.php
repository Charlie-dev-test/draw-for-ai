<?php

namespace backend\models;

use Yii;
use backend\models\AbstractModel;

class AuthAssignment extends AbstractModel
{
  public static function tableName()         
  {
      return 'auth_assignment';
  }
  
  public function rules()
  {
      $defaultAttrs = array_keys($this->attributeLabels());
      return [
          [$defaultAttrs, 'default'],
      ];
  }
  
  public function attributeLabels()
  {
      return [
  			'id' => 'ID',
  			'item_name' => 'Роль',
  			'user_id' => 'Пользователь ID',
				'created_at' => 'Создано',
				'orderid' => 'Сортировка',
				'active' => 'Активность',
      ];
  }

  public function beforeSave($insert)
  {
    if($insert) {
    	$maxId = (int)$this->getMaxId('id');
      $this->id = $maxId + 1;
    	$this->created_at = time();
    } else {
      
    }
    $this->active = !empty($this->active) ? $this->active : 0;
    //$this->tag    = !empty($this->tag) ? $this->tag : "";
    return parent::beforeSave($insert);
	}
    
}