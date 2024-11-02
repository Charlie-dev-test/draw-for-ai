<?
namespace backend\models;

use Yii;
use backend\helpers\Transliterator;
use backend\models\Translates;
use backend\models\Resources\ResourcesForms;
use backend\helpers\Form;


/**
 * Description of Resources
 */
class AbstractModel extends AbstractModelExtraFields
{
 	
 	private static $DEBUG = 0;

 	public static $isExternalExport = false;
 	
 	public static $childrenList = array();

 	public $resourcesParents = array();
 	public $resourcesParentIds = array();
 	public $resourcesChildren = array();

 	public static $resourcesDependents = array();
 	
 	public static $resourcesData = array(
 	 	"Resources" => array(
    	"parentField" => "parentid",
    	"titleField"  => "title"
    ),	
    "ResourcesColumns" => array(
    	"parentField" => "resourceid",
    	"titleField"  => "title"
    ),	
    "ResourcesConditions" => array(	
    	"parentField" => "resourceid",
    	"titleField"  => "condition"
    ),	
    "ResourcesForms" => array(	
    	"parentField" => "resourceid",
    	"titleField"  => "label"
		),	
    "ResourcesFormsParams" => array(		
    	"parentField" => "formid",
    	"titleField"  => "title"
    ),	
    "ResourcesJoins" => array(
    	"parentField" => "resourceid",
    	"titleField"  => "condition"
    ),	
    "ResourcesRefers" => array(
    	"parentField" => "resourceid",
    	"titleField"  => "field"
    )
  );

  public static $systemTables = array(
  	"helps",
  	"issues",
  	"languages",
  	"menus",
  	"files",
  	"resources",
  	"settings",
  	"test",
  	"translates",
  	"uploads",
  );

  public static $substTables = array(
  	"access_roles" => "auth_item",
  	"access_permissions" => "auth_item",
  	"test2" => "test",
  );

  public static function get_class($className)
  {
  	if(gettype($className) === "object") {
  		$className = get_class($className);
  	}
  	$classPath = explode("\\", $className);
  	return $classPath[count($classPath)-1];
  }

  public static function getClassName($className="")
  {
  	$getClass = !empty($_GET["section"]) ? $_GET["section"] : "";
  	$className = !empty($className) ? $className : $getClass;
  	
  	$className = str_replace("\\", "/", $className);
  	
  	//-- get the last part of the "section" parameter
  	//-- it will be the class name!
  	if(preg_match("{.*\-(.*)}si", $className, $matches)) {
  		$className = $matches[1];
  	}
  	if(preg_match("{.*\/(.*)}si", $className, $matches)) {
  		$className = $matches[1];
  	}

  	$namePieces = explode("_", $className);
  	
  	if(count($namePieces) > 1) {
  		$className = "";
  		foreach($namePieces as $nameItem) {
  			$className .= ucfirst($nameItem);
  			
  		}
  		$className = str_replace("_", "", $className);
  		
  	} else {
  		$className = ucfirst($className);
  	}

  	if(self::$DEBUG) {
  		
  	}

    return $className;
  }

  public static function initModel($modelName=null)
  {
  	if(!is_null($modelName)) {
  		$className = self::getClassName($modelName);
      $model = self::getAbstractModel($className);
      return $model;
  	} elseif(!empty($_GET["section"])) {
  		$sectionName = $_GET["section"];
  		if(!empty(self::$substTables[$sectionName])) {
  			$sectionName = self::$substTables[$sectionName];
  		}
  		
  		$className = self::getClassName($sectionName);
  		
      $model = self::getAbstractModel($className);
      
      return $model;
    } elseif(!empty($_GET["resourceid"])) {
      $model = self::getAbstractModel(Yii::$app->controller->id, false);
      
      return $model;
    } else {
    	$model = self::getAbstractModel('resources', false);
    	
    	return $model;
    }
    return null;
  }
  public static function initModelSearch()
  {
  	
  	if(!empty($_GET["section"])) {
  		$name = $_GET["section"];
  		if(!empty(self::$substTables[$name])) {
  			$name = self::$substTables[$name];
  		}
  		
  		$className = self::getClassName($name)."Search";
      
      $model = self::getAbstractModel($className);
      
      return $model;
    }
    return null;
  }
  
