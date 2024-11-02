<?
namespace backend\models;

use Yii;
use backend\models\AbstractModel;
use yii\web\UploadedFile;

/**
 * Description of Files
 */
class Files extends AbstractModel
{
  public $pics_saved_file;
  public $pics_remove_file;

  protected $picsFile;
  protected $picsId;
  
  public $multipleUploads = false;

  protected $uploadsResult = array();

  public static function tableName()
  {
    return 'z_files';
  }
  
  /*
  * @return правила
  */
  public function rules()
  {
    $defaultAttrs = array_keys($this->attributeLabels());
    return [
      [$defaultAttrs, 'default'],
      ['title', 'string'],
      ['title', 'default', 'value' => ""],
      [['pics'], 'file','skipOnEmpty' => true, /*'extensions' => 'jpg, jpeg, png, gif, docx, txt, pdf',*/ 'maxSize' => 1024 * 1024 * 8, 'wrongExtension' => 'Неверный формат файла', 'tooBig' => 'Превышен лимит в 10МБ', 'maxFiles' => 10],
      
      //-- rules(): file types
      [['pics'], 'file',
      	'skipOnEmpty' => true, 
      	'extensions' => 'jpg, jpeg, png, gif, docx, pdf, txt',
      	//'maxSize' => 1024 * 1024 * 3,
      	'wrongExtension' => 'Неверный формат файла',
      	'tooBig' => 'Превышен лимит в 3 МБ',
      	'maxFiles' => 100
      ],

    ];
  }
  
  /*
  * @return атрибуты
  */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'parentid' => 'Родитель',
      'lang_id' => 'Язык',
      'country_id' => 'Страна',
      'sid' => 'sid',
      "source_id" => "ID источника",
      'user_id' => 'UserID',
      'orderid' => 'Сортировка',
      'title' => 'Заголовок',
      'pics' => 'Файл',
      'pics_saved_file' => 'Сохраненный файл',
      'pics_remove_file' => 'Удалить файл?',
      'active' => 'Активен?',
    ];
  }

  public function beforeSave($insert)
  {
    if($insert) {
    	$this->parentid = !empty($this->parentid) ? $this->parentid : "0";
    	$this->lang_id = !empty($this->lang_id) ? $this->lang_id : "0";
    	$this->country_id = !empty($this->country_id) ? $this->country_id : "0";
    	$this->user_id = !empty($this->user_id) ? $this->user_id : "0";
    	$this->sid = !empty($this->sid) ? $this->sid : "";
    	$this->title = !empty($this->title) ? $this->title : "";
    } else {
      $pics1 = $this->pics;
      //-- restore the value from "pics_saved_file"
      if((is_null($this->pics) || $this->pics == "") && !empty($this->pics_saved_file)) {
      	$this->pics = $this->pics_saved_file;
      }
    }
    
    //-- all files already uploaded!
    if(!$this->multipleUploads) {
      $this->upload();
      foreach($this->uploadsResult as $field => $value) {
      	//Yii::$app->session->addFlash("warning", "from uploadsResult: ".$field." = ".$value);
      	$this->$field = $value;
			}
		}
    return parent::beforeSave($insert);
	}

	public function beforeValidate()
  {
    //-- all files already uploaded!
    if($this->multipleUploads) {
    	return true;
    }

    if(parent::beforeValidate()) {
      $this->afterLoad();
      return true;
    } else {
      return false;
    }
  }

  public function afterLoad()
  {
    //-- all files already uploaded!
    if($this->multipleUploads) {
    	return true;
    }

    try {
      if(!is_null($this->pics)) {
        if(is_array($this->pics)) {
        	$this->picsFile = UploadedFile::getInstances($this, 'pics');
        } else {
        	$this->picsFile = UploadedFile::getInstance($this, 'pics');
        }
      }
    } catch(Exeption $e) {
      Yii::$app->session->addFlash("danger", 'Файл (pics) не получен с сообщением: '.$e->getMessage());
    }
    return;
  }

  public function upload()
  {
		$startPicsId = $this->pics;
		if($this->validate())
		{
      //-- remove files and folders for the saved PICS
      if(!empty($this->pics_remove_file)) {
      	$this->pics = null;
      	$this->removeImage($this->pics_saved_file);
      }
      
      //-- save PICS file
      if(isset($this->picsFile->extension)) {
        if($picsId = (int)$this->saveImage($this->picsFile, $startPicsId, $this->pics_saved_file, $this->pics_remove_file)) {
          $this->uploadsResult["pics"] = $picsId;
          Yii::$app->session->addFlash("success", "Файл (pics -> $picsId) успешно сохранен");
        } else {
          Yii::$app->session->addFlash("danger", 'Ошибка сохранения файла (pics): '.$picsId);
        }
      }
		} else{
    	Yii::$app->session->addFlash("danger", $this->errors);
			return false;
		}
  }

	public function getFiles($source_id, $lang_id=null, $sid="issue", $showAll=true)
  {
    $model = null;
    $resource = Resources::getResourceByResourceName("menus-issues-files");
  	if(!empty($resource->parent_field)) {
  		$parentField = $resource->parent_field;

      $translates = new Translates();
          
      $where1 = [
				"`".self::tableName()."`.`source_id`" => $source_id,
			];
			if(!empty($sid)) {
				$where1["`".self::tableName()."`.`sid`"] = $sid;
			}
			if(!is_null($lang_id)) {
				$where1["`".self::tableName()."`.`lang_id`"] = $lang_id;
			}
			if(!$showAll) {
				$where1["`".self::tableName()."`.`active`"] = 1;
			}
      
      $q1 = $this->find()
        ->select([
					"title",
					"orderid",
					"id",
					"pics",
					"lang_id",
					"active",
				])
				->where($where1)
      ;
      
      $where2 = [
				"`z_translates`.`sid`" => $this->sid,
				"`".self::tableName()."`.`source_id`" => $source_id,
			];
			if(!is_null($lang_id)) {
				$where2["`z_translates`.`lang_id`"] = $lang_id;
			}
			if(!$showAll) {
				$where2["`z_translates`.`active`"] = 1;
				$where2["`".self::tableName()."`.`active`"] = 1;
			}
      
      $q2 = $translates->find()
      	->select([
					"title"=>"`z_translates`.`title`",
					"orderid"=>"`z_translates`.`orderid`",
					"id"=>"`".self::tableName()."`.`id`",
					"pics"=>"`".self::tableName()."`.`pics`",
					"lang_id"=>"`".self::tableName()."`.`lang_id`",
					"active"=>"`z_translates`.`active`",
				])
				->leftJoin("`".self::tableName()."`", "`z_translates`.`source_id` = `".self::tableName()."`.`id`")
        ->where($where2)
      ;

      /*
      !!! WRONG QUERY (orderby works for $q1 only) !!!
      $model = $q1->union($q2)
      	->orderBy(['orderid'=>SORT_ASC])
      	->all()
      ;
      */
      $q = $this->find()
        ->from($q1->union($q2))
        ->orderBy(['orderid'=>SORT_ASC])
      ;
      //$sql = $q->createCommand()->getRawSql();
      //print_r($sql);
      $model = $q->all();

    }
    return $model;
  }

}
