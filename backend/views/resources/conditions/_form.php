<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Resources;

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

    echo $form->field($model, 'condition')->textInput(['maxLength' => true, "required"=>true]);
    echo $form->field($model, 'value')->textInput(['maxLength' => true, "required"=>true]);
    if($model->isNewRecord) {
    	echo $form->field($model, 'resourceid')->hiddenInput(['value' => $resourceIdParameter])->label(false);
    } else {
    	echo $form->field($model, 'resourceid')->hiddenInput(['value' => $model->resourceid])->label(false);
    }
    ?>
    <div class="form-group">
      <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update' , [
          'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
      ])?>
    </div>
    <?php ActiveForm::end();?>
</div>

