<?php

namespace backend\models;

use Yii;
use backend\models\AbstractModel;

class AuthItemChild extends AbstractModel
{
  public $name;
  
  public static function tableName()         
  {
      return 'auth_item_child';
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
  				'parent' => 'Роль',
				  'child' => 'Разрешение',
				  'orderid' => 'Сортировка',
				  'active' => 'Активность',
      ];
  }

  public function beforeSave($insert)
  {
    if($insert) {
    	$maxId = (int)$this->getMaxId('id');
      $this->id = $maxId + 1;
    }
    $this->active = !empty($this->active) ? $this->active : 0;
    return parent::beforeSave($insert);
	}

}