<?

use yii\helpers\Url;
use backend\helpers\Form;
use backend\models\Resources;
use backend\models\Resources\ResourcesForms;
use backend\models\AbstractModel;

/**
 *
 * Use multiple upload
 * demo: https://demos.krajee.com/widget-details/fileinput
 *
 */
use yii\bootstrap4\Modal;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;

$fileUploadModel = null;
$fileUploadField = null;
$fileUploadFieldName = null;
foreach($rowsForms as $frmId => $frms) {
	
	if($frms->active && $frms->type === "File" && $frms->multiple_upload) {
		if(!empty($fileUploadModel) && !empty($fileUploadField)) {
			$rf = new ResourcesForms();
			$resourcesFormsAttrs = $rf->attributeLabels();
			$s  = "<b>Пакетная загрузка файлов возможна только для одного поля типа File!</b>";
			$s .= "<br/>Использовано первое из списка всех отмеченных: \"<b>".$fileUploadFieldName."</b>\" - остальные поля будут проигнорированы!";
			if(!empty($resourcesFormsAttrs["multiple_upload"])) {
				$s .= "<br><i>Снимите флажок \"".$resourcesFormsAttrs["multiple_upload"]."\" для все прочих полей формы, оставив только одно!</i>";
			}
			Yii::$app->session->addFlash("warning", $s);
			break;
		}
		
		$resModel = Resources::getResourceById($frms->resourceid);
		if(!empty($resModel->model)) {
			$fileUploadModel = AbstractModel::initModel($resModel->model);
			if(!is_null($fileUploadModel)) {
				$fileUploadField = $frms->field;
				$fileUploadFieldName =$frms->label; 
			}
		}
	}
}
?>
<style>
.modal-dialog,
.modal-content {
    /* 80% of window height */
    height: 80%;
}
@media (min-width: 992px) {
  .modal-dialog {
    max-width: 80% !important;
  }
}
.modal-body {
    /* 100% = dialog height, 120px = header + footer */
    /*max-height: calc(100% - 20px);*/
    overflow-y: scroll;
    overflow-y: auto;
}
</style>
<?
if(!empty($fileUploadModel) && !empty($fileUploadField)) {

	Modal::begin([
    'title' => 'Пакетная загрузка файлов',
    'toggleButton' => [
      'label' => 'Пакетная загрузка файлов',
      'class' => 'btn btn-success btn-block',
      'style' => 'width:auto;',
    ],
	]);

	$formMultipleUpload = ActiveForm::begin([
    "options" => [
			"id" => "upload-images-form",
			"enctype" => "multipart/form-data",
    ],
    "enableAjaxValidation" => false,
    "enableClientValidation" => true,
    /*
    "fieldConfig" => [
    	"template" => $globalFormTemplate,
    ],
    */
	]);

	//-- set CONDITIONS as Hidden
  foreach($rowsConditions as $row) {
  	if(!empty($row->condition) && !empty($row->value)) {
  		$params = array();
  		//$params["required"] = true;
  		$params["value"] = $row->value;
  		$inputObj = $formMultipleUpload->field($fileUploadModel, $row->condition)
  			->label(false)
  			->hint(false)
  		;
  		echo Form::input($inputObj, "Hidden", $params);
  	}
  }

  //-- set PARENTID as Hidden
  if(!empty($parentIdParameter) && !empty($sectionNameParameter)) {
  	$res = Resources::getResourceByResourceName($sectionNameParameter);
		if(!empty($res->parent_field)) {
			$params = array();
			$params["required"] = true;
  		$params["value"] = $parentIdParameter;
			$inputObj = $formMultipleUpload->field($fileUploadModel, $res->parent_field)
  			->label(false)
  			->hint(false)
  		;
  		echo Form::input($inputObj, "Hidden", $params);
		}
  }

  //-- set Multiple Uploads flag as Hidden
	echo $formMultipleUpload->field($fileUploadModel, 'multiple_uploads_field')
		->hiddenInput(['value' => $fileUploadField])
		->label(false)
		->hint(false);
	

	echo $formMultipleUpload->field($fileUploadModel, $fileUploadField.'[]')->widget(
		FileInput::classname(),
		[
      'name' => $fileUploadField.'[]',
      'resizeImages' => true,
      'language' => 'ru',
      'options' => [
      	'multiple' => true,
      	//'accept' => 'image/*'
      ],
      'pluginOptions' => [
      	'previewFileType' => 'any',
      	//'uploadUrl' => Url::to(['/adm/upload']),
      	//'uploadExtraData' => [
        //  'params' => $globalExtraParams,
        //  'model' => get_class($fileUploadModel),
        //  'field' => $fileUploadField,
        //],
        //'maxFileCount' => 10,
        //'maxFileSize' => 2800,
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => true,
        //'browseLabel' => '',
        //'removeLabel' => '',
        //'mainClass' => 'input-group-lg',
        
        //'browseClass' => 'btn btn-success',
        //'uploadClass' => 'btn btn-info',
        //'removeClass' => 'btn btn-danger',
        //'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',

        /*
        //-- preview existing files
        'initialPreview'=> Yii::getAlias("@web/data/storage/0kth9rob/sergey_n_bandana.jpg"),
        'initialPreviewAsData'=>true,
        'overwriteInitial'=>true,
        'showUpload' =>false,
        'allowedFileExtensions'=>['jpg', 'png'],
        */

      ],
		]
	);
	
	$isActive = AbstractModel::chkAttributes($fileUploadModel, "active", false);
	if($isActive) {
		echo $formMultipleUpload->field($fileUploadModel, 'active')->checkbox([
  		'checked' => !$fileUploadModel->active ? false : true,
  		'value' => 1,
  	]);
  }

	ActiveForm::end();
	Modal::end();
}
