<?

namespace backend\models;

use Yii;
use backend\models\AbstractModel;
use backend\models\Resources;
use backend\models\Resources\ResourcesColumns;
use backend\models\Resources\ResourcesConditions;
use backend\models\Resources\ResourcesForms;
use backend\models\Resources\ResourcesFormsParams;
use backend\models\Resources\ResourcesJoins;
use backend\models\Resources\ResourcesRefers;

use backend\models\Uploads;
use backend\helpers\Funcs;
use backend\helpers\Getsql;

/**
 * Description of Resources
 */
class Resources extends AbstractModel
{
  const DEBUG = false;

  private static $MSTIME = 0;
  private static $OPTIMIZED_RESOURCES_LIST = [];
  
  public static $numRecordsRes = 0;
  public static $numRecordsMod = 0;
  public static $numRecordsFld = 0;
  public static $uploadsIdList = [];
  public static $handlerCheck = [];

  const MODE_DELETE = "delete";
  const MODE_SAVE = "save";
  const MODE_EXPORT = "export";
  
  public static $modeMessage = [
  	self::MODE_DELETE => "удалено",
  	self::MODE_SAVE   => "сохранено",
  	self::MODE_EXPORT => "экспортировано",
  ];
  
  public static $resourcesList = [];
  public static $resourcesDependentsInUse = [];

  public static $EXPORT_FOLDER = "/web/data/export";
  public static $EXPORT_URL = "/data/export";

  public static $SQL_FILE_NAME = "/[TIMESTAMP]_complete_cms.sql";
  public static $SQL_FILE_URL = "/[TIMESTAMP]_complete_cms.sql";
  
  public static $ZIP_FILE_NAME = "/[TIMESTAMP]_complete_cms.zip";
	public static $ZIP_FILE_URL = "/[TIMESTAMP]_complete_cms.zip";

	public static $FILE_NAMES_SET = false;
  
  public static $exportSql = "";
  public static $exportStruct = [];
	
	public static $typesList = array(
    "Text"           => "Строка",
    "Autocomplete"   => "Автодополнение",
    //"AutocompleteId" => "Автодополнение с выбором идентификатора",
    "Date"           => "Дата",
    "Textarea"       => "Текст",
    "Mce"            => "HTML редактор",
    "File"           => "Файл",
    "Select"         => "Выпадающий список",
    "Radio"          => "Радиокнопка",
    "Multiradio"     => "МультиРадиокнопка",
    "Checkbox"       => "Флажок",
    "MultiCheckbox"  => "МультиФлажок",
    "EditArea"       => "Редактор кода",
    "Hidden"         => "Скрытое поле",
    "Password"       => "Пароль",
    "UniqId"         => "Уникальный ID",
    //"PointPicker"    => "Выбор точки на картинке",
	);

  public static $dataTypesList = array(
  	"band"    => "Лента",
	  "catalog" => "Каталог",
	);
    
    /*
    * @return имя таблицы
    */
    public static function tableName()
    {
        return 'z_resources';
    }
    
    /*
    * @return правила
    */
    public function rules()
    {
        $defaultAttrs = array_keys($this->attributeLabels());
        return [
            [$defaultAttrs, 'default'],
            //[['title','resourceid'], 'string'],
            //[['title','resourceid'], 'required'],
            //['visible', 'integer', 'integerOnly'=>true],
            //OR optional 
            //[['visible','parent_field','model'], 'safe'],
            //[['parentid'], 'integer'],
            //[['title'], 'string'],
            //[['model'], 'string', 'max' => 255],
            //[['parentid'], 'exist', 'skipOnError' => true, 'targetClass' => Resources::className(), 'targetAttribute' => ['parentid' => 'id']],
        ];
    }
    
    /*
    * @return аттрибуты
    */
    public function attributeLabels()
    {
        return [
          'id'                   => "ID",
          'resourceid'           => "Идентификатор/Ссылка",
          'actionid'             => "Действие",
          'parentid'             => "Родитель",
          'orderid'              => "Порядок сортировки",
          'title'                => "Название",
          'model'                => "Модель",
          'menu_icon'            => "Иконка меню",
          'datatype'             => "Тип",
          'indexate'             => "Поля для индексирования",
          'default_field'        => "Поле по умолчанию",
          'parent_field'         => "Родительское поле",
          'order'                => "Сортировка",
          'group'                => "Группировка",
          'paginate'             => "Постраничность",
          'can_delete'           => "Разрешить удалять?",
          'can_edit'             => "Разрешить редактировать?",
          'can_add'              => "Разрешить добавлять?",
          'delete_confirm'       => "Подтверждение удаления?",
          'delete_on_have_child' => "Удалять при наличии детей?",
          'sortable'             => "Сортируемый?",
          'sortable_position'    => "Позиция при добавлении",
          'visible'              => "Видимый в меню?",
          'on_have_subcat'       => "Показывать этот ресурс для всех разделов каталога",
          'direct_link'          => "Прямая ссылка",
          'active'               => 'Активность',
        ];
    }

    /**
   	* Declares attribute hints.
   	*/
    public function attributeHints()
    {
        $fldParentField = $this->attributeLabels()["parent_field"];
        $fldDirectLink = $this->attributeLabels()["direct_link"];
        $htmlFormat = "<font color=\"red\"><b>Заголовок</b></font>";
        return [
          'id'                   => "",
          'resourceid'           => "Правило заполнения Идентификатора ресурса: <b>имямодели1-имямодели2-имямодели3</b><br/>Пример: <b>menus-issues-translates</b> (Меню-Статьи-Переводы)<br/>Если включена галочка \"<b>".$fldDirectLink."</b>\", то в поле вводится ссылка, например, <b>/adm/help</b>",
          'actionid'             => "",
          'parentid'             => "Привязка к родительскому ресурсу, если необходимо",
          'orderid'              => "",
          'title'                => "Могут использоваться HTML-теги для форматирования.<br/>Пример: <b>".htmlspecialchars($htmlFormat)."</b>, результат: ".$htmlFormat,
          'model'                => "Привязка к модели, если необходимо",
          'menu_icon'            => "Иконка для меню CMS: см. список по ссылке ниже",
          'datatype'             => "<b>Лента</b> - отображение записей в Grid-е, <b>Каталог</b> - отображение записей в TreeGrid-е",
          'indexate'             => "Список полей через точку с запятой",
          'default_field'        => "",
          'parent_field'         => "Используется, если вы хотите установить связь с родительской таблицей. В этом случае родительской таблицей является таблица модели родительского ресурса<br/>Пример: Текущая модель - Issues, родительская - Menus. \"".$fldParentField."\" <b>catalog_id</b> модели <b>Issues</b> будет принимать значение <b>id</b> модели <b>Menus</b>",
          'order'                => "Список полей для сортировки, разделяемый запятыми<br/>Пример: <b>orderid;id DESC</b>",
          'group'                => "",
          'paginate'             => "Число записей на одной странице",
          'can_delete'           => "",
          'can_edit'             => "",
          'can_add'              => "",
          'delete_confirm'       => "",
          'delete_on_have_child' => "",
          'sortable'             => "",
          'sortable_position'    => "Работает только в сортируемых каталогах и списках",
          'visible'              => "Если стоит галочка, то этот ресурс будет виден для всех разделов каталога. Иначе только для \"листьев\"",
          'on_have_subcat'       => "",
          'direct_link'          => "Если стоит галочка, то этот ресурс будет использоваться исключительно для отображения ссылки в меню CMS",
          'active'               => 'Отображать или нет колонку в TreeView',
        ];
    }

