<?php

/* @var $this yii\web\View */
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = 'Пользователи';
?>
<div class="site-index">

<style type="text/css">
  .space{
    margin-right: 15px; 
  }


</style>
<? 
        if(\Yii::$app->user->can('adduser'))
        {
            echo Html::a("Добавление нового пользователя",'#myModal', ['class' => 'btn btn-sm btn-primary space','data-toggle' => 'modal']);
            echo Html::a("Refresh", ['site/user'], ['class' => 'btn btn-sm btn-primary']);
        }
?>


    <?php Pjax::begin(); ?>
    <div class="body-content">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>name</th>
            <th>login</th>
            <th>email</th>
            <th>role</th>
          </tr>
        </thead>
      <tbody>
<?php 
        if($model){
            $i = 1;
            foreach ($model as $m){     
                if ($m->status != 10){
                    $class = 'danger'; // Не активный
                }else {
                    $class = '';
                }
                echo "
                  <tr class=".$class.">
                    <td>".$i."</td>
                    <td>".$m->fullname."</td>
                    <td>".$m->username."</td>
                    <td>".$m->email."</td>
                    <td>".$m->item_name."</td>
                  </tr>
                ";
                $i++;
            }
        }
?>
      </tbody>
    </table>
  </div>
<?php Pjax::end(); ?>
<!-- HTML-код модального окна -->
<div id="myModal" class="modal fade">
<?
  if(\Yii::$app->user->can('adduser'))
    {
      echo \backend\widgets\Formuser::widget(); 
    }
  else
    {
      echo "недостаточно прав";
    }
?>
</div>
 
<!-- Скрипт, вызывающий модальное окно после загрузки страницы -->
<script>
  $(document).ready(function() {
    $('#pay-button').click(function () {        
        $.ajax({
            type: "POST",
            url: "/backend/web/index.php?r=site/ajaxuser",
            data: {
                //test:'test',
                fullname : $('[name="fullname-user"]').val(),
                username   : $('[name="username-user"]').val(),
                password: $('[name="password-user"]').val(),
                email: $('[name="email-user"]').val(),
            },
            success: function (data) {
                if(data == 1){
                    $("#myModal").hide();
                    $("div.modal-backdrop").detach();
                //    $('#pay-form')[0].reset();
                }else{
                    alert(data);
                }
            },
            error: function (exception) {
                alert('exception');
            }
        });
    });
  });
</script>
</div>

