<?php
namespace backend\widgets;

use yii\bootstrap\Widget;
use yii\db\Query;
use Yii;

class Roleform extends \yii\base\Widget
{
    public $datarole;
    public $dataallrole;

    public function run()
    {
        $rolevar = $this->datarole; //  Список достпных ролей (полный)
        $roleall = $this->dataallrole; // Весь список привелегий
        $roleall = array_merge($rolevar,$roleall);
        
        $model = new \backend\models\Roleform();
        if($c = Yii::$app->request->post('Roleform')){
            // @string название роли, для удобства 
            $check = $c['roledown']; 
            
            if(!empty($check) && empty($c['hiddenpool'] )){
               
                    $selectedvalue = $this->addSelect($check);
                    $model->checked = true;// Рендер второй страницы получившей нужную роль
                    return $this->render('roleform', compact('model','check','roleall','selectedvalue'));
            }else{
                 
                $model->attributes = Yii::$app->request->post('Roleform');
                if ($model->validate()) {
                    $model->send();
                }
                $selectedvalue = $this->addSelect($check);// Обрабатываем массив
                $model->success = true;
                return $this->render('roleform', compact('model','rolevar','check','roleall','selectedvalue'));
            }
        }else{
            // Дефолтная страница , выбираем роль для которой добавляем привелегию
            return $this->render('roleform', compact('model','rolevar'));
        }  
    }

    /**
     *   Получаем и обрабатываем массив
     *
     *   @param $name string
     *   @return array
     */

    protected function addSelect($name){
        $excRole = new Query;
        $excRole->select('child')->from('auth_item_child')->where('parent=:id1', array(':id1'=>$name));
        $command = $excRole->createCommand();
        $excRole = $command->queryAll();
        $selectedvalue = array();
        foreach ($excRole as $v) {
            $selectedvalue[$v['child']] = ["selected"=>true];
        }

        return $selectedvalue;
    }

}