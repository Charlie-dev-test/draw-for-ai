<?php
  /*
    Отрисовываем добавление прав на привелегию , сначало даем выбрать роль , а далее выводил два полня. 
    Слева обозначены не назначеные привилегии , справа соответсвенно назначенные 
  */

  use yii\bootstrap\ActiveForm;
  use yii\widgets\Pjax;
  use yii\helpers\Html;
?>
<?php
  $form = ActiveForm::begin(['options' => ['data-form'=>true, 'data-pjax' => true, 'id'=>'w5','class'=>'form form-footer'], 'enableAjaxValidation' => false, 'enableClientValidation' => true, 'validateOnChange' => false, 'validateOnBlur' => false]);
?>
<?php if($model->success): ?>
  <h3>Связи были успешно добавлены</h3>
  <?= Html::a("<span >Вернуться</span>", ['role/index'], ['class' => 'btn btn-success btn-md']); ?>
<?php elseif($model->false): // На всякий случай если возникнет ошибка?>
    <h3>Что то пошло не так </h3>
<?php elseif($model->checked): ?>
<?= 
  $form->field($model, 'roledown')->dropDownList(array($check => $check),['id'=>'disabledSelect','options'=>[$check =>["selected"=>true]]])->label(false)->error(false);
?>
<?= $form->field($model, 'selectrole')->dropDownList($roleall,
                                         [
                                          'multiple'=>'multiple',
                                          'id'=>'rolelist',
                                          'options'=> $selectedvalue             
                                         ]             
                                        )->label("Выберите привилегии");?>

<?= $form->field($model, 'hiddenpool')->textInput(['placeholder' => 'rolename','style'=>'display:none;','value'=>'1'])->label(false)->error(false); ?>
<?= \yii\bootstrap\Html::submitButton('Отправить', ['class' => 'btn btn-success', 'text' => 'Отправить']); ?>
<script type="text/javascript">
  $(document).ready(function() {
      $('#rolelist').multiSelect();
  });
</script> 
<?php else:?>
  <?= $form->field($model, 'roledown')->dropDownList($rolevar)->label(false)->error(false); ?>
  <?= \yii\bootstrap\Html::submitButton('Отправить', ['class' => 'btn btn-success', 'text' => 'Отправить']); ?>
<?php endif?>
<?php ActiveForm::end(); ?>
