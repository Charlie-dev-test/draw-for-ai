<?

use backend\models\AbstractModel;

$modelInfoData = "";

$modelInfoRows = AbstractModel::getModelInfo($modelName);
if(!empty($modelInfoRows["class_comments"])) {
	$comms = $modelInfoRows["class_comments"];
	$comms = str_replace("\n", "<br/>", $comms);
	//-- class comments
	$modelInfoData .= "<div class=\"model_info_comments\">".$comms."</div>";
}
//-- class name
$modelInfoData .= "<div class=\"model_info_class_name\">class ".$modelInfoRows["class_name"]."</div>";

if(!empty($modelInfoRows["class_properties"])) {
	foreach($modelInfoRows["class_properties"] as $classProp) {
		if(!empty($classProp["comments"])) {
			$comms = $classProp["comments"];
			$comms = str_replace("\n", "<br/>", $comms);
			//-- method comments
			$modelInfoData .= "<div class=\"model_info_comments prop\">".$comms."</div>";
		}
		$propType = "";
		if(!empty($classProp["type"])) {
			$strPropType = implode(" ", $classProp["type"]);
			$propType = "<span class=\"model_info_thin\"><i>".$strPropType."</i></span> ";
		}
		//-- property name
		$propName = $classProp["name"];
		$propValue = $classProp["value"];
		$modelInfoData .= "<div class=\"model_info_prop_name\">".$propType.$propName."</div>";
		if(!is_null($propValue)) {
			$modelInfoData .= "<div class=\"model_info_comments values\">".json_encode($propValue, JSON_UNESCAPED_UNICODE)."</div>";
		}
	}
	$modelInfoData .= "<div><hr/></div>";
}

if(!empty($modelInfoRows["class_methods"])) {
	foreach($modelInfoRows["class_methods"] as $methodName => $classMethod) {
		if(!empty($classMethod)) {
			if(!empty($classMethod["method_comments"])) {
				$comms = $classMethod["method_comments"];
				$comms = str_replace("\n", "<br/>", $comms);
				//-- method comments
				$modelInfoData .= "<div class=\"model_info_comments method\">".$comms."</div>";
			}
			$methodType = "";
			if(!empty($classMethod["method_type"])) {
				$methodType = "<span class=\"model_info_thin\"><i>".$classMethod["method_type"]."</i></span> ";
			}
			//-- method name
			$modelInfoData .= "<div class=\"model_info_method_name\">".$methodType.$methodName."</div>";
			
			if(!empty($classMethod["method_params"])) {
				$modelInfoData .= "<div class=\"model_info_comments param\">//-- список параметров</div>";
				foreach($classMethod["method_params"] as $paramName => $paramType) {
					$paramName = "<b>".$paramName."</b>";
					if(!empty($paramType)) {
						$paramName .= " <i>".$paramType."</i>";
					}
					//-- parameter name
					$modelInfoData .= "<div class=\"model_info_params\">".$paramName."</div>";
				}
			}
			$modelInfoData .= "<div><hr/></div>";
		}
	}
}

?>
<div class="modal fade" id="<?=$modelName?>" tabindex="-1" role="dialog" aria-labelledby="<?=$modelName?>LongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content w-100">
      <div class="modal-header">
        <h2 class="modal-title" id="<?=$modelName?>Title">Модель: <?=$modelName?></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><?=$modelInfoData?></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?
$modelInfoHtml = "<span class=\"model_info_link model_info_tooltip\" title=\"Структура модели ".$modelName."\" data-toggle=\"modal\" data-target=\"#".$modelName."\"><b>".$modelName."</b></span>";
