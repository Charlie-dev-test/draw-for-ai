<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Resources;
use backend\helpers\Form;

/**
 * Description of _form
 */

$globalModelsInc = realpath(__DIR__."/../")."/_globalmodels.php";
include($globalModelsInc);

?>

<div class="menu-form">
    <?
    $form = ActiveForm::begin([
    	"fieldConfig" => [
      	"template" => $globalFormTemplate,
      ]
    ]);

    echo $form->field($model, 'title')->textInput(['maxLength' => true, "required"=>true]);
    if($model->isNewRecord) {
    	echo $form->field($model, 'formid')->hiddenInput(['value' => $formIdParameter])->label(false);
    } else {
    	echo $form->field($model, 'formid')->hiddenInput(['value' => $model->formid])->label(false);
    }
    
    $inputObj = $form->field($model, 'value');
    echo Form::input($inputObj, "EditArea", []);
    /*
    echo $form->field($model, 'is_eval')->checkbox([
    	'checked' => !$model->is_eval ? false : true,
    	'value' => 1,
    ]);
    */
    ?>
    <div class="form-group">
      <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update' , [
          'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
      ])?>
    </div>
    <?php ActiveForm::end();?>
</div>
