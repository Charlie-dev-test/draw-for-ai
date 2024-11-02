<?

use backend\models\Resources;
use backend\models\Resources\ResourcesForms;
use backend\helpers\Admin;

$resourceIdParameter = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
$mainIdParameter = (int)Yii::$app->getRequest()->getQueryParam('id');
$formIdParameter = (int)Yii::$app->getRequest()->getQueryParam('formid');

$resourcesRootPath = Yii::getAlias('@resources_root');
$strPath1 = $resourcesRootPath."/*/models/*.php";
$strPath2 = $resourcesRootPath."/models/*.php";
$modelesList = array();
$modelesList["-"] = "Нет";
foreach(glob($strPath1) as $fileName) {
	$pathInfo = pathinfo($fileName);
	$fileName = $pathInfo["dirname"]."/".$pathInfo["filename"];
	$modelesListItem = substr($fileName, strlen($resourcesRootPath)+1);
	$modelesList[$modelesListItem] = $modelesListItem;
}
foreach(glob($strPath2) as $fileName) {
	$pathInfo = pathinfo($fileName);
	$fileName = $pathInfo["dirname"]."/".$pathInfo["filename"];
	$modelesList[] = substr($fileName, strlen($resourcesRootPath)+1);
}

$fontAwesomeIcons = Admin::getFontAwesomeIcons();
$menuIconsListOptions = [];
foreach($fontAwesomeIcons as $icon => $name) {
	$menuIconsListOptions[$name]['class'] = "fa fa-".$icon;
}
$menuIconsList = [];
$menuIconsList["-"] = "Нет";
$menuIconsList = array_merge($menuIconsList, $fontAwesomeIcons);
/*
if($model->isNewRecord) {
	$globalResourceModelFields = Resources::getResourceModelFields($resourceIdParameter);
} else {
	$globalResourceModelFields = Resources::getResourceModelFields($mainIdParameter);
}
*/
$globalResourceModelFields = Resources::getResourceModelFields($resourceIdParameter);
$globalResourceModelFieldsAutocomplete = [];
foreach($globalResourceModelFields as $value => $label) {
	$globalResourceModelFieldsAutocomplete[] = [
		"value" => $value,
		"label" => $label,
		//"id" => $value,
	];
}

$globalFormTemplate = "{label}{input}<i><small><font color=\"brown\">{hint}</font></small></i>{error}";
