<?
use backend\models\Resources;
use backend\models\Resources\ResourcesForms;
use backend\models\Resources\ResourcesColumns;
use backend\models\Resources\ResourcesConditions;
use backend\models\Resources\ResourcesRefers;

use backend\models\User;
use backend\models\AuthRule;
use backend\models\AbstractModel;
use backend\controllers\AbstractController;

$globalTitle = $this->title;
$globalControllerId = Yii::$app->controller->id;
$globalActionId = Yii::$app->controller->action->id;
$sectionNameParameter = Yii::$app->getRequest()->getQueryParam('section');
if($globalControllerId === "resources" || preg_match("{resources\/.*?}si", $globalControllerId)) {
	$sectionNameParameter = "resources";
}
//-- get current resource by its section
$resource = Resources::getResourceByResourceName($sectionNameParameter);

$accessDenied = false;

//-- check AuthRule permissions
include("_authrule.php");

if(!IS_ROOT) {

	//-- check AuthView permissions
	include("_authview.php");

	if(!empty($resource->id) && (!$accessFound || !$authViewAccessFound)) {
	//if((!$accessFound || !$authViewAccessFound)) {
		$accessDenied = true;
		//-- access to menu denied ("AuthRule" permissions)
		if(!$accessFound) {
			$errorStr = "ДОСТУП К ЭТОМУ РАЗДЕЛУ ЗАПРЕЩЕН (AuthRule)";
		}
		//-- access to section denied ("AuthView" permissions)
		if(!$authViewAccessFound) {
			$errorStr = "ДОСТУП К ЭТОМУ РАЗДЕЛУ ЗАПРЕЩЕН (AuthView)";
		}
		\Yii::$app->getSession()->setFlash("danger", array("<h4><b>".	$errorStr."</b></h4>"));
		//$this->title = 	$errorStr;
	}

	if($globalControllerId === "site" && $globalActionId === "error") {
		$accessDenied = true;
		$errorStr = "ДОСТУП К ЭТОМУ ДЕЙСТВИЮ ЗАПРЕЩЕН";
		if(!empty($globalTitle)) {
			//$errorStr .= ": ".$globalTitle;
		}
		\Yii::$app->getSession()->setFlash("danger", array("<h4><b>".$errorStr."</b></h4>"));
		//$this->title = $errorStr;
	}
	
  if($sectionNameParameter === "user") {
  	$canAddUser = \Yii::$app->user->can('adduser');
    if(!$canAddUser) {
    	$canUserDoAction["create"] = false;
    	$canUserDoAction["update"] = false;
    	$canUserDoAction["delete"] = false;
    }
  }
}

