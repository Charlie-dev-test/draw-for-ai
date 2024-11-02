<?php

use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['id' => 'form_pjax', 'enableReplaceState' => false, 'enablePushState' => false, 'linkSelector' => false]) ?>
<?php
$form = ActiveForm::begin(['options' => ['data-form' => true, 'data-pjax' => true, 'id' => 'w2', 'class' => 'form form-footer'], 'enableAjaxValidation' => false, 'enableClientValidation' => true, 'validateOnChange' => false, 'validateOnBlur' => false]);
?>
<?php
//Создаем переменные для селекта
$type = array(
    'addpriv' => 'Добавить разрешение',
    'addrole' => 'Добавить роль'
);
// $model->false = false;
?>
<?php if ($model->success === true): ?>
    <script type="text/javascript">

        $("#reload_tab_role").click(function () {
            $.pjax.reload({container: '#form_pjax', async: false});
        });

    </script>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Выполнено</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Атрибут "<?php echo $model['add']; ?>" был добавлен</p>
            </div>
            <button id="reload_tab_role" type="button" class="btn btn-primary">Продолжить</button>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
<?php elseif ($model->false === true): ?>
    <script type="text/javascript">
        $("#reload_tab_role").click(function () {
            $.pjax.reload({container: '#form_pjax', async: false});
        });
    </script>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ошибка!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p><? echo $model->test['message'] ?></p>
            </div>
            <button id="reload_tab_role" type="button" class="btn btn-primary">Попробовать ещё</button>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавление роли</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group-1 div-focus-error">
                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'rolename'])->label('Название роли:')->error(false); ?>
                </div>
                <div class="form-group-1 div-focus-error">
                    <?= $form->field($model, 'desc')->textInput(['placeholder' => 'roledesc'])->label('Краткое описание:')->error(false); ?>
                </div>
                <div class="form-group-1">
                    <?= $form->field($model, 'typeform')->dropDownList($type)->label(false)->error(false); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= \yii\bootstrap\Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'text' => 'Отправить']); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>