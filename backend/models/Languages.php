<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use backend\models\AbstractModel;

/**
 * Description of Language
 */
class Languages extends AbstractModel
{
    public $langname;
    
    public static function tableName() {
        return 'z_languages';
    }
    
    /*
    * @return правила
    */
    public function rules()
    {
        $defaultAttrs = array_keys($this->attributeLabels());
        return [
            [$defaultAttrs, 'default'],
            //['langname', 'string', 'max' => 255],
        /*
        return [
            [['orderid'], 'integer'],
            [['title', 'code'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['code'], 'unique'],
            [['active'], 'number', 'min' => 0, 'max' =>1]
        */
        ];
    }
    
    /*
    * @return атрибуты
    */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'orderid' => 'Сортировка',
            'title' => 'Заголовок',
            'code' => 'Код языка',
            'active' => 'Активен?',
            //'langname' => 'Язык!',
        ];
    }
    
    public function getTranslates()
    {
        return $this->hasMany(Translates::className(), ['id' => 'lang_id']);
    }
    
    public static function find() {
        return parent::find();
    }
    
    public static function getProvider() {
        $dataProvider = new ActiveDataProvider([
            'query' => self::find(),
            'pagination' => [
              'pageSize' => 100,
            ],
        ]);
        return $dataProvider;
    }
    
    public static function langArrayList() {
        return self::find()
                ->select(['id', 'title'])
                ->asArray()
                ->all();
    }

    public static function getLanguage($id)
    {
        $model = self::find()->where(["id"=>$id])->one();
        return $model;
    }

    public static function getLanguageId($code="ru")
    {
        $model = self::find()->where(["code"=>$code])->one();
        return $model->id;
    }
}
