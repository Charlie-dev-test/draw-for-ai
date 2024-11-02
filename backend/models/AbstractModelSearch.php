<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Resources\ResourcesColumns;
use backend\models\Resources\ResourcesConditions;
use backend\models\AbstractModel;
use kartik\grid\GridView;

/**
 * Description of AbstractModelSearch
 */
class AbstractModelSearch extends AbstractModel
{
    public function rules()
    {
        $defaultAttrs = array_keys($this->attributeLabels());
        return [
            [$defaultAttrs, 'default'],
        ];
    }
    
    /**
     * @bypass  Resources class scenarios
     */
    public function scenarios()
    {
        return AbstractModel::scenarios();
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param object $parentObj
     *
     * @return ActiveDataProvider
     */
    public function search($params, $parentObj=null)
    {
        if(!empty($params["model"])) {
        	unset($params["model"]);
        }
        
        $query = AbstractModel::find();
        $tableName = parent::tableName();

        $searchModel = $this->initModelSearch();
        $searchClassName = AbstractModel::getClassName(get_class($searchModel));
        //-- get Columns Filter params
        $columnsFilterParams = [];
        if(!empty($params[$searchClassName])) {
       	  $columnsFilterParams = $params[$searchClassName];
        }
        
        //-- store all filter values (taken from the params) in our GridView 
        if(!is_null($parentObj)) {
        	$parentObj->load($params);
        }
        
        //-- get Columns Sorting params
        $columnsSortingParams = [];
        if(!empty($params["sort"])) {
       	  $columnsSortingParams = $params["sort"];
        }

        //-- get orderByParams parameter
        $orderByParams = "";
        if(!empty($params["orderby"])) {
        	$orderByParams = $params["orderby"];
        	unset($params["orderby"]);
        }
        
        //-- get joinsParams parameter
        $joinsParams = array();
        if(!empty($params["joins"])) {
        	$joinsParams = $params["joins"];
        	unset($params["joins"]);
        }
        
        $rowsColumns = [];
        $gridViewFilterTypes = array_keys(ResourcesColumns::$gridViewFilterTypes);
        if(!empty($params["section"])) {
        	//-- get current resource
        	$resource = Resources::getResourceByResourceName($params["section"]);
        	//-- remove "section" parameter
        	unset($params["section"]);
        
        	if(!empty($params["parentid"]) && !empty($resource->parent_field)) {
        		//-- get the name if the real parentID
        		$params[$resource->parent_field] = $params["parentid"];
        		//-- remove "parentid" parameter
        		unset($params["parentid"]);
        	}
        
        	if(!empty($resource->id)) {
        		
        		$m = new ResourcesColumns();
						$m->getResourceChildrenFull(
							$resource->id,
							Resources::$resourcesData["ResourcesColumns"]["parentField"],
							Resources::$resourcesData["ResourcesColumns"]["titleField"]
						);
						$rowsColumns = $m->resourcesChildren;
        		
        		//-- check for the inappropriate columns
        		$resourceModelFields = array_keys(Resources::getResourceModelFields($resource->id));
        		if(!empty($resourceModelFields) && is_array($resourceModelFields)) {
  	      		foreach($params as $k => $v) {
    	    			if(!in_array($k, $resourceModelFields)) {
    	    				unset($params[$k]);
    	    			}
      	  		}
        		}
        		
        		$m = new ResourcesConditions();
						$rowsConditions = ResourcesConditions::getResourcesByResourceId($resource->id);
						foreach($rowsConditions as $row) {
							if(!empty($row->condition) && !empty($row->value)) {
    						//-- add conditions to the "where" clause
    						$query->andWhere(["=", $row->condition, $row->value]);
    						$params[$row->condition] = $row->value;
    					}
						}
        	}
        }
        
        //$selectStr = "`".$tableName."`.*";
        $selectArr[] = "`".$tableName."`.*";
        
        if(!empty($joinsParams)) {
        	foreach($joinsParams as $joinsParam) {
        		$className = AbstractModel::getClassName($joinsParam["model"]);
        		$model = AbstractModel::getAbstractModel($className, true);
        		if(!is_null($model)) {
        			$joinTableName = $model::tableName();
        			$strCondition = str_replace(
        				array("{{table}}", "{{jointable}}"),
        				array($tableName, $joinTableName),
        				$joinsParam["condition"]
        			);
        			$query->leftJoin($joinTableName, $strCondition);
        			if(!empty($joinsParam["fields"])) {
        				$joinsParamFields = $joinsParam["fields"];
        				$joinFieldsList = explode(";", $joinsParamFields);
        				foreach($joinFieldsList as $joinFieldsItem) {
        					$joinFields = explode("|", $joinFieldsItem);
        					if(count($joinFields) === 2) {
        						//$selectStr .= ",`".$joinTableName."`.`".$joinFields[0]."` as '".$joinFields[1]."'";
        						$selectArr[$joinFields[1]] = "`".$joinTableName."`.`".$joinFields[0]."`";
        					}
        				}
        			}
        		}
        	}
        }
        
        //-- make the "where" clause
        $query->where($params);
        
        //-- set Filters from params
        if(!empty($columnsFilterParams)) {
        	foreach($columnsFilterParams as $key => $val) {
        		//-- type "string" => use just for not empty string!
        		if($val !== "") {
        			//-- trying to get filter type
        			$filterType = "";
        			foreach($rowsColumns as $row) {
  							if(!empty($row->field) && $row->filter_flag === 1) {
  								//-- found the field
  								if($key === $row->field) {
                  	//-- get filter type
                  	if(!empty($row->filter_type) && in_array($row->filter_type, $gridViewFilterTypes)) {
                  		//-- special filter type
                  		$filterType = $row->filter_type;
                  	}
  								}
  							}
  						}
  						//-- handle filter type to make "andFilterWhere" clause
        			$key = $tableName.".".$key;
        			$query = $this->getFilterWhereClause($filterType, $query, $key, $val);
        		}
        	}
        }

        if(!empty($columnsSortingParams)) {
        	//-- skip Resource sorting!
        } else {
        	//-- set orderBy clause from Resources settings
        	if(!empty($orderByParams)) {
        		$query->orderBy($orderByParams);
        	}
        }
        
        $query->select($selectArr);
        

        $dataProviderParams = [
        	"query" => $query
        ];

        $dataProvider = new ActiveDataProvider($dataProviderParams);

        return $dataProvider;
    }

    private function getFilterWhereClause($filterType, $query, $key, $val)
    {
    	if($filterType !== "") {
    		switch($filterType) {
          case GridView::FILTER_CHECKBOX: //-- 'checkbox'
          	$query->andFilterWhere(['=', $key, $val]);
						break;
					//-- !!! NOT IMPLEMENTED YET !!!
					case GridView::FILTER_RADIO: //-- 'radio'
						break;
					case GridView::FILTER_SELECT2: //-- '\kartik\select2\Select2'
						$query->andFilterWhere(['=', $key, $val]);
						break;
					case GridView::FILTER_TYPEAHEAD: //-- '\kartik\switchinput\SwitchInput'
						$query->andFilterWhere(['like', $key, $val]);
						break;
					case GridView::FILTER_SWITCH: //-- '\kartik\switchinput\SwitchInput'
						$query->andFilterWhere(['=', $key, $val]);
						break;
					case GridView::FILTER_SPIN: //-- '\kartik\touchspin\TouchSpin'
						$query->andFilterWhere(['=', $key, $val]);
						break;
					case GridView::FILTER_STAR: //-- '\kartik\rating\StarRating'
						$query->andFilterWhere(['between', $key, 0.0, floatval($val)]);
						break;
					case GridView::FILTER_DATE: //-- '\kartik\date\DatePicker'
						$tm = strtotime(trim($val));
						if($tm !== false) {
							$query->andFilterWhere(['=', $key, date("Y-m-d", $tm)]);
						}
						break;
					//-- !!! NOT IMPLEMENTED YET !!!
					case GridView::FILTER_TIME: //-- '\kartik\time\TimePicker'
						break;
					case GridView::FILTER_DATETIME: //-- '\kartik\datetime\DateTimePicker'
						$tm = strtotime(trim($val));
						if($tm !== false) {
							$query->andFilterWhere(['=', $key, date("Y-m-d H:i", $tm)]);
						}
						break;
					case GridView::FILTER_DATE_RANGE: //-- '\kartik\daterange\DateRangePicker'
						if(preg_match("{(.*?)\s\-\s(.*)}si", $val, $matches)) {
							$tm1 = strtotime(trim($matches[1]));
							$tm2 = strtotime(trim($matches[2]));
							if($tm1 !== false && $tm2 !== false) {
								$query->andFilterWhere(['between', $key, date("Y-m-d", $tm1), date("Y-m-d", $tm2)]);
							}
						}
						break;
					//-- !!! NOT IMPLEMENTED YET !!!
					case GridView::FILTER_SORTABLE: //-- '\kartik\sortinput\SortableInput'
						break;
					case GridView::FILTER_RANGE: //-- '\kartik\range\RangeInput'
						$query->andFilterWhere(['between', $key, 0, $val]);
						break;
					case GridView::FILTER_COLOR: //-- '\kartik\color\ColorInput'
						$query->andFilterWhere(['=', $key, $val]);
						break;
					case GridView::FILTER_SLIDER: //-- '\kartik\slider\Slider'
						$query->andFilterWhere(['=', $key, $val]);
						break;
					case GridView::FILTER_MONEY: //-- '\kartik\money\MaskMoney'
						$query->andFilterWhere(['=', $key, $val]);
						break;
					case GridView::FILTER_NUMBER: //-- '\kartik\number\NumberControl'
						$query->andFilterWhere(['=', $key, floatval($val)]);
						break;
					case GridView::FILTER_CHECKBOX_X: //-- '\kartik\checkbox\CheckboxX'
						$query->andFilterWhere(['=', $key, $val]);
						break;
    		}
    	} else {
    		$query->andFilterWhere(['like', $key, $val]);
    	}
    	return $query;
    }

}
