<?
use backend\models\Resources;
use backend\models\AuthView;


//-- get "AuthView" permissions
$authViewAccessFound = true;
//-- using for "adm" controller only!
if($globalControllerId === "adm") {
	$sectionNameParameter = Yii::$app->getRequest()->getQueryParam('section');
	$parentIdParameter = Yii::$app->getRequest()->getQueryParam('parentid');
	//-- get parent model row by section name parameter
	$rowParent = Resources::getParentResourceBySection($sectionNameParameter);
	if(!empty($rowParent->resourceid)) {
		//-- get children for current resource
		$rowsChildren = [];
		$m = new Resources();
		$rowsChildren = $m->getResourceOneLevelChildren(
			$rowParent->id,
			Resources::$resourcesData["Resources"]["parentField"],
			Resources::$resourcesData["Resources"]["titleField"]
		);
		//-- check if using or not accessibility for extra links
		$authViewMode = false;
		foreach($rowsChildren as $rowsChild) {
			if(!empty($rowsChild->resourceid)) {
				$resourceModel = $rowsChild->model;
		  	if($resourceModel !== "backend/models/AuthView") {
		  		continue;
		  	}
		  	//-- we are really using "AuthView" for this section!
		  	$authViewMode = true;
		  }
		}
		if($authViewMode) {
			//-- get children of current resource
			foreach($rowsChildren as $rowsChild) {
				if(!empty($rowsChild->resourceid)) {
					$title = $rowsChild->title;
					$resourceid = $rowsChild->resourceid;
					$resourceModel = $rowsChild->model;
					$parentResourceModel = null;
					if(!empty($resourceid)) {
    				//-- compare with current "section" parameter
    				if($resourceid === $sectionNameParameter) {
    					/**
    					 * parameters:
    					 *
    					 * $rowParent->model (parent model) :: backend\models\Menus
    					 * $resourceid (current resourceid) :: menus-issues
    					 * $parentIdParameter (parentid) :: 44
    					 */
    					$canUseAuthViewed = AuthView::canUseAuthViewed($rowParent->model, $resourceid, $parentIdParameter);
    					if(!$canUseAuthViewed) {
    						//-- access denied!
    						$authViewAccessFound = false;
    					}
    				}
    			}
				}
			}
		}
	}
}
