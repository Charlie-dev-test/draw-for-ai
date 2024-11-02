<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Resources;

/**
 * Description of _form
 */

$commonPath = Yii::getAlias('@backend')."/views/resources/";
include($commonPath."_globalmodels.php");

$resourcePairsData = Resources::getRecursivePairs(Resources::getResourcesTree());

$resourcePairs = array();
$resourcePairs[0] = "Корень";
$insertCode = "-";
foreach($resourcePairsData as $node) {
	$id = (int)$node["id"];
	$level = $node["level"];
	$title = $node["title"];

	/*
	//-- skip (ID cannot be equal to PARENTID)
	if($id === $mainIdParameter) {
		continue;
	}
	*/
	$space = ($level === 0) ? "" : " ";
	$resourcePairs[$id] = str_repeat($insertCode, $level).$space.$title;
}

?>
<script>
function switchMenuIconsExamples()
{
	var listIconRow = $('form .list_icon_row');
	var status = listIconRow.css('display');
	var display = (status === 'none') ? 'flex' : 'none';
	listIconRow.css('display', display);
	return false;
}
</script>
<style>
form .list_icon_span {
	text-decoration: none;
	font-weight: normal;
}
form .list_icon_item {
	padding: 1px;
}
form .list_icon_item i {
	padding: 5px;
	border: 1px solid #1d212a;
	background-color: #eee;
}
form .list_icon_item span {
	font-family: 'Open Sans';
	font-size: 12px;
}
form .list_icon_row {
	padding: 1px;
	background-color: #fff;
	color: #1d212a;
	display: none;
}
form .list_icon_link {
	cursor: pointer;
	font-weight: bold;
	text-decoration: underline;
}
</style>
<div class="menu-form">
    <?
    $form = ActiveForm::begin([
    	"fieldConfig" => [
      	"template" => $globalFormTemplate,
      ]
    ]);
    
    echo $form->field($model, 'title')->textInput(['maxLength' => true, "required"=>true]);
    echo $form->field($model, 'direct_link')->checkbox([
    	'checked' => !$model->direct_link ? false : true,
    	'value' => 1,
    ]);
    echo $form->field($model, 'resourceid')->textInput(['maxLength' => true, "required"=>true]);
    echo $form->field($model, 'actionid')->hiddenInput()->label(false);
    if($mainIdParameter > 0) {
    	echo $form->field($model, 'parentid')->dropDownList($resourcePairs);
    }
    echo $form->field($model, 'visible')->checkbox([
    	'checked' => !$model->visible ? false : true,
    	'value' => 1,
    ]);
    //+++ on_have_subcat
    echo $form->field($model, 'model')->dropDownList($modelesList);
    $attrs = $model->attributeLabels();
    echo $form->field($model, 'menu_icon')->dropDownList($menuIconsList/*, ['options'=>$menuIconsListOptions]*/);
    ?>
    <div class="row w-100 no-gutters list_icon_link" onclick="return switchMenuIconsExamples();"><?=$attrs['menu_icon']?>: кликнуть для показа списка вариантов!</div>
    <div class="row w-100 no-gutters list_icon_row">
	    <?
  	  foreach($fontAwesomeIcons as $icon => $name) {
	    	?>
  	  	<div class="col-auto list_icon_item">
	    		<i class="fa fa-<?=$name?>"><span class="list_icon_span"><?=$name?></span></i><br/>
  	  	</div>
	    	<?
  	  }
	    ?>
    </div>
    <div class="row w-100 no-gutters">&nbsp;</div>
    <?
    echo $form->field($model, 'datatype')->dropDownList(Resources::$dataTypesList);
    //echo $form->field($model, 'default_field')->textInput();
    echo $form->field($model, 'parent_field')->textInput()/*->hint(true)*/;
    //echo $form->field($model, 'indexate')->textInput();
    echo $form->field($model, 'order')->textInput();
    //echo $form->field($model, 'group')->textInput();
    echo $form->field($model, 'paginate')->textInput();
    //+++ can_delete
    //+++ can_edit
    //+++ can_add
    //+++ delete_confirm
    //+++ delete_on_have_child
    //+++ sortable
    echo $form->field($model, 'sortable_position')->hiddenInput(['value' => 'bottom'])->label(false)->hint(false);
    //+++ ??? new_parent_id ???

    ?>

    <div class="form-group">
      <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update' , [
          'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
      ])?>
    </div>
    <?
    ActiveForm::end();
    ?>
</div>
