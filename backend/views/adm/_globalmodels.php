<?

use backend\models\Resources;
use backend\models\Resources\ResourcesForms;

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

if($model->isNewRecord) {
	$globalResourceModelFields = Resources::getResourceModelFields($resourceIdParameter);
} else {
	$globalResourceModelFields = Resources::getResourceModelFields($mainIdParameter);
}

$globalFormTemplate = "{label}{input}<i><small><font color=\"brown\">{hint}</font></small></i>{error}";

include("_common.php");
