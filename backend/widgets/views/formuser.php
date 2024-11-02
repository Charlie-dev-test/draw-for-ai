<?php
    /*
        Форма добавления пользователя и назначение меу роли из списка , получаемого из бд

    */
    use yii\bootstrap\ActiveForm;
    use yii\widgets\Pjax;
?>
<?php
    Pjax::begin(['id' => 'form_pjax', 'enableReplaceState' => false, 'enablePushState' => false, 'linkSelector' => false]) ?>
<?php
    $form = ActiveForm::begin(['options' => ['data-form'=>true, 'data-pjax' => true, 'id'=>'w2','class'=>'form form-footer'], 'enableAjaxValidation' => false, 'enableClientValidation' => true, 'validateOnChange' => false, 'validateOnBlur' => false]);
?>
<?php if($model->success): ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Добавление нового пользователя</h4>
            </div>
            <h3>Пользователь <?php echo $model->login; ?> успешно добавлен</h3>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
<?php elseif($model->false): ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Добавление нового пользователя</h4>
            </div>
            <h3>Что то пошло не так: <br> <span style="color:red;"><? echo $model->mess; ?></span></h3>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Добавление нового пользователя</h4>
            </div>

            <div class="modal-body" style="height: 300px;">
                <!-- Пока пусть тут находится , потом перенести в общий стайл какой то -->
                <style>
                    .col-xs-5 .form-group{
                        height: 42px;
                    }

                    .form-user-list li{
                        list-style: none;
                        height: 34px;
                        margin-bottom: 15px;
                        text-align: right;
                    }
                </style>
                <div class = "col-xs-12">
                    <div class="col-xs-4" style="padding: 0px;">
                        <ul class="form-user-list">
                            <li>Логин </li>
                            <li>Имя пользователя</li>
                            <li>Роль</li>
                            <li>Email</li>
                            <li>Password</li>
                        </ul>
                    </div>
                    <div class="col-xs-8">
                        <div class="form-group-1 div-focus-error">
                            <?= $form->field($model, 'login')->textInput(['placeholder' => 'login'])->label(false)->error(false); ?>
                        </div>
                        <div class="form-group-1 div-focus-error">
                            <?= $form->field($model, 'username')->textInput(['placeholder' => 'username'])->label(false)->error(false); ?>
                        </div>
                        <div class="form-group-1">
                            <?= $form->field($model, 'role')->dropDownList($rolelist)->label(false)->error(false);?>
                        </div>
                        <div class="form-group-1">
                            <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-MAIL'])->label(false)->error(false); ?>
                        </div>
                        <div class="form-group-1 div-focus-error">
                            <?= $form->field($model, 'password')->textInput(['placeholder' => 'Password'])->label(false)->error(false); ?>
                        </div>
                    </div>
                </div>
                <div class = "col-xs-12">
                    <div class="col-xs-4">     
                    </div>
                     <div class="col-xs-8">
                        <?= \yii\bootstrap\Html::submitButton('Отправить', ['class' => 'btn', 'text' => 'Отправить']); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>