    public function beforeSave($insert)
    {
      if($insert) {
      	$this->orderid = $this->getMaxOrder() + 1;
      }
      $this->datatype = !empty($this->datatype) ? $this->datatype : "list";
      $this->indexate = !empty($this->indexate) ? $this->indexate : "";
      $this->menu_icon = !empty($this->menu_icon) ? $this->menu_icon : "";
      $this->default_field = !empty($this->default_field) ? $this->default_field : "";
      $this->parent_field = !empty($this->parent_field) ? $this->parent_field : "";
      $this->order = !empty($this->order) ? $this->order : "";
      $this->group = !empty($this->group) ? $this->group : "";
      $this->direct_link = !empty($this->direct_link) ? $this->direct_link : "0";
      
      $this->parent_field = trim((string)$this->parent_field);
      if(strlen($this->parent_field) === 0) {
      	$fld = $this->attributeLabels()["parent_field"];
      	Yii::$app->session->addFlash("warning", "Не указано значение для поля \"".$fld."\"! Могут возникнуть проблемы, если связь с родительской таблицей необходима...");
      }
      return parent::beforeSave($insert);
		}

    /*
    * parent relations
    * @return \yii\db\ActiveQuery
    */
    public function getResource()
    {
      return $this->hasOne(self::className(), ['id' => 'parentid']);
    }
    
    /*
    * relations
    * @return \yii\db\ActiveQuery
    */
    public function getResources()
    {
      return $this->hasMany(self::className(), ['parentid' => 'id']);
    }
    
    /*
    * @return all
    */
    public function dataResources()
    {
      $model = self::find()->all();
      return $model;
    }

    public static function getResourcesTree($stripTags=true)
    {
      $refs = array();
      $list = array();
     
      $nodes = Yii::$app->db->createCommand('SELECT * FROM `z_resources` ORDER BY `orderid`')
      	->queryAll()
      ;
     
      foreach($nodes as $data) {
        $thisref = &$refs[$data['id']];
        $thisref['id'] = $data['id'];
        $thisref['parentid'] = $data['parentid'];
        //-- strip tags?
        $title = $data['title'];
        if($stripTags) {
        	$title = strip_tags($title);
        }
        $thisref['title'] = $title;
        $thisref['menu_icon'] = $data['menu_icon'];
        $thisref['direct_link'] = $data['direct_link'];
        $thisref['resourceid'] = $data['resourceid'];
        $thisref['visible'] = $data['visible'];
        $thisref['active'] = $data['active'];
        if($data['parentid'] == 0) {
          $list[$data['id']] = &$thisref;
        } else {
          $refs[$data['parentid']]['children'][$data['id']] = &$thisref;
        }
      }
      return $list;
		}


	public static function getRecursivePairs($array, $level = 0, &$result=array())
	{
    $insertCode = "   ";
    foreach($array as $node)
		{
      $result[] = array(
      	"id" => $node["id"],
      	"parentid" => $node["parentid"],
      	"level" => $level,
      	"title" => $node["title"],
      	"menu_icon" => $node["menu_icon"],
      	"direct_link" => $node["direct_link"],
      	"resourceid" => $node["resourceid"],
        "visible" => $node["visible"],
        "active" => $node["active"],
      );
      //echo str_repeat($insertCode, $level), "[".$node["title"]."] (".$level.")", "\n";
      if(isset($node["children"])) {
        self::getRecursivePairs($node["children"], $level+1, $result);
      }
    }
   
    return $result;
	}

  public static function getResourceDependents($resourceid, $starts=true, $flag=null)
	{
  	if($flag === "form") {
  		//-- skip the form handling if the resourceId is in use
  		if(in_array($resourceid, self::$resourcesDependentsInUse)) {
  			return false;
  		}
  		self::$resourcesDependentsInUse[] = $resourceid;
  		//echo "resourceid = $resourceid<br/>";
  	}
  	
  	//-- init array
  	if($starts) {
  		self::$resourcesDependents = [];
  	}

  	//-- get current Resource
  	$row = self::getResourceById($resourceid);
  	if(!empty($row->id)) {
  		$title = self::$resourcesData["Resources"]["titleField"];
  		//-- save Resources to array
  		try {
  			self::$resourcesDependents["Resources"][$row->id] = $row->$title;
  		} catch(yii\base\UnknownPropertyException $ex) {
  			//-- !!! $row->$title NOT FOUND => so, skip it...
  		}
  	}

  	//-- get all children for Resources
  	$m = new Resources();
  	$m->getResourceChildren(
  		$resourceid,
  		self::$resourcesData["Resources"]["parentField"],
  		self::$resourcesData["Resources"]["titleField"]
  	);
  	$rowsResources = $m->resourcesChildren;
  	//-- get recursive Resources
  	foreach(array_keys($rowsResources) as $rowId) {
			self::getResourceDependents($rowId, false);
		}

  	//-- get all children for ResourcesColumns
  	$m = new ResourcesColumns();
  	$m->getResourceChildren(
  		$resourceid,
  		self::$resourcesData["ResourcesColumns"]["parentField"],
  		self::$resourcesData["ResourcesColumns"]["titleField"]
  	);
  	$rowsColumns = $m->resourcesChildren;
  	if(!empty($rowsColumns)) {
  		foreach($rowsColumns as $k => $v) {
  			//-- save ResourcesColumns to array
  			self::$resourcesDependents["ResourcesColumns"][$k] = $v;
  		}
  	}

  	//-- get all children for ResourcesConditions
  	$m = new ResourcesConditions();
  	$m->getResourceChildren(
  		$resourceid,
  		self::$resourcesData["ResourcesConditions"]["parentField"],
  		self::$resourcesData["ResourcesConditions"]["titleField"]
  	);
  	$rowsConditions = $m->resourcesChildren;
  	if(!empty($rowsConditions)) {
  		foreach($rowsConditions as $k => $v) {
  			//-- save ResourcesConditions to array
  			self::$resourcesDependents["ResourcesConditions"][$k] = $v;
  		}
  	}
  	
  	//-- get all children for ResourcesForms
  	$m = new ResourcesForms();
  	$m->getResourceChildren(
  		$resourceid,
  		self::$resourcesData["ResourcesForms"]["parentField"],
  		self::$resourcesData["ResourcesForms"]["titleField"]
  	);
  	$rowsForms = $m->resourcesChildren;
  	if(!empty($rowsForms)) {
  		foreach($rowsForms as $k => $v) {
  			//-- save ResourcesForms to array
  			self::$resourcesDependents["ResourcesForms"][$k] = $v;
  		}
  	}

  	//-- get all children for ResourcesJoins
  	$m = new ResourcesJoins();
  	$m->getResourceChildren(
  		$resourceid,
  		self::$resourcesData["ResourcesJoins"]["parentField"],
  		self::$resourcesData["ResourcesJoins"]["titleField"]
  	);
  	$rowsJoins = $m->resourcesChildren;
  	if(!empty($rowsJoins)) {
  		foreach($rowsJoins as $k => $v) {
  			//-- save ResourcesJoins to array
  			self::$resourcesDependents["ResourcesJoins"][$k] = $v;
  		}
  	}

  	//-- get all children for ResourcesRefers
  	$m = new ResourcesRefers();
  	$m->getResourceChildren(
  		$resourceid,
  		self::$resourcesData["ResourcesRefers"]["parentField"],
  		self::$resourcesData["ResourcesRefers"]["titleField"]
  	);
  	$rowsRefers = $m->resourcesChildren;
  	if(!empty($rowsRefers)) {
  		foreach($rowsRefers as $k => $v) {
  			//-- save ResourcesRefers to array
  			self::$resourcesDependents["ResourcesRefers"][$k] = $v;
  		}
  	}
  	
  	foreach(array_keys($rowsForms) as $rowId) {
			//-- get all children for ResourcesFormsParams
			//ResourcesForms::getResourceDependents($rowId, false, "form");
			self::getResourceDependents($rowId, false, "form");
			
			/*
			echo "<pre>";
  		//print_r(self::$resourcesDependents);
	  	print_r(array_keys($rowsForms));
  		echo "</pre>";
	  	return false;
	  	*/

    	$m = new ResourcesFormsParams();
			$m->getResourceChildrenFull(
				$rowId,
				Resources::$resourcesData["ResourcesFormsParams"]["parentField"],
				Resources::$resourcesData["ResourcesFormsParams"]["titleField"]
			);
			$rowsFormsParams = $m->resourcesChildren;
			if(!empty($rowsFormsParams)) {
  			foreach($rowsFormsParams as $k => $v) {
  				if(!empty($v->value)) {
  					//-- save ResourcesFormsParams to array
  					self::$resourcesDependents["ResourcesFormsParams"][$k] = $v->value;
  				}
  			}
  		}
		}

  }