  public static function tableName()
  {
    //$tableName = "";
    //if(!empty($_GET["section"])) {
    	$tableName = $_GET["section"];
    //}
  	if(!empty(self::$substTables[$tableName])) {
  		$tableName = self::$substTables[$tableName];
  	}
    if(self::$DEBUG) {
    	
    }
    if(preg_match("{.*\-(.*)}si", $tableName, $matches)) {
    	$tableName = $matches[1];
    }
    if(in_array($tableName, AbstractModel::$systemTables)) {
    	$tableName = "z_".$tableName;
    }
    
    return $tableName;
  }

    /*
    * @return rules
    */
    public function rules()
    {
        $defaultAttrs = array_keys($this->attributeLabels());
        if(self::$DEBUG) {
        	
        }
        return [
            [$defaultAttrs, 'default'],
        ];
    }
    
    public function getMaxOrder()
    {
      return $this->find()
        ->max('orderid');
    }

    public function getMaxId($idName)
    {
      return $this->find()
        ->max($idName);
    }

    public static function checkExportDB()
    {
     	self::$isExternalExport = false;
     	if(!empty(Yii::$app->exportDB->dsn)) {
      	$sqlCommand = "SELECT 1 FROM `z_resources`";
      	try {
      		$result = \Yii::$app->exportDB->createCommand($sqlCommand)->queryAll();
      		self::$isExternalExport = true;
      	} catch(yii\db\Exception $ex) {
      		$msg = "Невозможно создать дамп для внешнего экспорта! Будет создан локальный...";
      		//Yii::$app->session->addFlash("danger", $ex->getMessage());
      		Yii::$app->session->addFlash("danger", $msg);
      	}
      }
    }
    
    public static function getMaxIdStatic($model, $idName)
    {
      $maxId = null;
      $modelObj = null;
      //-- if the model is String...
      if(gettype($model) === "string") {
      	$className = self::getClassName($model);
      	//-- get model as a common one
      	$modelObj = self::getAbstractModel($className);
      	if(is_null($modelObj)) {
      		//-- get model as a child of the Resources model
      		$modelObj = self::getAbstractModel($className, false);
      	}
      }
      //-- if the model is Object...
      if(gettype($modelObj) === "object") {
      	//-- check for the export database existence
      	$foundExportMaxId = false;
      	if(self::$isExternalExport) {
      		//-- the same table name as parent
      		$tableName = $modelObj::tableName();
      		$sqlCommand = "SELECT MAX(`".$idName."`) AS 'maxId' FROM `".$tableName."`";
      		//-- get Max ID from the export table
      		try {
      			$result = \Yii::$app->exportDB->createCommand($sqlCommand)->queryAll();
      			if(is_string($result[0]["maxId"]) && strlen($result[0]["maxId"]) > 0) {
      				//-- found Max ID from the export table!
	      			$maxId = $result[0]["maxId"];
  	    			$foundExportMaxId = true;
    	  		}
      		} catch(yii\db\Exception $ex) {
      			$msg = "Проблемы с созданием внешнего экспорта для таблицы ".mb_strtoupper($tableName, "utf-8")."!";
      			//Yii::$app->session->addFlash("danger", $ex->getMessage());
      			Yii::$app->session->addFlash("danger", $msg);
      		}
      	}
      	if(!$foundExportMaxId) {
      		//-- Max ID from the export table not found, use current model
      		$maxId = $modelObj::find()->max($idName);
      	}
      	if(!empty($maxId)) {
      		$maxId = (int)$maxId;
      	}
      }
      return $maxId;
    }
    
