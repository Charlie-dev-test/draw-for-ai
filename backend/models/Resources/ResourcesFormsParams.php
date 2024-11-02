<?php

namespace backend\models\Resources;

use backend\models\Resources;
use backend\models\AbstractModel;

class ResourcesFormsParams extends Resources
{
    
    public static function tableName()
    {
      return 'z_resources_forms_params';
    }
    
    /*
    * @return аттрибуты
    */
    public function attributeLabels()
    {
        return [
          'id'                   => "ID",
          'formid'               => "ID формы",
          'title'                => "Имя параметра",
          'value'                => "Значение",
          'is_eval'              => "PHP код",
          'parentid'             => "Родитель",
        ];
    }

    /**
   	* Declares attribute hints.
   	*/
    public function attributeHints()
    {
        return [
          'id'                   => "",
          'formid'               => "",
          'title'                => "Пример: multiOptions",
          'value'                => "Пример:<br/>return array('int'=>'Число','bool'=>'Да/Нет','string'=>'Строка');<br/>или<br/>\$langsModel = new backend\\models\\Languages();<br/>return \$langsModel->fetchPairs(array('id','title'),array(),'orderid');",
          'is_eval'              => "",
          'parentid'             => "",
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