  public static function getResourceModelFields($resourceId)
	{
		$attributeLabels = array();	

		$resource = self::getResourceById($resourceId);
		if(!empty($resource->model)) {
			$model = (string)$resource->model;
			$resourcesRootPath = Yii::getAlias('@resources_root');
			$classPath =  $resourcesRootPath."/".$model.".php";
			if(file_exists($classPath)) {
				$rightClassName = str_replace("/", "\\", $resource->model);
				$isClassExists = class_exists($rightClassName);
				if(!$isClassExists) {
					require($classPath);
				}
				$model = str_replace("/", "\\", $model);
				$modelInstance = new $model();
				if(!is_null($modelInstance)) {
					$attributeLabels = $modelInstance->attributeLabels();
					foreach($attributeLabels as $key => $val) {
						$attributeLabels[$key] = $val." (".$key.")";
					}
				}
			}
		}
		return $attributeLabels;
	}

	public static function getResourceById($id)
	{
     $result = self::findOne($id);
     return $result;
  }
	
	public static function getResourcesByResourceNameList($names)
	{
		$rows = self::find()->where(['IN', 'resourceid', $names])->all();
    return $rows;
	}
	
	public static function getResourceByResourceName($name)
	{
     $model = self::find()->where(['resourceid' => $name])->one();
     return $model;
  }

  public static function getResourcesByResourceId($resourceid)
	{
     $model = self::find()->where(['resourceid' => $resourceid])->all();
     return $model;
  }

	public function getResourceParents($id, $parentField="resourceid", $titleField="title", $starts=true)
	{
  	//-- init array
  	if($starts) {
  		$this->resourcesParents = array();
  		$this->resourcesParentIds = array();
  	}
  	$row = $this->find()->select('id,parentid,'.$titleField)->where(['id' => $id])->one();
	  if(!is_null($row) && !empty($row->$titleField)) {
  		$this->resourcesParentIds[] = $row->id;
  		$this->resourcesParents[$row->$parentField] = $row->$titleField;
  		$this->getResourceParents($row->$parentField, $parentField, $titleField, false);
  	}
  }

  public static function getParentResource($model, $flag=0)
	{
  	$modelName = str_replace("\\", "/", get_class($model));
  	
  	//-- get all resources with the same model name
  	$resourcesRows = self::find()->select('id,resourceid,parentid,parent_field')->where(['model'=>$modelName])->all();
  	foreach($resourcesRows as $resourcesRow) {
  		$mainId = $resourcesRow->id;
  		$parentId = $resourcesRow->parentid;
  		$parentField = $resourcesRow->parent_field;
  		$resourceId = $resourcesRow->resourceid;

  		//-- get all resource forms
  		$formsRows = ResourcesForms::find()->select('id,type,field')->where(['resourceid'=>$mainId])->all();

  		//-- is there is the top level of the model...
  		if(!isset($model->$parentField) || $model->$parentField === 0) {
  			return array(
  				"resource" => $model,
		  		"parent_field" => $parentField,
  				"parentid" => 0,
  				"forms" => $formsRows,
	  		);
	  	}

  		//-- get all resource conditions
  		$conditionsRows = ResourcesConditions::find()->select('id,condition,value')->where(['resourceid'=>$mainId])->all();
  		foreach($conditionsRows as $conditionsRow) {
  			
  			//-- check SID & its value from the resource conditions list
  			if($conditionsRow->condition === "sid" && $conditionsRow->value === $model->sid) {
  				//-- get parent resource
  				$resourcesParentRow = self::find()->select('id,resourceid,parentid,parent_field,model')->where(['id'=>$parentId])->one();
  				if(!empty($resourcesParentRow->id)) {
  					
  					//-- get model of the parent resource
  					$parentModel = AbstractModel::initModel($resourcesParentRow->model);
  					$where = ['id'=>$model->$parentField];
  					if(AbstractModel::chkAttributes($parentModel, "sid", false)) {
  						//-- there is the SID of the original model, not the parent one!
  						//$where["sid"] = $model->sid;
  					}
  					$mod = $parentModel::find()->where($where)->one();
  					if(!is_null($mod) && !empty($mod->id)) {
  						return array(
  							"resource" => $parentModel,
	  						"parent_field" => $parentField,
  							"parentid" => $mod->id,
  							"forms" => $formsRows,
	  					);
  					}
  				}
  			}
  			break;
  		}
  	}
  	return null;
  }

