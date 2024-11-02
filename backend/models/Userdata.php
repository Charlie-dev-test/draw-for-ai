<?php

namespace backend\models;

use backend\models\AbstractModel;

/**
 * Description of Userdata
 */
class Userdata extends AbstractModel
{
    
    /*
    * @return имя таблицы
    */
    public static function tableName()
    {
        return 'userdata';
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
          "user_id"      => "ID юзера",
					"citizenship"  => "Гражданство",
					"dob"          => "Дата рождения",
					"passport"     => "Паспортные данные",
					"address_reg"  => "Адрес места регистрации",
					"address_loc"  => "Адрес фактического проживания",
					"phone"        => "Номер мобильного телефона",
					"inn"          => "Номер ИНН",
					"snils"        => "Номер СНИЛС",
					"bank_card"    => "№ банковской карты",
					"bank_account" => "№ счета, привязанного к карте",
					"bank_name"    => "Наименование банка",
					"bank_bik"     => "БИК",
					"bank_corr"    => "Корр. счет",
          "active"       => "Активность",
          "orderid"      => "Сортировка",
        ];
    }

    public function beforeSave($insert)
    {
    	if($date = \DateTime::createFromFormat('d.m.Y', $this->dob)) {
    		$this->dob = $date->format("Y-m-d");
    	}
      //$this->title = !empty($this->title) ? $this->title : "";
      
      return parent::beforeSave($insert);
		}

}