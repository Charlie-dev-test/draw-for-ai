<?php
namespace backend\behaviors;

use yii\db\ActiveRecord;

/**
 * Sortable behavior. Enables model to be sorted manually by admin
 * @package backend\behaviors
 */
class SortableModel extends \yii\base\Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'findMaxOrderNum',
        ];
    }

    public function findMaxOrderNum()
    {
        if(!$this->owner->order_num) {
            $maxOrderNum = (int)(new \yii\db\Query())
                ->select('MAX(`order_num`)')
                ->from($this->owner->tableName())
                ->scalar();
            $this->owner->order_num = ++$maxOrderNum;
        }
    }
}