	public function getResourceChildren($id, $parentField="resourceid", $titleField="title", $starts=true)
	{
  	//-- init array
  	if($starts) {
  		$this->resourcesChildren = array();
  	}
  	//-- get all children
  	$where[$parentField] = $id;
  	$defaultAttrs = array_keys($this->attributeLabels());
  	if(in_array('active', $defaultAttrs)) {
  		$where['active'] = 1;
  	}
  	$rows = $this->find()->select('id,parentid,'.$titleField)->where($where)->all();
	  if(!is_null($rows)) {
	  	foreach($rows as $row) {
  			if(!is_null($row) && !empty($row->$titleField)) {
  				$this->resourcesChildren[$row->id] = $row->$titleField;
  				//$this->getResourceChildren($row->id, $parentField, $titleField, false);
  			}
  		}
  	}
  }
  public function getResourceOneLevelChildren($id, $parentField="resourceid", $titleField="title", $starts=true)
	{
  	//-- get all children
  	$where[$parentField] = $id;
  	$defaultAttrs = array_keys($this->attributeLabels());
  	if(in_array('active', $defaultAttrs)) {
  		$where['active'] = 1;
  	}
  	$rows = $this->find()->where($where)->all();
	  return $rows;
  }
  public function getResourceChildrenFull($id, $parentField="resourceid", $titleField="title", $starts=true)
	{
  	//-- init array
  	if($starts) {
  		$this->resourcesChildren = array();
  	}
  	//-- get all children
  	$where[$parentField] = $id;
  	$defaultAttrs = array_keys($this->attributeLabels());
  	if(in_array('active', $defaultAttrs)) {
  		$where['active'] = 1;
  	}
  	$rows = $this->find()->where($where)->orderBy('orderid')->all();
	  if(!is_null($rows)) {
	  	foreach($rows as $row) {
  			if(!is_null($row) && !empty($row->$titleField)) {
  				$this->resourcesChildren[$row->id] = $row;
  				//$this->getResourceChildren($row->id, $parentField, $titleField, false);
  			}
  		}
  	}
  }

  public static function getResourcesFormsTypes($resource, $type="File")
	{
		//-- get the list of the form fields
  	$files = [];
  	if(!empty($resource->id)) {
  		$m = new ResourcesForms();
			$m->getResourceChildrenFull(
				$resource->id,
				self::$resourcesData["ResourcesForms"]["parentField"],
				self::$resourcesData["ResourcesForms"]["titleField"]
			);
			$rowsForms = $m->resourcesChildren;
			foreach($rowsForms as $row) {
      	if(!empty($row->field) && $row->type === $type) {
      		$files[] = $row->field;
      	}
      }
    }
    return $files;
	}

	public static function getResourcesItem($rowsResource, $id, $conds, $files, $isCurrent=false)
  {
  	$title = trim((string)$rowsResource->title);
  	if(!$isCurrent) {
  		$parentField = trim((string)$rowsResource->parent_field);
  		if(strlen($parentField) === 0) {
  			Yii::$app->session->addFlash("danger", "Не указано Родительское поле для ресурса \"".$title."\"!");
  			return null;
  		}
  	} else {
  		$parentField = null;
  	}
  	
  	$idsList = array();
  	$modelClass = $rowsResource->model;
  	$className = AbstractModel::getClassName($rowsResource->model);
    $modelInstance = AbstractModel::getAbstractModel($className, true);
  	
  	//Yii::$app->session->addFlash("success", $className.", ".$rowsResource->parent_field." => ".$id);
  	
  	if(!$isCurrent) {
  		$select = $modelInstance::find()
        ->where([$parentField => $id])
      ;
      $str = "";
      foreach($conds as $fld => $val) {
      	if(!empty($str)) {
      		$str .= ",";
      	}
      	$str .= $fld."=>".$val;
      	$select->andWhere([$fld => $val]);
      }
      if(!empty($str)) {
      	$str = "(".$str.")";
      }
    } else {
    	$select = $modelInstance::find()
        ->where(["id" => $id])
      ;
    }
    $rows = $select->all();
    //-- list of items (the lowerest level)
    foreach($rows as $row1) {
  		if(!empty($row1->id)) {
  			$childId = $row1->id;
  			
  			$doProcessing = true;
  			foreach(self::$resourcesList as $resourcesItem) {
  				$clsName = $resourcesItem["className"];
  	    	$chldId = $resourcesItem["id"];
  	    	//-- the item already exists
  	    	if($clsName === $className && $chldId === $childId) {
  	    		$doProcessing = false;
  	    		continue;
  	    	}
  			}

  			$f = "";
  			$uploads = [];
  			foreach($files as $file) {
  				if(!empty($f)) {
    				$f .= ",";
    			}
    			$fileId = (int)$row1->$file;
    			if(!empty($fileId)) {
    				//$fileId
    				$f .= $fileId;
    				$uploads[] = $fileId;
    			}
  			}
  			if(!empty($f)) {
		    	$f = "[".$f."]";
		    }
  			
  			//Yii::$app->session->addFlash("warning", $className.",id=".$childId.",parent=".$row1->$parentField.$str.":".$row1->title);
  			
  			$parentIdValue = null;
  			if(!$isCurrent) {
  				$parentIdValue = $row1->$parentField;
  			}

  			if($doProcessing) {
  				//-- add the item on the list
  				self::$resourcesList[] = [
  					"className" => $className,
  					"id" => $childId,
  					"uploads" => $uploads,
  					"parent_field" => $parentField,
  					"parentid" => $parentIdValue,
  					"resource" => get_class($rowsResource),
  				];
  				
  				$idsList[] = $childId;
  			}
  		}
  	}
  	return $idsList;
  }
  
  public static function getResourcesList($resourceid, $id, $starts=true)
  {
  	//-- get all children for Resources
  	$m = new Resources();
  	$rowsResources = $m->getResourceOneLevelChildren(
  		$resourceid,
  		self::$resourcesData["Resources"]["parentField"],
  		self::$resourcesData["Resources"]["titleField"]
  	);

  	//Yii::$app->session->addFlash("danger", $id);
  	foreach($rowsResources as $rowsResource) {
  		
  		//-- get the list of the conditions
      $conds = [];
      $m = new ResourcesConditions();
			$rowsConditions = ResourcesConditions::getResourcesByResourceId($rowsResource->id);
			foreach($rowsConditions as $row) {
				if(!empty($row->condition) && !empty($row->value)) {
      		//-- add conditions to params
      		$conds[$row->condition] = $row->value;
      	}
			}

  		//-- get the list of the File fields
  		$files = self::getResourcesFormsTypes($rowsResource, "File");

  		$ids = self::getResourcesItem($rowsResource, $id, $conds, $files);
  		if(is_null($ids)) {
  			return null;
  		}
  		//Yii::$app->session->addFlash("info", $id.", ".$rowsResource->id.", ".get_class($rowsResource));
  		foreach($ids as $id2) {
  			self::getResourcesList($rowsResource->id, $id2, false);
  		}
  	}
  	
  	//-- THE SAME FOR THE CURRECT RESOURCE
  	//-- get the list of the conditions
    $rowsResource = self::getResourceById($resourceid);
    $conds = [];
    $m = new ResourcesConditions();
		$rowsConditions = ResourcesConditions::getResourcesByResourceId($rowsResource->id);
		foreach($rowsConditions as $row) {
			if(!empty($row->condition) && !empty($row->value)) {
    		//-- add conditions to params
    		$conds[$row->condition] = $row->value;
    	}
		}

  	//-- get the list of the File fields
  	$files = self::getResourcesFormsTypes($rowsResource, "File");

  	$isCurrent = true;
  	$ids = self::getResourcesItem($rowsResource, $id, $conds, $files, $isCurrent);
  	if(is_null($ids)) {
  		return null;
  	}

  	return true;
  }

