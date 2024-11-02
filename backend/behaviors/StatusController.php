<?php
namespace backend\behaviors;

use Yii;

/**
 * Status behavior. Adds statuses to models
 * @package backend\behaviors
 */
class StatusController extends \yii\base\Behavior
{
    public $model;

    public function changeStatus($id, $status)
    {
        $modelClass = $this->model;

        if(($model = $modelClass::findOne($id))){
            $model->status = $status;
            $model->update();
        }
        else{
            $this->error = Yii::t('backend', 'Not found');
        }

        return $this->owner->formatResponse(Yii::t('backend', 'Status successfully changed'));
    }
}