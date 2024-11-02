<?
namespace backend\helpers;

use Yii;
use backend\models\Resources;
use backend\models\AbstractModel;

use rmrevin\yii\fontawesome\FAS;

class Admin
{
  static function getSectionsInfo($sectionName = null)
  {
    $parentIdParameter = (int)Yii::$app->getRequest()->getQueryParam('parentid');
    $sectionNameParameter = Yii::$app->getRequest()->getQueryParam('section');
    if(!is_null($sectionName)) {
    	$sectionNameParameter = $sectionName;
    }
		$sectionItems = explode("-", $sectionNameParameter);
		
		//-- the main array for storing ALL navigation data
		$globalSectionsList = array();
		
		$sectionItemName = "";
		$modelListItems = array();
		$sectionDirectItems = array();
		$sectionReverseItems = array();
		foreach($sectionItems as $sectionItem) {
			if(!empty($sectionItemName)) {
				$sectionItemName .= "-";
			}
			$sectionItemName .= $sectionItem;
			//-- save models
			$modelListItems[] = $sectionItem;
			//-- save sections
			$sectionDirectItems[] = $sectionItemName;
		}
		//-- reverse sections
		$sectionReverseItems = array_reverse($sectionDirectItems);
   
		$idx = 0;
		foreach($sectionDirectItems as $sectionDirectItem) {
			$modelDirectItem = $modelListItems[$idx];
			$modelReverseItem = array_reverse($modelListItems)[$idx];
			$sectionDirectItem = $sectionDirectItems[$idx];
			$sectionReverseItem = $sectionReverseItems[$idx];
			
			//-- start storing data
			$globalSectionsList[] = array(
				"model_direct" => $modelDirectItem,
				"model_reverse" => $modelReverseItem,
				"section_direct" => $sectionDirectItem,
				"section_reverse" => $sectionReverseItem,
				"parent_field" => "",
				"child_field" => "",
				"title" => "",
				"title_details" => "",
				"parentid" => 0,
			);

			
   
			//-- set direct parent field
			$res = Resources::getResourceByResourceName($globalSectionsList[$idx]["section_direct"]);
			$globalSectionsList[$idx]["parent_field"] = !empty($res->parent_field) ? $res->parent_field : "title";
			$globalSectionsList[$idx]["title"] = $res->title;
			
			//-- set reverse parent field
			$res = Resources::getResourceByResourceName($globalSectionsList[$idx]["section_reverse"]);
			if(!empty($res->parent_field)) {
				$globalSectionsList[$idx]["child_field"] = $res->parent_field;
			}
   
			$idx++;
		}
   
		$numSections = count($globalSectionsList);
   
		$idx = 0;
		$parentId = $parentIdParameter;
		foreach($globalSectionsList as $globalSectionsItem) {
			
			$modelDirect = $globalSectionsList[$idx]["model_direct"];
			$sectionDirect = $globalSectionsList[$idx]["section_direct"];
			$modelParentField = $globalSectionsList[$idx]["parent_field"];
   
			$idxxx = $numSections - ($idx + 1);
			$globalSectionsList[$idxxx]["parentid"] = $parentId;
   
			if($idx < count($globalSectionsList)-1) {
				//-- get child data
				$modelReverse = $globalSectionsList[$idx+1]["model_reverse"];
				$modelParentField = $globalSectionsList[$idx+1]["child_field"];
				//-- get child model
				$model = Resources::getAbstractModel($modelReverse);
				$row = $model->findOneModel($parentId);
				if(!is_null($row)) {
					$parentId = 0;
					if(!empty($modelParentField)) {
						$parentId = (int)$row->$modelParentField;
					} elseif(!empty($_GET["parentid"])) {
						$parentId = (int)$_GET["parentid"];
					}
					$title = "";
					if(isset($row->title)) {
						$title = $row->title;
					}
					
					$idxxx = $numSections - ($idx + 2);
					
					//-- store the title of the parent section
					$globalSectionsList[$idxxx]["title_details"] = $title;
				}
			}
			$idx++;
		}
		
		return $globalSectionsList;
	}

	public static function getFontAwesomeIcons()
	{
		$refl = new \ReflectionClass('rmrevin\yii\fontawesome\FAS');
		$classConstants = $refl->getConstants();
		
		$fontAwesomeIcons = [];
		foreach($classConstants as $classConstant => $icon) {
			if(substr($classConstant, 0, 1) === "_") {
				//-- icon const found
				//$name = "fa-".$icon;
				$name = $icon;
				//$fontAwesomeIcons[$name] = "<i class=\"fa ".$name."\">".$name."</i>";
				$fontAwesomeIcons[$name] = $name;
			}
		}
		return $fontAwesomeIcons;
	}

}