    public function beforeSave($insert)
    {
      $attrs = $this->getDirtyAttributes();
			$allOldAttrs = $this->getOldAttributes();
      $allFields = array_keys($allOldAttrs);
      foreach($allFields as $fld) {
      	if($this->isAttributeChanged($fld)) {
      		//-- changed
      		$value1 = $this->$fld;
      		if(is_array($value1)) {
      			$value1 = serialize($value1);
      		}
      		$value2 = $attrs[$fld];
      		if(is_array($value2)) {
      			$value2 = serialize($value2);
      		}
      	} else {
      		//-- unchanged
      		$this->$fld = $allOldAttrs[$fld];
      	}
      }
      
      
      $defaultAttrs = $this->attributes();
      
      //-- for INSERT only!
      if($insert) {
        if(in_array("orderid", $defaultAttrs)) {
        	$maxOrder = (int)$this->getMaxOrder();
        	$this->orderid = $maxOrder + 1;
        }
      }

			$sectionNameParameter = Yii::$app->getRequest()->getQueryParam('section');
			//$parentIdParameter = Yii::$app->getRequest()->getQueryParam('parentid');
			if(!empty($sectionNameParameter)) {
				$resource = Resources::getResourceByResourceName($sectionNameParameter);
				if(!empty($resource->id)) {
					$formResources = ResourcesForms::getFormByResourceId($resource->id);
					if(!empty($formResources[0]) && gettype($formResources[0]) === "object" && !empty($formResources[0]->type)) {
						foreach($formResources as $frm) {
							$fld = $frm->field;
							
							//-- handle MultiCheckbox form type
							if($frm->type === "MultiCheckbox") {
								//-- the field has been changed
								if($this->isAttributeChanged($fld)) {
      						$useSerialize = true;
									//-- if exists parameter in /params-local.php
									if(array_key_exists("DO_NOT_USE_MULTICHECKBOX_SERIALIZE", \Yii::$app->params)) {
										//-- if the parameter is true
										if(\Yii::$app->params["DO_NOT_USE_MULTICHECKBOX_SERIALIZE"] === true) {
											//-- do not use serialize for this type of fields!
											$useSerialize = false;
										}
									}
      						if($useSerialize) {
      							//-- do sirialize!
      							$this->$fld = serialize($this->$fld);
      						}
      					} else {
      						//-- unchanged
      						//$this->$fld = $allOldAttrs[$fld];
      					}
							}
							
							//-- handle UniqId form type
							//-- for INSERT only!
							if($insert && $frm->type === "UniqId") {
								//$fld = $frm->field;
								if(in_array($fld, $defaultAttrs)) {
									//-- get model name
									$modelName = str_replace("backend\\models\\", "", get_class(self::initModel()));
									//-- default value of UniqId length
									$uniqIdLength = 8;
									if(array_key_exists($modelName, $_POST)) {
										//-- post from form
										$flds = $_POST[$modelName];
										$uniqIdLengthField = $fld."_length";
										//-- UniqId length exists!
										if(!empty($flds[$uniqIdLengthField])) {
											$uniqIdLength = $flds[$uniqIdLengthField];
										}
									}
									$this->$fld = Form::getToken($uniqIdLength);
								}
							}
						}
					}
				}
			}
      
      
      if(in_array("smart_address", $defaultAttrs)) {
        $this->smart_address = trim((string)$this->smart_address);
        if($this->smart_address == "") {
        	$this->smart_address = Transliterator::translitForGoogle($this->title);
        }
        $result = AbstractModel::checkSmartAddress($this->id, $this->smart_address);
        if(!empty($result)) {
        	Yii::$app->session->addFlash("warning", "Умный адрес \"".$this->smart_address."\" уже существует! => <b>".implode(", ", $result)."</b>");
        }
      }
      if(in_array("date_modified", $defaultAttrs)) {
      	$this->date_modified = date("Y-m-d H:i:s");
      }
      if(in_array("active", $defaultAttrs)) {
      	$this->active = !empty($this->active) ? $this->active : 0;
      }
      //-- check ALL attrs for NULL and replace by the empty string
      //foreach($defaultAttrs as $attr) {
      	//$this->$attr = is_null($this->$attr) ? $this->$attr : "";
      //}



      //exit;
      
      return parent::beforeSave($insert);
		}

	

  /**
   * Declares attribute hints.
   */
  public function attributeHints()
  {
    return array();
  }

  /**
   * Return a hint
   */
  public function getHint( $attribute )
  {
    $hints = $this->attributeHints();
    return $hints[$attribute];
  }
  