  public static function getResourcesMenu($insertCode, $isHtml=true, $menuRulesList=[], $useMenuRulesList=false, $visibleOnly=true)
  {
  	$resourceAdminPairsData = Resources::getRecursivePairs(Resources::getResourcesTree(false));
		$resourceAdminPairs = array();
		//$resourcePairs[0] = "Корень";
		//$insertCode = "<span>&nbsp;&nbsp;&nbsp;</span>";
		foreach($resourceAdminPairsData as $node) {
			$id = (int)$node["id"];
			if($useMenuRulesList && !in_array($id, $menuRulesList)) {
				//-- $id is on the list! => SKIP...
				continue;
			}
			$parentid = (int)$node["parentid"];
			$level = $node["level"];
			$menuIcon = $node["menu_icon"];
			$directLink = $node["direct_link"];
			$title = $node["title"];
			$resourceid = $node["resourceid"];
			$visible = (int)$node["visible"];
			$active = (int)$node["active"];
			if($visibleOnly && $visible === 0) {
				continue;
			}
    
      $space = ($level === 0) ? "" : " ";
      if(!$visibleOnly) {
      	$title = strip_tags($title)." [".$resourceid;
      	if($visible === 0) {
      		$space .= " ";
      	} else {
      		//$title .= " | видимое";
      	}
      	$title .= "]";
      }
			$fullTitle = str_repeat($insertCode, $level).$space.$title;
			
			
			$resourceAdminPairs[$id] = array(
				"title" => $fullTitle,
				"parentid" => $parentid,
				"menu_icon" => $menuIcon,
				"direct_link" => $directLink,
				"resourceid" => $resourceid,
			);
		}

		$data = $isHtml ? "" : [];
		foreach($resourceAdminPairs as $id => $resourcePair) {
			$hasChilden = false;
			foreach($resourceAdminPairs as $_id => $r) {
				$parentid = $r["parentid"];
				if($parentid === $id) {
					$hasChilden = true;
					break;
				}
			}
			if($isHtml) {
				if(!$hasChilden) {
					//-- default resource link
					$href = "/adm/index?section=".$resourcePair["resourceid"];
					if($resourcePair["resourceid"] === "resources") {
						$href = "/resources";
					}
					//-- check for direct link
					if(strpos($resourcePair["resourceid"], "/") !== false) {
						$href = $resourcePair["resourceid"];
					}
					$data .= "<a class=\"menu-item\" href=\"".$href."\">";
				} else {
					$data .= "<a class=\"menu-item\">";
				}
				if(!empty($resourcePair["menu_icon"])) {
					$numNbsp = substr_count($resourcePair["title"], '&nbsp;');
					$data .= str_repeat('&nbsp;', $numNbsp)."<i class=\"fa fa-".$resourcePair["menu_icon"]."\"></i>";
					$resourcePair["title"] = str_replace("&nbsp;", "", $resourcePair["title"]);
					$resourcePair["title"] = str_replace("<span></span>", "", $resourcePair["title"]);
				}
				$data .= $resourcePair["title"];
				$data .= "</a>";
			} else {
				$controller = "";
				$section = "";
				if(!$hasChilden) {
					if($resourcePair["resourceid"] === "resources") {
						$controller = "resources";
					} else {
						$controller = "adm";
						$section = $resourcePair["resourceid"];
					}
				}
				$resourcePair["id"] = $id;
				$resourcePair["controller"] = $controller;
				$resourcePair["section"] = $section;

				$data[] = $resourcePair;
				/*
				$data[] = [
					"id" => $id,
					"controller" => $controller,
					"section" => $section,
					"title" => $resourcePair["title"],
					"resss" => $resourcePair,
				];	
				*/
			}
		}
		return $data;
	}

	public static function getModelSQL($model, $parentModel=null, $parentField=null, $parentId=null, $uploads=null)
  {
  	$tableName = $model::tableName();
  	$modelId = $model->id;
  	$currentModel = get_class($model);

  	//$className = AbstractModel::getClassName($model);
    //-- get model as a common one
    $filesList = [];
    if(get_class($model) === "backend\\models\\Files") {
	    $className = AbstractModel::getClassName(get_class($model));
  	  $modelObj = AbstractModel::getAbstractModel($className);
	  	$parentResource = Resources::getParentResource($modelObj);
  		if(!empty($parentResource["forms"])) {
	  		$forms = $parentResource["forms"];
	  		foreach($forms as $form) {
	  			if($form->type === "File") {
	  				$filesList[] = $form->field;
	  			}
	  		}
  		}
  	}
  	
  	$sql = "";
  	if(!is_null($parentModel) && !is_null($parentField) && !is_null($parentId)) {
  		$sql .= $parentModel."|".$currentModel."|".$parentId."|".$modelId."|".$parentField."|";
  	} else {
  		return false;
  	}

  	
  	$qqq = "???";
  	if(!empty($parentField)) {
  		$qqq = $model->$parentField;
  	}
  	
  	
  	$sql .= "INSERT INTO `".$tableName."` (";
    $exportColumns = AbstractModel::getFieldsList($model);
  	
  	$cols = [];
  	$vals = [];
  	$idx = 0;
  	$posId = -1;
  	$posParentField = -1;
  	$posFiles = [];
  	foreach($exportColumns as $col) {
  		//-- is it the ID Field?
  		if($col === "id") {
  			$posId = $idx;
  		}
  		//-- is it the Parent Field?
  		if($col === $parentField) {
  			$posParentField = $idx;
  		}
  		//-- is it the File type?
  		if(in_array($col, $filesList)) {
  			$posFiles[] = $idx;
  		}
  		if($idx > 0) {
  			$sql .= ",";
  		}
  		$sql .= "`".$col."`";
  		$vals[] = $model->$col;
  		$idx++;
  	}
  	$sql .= ") VALUES(";
  	$idx = 0;
  	$filesIdx = 0;

  	foreach($vals as $val) {
  		if($idx > 0) {
  			$sql .= ",";
  		}
  		$val = addslashes($val);
  		$val = str_replace("\r\n", "\\r\\n", $val);
  		//-- is it the ID Field?
  		if($posId === $idx) {
  			$val = "[!ID!]";
  		}
  		//-- is it the Parent Field?
  		if($posParentField === $idx) {
  			$val = "[!PARENT_FIELD!]";
  		}
  		//-- is it the File type?
  		if(in_array($idx, $posFiles)) {
  			//$val = "[!FILE:".$filesIdx."!]";
  			if(!empty($val)) {
  				$val = "[!FILE:".$val."!]";
  			} else {
  				$val = "";
  			}
  			$filesIdx++;
  		}
  		$sql .= "'".$val."'";
  		$idx++;
  	}
  	$sql .= ");\n";
  	
  	self::saveExportFile($sql);
  	//self::$exportSql .= $sql;
  }

