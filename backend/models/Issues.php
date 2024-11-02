<?php

namespace backend\models;

use backend\models\AbstractModel;
use backend\models\Translates;
use backend\models\Resources\ResourcesConditions;
/**
 * Description of Issues
 */
class Issues extends AbstractModel
{
  	private $section = "menus_issues";
  	
  	private $sid = "issue";

    function __construct($section=null)
    {
    	if(!is_null($section)) {
    		$this->section = $section;
    	}
    	$this->setParentField($this->section);
    }  
	
    public static function tableName()
    {
    	return 'z_issues';
    }
    
    /**
     * 
     * @bypass
     * find method
     * **/
    public static function find()
    {
        return parent::find();
    }
    
    /**
     * 
     * @bypass
     * findOne method
     * **/
    public static function findOne($condition)
    {
        return parent::findOne($condition);
    }    
    
    public function rules()
    {
        $defaultAttrs = array_keys($this->attributeLabels());
        return [
            [$defaultAttrs, 'default'],
            /*
            [['sid', 'catalog_id', 'lang_id', 'title'], 'required'],
            [['parentid', 'lang_id', 'country_id', 'catalog_id', 'pic', 'pic1'], 'integer'],
            [['text', 'small_text'], 'string'],
            [['sid', 'title', 'title2', 'tag', 'seo_description', 'seo_keywords'], 'string', 'max' => 255],
            [['date', 'date_modified'], 'date'],
            [['active', 'extra_flag', 'extra_priority', 'showfiles'], 'integer', 'min' => 0, 'max' => 1],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['lang_id' => 'id']],
            */
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderid' => 'Сортировка',
            'pic' => 'Картинка1',
            'pic1' => 'Картинка2',
            'sid' => 'Тип статьи',
            'catalog_id' => 'id источника',
            'lang_id' => 'Язык',
            'date' => 'Дата',
            'country_id' => 'Страна номер',
            'title' => 'Заголовок',
            'title2' => 'Заголовок2',
            'smart_address' => 'Умный адрес',
            'small_text' => 'Краткий текст',
            'text' => 'Текст',
            'tag' => 'Тэг',
            'seo_description' => 'SEO описание',
            'seo_keywords' => 'SEO ключевые слова',
            'active' => 'Активен',
            'showfiles' => 'showfiles',
            'extra_priority' => 'extra_priority',
            'extra_flag' => 'extra_flag',
            'date_modified' => 'Дата создания/обновления',
        ];
    }

    public function beforeSave($insert)
    {
      $this->title2 = !empty($this->title2) ? $this->title2 : "";
      $this->tag    = !empty($this->tag) ? $this->tag : "";
      
      return parent::beforeSave($insert);
		}

