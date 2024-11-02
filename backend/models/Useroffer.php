<?php

namespace backend\models;

use backend\models\AbstractModel;
use backend\helpers\Form;
/**
 * Description of Useroffer
 */
class Useroffer extends AbstractModel
{
    public $token_length;
    /*
    * @return имя таблицы
    */
    public static function tableName()
    {
        return 'useroffer';
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
          "id"           => "ID",
          "token"        => "Токен",
          "token_length" => "Длина токен",
					"text"         => "Текст",
					"date"         => "Дата создания",
          "active"       => "Активность",
        ];
    }

    public function beforeSave($insert)
    {
    	if($insert) {
    		$this->date = date("Y-m-d H:i:s");
      	$this->token = Form::getToken($this->token_length);
      }
      return parent::beforeSave($insert);
		}

}