  public function findOneModel($id, $sid="")
  {
    $query = self::find()->where(["id"=>$id]);
    if(!empty($sid)) {
    	$query->andWhere(["sid"=>$sid]);
    }
    $row = $query->one();
    return $row;
	}

	public static function getAbstractModel($id, $isParamId=true)
  {
  	$model = null;

  	//-- look for the models in the "models" folder
  	$modelsRootPath = false;
  	if($isParamId) {
  		$modelsRootPath = true;
  	}
  	$modelNamePieces = explode("/", $id);
		$modelName = "";
		foreach($modelNamePieces as $modelNamePiece) {
			$modelName .= ucfirst($modelNamePiece);
		}
		//-- check for the system models
		if(preg_match("{z_(.*)}si", $modelName, $matches)) {
    	$modelName = ucfirst($matches[1]);
    } elseif(preg_match("{(.*?)_(.*)}si", $modelName, $matches)) {
    	//-- check for the models with underlines
    	$pieces = explode("_", $modelName);
    	$realModelName = "";
    	foreach($pieces as $piece) {
    		$realModelName .= ucfirst($piece);
    	}
    	if(!empty($realModelName)) {
    		$modelName = $realModelName;
    	}
    }
    if(self::$DEBUG) {
    	
    }
  	$modelClass = "/backend/models/Resources";
		if($modelName !== "Resources") {
			$modelClass = "/backend/models/Resources/".$modelName;
		}
		if($modelsRootPath) {
			$modelClass = "/backend/models/".$modelName;
		}
		if(self::$DEBUG) {
			
		}
		$resourcesRootPath = Yii::getAlias('@resources_root');
		$classPath =  $resourcesRootPath.$modelClass.".php";
		
		if(file_exists($classPath)) {
			require_once($classPath);
			$modelClass = str_replace("/", "\\", $modelClass);
			$modelInstance = new $modelClass();
			if(!is_null($modelInstance) && gettype($modelInstance) === "object") {
				$model = $modelInstance;
			}
		}

		return $model;
  }

  /**
   * Возвращает ассоцитиативный массив, где ключом является поле, указанное в первом элементе параметра $keys а значение во второом
   * @param <array('id','title')> $keys
   * @param <array> $where
   * @param <array or string> $order
   * @return <array>
   */
  public function fetchPairs($keys=null,$where=null,$order=null)
  {
    $query = $this->find();
    if(is_null($keys)) {
    	$keys = array("id","title");
    }
    $query->select($keys);
    if(!empty($where)) {
    	$query->where($where);
    }
    if(!empty($order)) {
    	$query->orderBy($order);
    }
    $rows = $query->all();
    if(!is_null($rows)) {
      $pairs = array();
      foreach($rows as $row) {
      	$k = $keys[0];
      	$v = $keys[1];
      	$vals = $row->$v;
      	if(count($keys) > 2) {
      		$extraVals = [];
      		$notEmpty = false;
      		for($i=2;$i<count($keys);$i++) {
      			$v = $keys[$i];
      			$val = $row->$v;
      			if(!empty($val)) {
      				$extraVals[] = $val;
      				$notEmpty = true;
      			}
      		}
      		if($notEmpty) {
      			$vals .= " (".implode(", ", $extraVals).")";
      		}
      	}
      	$pairs[$row->$k] = $vals;
      }
    }
    return $pairs;
  }

  /**
   * Возвращает ассоцитиативный массив, где ключом является поле, указанное в первом элементе параметра $keys а значение во второом
   * @param <array('id','title')> $keys
   * @param <array> $where
   * @param <array or string> $order
   * @return <array>
   */
  public function fetchValues($keys=null,$where=null,$order=null)
  {
    $query = $this->find();
    if(is_null($keys)) {
    	$keys = array("title","id");
    }
    $query->select($keys);
    if(!empty($where)) {
    	$query->where($where);
    }
    if(!empty($order)) {
    	$query->orderBy($order);
    }
    $rows = $query->all();
    if(!is_null($rows)) {
      $items = array();
      foreach($rows as $row) {
      	$k = $keys[0];
      	$v = $row->$k;
      	
      	$items[$v] = $v;
      }
    }
    return $items;
  }

