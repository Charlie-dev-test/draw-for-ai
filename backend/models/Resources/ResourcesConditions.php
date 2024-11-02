<?php

namespace backend\models\Resources;

use backend\models\Resources;
use backend\models\AbstractModel;

class ResourcesConditions extends Resources
{
    
    /*
    * @return имя таблицы
    */
    public static function tableName() {
      return 'z_resources_conditions';
    }
    
    /*
    * @return аттрибуты
    */
    public function attributeLabels() {
        return [
          'id'                   => "ID",
  				'resourceid'           => "Идентификатор",
  				'condition'            => "Поле",
  				'value'                => "Значение",
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
  				'condition'            => "Пример: sid",
  				'value'                => "Пример: menu",
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

		public static function getResourceConditions($resourceid)
		{
			$model = self::findOne($id);
     	return $model;
		}

}
