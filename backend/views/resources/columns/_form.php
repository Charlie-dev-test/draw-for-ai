<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Resources;
use backend\models\Resources\ResourcesColumns;
use backend\helpers\Form;

//-- use AutoComplete to get the list of the columns
use yii\jui\AutoComplete;
//use yii\web\JsExpression;

/**
 * Description of _form
 */

$globalModelsInc = realpath(__DIR__."/../")."/_globalmodels.php";
include($globalModelsInc);

$showForm = true;
if(count($globalResourceModelFields) === 0) {
	Yii::$app->session->addFlash("danger", "Не указана модель родительского ресурса!");
	$showForm = false;
}

$gridViewFilterTypes = ResourcesColumns::$gridViewFilterTypes;
asort($gridViewFilterTypes);
//-- add empty value (do not use any filters!)
$gridViewFilterTypes = array_merge(["" => "---"], $gridViewFilterTypes);
?>

<div class="menu-form">
  <?
  if($showForm) {
    $form = ActiveForm::begin([
    	"fieldConfig" => [
      	"template" => $globalFormTemplate,
      ]
    ]);

    if($model->isNewRecord) {
    	//echo "resourceId : ".$resourceIdParameter;
    	echo $form->field($model, 'resourceid')->hiddenInput(['value' => $resourceIdParameter])->label(false);
    } else {
    	//echo "resourceId : ".$model->resourceid;
    	echo $form->field($model, 'resourceid')->hiddenInput(['value' => $model->resourceid])->label(false);
    }
    echo $form->field($model, 'title')->textInput(["required"=>true]);
    echo $form->field($model, 'field')->widget(AutoComplete::className(),
    	[
    		'clientOptions' => [
    			'source' => $globalResourceModelFieldsAutocomplete,
    			'autoFill' => true,
    			'minLength' => '0',
    		],
    		'options' => [
    			'class' => 'form-control',
    		]
    	]);
    echo $form->field($model, 'width')->textInput();
    /*
    echo $form->field($model, 'visible')->checkbox([
    	'checked' => !$model->visible ? false : true,
    	'value' => 1,
    ]);
    */
    echo $form->field($model, 'sort_flag')->checkbox([
    	'checked' => !$model->sort_flag ? false : true,
    	'value' => 1,
    ]);
    echo $form->field($model, 'filter_flag')->checkbox([
    	'checked' => !$model->filter_flag ? false : true,
    	'value' => 1,
    ]);
    echo $form->field($model, 'filter_type')->dropDownList($gridViewFilterTypes);
    //$inputObj = $form->field($model, 'filter');
    echo Form::input($form->field($model, 'filter'), "EditArea", []);
    echo $form->field($model, 'escape')->checkbox([
    	'checked' => !$model->escape ? false : true,
    	'value' => 1,
    ]);
    //$inputObj = $form->field($model, 'eval');
    echo Form::input($form->field($model, 'eval'), "EditArea", []);
    /*
    echo $form->field($model, 'orderlink')->checkbox([
    	'checked' => !$model->orderlink ? false : true,
    	'value' => 1,
    ]);
    echo $form->field($model, 'template')->textInput();
    echo $form->field($model, 'filter_query')->textInput();
    echo $form->field($model, 'filter_items')->textarea(['rows' => '6']);
    echo $form->field($model, 'on_have_subcat')->checkbox([
    	'checked' => !$model->on_have_subcat ? false : true,
    	'value' => 1,
    ]);
    */
    echo $form->field($model, 'active')->checkbox([
    	'checked' => !$model->active ? false : true,
    	'value' => 1,
    ]);
    ?>
    <div class="form-group">
      <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update' , [
          'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
      ])?>
    </div>
    <?
    ActiveForm::end();
	}
	?>
</div>
