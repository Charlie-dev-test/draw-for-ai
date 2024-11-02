<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Uploads;
use backend\models\Resources;
use backend\models\Resources\ResourcesForms;
use backend\models\Resources\ResourcesFormsParams;
use backend\models\Resources\ResourcesRefers;
use backend\models\AbstractModel;
use backend\helpers\Form;
use backend\helpers\View;
use backend\helpers\Funcs;

/**
 * Description of _form
 */

include("_globalmodels.php");

$ADMIN_VIEW_TEMPLATE = isset($admin_view_template);

?>
<div class="menu-form">
  <?
  //-- get all children for ResourcesForms
  
  if($showForm) {
    
  	$ADMIN_VIEW_PARAMS = [];
  	$ADMIN_VIEW_OPTIONS = [];
  	
  	$viewObj = new stdClass();
		$viewObj->model = $model;
		$viewObj->row = new stdClass();
		$viewObj->row->type = "???";
		$viewObj->row->field = "???";

    if($ADMIN_VIEW_TEMPLATE) {
    	echo "<table>";
    }

    $form = ActiveForm::begin([
      "options" => [
				"id" => "upload-image-form",
				"enctype" => "multipart/form-data",
      ],
      "enableAjaxValidation" => false,
      "enableClientValidation" => true,
      "fieldConfig" => [
      	"template" => $globalFormTemplate,
      ]
		]);

    //-- set CONDITIONS as Hidden
    foreach($rowsConditions as $row) {
    	if(!empty($row->condition) && !empty($row->value)) {
    		$params = array();
    		$params["value"] = $row->value;

    		if($ADMIN_VIEW_TEMPLATE) {
					$viewObj->row->type = "Hidden";
					$viewObj->row->field = $row->condition;
					$fldValue = "! not implemented yet !";
					$fldValue = View::info($viewObj, $params);
					$ADMIN_VIEW_PARAMS[$row->condition] = $fldValue;
					//-- show this for "root" users only!
					if(IS_ROOT && !empty($fldValue)) {
						echo "<tr valign=\"top\"><td>".$row->condition."</td><td>".$fldValue."</td></tr>";
      		}
      	} else {
    			$inputObj = $form->field($model, $row->condition)
    				->label(false)
    				->hint(false)
    			;
    			echo Form::input($inputObj, "Hidden", $params);
    		}
    	}
    }

    //-- set PARENTID as Hidden
    if(!empty($parentIdParameter) && !empty($sectionNameParameter)) {
    	$res = Resources::getResourceByResourceName($sectionNameParameter);
			if(!empty($res->parent_field)) {
				$params = array();
				$params["required"] = true;
    		$params["value"] = $parentIdParameter;
				
				if($ADMIN_VIEW_TEMPLATE) {
					$viewObj->row->type = "Hidden";
					$viewObj->row->field = $res->parent_field;
					$fldValue = View::info($viewObj, $params);
					$ADMIN_VIEW_PARAMS[$res->parent_field] = $fldValue;
					//-- show this for "root" users only!
					if(IS_ROOT && !empty($fldValue)) {
						echo "<tr valign=\"top\"><td>".$res->parent_field."</td><td>".$fldValue."</td></tr>";
      		}
      	} else {
					$inputObj = $form->field($model, $res->parent_field)
    				->label(false)
    				->hint(false)
    			;
    			echo Form::input($inputObj, "Hidden", $params);
    		}
			}
    }

    //-- set active form inputs
    foreach($rowsForms as $row) {
    	if(!empty($row->field)) {
    		
    		if($row->show_check) {
					if(!eval($row->show_check)) {
						continue;
					}
				}
    		
				//-- use default type for the field
				$useDefaultType = true;
				
				$params = array();
				$options = array();
    		if(!empty($row->required)) {
    			$params["required"] = true;
    		}
    
    		$dependenciesOption = "";
    		$fieldsDependencies = $model::getFieldsDependencies();
        if(!empty($fieldsDependencies["field_main"])) {
					$depMain = $fieldsDependencies["field_main"];
					if($row->field === $depMain) {
						$dependenciesOption = "deps_field_main";
					} else {
						$depDependencies = $fieldsDependencies["field_dependencies"];
						$dependenciesOption = "deps_field";
						foreach($depDependencies as $depValue => $depFields) {
							foreach($depFields as $depField) {
								if($row->field === $depField) {
									$dependenciesOption .= " deps_show-".$depValue;
								}
							}
						}
					}
				}
    		
    		//-- set form parameters for the current field
    		$m = new ResourcesFormsParams();
				$m->getResourceChildrenFull(
					$row->id,
					Resources::$resourcesData["ResourcesFormsParams"]["parentField"],
					Resources::$resourcesData["ResourcesFormsParams"]["titleField"]
				);
				$rowsFormsParams = $m->resourcesChildren;
				
				//-- check if show all checkboxes in one column
				$isOneColumnMultiCheckbox = false;
				foreach($rowsFormsParams as $rowsFormsParam) {
					if(!empty($rowsFormsParam->title) && !empty($rowsFormsParam->value)) {
					  //--  the type of the parameter is "OneColumn"
						if(preg_match("{onecolumn}si", $rowsFormsParam->title)) {
							$vals = @eval($rowsFormsParam->value);
							if($vals) {
					  		if($row->type === "MultiCheckbox") {
					  			$isOneColumnMultiCheckbox = true;
					  		}
					  	}
					  }
					}
				}
				
				foreach($rowsFormsParams as $rowsFormsParam) {
					if(!empty($rowsFormsParam->title) && !empty($rowsFormsParam->value)) {
					  //--  the type of the parameter is "MultiOptions"
						if(preg_match("{multioptions}si", $rowsFormsParam->title)) {
							$vals = @eval($rowsFormsParam->value);
							if(is_array($vals)) {
								foreach($vals as $key => $val) {
									$params[$key] = $val;
								}
								unset($params["required"]);
							}
							//-- if "MultiOptions" & "Select" & "onCreate", set default value
							if($row->type === "Select" && $globalActionId === "create") {
								if(!empty($row->value)) {
									//-- default value has been set
									$options["value"] = $row->value;
									//$options[$row->value] = ["selected" => true];
								}
							}
							//-- if "MultiOptions" & "MultiCheckbox", check for the REFERS!
							if($row->type === "MultiCheckbox") {
								$requestIdParameter = Yii::$app->getRequest()->getQueryParam('id');
								$checkedResult = ResourcesRefers::getRefers($rowsRefers, $row->field, $requestIdParameter);
								$fldName = $row->field;
								if(!empty($requestIdParameter) && count($rowsRefers) === 0 && count($checkedResult) === 0) {
									$requestIdParameter = (int)$requestIdParameter;
									$modelRow = $model::findOne($requestIdParameter);
									//-- if serialized data, do unserialize!
									if(!is_null($modelRow) && Funcs::is_serial($modelRow->$fldName)) {
										$checkedResult = unserialize($modelRow->$fldName);
									}
								}
								
								$extraCls = $isOneColumnMultiCheckbox ? " one-column" : "";
								$options = ["class" => "checkbox".$extraCls];
								$model->$fldName = $checkedResult;
							}
						}
					}
				}
				
				//-- extra options for type CHECKBOX
				if($row->type === "Checkbox") {
					$options = ["class" => "checkbox"];
				}
    		
    		//-- extra field for type PASSWORD
				if($row->type === "Password") {
					$params = array();
    			$params["value"] = "";
    			
					$globalActionId = Yii::$app->controller->action->id;
    			$params["required"] = ($globalActionId === "create");
    			$options["dependencies"] = $dependenciesOption;

					if($ADMIN_VIEW_TEMPLATE) {
						$fldValue = View::info($viewObj, $params, $options);
						//-- show this for "root" users only!
						if(IS_ROOT && !empty($fldValue)) {
							echo "<tr valign=\"top\"><td>openpasswordfield</td><td>".$fldValue."</td></tr>";
      			}
      		} else {
						//-- the fake field to change the password
						$inputOpenPasswordObj = $form->field($model, "openpasswordfield")
	    				->hint(false)
  	  			;
    				echo Form::input($inputOpenPasswordObj, "Text", $params, $options);
					}
    			//-- DO NOT use default type for the field
					$useDefaultType = false;
				}
    		
    		//-- extra field for type FILE
    		$inputSavedFileObj = null;
    		$inputRemoveFileObj = null;
    		$inputSavedFileValue = 0;
    		if($row->type === "File") {
					$fld = $row->field;
					if(!empty($model->$fld)) {
						$paramValue = (int)$model->$fld;
						if(!empty($paramValue)) {
							$inputSavedFileValue = $paramValue;
							$uploadsRow = Uploads::findOne($paramValue);
							if(!empty($uploadsRow->realname)) {
								//echo "<div class=\"form-group\">".$model->$fld."</div>";
								if($ADMIN_VIEW_TEMPLATE) {
									
								} else {
									$inputSavedFileObj = $form->field($model, $row->field."_saved_file")
    								->label($uploadsRow->path."/".$uploadsRow->realname, ["class" => "control-label small"])
	    							->hint(false)
  	  						;
  	  						$inputRemoveFileObj = $form->field($model, $row->field."_remove_file")
    								//->label()
	    							->hint(false)
  	  						;
  	  					}
  	  					$params["required"] = false;
  	  				}
						}
					}
				}
		
				//-- extra field for type UNIQID
    		$inputUniqIdLengthObj = null;
    		$inputUniqIdLengthValue = 0;
    		if($row->type === "UniqId") {
					$fld = $row->field;
					$paramValue = $row->value;
					$inputUniqIdLengthValue = $paramValue;
					$inputUniqIdLengthObj = $form->field($model, $row->field."_length")
    				->label(false)
	    			->hint(false)
  	  		;
  	  		$params["required"] = false;
				}
		
				//-- use default type for the field
				if($useDefaultType) {
    			$options["dependencies"] = $dependenciesOption;
					
					if($ADMIN_VIEW_TEMPLATE) {
						foreach($ADMIN_VIEW_PARAMS as $k => $v) {
							$params[$k] = $v;
						}
						foreach($ADMIN_VIEW_OPTIONS as $k => $v) {
							$options[$k] = $v;
						}
						$viewObj->row = $row;
						$fldValue = View::info($viewObj, $params, $options);
						if(!empty($fldValue)) {
							echo "<tr valign=\"top\"><td>".$row->label."</td><td>".$fldValue."</td></tr>";
      			}
      		} else {
						$inputObj = $form->field($model, $row->field)
    					->label($row->label)
    					->hint($row->description)
    				;
    				echo Form::input($inputObj, $row->type, $params, $options);
    			}
    		}
    		if(!$ADMIN_VIEW_TEMPLATE) {
    			if($row->type === "File" && !is_null($inputSavedFileObj)) {
    				$params = array();
    				$params["value"] = $inputSavedFileValue;
    				$params["class"] = "form-control small";
    				$options["dependencies"] = $dependenciesOption;
    				echo Form::input($inputSavedFileObj, "Hidden", $params, $options);
          
    				$params = array();
    				$params["value"] = 1;
    				$options["dependencies"] = $dependenciesOption;
    				echo Form::input($inputRemoveFileObj, "Checkbox", $params, $options);
    			}
        }
    		if($row->type === "UniqId" && !is_null($inputUniqIdLengthObj)) {
    			$params = array();
    			$params["value"] = $inputUniqIdLengthValue;
    			$options["dependencies"] = $dependenciesOption;
    			
    			if($ADMIN_VIEW_TEMPLATE) {
						$viewObj->row = $row;
						$fldValue = View::info($viewObj, $params, $options);
						if(!empty($fldValue)) {
							//echo "<tr valign=\"top\"><td>".$row->label."</td><td>".$fldValue."</td></tr>";
      			}
      		} else {
    				//echo Form::input($inputUniqIdLengthObj, "Text", $params, $options);
    				echo Form::input($inputUniqIdLengthObj, "Hidden", $params, $options);
    			}
    		}
    	}
    }
    if(!$ADMIN_VIEW_TEMPLATE) {
      ?>
      <div class="form-group">
      	<?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update' , [
          'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
      	])?>
      </div>
      <?
    }
    ActiveForm::end();

    if($ADMIN_VIEW_TEMPLATE) {
    	echo "</table>";
    }
  
  } //-- $showForm 
?>
</div>
