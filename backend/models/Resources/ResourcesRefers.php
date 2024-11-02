<?php

namespace backend\models\Resources;

use backend\models\Resources;
use backend\models\AbstractModel;

class ResourcesRefers extends Resources
{
    
  public $model_object = null;
  
  public static function tableName() {
    return 'z_resources_refers';
  }
  
  /*
  * @return аттрибуты
  */
  public function attributeLabels()
  {
      return [
        'id'           => "ID",
  			'resourceid'   => "Идентификатор",
        'field'        => "Поле",
        'model'        => "Модель",
        'field1'       => "Поле для связи на таблицу текущей модели",
        'field2'       => "Поле для связи на таблицу указанной модели",
        'parentid'     => "Родитель",
        'model_object' => "Model Object",
      ];
  }

  /**
  * Declares attribute hints.
  */
  public function attributeHints()
  {
      return [
        'id'         => "",
  			'resourceid' => "",
        'model'      => "Модель таблицы для хранения связанных данных таблиц #1 и #2",
        'field'      => "Поле со списком мультивыбора из таблицы #1",
        'field1'     => "Поле для связи из таблицы #1",
        'field2'     => "Поле для связи из таблицы #2",
        'parentid'   => "",
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

	//-- $rowsRefers - list of all refers
	//-- $rowField - current field name for using refers
	//-- $id - ID of the row for update
	public static function getRefers($rowsRefers, $rowField, $id)
  {
  	$result = [];
  	foreach($rowsRefers as $rowsRefer) {
  		if(!empty($rowsRefer->field) && !empty($rowsRefer->model) && !empty($rowsRefer->field1) && !empty($rowsRefer->field2)) {
      	$refField = $rowsRefer->field;
      	//-- not current field name => skip it!
      	if($refField !== $rowField) {
      		continue;
      	}
      	$refModel = $rowsRefer->model;
      	$refField1 = $rowsRefer->field1;
      	$refField2 = $rowsRefer->field2;
      	
      	$className = AbstractModel::getClassName($refModel);
      	$modelRefer = AbstractModel::getAbstractModel($className);
      	
      	$modelRefers = $modelRefer::find()->where([$refField2 => $id])->all();
      	foreach($modelRefers as $modelRefer) {
      		$result[] = $modelRefer->$refField1;
      	}
      }
    }
    return $result;
	}

	//-- $rowsRefers - list of all refers
	//-- $rowField - current field name for using refers
	public static function getRefersInfo($rowsRefers, $rowField)
  {
  	$result = null;
  	foreach($rowsRefers as $rowsRefer) {
  		if(!empty($rowsRefer->field) && !empty($rowsRefer->model) && !empty($rowsRefer->field1) && !empty($rowsRefer->field2)) {
      	$refField = $rowsRefer->field;
      	//-- not current field name => skip it!
      	if($refField !== $rowField) {
      		continue;
      	}
      	$refModel = $rowsRefer->model;
      	$refField1 = $rowsRefer->field1;
      	$refField2 = $rowsRefer->field2;
      	
      	$className = AbstractModel::getClassName($refModel);
      	$modelRefer = AbstractModel::getAbstractModel($className);
      	$rowsRefer->model_object = $modelRefer;
      	
      	return $rowsRefer;
      }
    }
    return $result;
	}

}
