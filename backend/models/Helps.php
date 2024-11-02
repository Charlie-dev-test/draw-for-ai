<?php

namespace backend\models;

use backend\models\Translates;
use backend\models\AbstractModel;

/**
 * Description of Helps
 */
class Helps extends AbstractModel
{
    private $section = "helps";
    private $sid = "help";

    private $tree = array();
    private $level = 0;

    public $lev;
    
    function __construct($section=null)
    {
    	if(!is_null($section)) {
    		$this->section = $section;
    	}
    	$this->setParentField($this->section);
    }

    /*
    * @return имя таблицы
    */
    public static function tableName()
    {
        return 'z_helps';
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
          "id"              => "ID",
          "parentid"        => "Родитель",
          "lang_id"         => "Язык",
          "orderid"         => "Сортировка",
          "title"           => "Название пункта помощи",
          "text"            => "Текст",
          "icon"            => "Иконка",
          "folder"          => "Папка?",
          "show"            => "На сайте?",
          "active"          => "Активно?",
          "date_modified"   => "Дата изменения",
        ];
    }


    public function beforeSave($insert)
    {
      $this->parentid = !empty($this->parentid) ? $this->parentid : 0;
      $this->icon = !empty($this->icon) ? $this->icon : "";
      $this->text = !empty($this->text) ? $this->text : "";
      
      return parent::beforeSave($insert);
		}
		
    
    /*
    * @return name of help 
    */
    public function showName($id) {
        $model = self::find()
                ->where(['id' => $id])
                ->one()->title;
        return $model;
    }
    
    
    /*
    * @return stdClass row
    */
    public static function findOneByKey($parentid, $orderid) {
        return self::find()
                ->where([
                	'orderid' => $orderid,
                	'parentid' => $parentid,
                	//'active' => 1,
                ])
                ->one();
    }
    
    /*
    * @return all
    */
    public function dataHelp() {
        $model = self::find()->all();
        return $model;
    }
    
    public function getHelpChildren($parentid, $lang_id=null, $showAll=true)
    {
        $model = null;
        $resource = Resources::getResourceByResourceName("helps");
  			if(!empty($resource->parent_field)) {
  				$parentField = $resource->parent_field;
        
          $translates = new Translates();
          
          $where1 = [
          	'parentid' => $parentid,
          ];
          if(!is_null($lang_id)) {
          	$where1['lang_id'] = $lang_id;
          }
          if(!$showAll) {
          	$where1['active'] = 1;
          }
          
          $q1 = $this->find()
            ->select([
							"title",
							"orderid",
							"id",
						])
            ->where($where1)
          ;
          
          $where2 = [
		      	"`z_translates`.`sid`" => $this->sid,
		      	"`".self::tableName()."`.`parentid`" => $parentid,
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

    public function getHelpLevels($parentid, $lang_id=null, $showAll=true)
    {
     	$rows  = $this->getHelpChildren($parentid, $lang_id, $showAll);
     	foreach($rows as $row) {
     		$this->level++;
     		$row["lev"] = $this->level;
     		$this->tree[] = $row;
     		$parentid = $row["id"];
     		$this->getHelpLevels($parentid, $lang_id, $showAll);
     		$this->level--;
     	}
     	return $this->tree;
    }
}