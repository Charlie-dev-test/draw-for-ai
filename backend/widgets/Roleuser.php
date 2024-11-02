<?php
namespace backend\widgets;

use yii\bootstrap\Widget;
use yii\db\Query;

class Roleuser extends \yii\base\Widget
{
    //public $type;

    public function run()
    {
        // Масств для описания
        $model = new \backend\models\Roleuser();
        $model->attributes = \Yii::$app->request->post('Roleuser');
        if ($model->validate()) {
            $check = $model->send();
        }else{
            //$model->false = true;
            return $this->render('roleuser', compact('model'));
        }

        if($check === true){
            $model->success = true;
        }else{

            $model->test = $check;
            $model->false = true;
        }
        
        return $this->render('roleuser', compact('model'));
    }
}