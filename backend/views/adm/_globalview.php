<?

use backend\models\Resources;
use backend\helpers\Admin;

//$viewsPath = Yii::getAlias('@backend')."/views/";
//include($viewsPath."_a-c-c-e-s-s.php");

$this->title = "";

$resourceIdParameter = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
$mainIdParameter = (int)Yii::$app->getRequest()->getQueryParam('id');
$parentIdParameter = (int)Yii::$app->getRequest()->getQueryParam('parentid');
$pageParameter = (int)Yii::$app->getRequest()->getQueryParam('page');
$sectionNameParameter = Yii::$app->getRequest()->getQueryParam('section');

//-- check for direct link
$isDirectLink = false;
$directLinkResource = null;
if(is_null($sectionNameParameter)) {
	$pathInfo = Yii::$app->getRequest()->getPathInfo();
	if(!empty($pathInfo)) {
		$resource = Resources::getResourceByResourceName("/".$pathInfo);
		if(!empty($resource->resourceid) && !empty($resource->direct_link)) {
			//-- there is the direct link here!
			$isDirectLink = true;
			$directLinkResource = $resource->resourceid;
			$sectionNameParameter = $directLinkResource;
		}
	}
}
defined("IS_DIRECT_LINK") || define("IS_DIRECT_LINK", $isDirectLink);
defined("DIRECT_LINK_RESOURCE") || define("DIRECT_LINK_RESOURCE", $directLinkResource);

$globalControllerId = Yii::$app->controller->id;
$globalActionId = Yii::$app->controller->action->id;


$mainTitle = "";
$globalExtraParams = "";
if(!empty($sectionNameParameter)) {
	
	$globalSectionsList = Admin::getSectionsInfo($sectionNameParameter);

	$idx = 0;
	$parentId = $parentIdParameter;
	foreach($globalSectionsList as $globalSectionsItem) {
		
		if(!empty($mainTitle)) {
			$mainTitle .= ". ";
		}
		$currSection = $globalSectionsList[$idx]["section_direct"];
		$currTitle = $globalSectionsList[$idx]["title"];
		$shortTitle = $globalSectionsList[$idx]["title"];
		$currParentId = $globalSectionsList[$idx]["parentid"];
		if(!empty($globalSectionsList[$idx]["title_details"])) {
			$currTitle .= " (".$globalSectionsList[$idx]["title_details"].")";
		}
		$mainTitle .= $currTitle;

		$extraParams = "?section=".$currSection;
		if(!empty($currParentId) && $idx > 0) {
			$extraParams .= "&parentid=".$currParentId;
		}
		$this->params['breadcrumbs'][] = ['label' => strip_tags($shortTitle), 'url' => ['/adm'.$extraParams]];

		$idx++;
	}

	$this->title = strip_tags($mainTitle);
	
	$globalExtraParams = "?section=".$sectionNameParameter;
	if(!empty($parentIdParameter)) {
		$globalExtraParams .= "&parentid=".$parentIdParameter;
	}
	if(!empty($pageParameter)) {
		$globalExtraParams .= "&page=".$pageParameter;
	}

}
//-- check for direct link
if(IS_DIRECT_LINK) {
	$this->params['breadcrumbs'] = [];
}

if($globalActionId === "update") {
	$this->title .= ": Редактирование";
}
if($globalActionId === "add" || $globalActionId === "create") {
	$this->title .= ": Добавление";
}

include_once("_common.php");
