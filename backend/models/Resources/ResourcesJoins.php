<?php

namespace backend\models\Resources;

use backend\models\Resources;
use backend\models\AbstractModel;

class ResourcesJoins extends Resources
{
    
    public static function tableName() {
      return 'z_resources_joins';
    }
    
    /*
    * @return аттрибуты
    */
    public function attributeLabels()
    {
        return [
          'id'                   => "ID",
  				'resourceid'           => "Идентификатор",
  				'orderid'              => "Сортировка",
  				'model'                => "Модель",
				  'condition'            => "Условие",
				  'fields'               => "Поля",
        ];
    }

    /**
   	* Declares attribute hints.
   	*/
    public function attributeHints()
    {
        return [
          'id'                   => "",
  				'resourceid'           => "",
  				'orderid'              => "",
  				'model'                => "Присоединяемая модель, например, <b>backend/models/Languages</b>",
				  'condition'            => "Условие присоединения в SQL синтаксисе. Возможно применение шаблона:<br/>{{table}} - таблица текущей модели<br/>{{jointable}} - таблица присоединяемой модели<br/>Пример: {{table}}.lang_id={{jointable}}.id",
				  'fields'               => "Блоки разделяются символом \"|\"<br/>Каждый блок содержит поле таблицы и алиас этого поля в запросе<br/>Например: title|langname<br/><b>Все алиасы должны быть объявлены в backend\\models\\AbstractModelExtraFields!</b>",
        ];
    }
    
    public function beforeSave($insert)
    {
      if($insert) {
        //$this->filter_query = !empty($this->filter_query) ? $this->filter_query : "";
      } else {
        
      }
      return AbstractModel::beforeSave($insert);
		}
    
}
