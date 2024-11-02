<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 12/11/20
 * Time: 2:55 AM
 */
namespace common\rbac\rules;

use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if(!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->role;
            if ($item->name === 'admin') {
                return $group == 1;
            } elseif ($item->name === 'user') {
                return $group == 1 || $group == 2;
            }
        }
    }

}