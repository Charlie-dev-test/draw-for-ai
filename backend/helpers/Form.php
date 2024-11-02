<?
namespace backend\helpers;

use Yii;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use backend\widgets\Redactor;
use trntv\aceeditor\AceEditor;
use yii\jui\AutoComplete;
use conquer\codemirror\CodemirrorWidget;
use conquer\codemirror\CodemirrorAsset;

class Form
{
	/**
   * Callback for escaping.
   *
   * @var string
   */
  private static $_escape = 'htmlspecialchars';

  private static $_token_length = 8;
  
  /**
   * Encoding to use in escaping mechanisms; defaults to utf-8
   * @var string
   */
  private static $_encoding = 'utf-8';

	public static function input($inputObj, $type="Text", $params=array(), $options=array())
	{
		$div1 = "";
		$div2 = "";
		if(!empty($options["dependencies"])) {
			$div1 = "<div class=\"".$options["dependencies"]."\">";
			$div2 = "</div>";
			if(!empty($inputObj->options["class"])) {
				$inputObj->options["class"] .= " ".$options["dependencies"];
			} else {
				$inputObj->options["class"] = $options["dependencies"];
			}
			unset($options["dependencies"]);
		}
		$type = ucfirst(mb_strtolower($type, "utf-8"));
		switch($type) {
			case "Text"://           => "Строка",
				return $inputObj->textInput($params);
      case "Autocomplete"://   => "Автодополнение",
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
      	return $inputObj->widget(AutoComplete::className(), $autocompleteParams);
      //case "Autocompleteid":// => "Автодополнение с выбором идентификатора",
      //	return $inputObj->textInput($params);
      case "Date"://           => "Дата",
      	return $inputObj->widget(\yii\jui\DatePicker::className(),
          [ 'dateFormat' => 'php:Y-m-d',
            'clientOptions' => [
              'changeYear' => true,
              'changeMonth' => true,
              'yearRange' => '-100:-0',
              'altFormat' => 'yyyy-mm-dd',
            ]],['placeholder' => 'yyyy-mm-dd'])
          ->textInput(['placeholder' => \Yii::t('app', 'yyyy-mm-dd')]);
      case "Textarea"://       => "Текст",
      	return $inputObj->textarea(['rows' => 6])->textArea($params);
      case "Mce"://            => "HTML редактор",
      	/*
      	$defaultParams = [
    			'options' => [
        		'minHeight' => 400,
        		'imageUpload' => Url::to(['/redactor/upload', 'dir' => 'pages']),
        		'fileUpload' => Url::to(['/redactor/upload', 'dir' => 'pages']),
        		'plugins' => ['fullscreen']
    			]
				];
				return $inputObj->textarea(['rows' => 16])->widget(Redactor::className(), $params);
      	
      	
      	$defaultParams = [
          'mode'=>'php', // programing language mode. Default "html"
          //'theme'=>'github', // editor theme. Default "github"
          'theme'=>'chrome', // editor theme. Default "github"
          'readOnly'=>'false' // Read-only mode on/off = true/false. Default "false"
        ];
      	$params = array_merge($defaultParams, $params);
      	return $inputObj->widget(AceEditor::className(), $params);
      	*/
      	
      	$defaultParams = [
        	//'preset' => 'standart',
        	'preset' => 'full',
	        'clientOptions' => [
            //'customConfig' => '/ckeditor/config.js',
        	]
        ];
        $params = array_merge($defaultParams, $params);
        if(!empty($params["required"])) {
        	unset($params["required"]);
        }
      	return $inputObj->widget(CKEditor::className(), $params);
      case "File"://           => "Файл",
      	//$config = Yii::$app->params["FILEINPUT_CONFIG"];
    		//return $inputObj->widget(FileInput::classname(), $config)->label(false);
      	$params['class'] = 'form-control';
      	return $inputObj->fileInput($params);
      case "Select"://         => "Выпадающий список",
      	//$options = ['options'=>['3'=>['Selected'=>true]]];
      	//return $inputObj->dropDownList($params, ["options" => $options]);
      	return $inputObj->dropDownList($params, $options);
      case "Radio"://          => "Радио-кнопка",
      	return $inputObj->radio($params);
      case "Multiradio"://     => "МультиРадио-кнопка",
      	return $inputObj->radioList($params);
      case "Checkbox"://       => "Флажок",
      	return $inputObj->checkbox($params, $options);
      case "Multicheckbox"://  => "Мультифлажок",
      	return $inputObj->checkboxList($params, ['itemOptions' => $options]);
      case "Editarea"://       => "Редактор кода",
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
      	return $inputObj->widget(CodemirrorWidget::className(), $params);
      	/*
      	$defaultParams = [
    			'options' => [
        		'minHeight' => 400,
        		'imageUpload' => Url::to(['/redactor/upload', 'dir' => 'pages']),
        		'fileUpload' => Url::to(['/redactor/upload', 'dir' => 'pages']),
        		'plugins' => ['fullscreen']
    			]
				];
				return $inputObj->textarea(['rows' => 6])->widget(Redactor::className(), $params);
				*/
				$defaultParams = [
          'mode'=>'php', // programing language mode. Default "html"
          //'theme'=>'github', // editor theme. Default "github"
          'theme'=>'chrome', // editor theme. Default "github"
          'readOnly'=>'false' // Read-only mode on/off = true/false. Default "false"
        ];
      	$params = array_merge($defaultParams, $params);
      	return $inputObj->widget(AceEditor::className(), $params);
      case "Hidden"://         => "Скрытое поле",
      	return $inputObj->hiddenInput($params)->label(false);
      case "Uniqid"://         => "UniqId",
      	return $inputObj->hiddenInput($params)->label(false);
      case "Password"://       => "Пароль",
      	return $inputObj->passwordInput($params);
      //case "Pointpicker"://    => "Выбор точки на картинке",
      //	return $inputObj->textInput($params);
		}
	}

	/**
   * Escapes a value for output in a view script.
   *
   * If escaping mechanism is one of htmlspecialchars or htmlentities, uses
   * {@link $_encoding} setting.
   *
   * @param mixed $var The output to escape.
   * @return mixed The escaped value.
   */
  public static function escape($var)
  {
    if(in_array(self::$_escape, array('htmlspecialchars', 'htmlentities'))) {
      return call_user_func(self::$_escape, $var, ENT_COMPAT, self::$_encoding);
    }
    if(1 == func_num_args()) {
      return call_user_func(self::$_escape, $var);
    }
    $args = func_get_args();
    return call_user_func_array(self::$_escape, $args);
  }

	private static function cryptoRandSecure($min, $max)
	{
    $range = $max - $min;
    if($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
      $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
      $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
	}

	public static function getToken($length)
	{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    $length = (int)$length;
    if($length === 0) {
    	$length = self::$_token_length;
    }

    for($i=0; $i < $length; $i++) {
      $token .= $codeAlphabet[self::cryptoRandSecure(0, $max-1)];
    }

    return $token;
	}
	
}
