<?
use yii\helpers\Html;
use backend\models\Resources;
use backend\models\Resources\ResourcesConditions;
use backend\models\AbstractModel;
use backend\models\AuthView;
use backend\models\AuthRule;

	$extraLinks = array();
	//-- there are some extra links here!
	if(count($rowsChildren) > 0) {
		$gridColumnsTemplate = "";
		$gridColumnsButtons = [];
		$idx = 0;
  
		//-- check AuthView permissions
		$authViewMode = false;
		if(!IS_ROOT) {
			foreach($rowsChildren as $rowsChild) {
				if(!empty($rowsChild->resourceid)) {
					$resourceModel = $rowsChild->model;
			  	if($resourceModel !== "backend/models/AuthView") {
			  		continue;
			  	}
			  	//-- this section should be checked for AuthView permissions!
			  	$authViewMode = true;
			  }
			}
		}
		foreach($rowsChildren as $rowsChild) {
			if(!empty($rowsChild->resourceid)) {
				$title = $rowsChild->title;
				$resourceid = $rowsChild->resourceid;
				$resourceModel = $rowsChild->model;
				$parentResourceModel = null;
				if(!empty($resourceid)) {
					if(!IS_ROOT) {
						//-- check section from the link for AuthView permissions
        		$accessFound = AuthRule::canUseAuthRuled($resourceid);
						//-- hide extra links bacause of their access
						if(!$accessFound) {
							continue;
						}
					}
				
					$rowParent = Resources::getParentResourceBySection($resourceid);
      		if(!empty($rowParent->model)) {
      			$parentResourceModel = $rowParent->model;
      		}
      	}
  
				if($authViewMode) {
					//-- show "AuthView" link for ROOT only!
					if(!IS_ROOT && $resourceModel === "backend/models/AuthView") {
						continue;
					}
				}
				
				$gridColumnButton =	function($url, $model, $key) use ($title, $resourceid, $parentResourceModel, $authViewMode)
				{
      		
      		$className = AbstractModel::getClassName($resourceid);
      		
      		//-- check conditions suitable for AuthView
      		if($authViewMode) {
      			if($className !== "AuthView" && !is_null($parentResourceModel)) {
      				$canUseAuthViewed = AuthView::canUseAuthViewed($parentResourceModel, $resourceid, $key);
      				
      				if(!$canUseAuthViewed) {
      					return "&ndash;"; //-- middle dash
      					//return "&mdash;"; //-- long dash
      				}
      			}
      		}
      		
      		$res = Resources::getResourceByResourceName($resourceid);
      		
      		$params = array();
      		//-- get the list of conditions
      		$m = new ResourcesConditions();
					$rowsConditions = ResourcesConditions::getResourcesByResourceId($res->id);
					foreach($rowsConditions as $row) {
						if(!empty($row->condition) && !empty($row->value)) {
      				//-- add conditions to params
      				$params[$row->condition] = $row->value;
      			}
					}
      		
					//-- make extra title
					$c = 0;
					if(!empty($res->parent_field)) {
						//-- get "parent_field" field
						$parentField = $res->parent_field;
						//-- add "parent_field" to params
						$params[$parentField] = $key;
        		$countsModel = AbstractModel::getAbstractModel($className);
        		if(!is_null($countsModel)) {
    	  			$c = $countsModel::find()->where($params)->count();
						}
          }
          $s = ($c === 0) ? "" : " (".$c.")";
        	
        	return Html::a($title.$s, ['index', 'parentid'=>$key, 'section'=>$resourceid]);
        };
				
				$gridColumnsButtons["link".$idx] = $gridColumnButton;
				if(strlen($gridColumnsTemplate) > 0) {
					$gridColumnsTemplate .= " | ";
				}
				$gridColumnsTemplate .= "{link".$idx."}";
				$idx++;
			}
		}
		
		$extraLinks =
		['class' => 'yii\grid\ActionColumn',
      'template' => $gridColumnsTemplate,
      'buttons'  => $gridColumnsButtons,
    ];
	}