  public static function setExportFileNames()
  {
  	if(self::$FILE_NAMES_SET) {
  		return false;
  	}

  	$ts = time();

  	$backendPath = Yii::getAlias('@backend');

  	self::$EXPORT_FOLDER = $backendPath.self::$EXPORT_FOLDER;

  	self::$SQL_FILE_NAME = self::$EXPORT_FOLDER.str_replace("[TIMESTAMP]", $ts, self::$SQL_FILE_NAME);
  	self::$SQL_FILE_URL = self::$EXPORT_URL.str_replace("[TIMESTAMP]", $ts, self::$SQL_FILE_URL);
  	
  	self::$ZIP_FILE_NAME = self::$EXPORT_FOLDER.str_replace("[TIMESTAMP]", $ts, self::$ZIP_FILE_NAME);
  	self::$ZIP_FILE_URL = self::$EXPORT_URL.str_replace("[TIMESTAMP]", $ts, self::$ZIP_FILE_URL);

  	Funcs::makedir(self::$SQL_FILE_NAME);

  	self::$FILE_NAMES_SET = true;
  }

  public static function saveExportFile($str)
  {
  	if($f = @fopen(Resources::$SQL_FILE_NAME, "a+")) {
  		@fwrite($f, $str);
  		@fclose($f);
  	}
  }

  public function handleResources($resourceId, $mode=self::MODE_EXPORT)
  {
    self::$OPTIMIZED_RESOURCES_LIST = [];
    
    if(self::DEBUG) {
    	self::$MSTIME = 0;
    	self::milliseconds("  1", true);
    }

    Resources::setExportFileNames();
    
    //Resources::$exportSql = "";
    //if(self::DEBUG) {
    	self::$handlerCheck = [];
    //}
    Resources::$exportStruct = [];

    //-- !!! HANDLE MODEL !!!
    self::$numRecordsMod = 0;
    self::$numRecordsFld = 0;
    self::$uploadsIdList = [];

    $resource = Resources::getResourceById($resourceId);
    if(is_null($resource)) {
    	if(self::DEBUG) {
    		Yii::$app->session->addFlash("danger", "Ошибка при обработке ресурса: ID = ".$id);
    	}
    	return false;
    }
    
    if(self::DEBUG) {
    	self::milliseconds("  2");
    }

    AbstractModel::checkExportDB();
    
    if($mode === self::MODE_EXPORT || $mode === self::MODE_SAVE) {
	    $str = "\n/* CompleteCMS. Dump: \"".Funcs::stripTags($resource->title)."\". Created: ".date("d.m.Y H:i:s")." */\n";
	    //-- use external DB for MODE_EXPORT only!
	    if($mode === self::MODE_EXPORT && AbstractModel::$isExternalExport)	{
	    	$str .= "/* Built for: \"".Yii::$app->exportDB->dsn." */\n";
	    } else {
	    	$str .= "/* Built for: \"".Yii::$app->db->dsn." */\n";
	    }
	    $str .= "\n";
    	Resources::saveExportFile($str);
    }

    if(self::DEBUG) {
    	self::milliseconds("  3");
    }
      
    //-- !!! HANDLE RESOURCES !!!
    self::$numRecordsRes = 0;

		Resources::getResourceDependents($resourceId);

		if(self::DEBUG) {
    	self::milliseconds("  4");
    }

		//$iiidx = 0;
		foreach(Resources::$resourcesDependents as $resourceName => $data) {
    	foreach($data as $dataId => $dataTitle) {
	    	
	    	if($resourceName === "Resources") {
	    		$modelName = "\\backend\\models\\Resources";

	    		//$iiidx++;
	    		//Yii::$app->session->addFlash("info", $iiidx.") ".$dataTitle." - ".$dataId);
	    		//-- handle models
	    		if(self::DEBUG) {
	    			$this->setLog("handleModelsCollection($dataId, $mode)");
	    		}
	    		$this->handleModelsCollection($dataId, $mode);

	    	} else {
	    		$modelName = "\\backend\\models\\Resources\\".$resourceName;
	    	}
	    	$foundModel = (new $modelName())->findOneModel($dataId);
	    	
	    	if($resourceName === "Resources") {
	    		$parentModel = "backend\\models\\Resources";
	    		$parentField = "parentid";
	    	  $parentId = $foundModel->parentid;
	    	} else {
	    		if($resourceName === "ResourcesFormsParams") {
	    			$parentModel = "backend\\models\\Resources\\ResourcesForms";
	    			$parentField = "formid";
	    			$parentId = $foundModel->formid;
	    		} else {
	    			$parentModel = "backend\\models\\Resources";
	    			$parentField = "resourceid";
	    			$parentId = $foundModel->resourceid;
	    		}
	    	}

	    	if($this->setHandlerCheck($foundModel)) {
	    		if($mode === self::MODE_DELETE) {
	    			if(!self::DEBUG) {
	    				$foundModel->delete();
	    			}
	    		}
	    		if($mode === self::MODE_EXPORT || $mode === self::MODE_SAVE) {
	    			Resources::getModelSQL($foundModel, $parentModel, $parentField, $parentId);
	    		}
	    		self::$numRecordsRes++;
	    	}
	    	
    	}
    }

    if(self::DEBUG) {
    	self::milliseconds("  5");
    }

		if($mode === self::MODE_EXPORT || $mode === self::MODE_SAVE) {
			$uploadsModel = new Uploads();
	    $add = true;
	    $uploadsModel->zipAllDirs(self::$uploadsIdList, Resources::$ZIP_FILE_NAME, $add);
	    
      /*
      if(self::DEBUG) {
	      sort($this->handlerCheck, SORT_NATURAL);
  		  file_put_contents(Resources::$DEBUG_FILE_LOG, implode("\n", $this->handlerCheck));
      }
      */
      
			$pathinfo = pathinfo(Resources::$SQL_FILE_NAME);
			$fileName = $pathinfo["basename"];
			
			$getSql = new Getsql();
			$execMode = ($mode !== self::MODE_SAVE) ? null : self::MODE_SAVE;
			$getSql->exec($fileName, $execMode);
    }

    if(self::DEBUG) {
    	self::milliseconds("  6");
    }

    return true;
  }

