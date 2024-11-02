<?php

namespace backend\models\Resources;

use backend\models\Resources;
use backend\models\AbstractModel;

class ResourcesForms extends Resources
{
    
    public static function tableName() {
      return 'z_resources_forms';
    }
    
    /*
    * @return аттрибуты
    */
    public function attributeLabels()
    {
        return [
          'id'              => "ID",
  				'resourceid'      => "Идентификатор",
          'orderid'         => "Порядок",
          'type'            => "Тип",
          'field'           => "Поле",
          'label'           => "Название (label)",
          'required'        => "Обязательное",
          'value'           => "Значение по умолчанию",
          'description'     => "Описание",
          'only_for_root'   => "Видно только для суперпользователя",
          'show_check'      => "Функция проверки доступности",
          'is_file'         => "Удалять файл",
          'parentid'        => "Родитель",
          'multiple_upload' => "Пакетная загрузка файлов",
        	'active'          => 'Активность',
        ];
    }

    /**
   	* Declares attribute hints.
   	*/
    public function attributeHints()
    {
    		return [
          'id'              => "",
  				'resourceid'      => "",
          'orderid'         => "",
          'type'            => "Для каждого поля типа \"Файл\" в модели должны быть созданы атрибуты <b>имяполя_saved_file</b> и <b>имяполя_remove_file</b>!<br/>Пример:<br/>class Files {<br/>&nbsp;&nbsp;&nbsp;public \$pics_saved_file;<br/>&nbsp;&nbsp;&nbsp;public \$pics_remove_file;<br/>}",
          'field'           => "Начните вводить имя поля или его наименование... и выберите поле из списка",
          'label'           => "",
          'required'        => "",
          'value'           => "Обычно используется для задания значений по умолчанию для полей типа Hidden",
          'description'     => "Будет отображаться как комментарий на форме ниже поля ввода",
          'only_for_root'   => "",
          'show_check'      => "PHP функция. Если возвращает false, то поле будет недоступно<br/>Пример:<br/>\$id = (int)Yii::\$app->getRequest()->getQueryParam('id');<br/>return (\$id > 1);",
          'is_file'         => "Действует только для типа \"Файл\". Если флажок установлен, то при удалении элемента, будет удален и сопутствующий файл",
          'parentid'        => "",
          'multiple_upload' => "Актуально только для данных типа \"Файл\": дает возможность использования виджета одновременной загрузки нескольких файлов",
          'active'          => 'Отображать или нет поле в форме',
        ];
    }

    public function beforeSave($insert)
    {
      //if($insert) {
        $this->value = !empty($this->value) ? $this->value : "";
        $this->parentid = !empty($this->parentid) ? $this->parentid : "0";
        $this->description = !empty($this->description) ? $this->description : "";
        $this->show_check = !empty($this->show_check) ? $this->show_check : "";
      //} else {
        
      //}
      return AbstractModel::beforeSave($insert);
		}

		public static function getFormById($id)
		{
			$model = self::findOne($id);
     	return $model;
		}
		public static function getFormByResourceId($id)
		{
			$model = self::find()->where(["resourceid" => $id])->all();
     	return $model;
		}
    
}
