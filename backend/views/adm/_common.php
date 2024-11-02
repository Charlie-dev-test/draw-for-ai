<?

use backend\models\Resources;
use backend\models\Resources\ResourcesForms;
use backend\models\Resources\ResourcesColumns;
use backend\models\Resources\ResourcesConditions;
use backend\models\Resources\ResourcesRefers;

$viewsPath = Yii::getAlias('@backend')."/views/";
include($viewsPath."_access.php");

$sectionNameParameter = Yii::$app->getRequest()->getQueryParam('section');
$parentIdParameter = Yii::$app->getRequest()->getQueryParam('parentid');
$resource = Resources::getResourceByResourceName($sectionNameParameter);

//-- check for direct link
if(IS_DIRECT_LINK && !is_null(DIRECT_LINK_RESOURCE)) {
	$resource = Resources::getResourceByResourceName(DIRECT_LINK_RESOURCE);
}

$showForm = false;
if(!empty($resource->id)) {
	$showForm = true;
} else {
	Yii::$app->session->addFlash("danger", "Не найден родительский ресурс!");
}

//-- get all children for ResourcesForms
$rowsColumns = [];
$rowsConditions = [];
$rowsRefers = [];
$rowsForms = [];
$rowsChildren = [];
if($showForm) {
	$m = new ResourcesColumns();
	$m->getResourceChildrenFull(
		$resource->id,
		Resources::$resourcesData["ResourcesColumns"]["parentField"],
		Resources::$resourcesData["ResourcesColumns"]["titleField"]
	);
	$rowsColumns = $m->resourcesChildren;

	$m = new ResourcesConditions();
	$rowsConditions = ResourcesConditions::getResourcesByResourceId($resource->id);

	//$m = new ResourcesRefers();
	$rowsRefers = ResourcesRefers::getResourcesByResourceId($resource->id);
	foreach($rowsRefers as $rowsRefer) {
	}
	
	$m = new ResourcesForms();
	$m->getResourceChildrenFull(
		$resource->id,
		Resources::$resourcesData["ResourcesForms"]["parentField"],
		Resources::$resourcesData["ResourcesForms"]["titleField"]
	);
	$rowsForms = $m->resourcesChildren;

	$m = new Resources();
	$rowsChildren = $m->getResourceOneLevelChildren(
		$resource->id,
		Resources::$resourcesData["Resources"]["parentField"],
		Resources::$resourcesData["Resources"]["titleField"]
	);
}
