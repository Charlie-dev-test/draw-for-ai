<?php

namespace backend\models;

use Yii;
use backend\models\AbstractModel;

/**
 * Description of Translates
 */
class Translates extends AbstractModel
{
    
    public static function tableName()
    {
        return 'z_translates';
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
        ];
    }
    
    public function attributeLabels()
    {
        return [
            "id"              => "ID",
            "parentid"        => "Родитель",
            "sid"             => "SID",
            "source_id"       => "ID источника",
            "lang_id"         => "Язык",
            "country_id"      => "Страна",
            "title"           => "Заголовок",
            "title2"          => "Заголовок 2",
            "smart_address"   => "Умный адрес",
            "small_text"      => "Малый текст",
            "text"            => "Большой текст",
            "tag"             => "Тэг",
            "seo_description" => "Description (SEO)",
            "seo_keywords"    => "Keywords (SEO)",
            "orderid"         => "Сортировка",
            "active"          => "Активность",
            "date_modified"   => "Дата изменения",
        ];
    }

    public function beforeSave($insert)
    {
      //if($insert) {
      	$this->title2 = !empty($this->title2) ? $this->title2 : "";
      	$this->tag    = !empty($this->tag) ? $this->tag : "";
      //} else {
        
      //}
      return parent::beforeSave($insert);
		}

		public function getSourceTranslatedList($sourceId, $sid)
		{
			//$langs = $this->find()
			$langs = self::find()
				->select([
					//"`".self::tableName()."`.`id`",
					//"`".self::tableName()."`.`title`",
					//"`".self::tableName()."`.`text`",
					//"`".self::tableName()."`.`small_text`",
					//"`".self::tableName()."`.`active`",
					"title"=>"`z_languages`.`code`"
				])
		    ->leftJoin("`z_languages`", "`".self::tableName()."`.`lang_id` = `z_languages`.`id`")
		    ->where([
		    	"`".self::tableName()."`.`source_id`" => $sourceId,
		    	"`".self::tableName()."`.`sid`" => $sid
		    ])
		    ->orderBy("`z_languages`.`code`")
		    ->all()
			;
			$resultLangs = array();
			if(!is_null($langs)) {
				foreach($langs as $lang) {
					//$resultLangs[] = $lang->langname;
					$resultLangs[] = $lang->title;
				}
			}
			return implode(", ", array_unique($resultLangs));
		}
    
}