  public function upload()
  {
  	return true;
  }

  public static function checkSmartAddress($id, $smartAddress)
  {
  	$smartAddress = trim($smartAddress);
  	if(!empty($smartAddress)) {
  		$title = self::$resourcesData["Resources"]["titleField"];
  		$query = self::find()
        ->select(['id',$title])
        ->where(["smart_address" => $smartAddress])
      ;
      if(!empty($id)) {
      	$query->andFilterWhere(["<>", "id", $id]);
      }
      
      $rows = $query->all();
      $result = [];
      if(count($rows) > 0) {
      	foreach($rows as $row) {
      		$result[] = $row->title;
      	}
      }
			return $result;
		} else {
			return [];
		}
  }

  public function getResourcesData()
  {
  	return self::$resourcesData;
  }
  
  public function getSmartAddress($smartAddress, $parentId=null, $languageId=0)
  {
  	$smartAddress = trim($smartAddress);
  	if(!empty($smartAddress)) {
  		$rd = $this->getResourcesData();
  		
  		$query = $this->find()
        //->select(['id',$titleField])
        ->where(["smart_address" => $smartAddress])
      ;
      if(!is_null($parentId)) {
      	
      	$parentField = $this->getParentField();
      	$query->andWhere([$parentField => $parentId]);
      }
      if(!empty($languageId)) {
      	$query->andWhere(["lang_id" => $languageId]);
      }
      
      $row = $query->one();
      
			return $row;
		} else {
			return [];
		}
  }

  public function setParentField($section)
  {
  	
  	$resource = Resources::getResourceByResourceName($section);
  	
  	if(!empty($resource->parent_field)) {
  		$this->parentfield = $resource->parent_field;
  	}
  }
  public function getParentField()
  {
  	return $this->parentfield;
  }

  public static function chkAttributes($model, $attr, $isValue=true)
  {
  	$attributeLabels = array_keys($model->attributeLabels());
  	
  	return in_array($attr, $attributeLabels) ? ($isValue ? $model->$attr : true) : null;
  }

  public function search($params)
  {
  	$ams = new AbstractModelSearch();
  	return $ams->search($params);
  }

  public static function getFieldsDependencies()
  {
  	$fieldsDependencies = [];
  	return $fieldsDependencies;
  }

  public static function getFieldsList($model)
  {
  	return $model->getTableSchema()->getColumnNames();
  	/*
  	$connection = Yii::$app->db;//get connection
		$dbSchema = $connection->schema;
		//or $connection->getSchema();
		$tables = $dbSchema->getTables();//returns array of tbl schema's
		foreach($tables as $tbl) {
    	echo $tbl->rawName, ':<br/>', implode(', ', $tbl->columnNames), '<br/>';
		}
		*/
  }

  public function setHandlerCheck($model)
  {
  	$item = $model::tableName()."_".str_pad($model->id, 4, "0", STR_PAD_LEFT);
  	$addItem = !in_array($item, $this->handlerCheck);
  	if($addItem) {
  		$this->handlerCheck[] = $item;
  	}
  	return $addItem;
  }

  public static function getChildrenList($model, $id, $starts=true)
  {
  	if($starts) {
  		self::$childrenList = [];
  	}

  	$parentField = $model->getParentField();
  	if(!empty($parentField)) {
  		$query = $model->find()
        ->where([$parentField => $id])
      ;
      $rows = $query->all();
      foreach($rows as $row) {
      	self::$childrenList[] = $row->id;
      	self::getChildrenList($model, $row->id, false);
      }
    }
  }

