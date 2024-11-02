<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Resources;
use backend\models\Resources\ResourcesForms;
use backend\helpers\Form;

//-- use AutoComplete to get the list of the columns
use yii\jui\AutoComplete;

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
    	echo $form->field($model, 'resourceid')->hiddenInput(['value' => $resourceIdParameter])->label(false);
    } else {
    	echo $form->field($model, 'resourceid')->hiddenInput(['value' => $model->resourceid])->label(false);
    }
    echo $form->field($model, 'label')->textInput(['maxLength' => true, "required"=>true]);
    echo $form->field($model, 'field')->widget(AutoComplete::className(),
    	[
    		'clientOptions' => [
    			'source' => $globalResourceModelFieldsAutocomplete,
    			'autoFill' => true,
    			'minLength' => '1',
    		],
    		'options' => [
    			'class' => 'form-control',
    			//'classes.ui-autocomplete' => 'base',
    			//'classes.ui-autocomplete' => 'mint-choc',
    		]
    	]);
    echo $form->field($model, 'type')->dropDownList(Resources::$typesList);
    echo $form->field($model, 'required')->checkbox([
    	'checked' => !$model->required ? false : true,
    	'value' => 1,
    ]);
    echo $form->field($model, 'value')->textInput();
    echo $form->field($model, 'description')->textarea(['rows' => '6']);
    /*
    echo $form->field($model, 'is_file')->checkbox([
    	'checked' => !$model->is_file ? false : true,
    	'value' => 1,
    ]);
    echo $form->field($model, 'only_for_root')->checkbox([
    	'checked' => !$model->only_for_root ? false : true,
    	'value' => 1,
    ]);
    */
    $inputObj = $form->field($model, 'show_check');
    echo Form::input($inputObj, "EditArea", []);
    
    echo $form->field($model, 'multiple_upload')->checkbox([
    	'checked' => !$model->multiple_upload ? false : true,
    	'value' => 1,
    ]);

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
