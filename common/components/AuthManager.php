<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 12/11/20
 * Time: 2:59 AM
 */
namespace  common\components;

use common\models\User;
use yii\rbac\Assignment;
use yii\rbac\PhpManager;

class AuthManager extends PhpManager
{
    public function getAssignments($userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            $assignment = new Assignment();
            $assignment->userId = $userId;
            $assignment->roleName = $user->role;
            return [$assignment->roleName => $assignment];
        }
        return [];
    }

    public function getAssignment($roleName, $userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            if($user->role == $roleName) {
                $assignment = new Assignment();
                $assignment->userId = $userId;
                $assignment->roleName = $user->role;
                return $assignment;
            }
        }
        return null;
    }

    public function assign($role, $userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            $this->setRole($user, $role->name);
        }
    }

    public function revoke($role, $userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            if ($user->role == $role->name) {
                $this->setRole($user, null);
            }
        }
    }

    public function revokeAll($userId)
    {
        if ($userId && $user = $this->getUser($userId)) {
            $this->setRole($user, null);
        }
    }

    public function getUser($userId) {
        if (!\Yii::$app->user->isGuest && \Yii::$app->user->id == $userId) {
            return \Yii::$app->user->identity;
        } else {
            return User::findOne($userId);
        }
    }

    public function setRole($user, $roleName)
    {
        $user->roile = $roleName;
        $user->updateAttributes(['role' => $roleName]);
    }
}