  public static function getModelInfo($modelName)
  {
  	$modelInfo = [];
  	
  	$isParamId = true;
  	if(preg_match("{Resources(.*)}si", $modelName, $matches)) {
  		if(!empty($matches[1])) {
  			$isParamId = false;
  		}
  	}
  	
  	$model = self::getAbstractModel($modelName, $isParamId);
  	$className = get_class($model);
  	$modelInfo["class_name"] = $className;
  	
  	$class = new \ReflectionClass($className);
  	$classMethods = $class->getMethods();
  	$classMethods = [];
  	foreach($class->getMethods() as $m) {
    	if($m->class == $className) {
        $classMethods[] = $m->name;
    	}
		}
  	
  	$modelInfo["class_comments"] = $class->getDocComment();

  	$defaultProperties = $class->getDefaultProperties();

  	$classProperties = [];
  	foreach($class->getProperties() as $p) {
    	if($p->class == $className) {
        $prop = [];
        $prop["name"] = $p->name;
        $prop["comments"] = $p->getDocComment();
        $prop["value"] = null;
        if(!empty($defaultProperties[$p->name])) {
        	$prop["value"] = $defaultProperties[$p->name];
        }
        $propType = [];
  			if($p->isPrivate()) {
  				$propType[] = "private";
  			}
  			if($p->isProtected()) {
  				$propType[] = "protected";
  			}
  			if($p->isPublic()) {
  				$propType[] = "public";
  			}
  			if($p->isStatic()) {
  				$propType[] = "static";
  			}
  			$prop["type"] = $propType;
  			$modelInfo["class_properties"][] = $prop;
    	}
		}

  	foreach($classMethods as $classMethod) {
  		$modelInfo["class_methods"][$classMethod] = null;
  		try {
  			$reflection = new \ReflectionMethod($className, $classMethod);
  			$methodType = "";
  			if($reflection->isAbstract()) {
  				$methodType = "abstract";
  			}
				if($reflection->isConstructor()) {
  				$methodType = "constructor";
  			}
				if($reflection->isDestructor()) {
  				$methodType = "destructor";
  			}
				if($reflection->isFinal()) {
  				$methodType = "final";
  			}
				if($reflection->isPrivate()) {
  				$methodType = "private";
  			}
				if($reflection->isProtected()) {
  				$methodType = "protected";
  			}
				if($reflection->isPublic()) {
  				$methodType = "public";
  			}
				if($reflection->isStatic() ) {
  				$methodType = "static";
  			}
  			$modelInfo["class_methods"][$classMethod]["method_type"] = $methodType;
  			$modelInfo["class_methods"][$classMethod]["method_comments"] = $reflection->getDocComment();
  			foreach($reflection->getParameters() as $arg) {
  				$argName = $arg->getName();
  				$argType = null;
  				if(!is_null($arg->getType())) {
  					$argType = $arg->getType()->getName();
  				}
  				$modelInfo["class_methods"][$classMethod]["method_params"][$argName] = $argType;
  			}
  		} catch(\ReflectionException $ex) {}
  	}
  	
  	return $modelInfo;
  }

  /**
   * Save uploaded image or Replace by the file
	 * @param string $file File itself
	 * @param string $id File ID
	 * @param string $saved_file_id Saved file ID
	 * @param string $is_remove_flag Is remove?
   */
  public function saveImage($file, $id, $saved_file_id, $is_remove_flag, $params=[])
  {
  	$newId = 0;
  	$success = false;
    if(!empty($file)) {
      $uploads = new Uploads();
      if(!empty($saved_file_id) && $is_remove_flag == 0) {
      	//-- replace the file
      	$uploadModel = $uploads->replace($saved_file_id, $file);
      } else {
      	//-- create a new one
      	$uploadModel = $uploads->create($file, $params);
      }
      if(!empty($uploadModel->id)) {
      	//-- new value of Uploads::ID for the file
      	$newId = $uploadModel->id;
      }
      //Yii::$app->session->addFlash("warning", "uploaded: real:".$id."|new:".$newId."|saved:".$saved_file_id."|remove:".$is_remove_flag);
    } else {
    	Yii::$app->session->addFlash("danger", 'Файлов нет');
    }
    return $newId;
  }
  
  /**
   * Remove uploaded image and its folder
	 * @param string $id File ID
   */
  public function removeImage($id)
	{
		$uploads = new Uploads();
		return $uploads->removeFileDir($id);
	}

	public static function fixUrl($url)
	{
		return (strpos($url, "?") === false) ? "?" : "&";
	}

}