  public function handleModelsCollection($resourceId, $mode)
  {
  	//return false;

  	$resource = Resources::getResourceById($resourceId);
    if(is_null($resource)) {
    	if(self::DEBUG) {
    		Yii::$app->session->addFlash("danger", "Ошибка при обработке ресурса: ID = ".$id);
    	}
    	return false;
    }
  	$sectionId = $resource->resourceid;
  	$resourceid = $resource->id;
  	$modelName = $resource->model;
  	$modelObj = AbstractModel::initModel($modelName);

  	if(self::DEBUG) {
  		$this->setLog("sectionId = $sectionId");
  		$this->setLog("resourceid = $resourceid");
  		$this->setLog("modelName = $modelName");
  		$this->setLog(get_class($modelObj));
  	}

  	//-- get all resource conditions
  	$rows1 = ResourcesConditions::find()->select('id,condition,value')->where(['resourceid'=>$resourceid])->all();
  	$sid = null;
  	foreach($rows1 as $row1) {
  		//-- check SID & its value from the resource conditions list
  		if($row1->condition === "sid" && !empty($row1->value)) {
  			$sid = $row1->value;
  			break;
  		}
  	}
  	if(self::DEBUG) {
  		$this->setLog("sid = $sid");
  	}

  	if(self::DEBUG) {
    	self::milliseconds(" 4a");
  	}

  	//Yii::$app->session->addFlash("success", $modelName);
    if(!is_null($modelObj)) {
      
      $query = $modelObj->find();
      if(!is_null($sid) && AbstractModel::chkAttributes($modelObj, "sid", false)) {
      	$query->where(["sid"=>$sid]);
      }
      //-- found ID parameter => get only one row
      $paramsId = (int)Yii::$app->getRequest()->getQueryParam('id');
      if(!empty($paramsId)) {
      	//$query->where(["id"=>$paramsId]);
      }
      $modelRows = $query->all();
      
      foreach($modelRows as $row) {
      	if(self::DEBUG) {
  				$this->setLog("handleModel(".$row->id.", $sectionId)");
  			}
      	
      	$this->handleModel($row->id, $sectionId, $modelObj, $mode);
      }
    } else {
    	//Yii::$app->session->addFlash("warning", "Модель не найдена!");
    	return false;
    }

    if(self::DEBUG) {
    	self::milliseconds(" 4b");
    }

    return true;
  }

	public function handleModel($modelId, $sectionId, $modelObj, $mode)
  {
  	//return false;
  	if(self::DEBUG) {
			$this->setLog("*** $modelId, $sectionId, ".get_class($modelObj).", $mode ***");
		}

  	
  	$rowsResource = Resources::getResourceByResourceName($sectionId);
  	if(self::DEBUG) {
			$this->setLog("rowsResource->id = ".$rowsResource->id);
		}

  	if(!empty($rowsResource->id)) {
  		
  		if(self::DEBUG) {
    		self::milliseconds("IVa");
    	}

  		$uploadsModel = new Uploads();
  		
  		$resourceid = $rowsResource->id;
  		//-- get all children for ResourcesRefers
  		$m = new ResourcesRefers();
  		$m->getResourceChildren(
  			$resourceid,
  			Resources::$resourcesData["ResourcesRefers"]["parentField"],
  			Resources::$resourcesData["ResourcesRefers"]["titleField"]
  		);
  		$rowsRefers = $m->resourcesChildren;
  		if(!empty($rowsRefers)) {
  			if(self::DEBUG) {
  				$this->setLog("=== rowsRefers ===");
  				$this->setLog($rowsRefers);
  			}
  			//-- look for the field name to get RefersInfo
  			foreach($rowsRefers as $refId => $rowField) {
  				//-- get all ResourcesRefers
  				$rowsRefersAll = ResourcesRefers::getResourcesByResourceId($resourceid);
  				//-- get all RefersInfo
  				$refersInfo = ResourcesRefers::getRefersInfo($rowsRefersAll, $rowField);
					//-- $modelObj = model-refferer (where to export from)
					if(!is_null($refersInfo->model_object)) {
						$modelObject = $refersInfo->model_object;
						$refField1 = $refersInfo->field1;
						$refField2 = $refersInfo->field2;

						$modelRefers = $modelObject::find()->where([$refField2 => $modelId])->all();
		    		foreach($modelRefers as $refer) {
							if($this->setHandlerCheck($refer)) {
								//-- delete all refers
								if($mode === self::MODE_DELETE) {
									//$this->numRecordsMod += count($modelRefers);
									if(!self::DEBUG) {
										//$modelObject->deleteAll([$refField2 => $modelId]);
										$refer->delete();
									} else {
										$this->setLog("delete refer: ".$refer->id);
									}
								}
								//-- export or save all refers
								if($mode === self::MODE_EXPORT || $mode === self::MODE_SAVE) {
									$referId = $refer->id;
	  	  					
	  	  					$resourcesRow = Resources::getParentResource($refer, 1);
	    						$parentModel = null;
	    						$parentField = null;
	    						$parentId = null;
	    						if(!is_null($resourcesRow) && !empty($resourcesRow["resource"])) {
	    							$parentModel = get_class($resourcesRow["resource"]);
	    							$parentField = $resourcesRow["parent_field"];
	    							$parentId = $resourcesRow["parentid"];
	    						}
	    						Resources::getModelSQL($refer, $parentModel, $parentField, $parentId);
	    					}
								self::$numRecordsMod++;
							}
	  	  		}
					}
  			}
  		}

  		if(self::DEBUG) {
    		self::milliseconds("IVb");
  		}

  		$result = Resources::getResourcesList($resourceid, $modelId);
  		if(is_null($result)) {
  			if(self::DEBUG) {
					$this->setLog("empty getResourcesList()");
				}
  			return false;
  			//return $this->redirect(['index']);
  			//return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
  		}

  		if(self::DEBUG) {
    		self::milliseconds("IVc");
  		}

  		$resourcesList = Resources::$resourcesList;
  		foreach($resourcesList as $resourcesItem) {
  			$className = $resourcesItem["className"];
  	    $childId = $resourcesItem["id"];

  	    $optResItem = $className."|".$childId;
  	    if(!in_array($optResItem, self::$OPTIMIZED_RESOURCES_LIST)) {
  	    	self::$OPTIMIZED_RESOURCES_LIST[] = $optResItem;
  	    } else {
  	    	//-- skip the items have been already processed
  	    	continue;
  	    }

  	    $uploads = $resourcesItem["uploads"];
  	    $parentField = $resourcesItem["parent_field"];

  			if(self::DEBUG) {
  				$this->setLog("className = $className");
  				$this->setLog("childId = $childId");
  				$this->setLog($uploads);
  				$this->setLog($parentField);
  			}

  			if(self::DEBUG) {
    			self::milliseconds(" ! ", false, "$className ($childId)");
  			}

  			foreach($uploads as $uploadId) {
  				if(self::DEBUG) {
  					$this->setLog("=== uploads ===");
  					$this->setLog($uploads);
  				}
  				$row = $uploadsModel->getFile($uploadId);
  				if(!empty($row->id)) {
	    			//-- collect uploadsId to make ZIP-file
	    			$add = true;
	    			if(!in_array($uploadId, self::$uploadsIdList)) {
	    				self::$uploadsIdList[] = $uploadId;
	    				//$uploadsModel->zipFileDir($uploadId, Resources::$ZIP_FILE_NAME, $add);
	    			} else {
	    				continue;
	    			}
  					if($this->setHandlerCheck($row)) {
  						
  						if(self::DEBUG) {
    						self::milliseconds(" @ ");
  						}

  						//-- delete uploads rows and folders/files
	    				if($mode === self::MODE_DELETE) {
	    					if(!self::DEBUG) {
	    						$uploadsModel->removeFileDir($uploadId);
	    					}
	    				}
	    				//-- export or save uploads rows and folders/files
	    				if($mode === self::MODE_EXPORT || $mode === self::MODE_SAVE) {
	    					Resources::getModelSQL($row, "backend\\models\\Files", "", $childId, $uploads);
	    				}

	    				if(self::DEBUG) {
    						self::milliseconds(" # ");
    					}

  						self::$numRecordsMod++;
  						self::$numRecordsFld++;
  					}
  				}
  			}

  			$modelInstance = AbstractModel::getAbstractModel($className, true);
  			if(($model = $modelInstance->findOne($childId))) {

  				if(self::DEBUG) {
    				self::milliseconds(" $ ");
    			}

    			if(self::DEBUG) {
  					$this->setLog("=== childId ===");
  					$this->setLog($childId);
  				}
    			if($this->setHandlerCheck($model)) {
    				//-- delete children rows
	    			if($mode === self::MODE_DELETE) {
	    			  if(!self::DEBUG) {
	    					$model->delete();
	    				}
	    			}
	    			
	    			if(self::DEBUG) {
    					self::milliseconds(" % ");
	    			}

	    			//-- export or save children rows
	    			if($mode === self::MODE_EXPORT || $mode === self::MODE_SAVE) {
	    				$resourcesRow = Resources::getParentResource($model, 2);
	    				
	    				if(self::DEBUG) {
    						self::milliseconds(" ^ ");
	    				}

	    				$parentModel = null;
	    				$parentField = null;
	    				$parentId = null;
	    				if(!is_null($resourcesRow) && !empty($resourcesRow["resource"])) {
	    					$parentModel = get_class($resourcesRow["resource"]);
	    					$parentField = $resourcesRow["parent_field"];
	    					$parentId = $resourcesRow["parentid"];
	    				}
	    				Resources::getModelSQL($model, $parentModel, $parentField, $parentId);
	    			
	    			  if(self::DEBUG) {
    						self::milliseconds(" & ");
	    				}
	    			}
    				self::$numRecordsMod++;
    			}
    		}
  		}

  		if(self::DEBUG) {
    		self::milliseconds("IVd");
    	}
    }
    
	  if(($model = $modelObj->findOne($modelId))) {
  		if(self::DEBUG) {
  			$this->setLog("=== modelId ===");
  			$this->setLog($modelId);
  		}
  		if($this->setHandlerCheck($model)) {
  			//-- delete current row
	      if($mode === self::MODE_DELETE) {
	      	if(!self::DEBUG) {
	      		$model->delete();
	      	}
	      }
	      //-- export or save current row
	      if($mode === self::MODE_EXPORT || $mode === self::MODE_SAVE) {
	      	$resourcesRow = Resources::getParentResource($model, 3);
	    		$parentModel = null;
	    		$parentField = null;
	    		$parentId = null;
	    		if(!is_null($resourcesRow) && !empty($resourcesRow["resource"])) {
	    			$parentModel = get_class($resourcesRow["resource"]);
	    			$parentField = $resourcesRow["parent_field"];
	    			$parentId = $resourcesRow["parentid"];
	    		}
	    		Resources::getModelSQL($model, $parentModel, $parentField, $parentId);
	      }
  			self::$numRecordsMod++;
  		}
    }

    if(self::DEBUG) {
    	self::milliseconds("IVe");
  	}
  }

