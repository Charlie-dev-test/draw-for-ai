<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\AdminAsset;

//$asset = \backend\assets\EmptyAsset::register($this);
$asset = AdminAsset::register($this);
$this->title = Yii::t('backend', 'Sign in');
?>
<div id="wrapper" class="row justify-content-center">
    <div class="col-lg-4 col-md-6 align-self-center text-center">
        <div class="panel">
            <div class="panel-heading text-center">
                <?= Yii::t('backend', 'Sign in') ?>
            </div>
            <div class="panel-body">
                <?php
                $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"
                            ]
                        ])
                ?>
                <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'placeholder' => Yii::t('backend', 'Username')]) ?>
                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => Yii::t('backend', 'Password')]) ?>
                <?= Html::submitButton(Yii::t('backend', 'Login'), ['class' => 'btn btn-lg btn-primary btn-block']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