		public function getIssues($catalog_id, $lang_id=null, $sid="", $showAll=true)
    {
        $sid = !empty($sid) ? $sid : $this->sid;

        $model = null;
        $resource = Resources::getResourceByResourceName("menus-issues");
  			if(!empty($resource->parent_field)) {
  				$parentField = $resource->parent_field;
          
          $translates = new Translates();
          
          $where1 = [
		      	"`".self::tableName()."`.`sid`" => $sid,
		      	"`".self::tableName()."`.`".$parentField."`" => $catalog_id,
		      ];
		      if(!is_null($lang_id)) {
		      	$where1["`".self::tableName()."`.`lang_id`"] = $lang_id;
		      }
		      if(!$showAll) {
		      	$where1["`".self::tableName()."`.`active`"] = 1;
		      }
          
          $q1 = $this->find()
            ->select([
							"title",
							"title2",
							"smart_address",
							"small_text",
							"text",
							"seo_description",
							"seo_keywords",
							"orderid",
							"id",
							"tag",
							"date_modified",
							"active",
						])
						->where($where1)
          ;
          
          $where2 = [
		      	"`z_translates`.`sid`" => $sid,
		      	"`".self::tableName()."`.`".$parentField."`" => $catalog_id,
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
							"title2"=>"`z_translates`.`title2`",
							"smart_address"=>"`z_translates`.`smart_address`",
							"small_text"=>"`z_translates`.`small_text`",
							"text"=>"`z_translates`.`text`",
							"seo_description"=>"`z_translates`.`seo_description`",
							"seo_keywords"=>"`z_translates`.`seo_keywords`",
							"orderid"=>"`z_translates`.`orderid`",
							"id"=>"`".self::tableName()."`.`id`",
							"tag"=>"`".self::tableName()."`.`tag`",
							"date_modified"=>"`".self::tableName()."`.`date_modified`",
							"active"=>"`z_translates`.`active`",
						])
						->leftJoin("`".self::tableName()."`", "`z_translates`.`source_id`=`".self::tableName()."`.`id` AND `".self::tableName()."`.`".$parentField."`=$catalog_id")
            ->where($where2)
          ;
          /*
          !!! WRONG QUERY (orderby works for $q1 only) !!!
          $model = $q1->union($q2)
          	->orderBy("`date_modified` DESC")
          	->all()
          ;
          */

          $q = $this->find()
            ->from($q1->union($q2))
            ->orderBy(['orderid'=>SORT_ASC])
          ;
          $sql = $q->createCommand()->getRawSql();
          //print_r($sql);
          $model = $q->all();
          
        }
        return $model;
    }

    public function getIssuesByResource($resource_name, $catalog_id, $lang_id=null, $showAll=true)
    {
      $model = null;
      $q1 = null;
      $q2 = null;
      
      //-- ISSUES
      $resource = Resources::getResourceByResourceName($resource_name);
  		if(!empty($resource->parent_field)) {
				$rowsConditions = ResourcesConditions::getResourcesByResourceId($resource->id);
  			$params = [];
  			foreach($rowsConditions as $row) {
  				if(!empty($row->condition) && !empty($row->value)) {
    				//-- add conditions to params
    				$params[$row->condition] = $row->value;
    			}
  			}
  			
  			$parentFieldIssues = $resource->parent_field;
        
        $where1 = [
		    	//"`".self::tableName()."`.`sid`" => $sid,
		    	"`".self::tableName()."`.`".$parentFieldIssues."`" => $catalog_id,
		    ];
		    if(!is_null($lang_id)) {
		    	$where1["`".self::tableName()."`.`lang_id`"] = $lang_id;
		    }
		    foreach($params as $k => $v) {
		    	$where1["`".self::tableName()."`.`".$k."`"] = $v;
		    }
		    if(!$showAll) {
		    	$where1["`".self::tableName()."`.`active`"] = 1;
		    }
        
        $q1 = $this->find()
          ->select([
						"title",
						"title2",
						"smart_address",
						"small_text",
						"text",
						"seo_description",
						"seo_keywords",
						"orderid",
						"id",
						"active",
					])
					->where($where1)
        ;

        //-- TRANSLATES
        $translates = new Translates();
        $resource = Resources::getResourceByResourceName($resource_name."-translates");
  			if(!empty($resource->parent_field)) {
					$rowsConditions = ResourcesConditions::getResourcesByResourceId($resource->id);
  				$params = [];
  				foreach($rowsConditions as $row) {
  					if(!empty($row->condition) && !empty($row->value)) {
    					//-- add conditions to params
    					$params[$row->condition] = $row->value;
    				}
  				}
  				
  				$parentFieldTranslates = $resource->parent_field;
          
          
          $where2 = [
		      	"`".self::tableName()."`.`".$parentFieldIssues."`" => $catalog_id,
		      ];
		      if(!is_null($lang_id)) {
		    		$where2["`z_translates`.`lang_id`"] = $lang_id;
		    	}
		      foreach($params as $k => $v) {
		      	$where2["`z_translates`.`".$k."`"] = $v;
		      }
		      if(!$showAll) {
		      	$where2["`z_translates`.`active`"] = 1;
		      	$where2["`".self::tableName()."`.`active`"] = 1;
		      }
          
          $q2 = $translates->find()
          	->select([
							"title"=>"`z_translates`.`title`",
							"title2"=>"`z_translates`.`title2`",
							"smart_address"=>"`z_translates`.`smart_address`",
							"small_text"=>"`z_translates`.`small_text`",
							"text"=>"`z_translates`.`text`",
							"seo_description"=>"`z_translates`.`seo_description`",
							"seo_keywords"=>"`z_translates`.`seo_keywords`",
							"orderid"=>"`z_translates`.`orderid`",
							//"id"=>"`".self::tableName()."`.`id`",
							"id"=>"`z_translates`.`id`",
							"active"=>"`z_translates`.`active`",
						])
						//->leftJoin("`".self::tableName()."`", "`z_translates`.`".$parentFieldTranslates."`=`".self::tableName()."`.`id`/* AND `".self::tableName()."`.`".$parentFieldIssues."`=$catalog_id*/")
						->leftJoin("`".self::tableName()."`", "`z_translates`.`".$parentFieldTranslates."`=`".self::tableName()."`.`id`")
            ->where($where2)
          ;
        }
      }

      if(!is_null($q1) && !is_null($q2)) {
      	
      	$q = $this->find()
          ->from($q1->union($q2))
          ->orderBy(['orderid'=>SORT_ASC])
        ;
        /*
        $sql = $q->createCommand()->getRawSql();
        //print_r($sql);
        */
        $model = $q->all();

      } elseif(!is_null($q1)) {
      	
      	$model = $q1
        	->orderBy(['orderid'=>SORT_ASC])
        	->all()
        ;

      } elseif(!is_null($q2)) {
      	$model = $q2
        	->orderBy(['orderid'=>SORT_ASC])
        	->all()
        ;
      }

      return $model;
    }
    
}