  public function downloadFile($type="sql")
  {
    $fileUrl = "";

  	if($type === "sql") {
  		$fileName = Resources::$SQL_FILE_NAME;
  		$fileUrl = Resources::$SQL_FILE_URL;
  		//file_put_contents($fileName, Resources::$exportSql);
  		if(!file_exists($fileName)) {
  			$fileUrl = "";
  		}
  	} elseif($type === "zip") {
      $fileName = Resources::$ZIP_FILE_NAME;
   		$fileUrl = Resources::$ZIP_FILE_URL;
    	if(!file_exists(Resources::$ZIP_FILE_NAME)) {
  			$fileUrl = "";
  		}
    }
    return $fileUrl;

    /*
    header("Cache-Control: public");
	  header("Content-Description: File Transfer");
	  header("Content-Disposition: attachment; filename=$filePath");
	  header("Content-Type: application/zip");
	  header("Content-Transfer-Encoding: binary");
	  readfile($file);
	  */
  }

  public function setHandlerCheck($model)
  {
  	$item = $model::tableName()."_".str_pad($model->id, 4, "0", STR_PAD_LEFT);
  	$addItem = !in_array($item, self::$handlerCheck);
  	if($addItem) {
  		self::$handlerCheck[] = $item;
  	}
  	return $addItem;
  }

  private function setLog($var, $isNew=false)
  {
  	@ob_start();
  	print_r($var);
  	echo "\n";
  	$txt = @ob_get_contents();
  	@ob_end_clean();
  	$flag = $isNew ? "w+" : "a+";
  	$fp = @fopen("./Resources.txt", $flag);
  	if($fp) {
  		@fwrite($fp, $txt);
  		@fclose($fp);
  	}
  }

  private static function milliseconds($num, $isNew=false, $comments="")
  {
    $mt = explode(' ', microtime());
    $ms = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));

    $savedMS = $ms;

    if($isNew) {
    	self::$MSTIME = $ms;
    	$ms = 0;
    } else {
    	$ms -= self::$MSTIME;
    }

    if(!empty($comments)) {
    	$comments = " (".$comments.")";
    }

    $flag = $isNew ? "w+" : "a+";
    $fp = @fopen("./milliseconds.txt", $flag);
  	if($fp) {
  		@fwrite($fp, $num.") ".$ms.$comments."\n");
  		@fclose($fp);
  	}

  	if(!$isNew) {
  		self::$MSTIME = $savedMS;
  	}
	}

	public static function getParentResourceBySection($sectionNameParameter)
	{
  	$row = self::find()->select('parentid')->where(['resourceid' => $sectionNameParameter])->one();
	  if(!is_null($row) && !empty($row->parentid)) {
  		$rowParent = self::find()->where(['id' => $row->parentid])->one();
  		if(!is_null($rowParent) && !empty($rowParent->id)) {
  			return $rowParent;
  		}
  	}
  	return null;
  }

  public static function getResourceChildrenLinks($sectionNameParameter)
  {
  	$listChildrenLinks = [];

  	if(!empty($sectionNameParameter)) {
			$res = Resources::getResourceByResourceName($sectionNameParameter);
			if(!empty($res->parentid)) {
				$m = new Resources();
				$rowsChildren = $m->getResourceOneLevelChildren(
					$res->parentid,
					Resources::$resourcesData["Resources"]["parentField"],
					Resources::$resourcesData["Resources"]["titleField"]
				);
				
				foreach($rowsChildren as $rowsChild) {
					if(!empty($rowsChild->resourceid)) {
						$resourceId = $rowsChild->resourceid;
						$resourceModel = $rowsChild->model;
						$resourceTitle = $rowsChild->title;
				  	if($resourceModel === "backend/models/AuthView") {
				  		continue;
				  	}
				  	$listChildrenLinks[$resourceId] = $resourceTitle;
				  }
				}
			}
		}

		return $listChildrenLinks;
	}

}
