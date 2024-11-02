<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;
use yii\behaviors\SluggableBehavior;

class Post extends ActiveRecord
{

    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::classname(),
                'attribute' => 'slug',
                //'slugAttribute' => 'slug'
            ],
        ];
    }

    public function rules()
    {
        return [
            ['author_id', 'integer'],
            ['date', 'date'],
            [['text', 'title', 'abridgment'], 'string']
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::classname(), ['id' => 'author_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'text' => 'Текст статьи',
            'title' => 'Название статьи',
            'abridgment' => 'Сокращенный текст',
        ];
    }

    public function getPostById($id)
    {
        return static::find()->where(['id' => $id])->one();
    }

    public static function getPostBySlug($slug)
    {
        return Post::find()->where(['slug' => $slug])->one();
    }
}