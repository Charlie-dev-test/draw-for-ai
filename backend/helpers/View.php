<?
namespace backend\helpers;

use backend\models\Files;
use backend\models\Uploads;


class View extends Form
{

	public static function info($viewObj, $params=[], $options=[])
	{
		$model = $viewObj->model;
		$row = $viewObj->row;
		
		$fld = $row->field;
		if(isset($params["value"])) {
			$fldValue = $params["value"];
		} else {
			$fldValue = $model->$fld;
			if(is_array($model->$fld)) {
				$fldValue = implode(", ", $model->$fld);
			}
		}
		$type = ucfirst(mb_strtolower($row->type, "utf-8"));
		
		switch($type) {
      case "Uniqid"://         => "UniqId",
      	return $fldValue;
			case "Text"://           => "Строка",
				return $fldValue;
      case "Autocomplete"://   => "Автодополнение",
      	return $fldValue;
      	$resourceModelFields = $params;
      	$resourceModelFieldsAutocomplete = [];
				foreach($resourceModelFields as $value => $label) {
					$resourceModelFieldsAutocomplete[] = [
						"value" => $value,
						"label" => $label." (".$value.")",
						//"id" => $label,
					];
				}
      	$autocompleteParams = [
    				'clientOptions' => [
		      		'source' => $resourceModelFieldsAutocomplete,
    					'autoFill' => true,
		      		'minLength' => '0',
		      	],
		      	'options' => [
		      		'class' => 'form-control',
		      	]
		      ];
      	return $viewObj->widget(AutoComplete::className(), $autocompleteParams);
      //case "Autocompleteid":// => "Автодополнение с выбором идентификатора",
      //	return $viewObj->textInput($params);
      case "Date"://           => "Дата",
      	$dateCond = (strlen($fldValue) === 10);
      	$dateTimeCond = (strlen($fldValue) === 19);
      	if($dateCond && $date = \DateTime::createFromFormat('Y-d-m', $fldValue)) {
    			return $date->format('d.m.Y');
    		} elseif($dateTimeCond && $date = \DateTime::createFromFormat('Y-d-m H:i:s', $fldValue)) {
    			return $date->format('d.m.Y H:i:s');
    		}
      	return $fldValue;
      case "Textarea"://       => "Текст",
      	return $fldValue;
      case "Mce"://            => "HTML редактор",
      	return $fldValue;
      case "File"://           => "Файл",
      	$files = new Files();
      	$uploads = new Uploads();
      	
      	//-- get pics from Files
      	$title = "";
      	$picsRow = $files->find()->where(["pics"=>$fldValue])->one();
      	if(!empty($picsRow->title)) {
      	  $title = $picsRow->title;
      	} else {
      		//-- try to find row in Uploads
      		$picsRow = $uploads->find()->where(["id"=>$fldValue])->one();
      		if(!empty($picsRow->name)) {
      	  	$title = $picsRow->name;
      		}
      	}
      	$picsData = $uploads->getFile($fldValue);
				$picsFileName = $picsData->getFullFileName();
				if(!empty($picsFileName)) {
					$url = "/".$picsFileName;
					$cls = "";
					if(isset($picsRow->active) && !$picsRow->active) {
						$cls = "inactive";
					}
					if(@is_array(getimagesize($picsFileName))){
    				return "<style>.inactive{border:3px solid red;}</style><a href=\"".$url."\" data-fancybox=\"admin_gallery\"><img class=\"".$cls."\" src=\"".$url."\" height=\"50\" title=\"".$title."\"/></a>";
					} else {
    				return $picsFileName;
					}
					
				}
      	return $fldValue;
      case "Select"://         => "Выпадающий список",
      	if(!empty($params[$fldValue])) {
      		$fldValue = $params[$fldValue];
      	}
      	return $fldValue;
      case "Radio"://          => "Радио-кнопка",
      	return $fldValue;
      case "Multiradio"://     => "МультиРадио-кнопка",
      	return $fldValue;
      case "Checkbox"://       => "Флажок",
      	return $fldValue;
      case "Multicheckbox"://  => "Мультифлажок",
      	return $fldValue;
      case "Editarea"://       => "Редактор кода",
      	return $fldValue;
      	$themes = [
      		CodemirrorAsset::THEME_COBALT,
      	];
      	/* !!! removed !!!
      	$_css = CodemirrorAsset::getCss();
      	foreach($_css as $k => $v) {
      		if(preg_match("{THEME_(.*)}si", $k, $matches)) {
      			$themes[] = $k;
      		}
      	}
      	*/
      	$assets = [
      		CodemirrorAsset::MODE_PHP,
	        CodemirrorAsset::MODE_CLIKE,
  	      CodemirrorAsset::MODE_CSS,
    	    CodemirrorAsset::MODE_JAVASCRIPT,
      	  CodemirrorAsset::MODE_HTMLEMBEDDED,
        	CodemirrorAsset::MODE_HTMLMIXED,
	        CodemirrorAsset::KEYMAP_EMACS,
  	      CodemirrorAsset::ADDON_EDIT_MATCHBRACKETS,
    	    CodemirrorAsset::ADDON_COMMENT,
      	  CodemirrorAsset::ADDON_DIALOG,
	        CodemirrorAsset::ADDON_SEARCHCURSOR,
  	      CodemirrorAsset::ADDON_SEARCH,
  	      //CodemirrorAsset::THEME_MIDNIGHT,
      	];
      	$assets = array_merge($assets, $themes);
      	
      	$defaultParams = [
    			'assets'=>$assets,
        	'settings'=>[
            //'theme' => '3024_day',
            //'theme' => '3024_night',
            //'theme' => 'abcdef',
            //'theme' => 'ambiance_mobile',
            //'theme' => 'ambiance',
            //'theme' => 'base16_dark',
            //'theme' => 'base16_light',
            //'theme' => 'blackboard',
            'theme' => 'cobalt', // !!!
            //'theme' => 'colorforth',
            //'theme' => 'dracula',
            //'theme' => 'eclipse',
            //'theme' => 'elegant',
            //'theme' => 'erlang_dark',
            //'theme' => 'icecoder',
            //'theme' => 'lesser_dark',
            //'theme' => 'liquibyte',
            //'theme' => 'mbo',
            //'theme' => 'mdn_like',
            //'theme' => 'midnight',
            //'theme' => 'monokai',
            //'theme' => 'neat',
            //'theme' => 'neo',
            //'theme' => 'night',
            //'theme' => 'paraiso_dark',
            //'theme' => 'paraiso_light',
            //'theme' => 'pastel_on_dark',
            //'theme' => 'rubyblue', //!!!
            //'theme' => 'seti',
            //'theme' => 'solarized',
            //'theme' => 'the_matrix',
            //'theme' => 'tomorrow_night_bright',
            //'theme' => 'tomorrow_night_eighties',
            //'theme' => 'ttcn',
            //'theme' => 'twilight',
            //'theme' => 'vibrant_ink',
            //'theme' => 'xq_dark',
            //'theme' => 'xq_light',
            //'theme' => 'yeti',
            //'theme' => 'zenburn',
            'lineNumbers' => true,
            'tabSize' => 2,
            'gutter' => true,
            'showCursorWhenSelecting' => true,
            'matchBrackets' => true,
            'undoDepth' => 1000,
            'smartIndent' => true,
            'indentWithTabs' => true,
            'electricChars' => true,
            //'mode' => 'text/x-csrc',
            //'mode' => 'text/x-php', 
            'mode' => "application/x-httpd-php-open",
            //'mode' => 'php', 
            //'keyMap' => 'emacs'
        	],
				];
      	$params = array_merge($defaultParams, $params);
      	return $viewObj->widget(CodemirrorWidget::className(), $params);
      case "Hidden"://         => "Скрытое поле",
      	return $fldValue;
      case "Password"://       => "Пароль",
      	return $fldValue;
      //case "Pointpicker"://    => "Выбор точки на картинке",
      //	return $viewObj->textInput($params);
		}
	}

}
