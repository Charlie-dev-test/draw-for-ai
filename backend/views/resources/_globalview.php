<?

use backend\models\Resources;
use backend\models\Resources\ResourcesForms;

$viewsPath = Yii::getAlias('@backend')."/views/";
include($viewsPath."_access.php");

$resourceIdParameter = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
$mainIdParameter = (int)Yii::$app->getRequest()->getQueryParam('id');
$formIdParameter = (int)Yii::$app->getRequest()->getQueryParam('formid');

$globalControllerId = Yii::$app->controller->id;
$globalActionId = Yii::$app->controller->action->id;

$resourceTitle = 'Ресурсы';

$this->params['breadcrumbs'][] = ['label' => strip_tags($resourceTitle), 'url' => ['/resources/index']];
if($globalControllerId !== "resources") {
	if($globalControllerId === "resources/formsparams") {
		$this->params['breadcrumbs'][] = ['label' => strip_tags($formsTitle), 'url' => ['/resources/forms/index', 'resourceid'=>$resourceIdParameter]];
		$this->params['breadcrumbs'][] = ['label' => strip_tags($this->title), 'url' => ["/".$globalControllerId."/index", 'resourceid'=>$resourceIdParameter, 'formid'=>$formIdParameter]];
	} else {
		$this->params['breadcrumbs'][] = ['label' => strip_tags($this->title), 'url' => ["/".$globalControllerId."/index", 'resourceid'=>$resourceIdParameter]];
	}
}

if($globalActionId === "update") {
	$this->title .= ". Редактирование";
}
if($globalActionId === "add") {
	$this->title .= ". Добавление";
}

$globalExtraParams = "";
if(!empty($mainIdParameter)) {
	//$this->title .= " (#$parentIdParameter)";
	$modelNamePieces = explode("/", $globalControllerId);
	$modelName = "";
	foreach($modelNamePieces as $modelNamePiece) {
		$modelName .= ucfirst($modelNamePiece);
	}
	$modelClass = "/backend/models/Resources";
	if($modelName !== "Resources") {
		$modelClass = "/backend/models/Resources/".$modelName;
	}
	$resourcesRootPath = Yii::getAlias('@resources_root');
	$classPath =  $resourcesRootPath."/".$modelClass.".php";
	if(file_exists($classPath)) {
		require_once($classPath);
		$modelClass = str_replace("/", "\\", $modelClass);
		$modelInstance = new $modelClass();
		if(!is_null($modelInstance)) {
			$row = $modelInstance->find()->where(['id' => $mainIdParameter])->one();
		}
	}
}
if(!empty($resourceIdParameter)) {
	//-- for any controller except the main one
	//-- for the INDEX action
	//if($globalControllerId !== "resources" && ($globalActionId === "index" || $globalActionId === "add")) {
	if($globalControllerId !== "resources") {
		$row = Resources::getResourceById($resourceIdParameter);
		if(!is_null($row)) {
			if(!empty($row->title)) {
				$globalExtraParams = "?resourceid=".$row->id;
			}
		}
		$resource = new Resources();
		$resource->getResourceParents($resourceIdParameter, "parentid");
		if(!empty($resource->resourcesParents)) {
			$resourceParentsTitle = "";
			foreach(array_reverse($resource->resourcesParents) as $item => $title) {
				if(!empty($resourceParentsTitle)) {
					$resourceParentsTitle .= ". ";
				}
				$resourceParentsTitle .= $title;
			}
			$this->title = $resourceParentsTitle.": ".$this->title;
		}
	}
}
if(!empty($formIdParameter)) {
	$globalExtraParams .= "&formid=".$formIdParameter;
	$row = ResourcesForms::getFormById($formIdParameter);
	if(!is_null($row) && !empty($row->label)) {
		$this->title = $this->title." (".$row->label.")";
	}
}
