<?php
namespace backend\widgets;

use yii\bootstrap\Widget;
use yii\db\Query;
use backend\models\auth_item;

class Formuser extends \yii\base\Widget
{

    public function run()
    {
        $model = new \backend\models\Formuser();
        $model->attributes = \Yii::$app->request->post('Formuser');
        if ($model->validate()) {
            $model->send();
        }
        #формируем список доступных ролейу
        
		$rolez = auth_item::find()->where(['type' => 1])->all();
		$rolelist = array();
		foreach ($rolez as $r){
            $rolelist[$r['name']] = $r['name'];
        }
                     
        return $this->render('formuser', compact('model', 'rolelist'));
    }
}