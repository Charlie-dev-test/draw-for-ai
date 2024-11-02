<?php

namespace backend\models;

use backend\models\Translates;
use backend\models\AbstractModel;

/**
 * Description of Menus
 */
class Menus extends AbstractModel
{
    private $section = "menus";
    private $sid = "menu";

    private $tree = array();
    private $level = 0;

    public $lev;

    public $langname;
    
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
        return 'z_menus';
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
          "country_id"      => "Страна",
          "orderid"         => "Сортировка",
          "title"           => "Название пункта меню",
          "text"            => "Текст",
          "smart_address"   => "Умный адрес",
          "url"             => "Ссылка",
          "seo_description" => "Description (SEO)",
          "seo_keywords"    => "Keywords (SEO)",
          "icon"            => "Иконка1",
          "icon_hover"      => "Иконка2",
          "pics"            => "Фото раздела",
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
      $this->icon_hover = !empty($this->icon_hover) ? $this->icon_hover : "";
      $this->pics = !empty($this->pics) ? $this->pics : "";
      $this->text = !empty($this->text) ? $this->text : "";
      
      return parent::beforeSave($insert);
		}
		
    
    /*
    * parent relations
    * @return \yii\db\ActiveQuery
    */
    public function getMenu()
    {
        return $this->hasOne(self::className(), ['id' => 'parentid']);
    }
    
    /*
    * relations
    * @return \yii\db\ActiveQuery
    */
    public function getMenus()
    {
        return $this->hasMany(self::className(), ['parentid' => 'id']);
    }
    
    /*
    * relations
    * @return \yii\db\ActiveQuery
    */
    public function getOrder() {
        return $this->hasOne(self::className(), ['orderid' => 'parentid']);
    }
    
    /*
    * relations
    * @return \yii\db\ActiveQuery
    */
    public function getOrders() {
        return $this->hasMany(self::className(), ['parentid' => 'orderid']);
    }
    
    /*
    * relations
    * @return \yii\db\ActiveQuery
    * Зависимости 'id', 'sid'
    * 
    */
    public function getTranslates() {
        return $this->hasMany(Translates::className(), ['source_id' => 'id', ])
                ->andOnCondition(['sid' => 'menu']);
    }
    
    
    /*
    * @return name of menu 
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
                ->where(['orderid' => $orderid])
                ->andWhere(['parentid' => $parentid])
                ->one();
    }
    
    /*
    * @return integer 'orderid'
    */
    public static function getNextOrder($parentid, $orderid) {
        $model = self::find()
                ->where(['>', 'orderid', $orderid])
                ->andWhere(['parentid' => $parentid])
                ->min('orderid');
        return $model;
    }
    
    /*
    * @return integer 'orderid'
    */
    public static function getPrevOrder($parentid, $orderid) {
        $model = self::find()
                ->where(['<', 'orderid', $orderid])
                ->andWhere(['parentid' => $parentid])
                ->max('orderid');
        return $model;
    }
    /*
    * @return all
    */
    public function dataMenu() {
        $model = self::find()->all();
        return $model;
    }
    
    public function getMenuChildren($parentid, $lang_id=null, $showAll=true)
    {
        $model = null;
        $resource = Resources::getResourceByResourceName("menus");
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
							"parentid",
							"url",
							"active",
						])
            ->where($where1)
          ;
          
          $where2 = [
		      	"`z_translates`.`sid`" => $this->sid,
		      	"`".self::tableName()."`.`parentid`" => $parentid
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
							"parentid"=>"`".self::tableName()."`.`parentid`",
							"url"=>"`".self::tableName()."`.`url`",
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

    public function getMenuByUrl($url, $lang_id=null, $showAll=true)
    {
      $model = null;
      $translates = new Translates();

      $where1 = [
      	'url' => $url,
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
					"text",
					"seo_description",
					"seo_keywords",
					"orderid",
					"id",
					"parentid",
					"url",
					"active",
				])
        ->where($where1)
      ;
      
      $where2 = [
		  	"`z_translates`.`sid`" => $this->sid,
		  	"`".self::tableName()."`.`url`" => $url
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
					"text"=>"`z_translates`.`text`",
					"seo_description"=>"`z_translates`.`seo_description`",
					"seo_keywords"=>"`z_translates`.`seo_keywords`",
					"orderid"=>"`z_translates`.`orderid`",
					"id"=>"`".self::tableName()."`.`id`",
					"parentid"=>"`".self::tableName()."`.`parentid`",
					"url"=>"`".self::tableName()."`.`url`",
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
      /*
      $sql = $q->createCommand()->getRawSql();
      //print_r($sql);
      */
      $row = $q->one();
      
      return $row;
    }

    public function getMenuLevels($parentid, $lang_id=null, $showAll=true)
    {
     	$rows  = $this->getMenuChildren($parentid, $lang_id, $showAll);
     	foreach($rows as $row) {
     		$this->level++;
     		$row["lev"] = $this->level;
     		$this->tree[] = $row;
     		$parentid = $row["id"];
     		$this->getMenuLevels($parentid, $lang_id, $showAll);
     		$this->level--;
     	}
     	return $this->tree;
    }
}