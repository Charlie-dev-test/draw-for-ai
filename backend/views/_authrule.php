<?
use backend\models\Resources;
use backend\models\AuthRule;


$accessFound = AuthRule::canUseAuthRuled();
$canUserDoAction = AuthRule::$canUserDoAction;
$menuRulesList = AuthRule::$menuRulesList;
