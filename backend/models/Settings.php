<?php

namespace backend\models;

use backend\helpers\Data;
use backend\behaviors\CacheFlush;

class Settings extends AbstractModel
{
  const VISIBLE_NONE = 0;
  const VISIBLE_ROOT = 1;
  const VISIBLE_ALL = 2;
  const CACHE_KEY = 'z_settings';

  static $_data;
  
  public static function tableName()         
  {
      return 'z_settings';
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
  			'id' => 'ID',
  			'title' => 'Имя',
  			'description' => 'Описание',
				'value' => 'Значение',
				'active' => 'Активность',
      ];
  }

  public function beforeSave($insert)
  {
    if($insert) {
    	$this->active = !empty($this->active) ? $this->active : 0;
    } else {
      
    }
    return parent::beforeSave($insert);
	}

	public function behaviors() {
        return [
            CacheFlush::className()
        ];
    }

    public static function get($name) {
        if (!self::$_data) {
            self::$_data = Data::cache(self::CACHE_KEY, 3600, function() {
                        $result = [];
                        try {
                            foreach (parent::find()->all() as $setting) {
                                $result[$setting->title] = $setting->value;
                            }
                        } catch (\yii\db\Exception $e) {
                            
                        }
                        return $result;
                    });
        }
        return isset(self::$_data[$name]) ? self::$_data[$name] : null;
    }

    public static function set($name, $value) {
        if (self::get($name)) {
            $setting = self::find()->where(['title' => $name])->one();
            $setting->value = $value;
        } else {
            $setting = new Setting([
                'name' => $name,
                'value' => $value,
                'title' => $name,
                'visibility' => self::VISIBLE_NONE
            ]);
        }
        $setting->save();
    }
    
}