<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\User;
use backend\models\Files;
use backend\models\Uploads;
use backend\helpers\Form;
use backend\helpers\Funcs;

use yii\web\UploadedFile;


/**
 * Description of _form
 */

$globalFormTemplate = "{label}{input}<i><small><font color=\"brown\">{hint}</font></small></i>{error}";

$userModel = new User();
$model = new Files();

?>
<style>
.help-block-error {
  color: red;
}
</style>
<div class="menu-form">
  <?
  if($_POST && $_FILES) {
  	
  	//-- array for table "user"
  	$userPost = [];
  	$userPost["User"] = [
  	  "username" => "petya_vasechkin",
      "fullname" => "Петя Васечкин",
      "email" => "peter_vasya@super.com",
      "openpasswordfield" => "666777888",
      "role" => "user",
  	];
  	      
  	//-- array for tables "z_files" and "z_uploads"
  	$filesPost = [];
  	$filesPost["Files"] = [
  		"title" => "Петя Васечкин",
      "sid" => "frontend",
      "pics" => [
      	"0" => null
      ],
    ];
    
  	/*
  	@ob_start();
  	//print_r($_POST);
  	print_r($userPost);
  	echo "\n===========================================\n";
  	//print_r($_FILES);
  	print_r($filesPost);
  	$data = @ob_get_contents();
  	@ob_end_clean();
  	//-- /frontend/web/post-file.txt
  	file_put_contents("./post-file.txt", $data);
  	*/

  	//-- loading "User" data
  	$multipleUploadsFieldName = "pics";
  	$userModel->loadDefaultValues();
    if($userModel->load($userPost)) {
  	  if($userModel->save()) {
      	$userId = (int)$userModel->id;
      	Yii::$app->session->addFlash("success", "Юзер ".$userId." успешно сохранен");
        
        //-- loading "Files" data
        $model->loadDefaultValues();
        if($model->load($filesPost)) {
        	$picsFile = UploadedFile::getInstances($model, $multipleUploadsFieldName);
        	if(is_array($picsFile)) {
            foreach($picsFile as $file) {
            	if(isset($file->extension)) {
                if($picsId = (int)$model->saveImage($file, 0, 0, 0)) {
                  $model->$multipleUploadsFieldName = $picsId;
                  $model->id = $model->getMaxId('id') + 1;
                  $model->multipleUploads = true;
                  //-- must be set to TRUE for create a new record in the database
                  $model->isNewRecord = true;
                  $model->user_id = $userId;
                  if($model->save()) {
          					Yii::$app->session->addFlash("success", "Файл (".$multipleUploadsFieldName." -> $picsId) успешно сохранен");
          				} else {
          					Yii::$app->session->addFlash("danger", 'Ошибка сохранения файла (pics): '.$picsId);
          				}
                } else {
                  Yii::$app->session->addFlash("danger", 'Ошибка сохранения файла (pics): '.$picsId);
                }
              }
            }
          }
        }
      }
    }

  	echo "<br/>";
  	foreach(Yii::$app->session->getAllFlashes() as $key => $messages) {
    	foreach($messages as $msg) {
    		echo '<div class="alert alert-' . $key . '">' . $msg . '</div>';
    	}
    }

  } else {
  	$form = ActiveForm::begin([
      "options" => [
				"id" => "upload-image-form",
				"enctype" => "multipart/form-data",
      ],
      "enableAjaxValidation" => false,
      "enableClientValidation" => true,
      "fieldConfig" => [
      	"template" => $globalFormTemplate,
      ]
		]);
  
  	?>
    <div class="form-group">
      <?
      echo $form->field($userModel, "username")->textInput(['value' => 'vasya_pupkin', 'required' => true])->label("Имя")->hint(false);
      echo $form->field($userModel, "fullname")->textInput(['value' => 'Вася Пупкин', 'required' => true])->label("Полное имя")->hint(false);
      echo $form->field($userModel, "email")->textInput(['value' => 'vasya_pupkin@pupkin.com', 'required' => true])->label("Email")->hint(false);
      echo $form->field($userModel, "openpasswordfield")->passwordInput(['value' => '1234567890', 'required' => true])->label("Пароль (1234567890)")->hint(false);
      echo $form->field($userModel, "role")->hiddenInput(['value' => 'user'])->label(false)->hint(false);
      echo "<hr/>";
      echo $form->field($model, "title")->textInput(['value' => 'test', 'required' => true])->label("Название файла")->hint(false);
			echo $form->field($model, "sid")->hiddenInput(['value' => 'frontend'])->label(false)->hint(false);
			echo $form->field($model, "pics[]")->fileInput(['multiple' => true,'required' => true])->label("Файл 1")->hint(false);
	      
      echo Html::submitButton('Create' , ['class' => 'btn btn-success']);
      ?>
    </div>
    <?
    ActiveForm::end();
  }
  
?>
</div>
