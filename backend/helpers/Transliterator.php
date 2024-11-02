<?
namespace backend\helpers;

use Yii;

class Transliterator
{
	public static $cyr_eng = array(
		"а" => "a",
		"б" => "b",
		"в" => "v",
		"г" => "g",
		"д" => "d",
		"е" => "e",
		"ё" => "yo",
		"ж" => "zh",
		"з" => "z",
		"и" => "i",
		"й" => "j",
		"к" => "k",
		"л" => "l",
		"м" => "m",
		"н" => "n",
		"о" => "o",
		"п" => "p",
		"р" => "r",
		"с" => "s",
		"т" => "t",
		"у" => "u",
		"ф" => "f",
		"х" => "h",
		"ц" => "ts",
		"ч" => "ch",
		"ш" => "sh",
		"щ" => "shch",
		"ъ" => "",
		"ы" => "y",
		"ь" => "",
		"э" => "e",
		"ю" => "yu",
		"я" => "ya",
		"А" => "A",
		"Б" => "B",
		"В" => "V",
		"Г" => "G",
		"Д" => "D",
		"Е" => "E",
		"Ё" => "Yo",
		"Ж" => "Zh",
		"З" => "Z",
		"И" => "I",
		"Й" => "J",
		"К" => "K",
		"Л" => "L",
		"М" => "M",
		"Н" => "N",
		"О" => "O",
		"П" => "P",
		"Р" => "R",
		"С" => "S",
		"Т" => "T",
		"У" => "U",
		"Ф" => "F",
		"Х" => "H",
		"Ц" => "Ts",
		"Ч" => "Ch",
		"Ш" => "Sh",
		"Щ" => "Shch",
		"Ъ" => "",
		"Ы" => "Y",
		"Ь" => "",
		"Э" => "E",
		"Ю" => "Yu",
		"Я" => "Ya",
		" " => "_",
		"-" => "_",
		"~" => "_",
		"!" => "_",
		"@" => "_",
		"#" => "_",
		"$" => "_",
		"%" => "_",
		"^" => "_",
		"&" => "_",
		"*" => "_",
		"(" => "_",
		")" => "_",
		"+" => "_",
		"=" => "_",
		"Ё" => "_",
		"№" => "_",
		";" => "_",
		":" => "_",
		"?" => "_",
		"{" => "_",
		"}" => "_",
		"[" => "_",
		"]" => "_",
		"\\" => "_",
		"\"" => "_",
		"|" => "_",
		"/" => "_"
	);

	public static $allow = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '-', '_');
	public static $dbEn = array(
		"а" =>    "a",
		"б" =>    "b",
		"в" =>    "v",
		"г" =>    "g",
		"д" =>    "d",
		"е" =>    "e",
		"ё" =>    "jo",
		"ж" =>    "zh",
		"з" =>    "z",
		"и" =>    "i",
		"й" =>    "j",
		"к" =>    "k",
		"л" =>    "l",
		"м" =>    "m",
		"н" =>    "n",
		"о" =>    "o",
		"п" =>    "p",
		"р" =>    "r",
		"с" =>    "s",
		"т	" =>    "t",
		"у" =>    "u",
		"ф" =>    "f",
		"х" =>    "h",
		"ц" =>    "c",
		"ч" =>    "ch",
		"ш" =>    "sh",
		"щ" =>    "shch",
		"ъ" =>    "'",
		"ы" =>    "y",
		"ь" =>    "",
		"э" =>    "e",
		"ю" =>    "yu",
		"я" =>    "ya",
		"А" =>    "a",
		"Б" =>    "b",
		"В" =>    "v",
		"Г" =>    "g",
		"Д" =>    "d",
		"Е" =>    "e",
		"Ё" =>    "jo",
		"Ж" =>    "zh",
		"З" =>    "z",
		"И" =>    "i",
		"Й" =>    "j",
		"К" =>    "k",
		"Л" =>    "l",
		"М" =>    "m",
		"Н" =>    "n",
		"О" =>    "o",
		"П" =>    "p",
		"Р" =>    "r",
		"С" =>    "s",
		"Т" =>    "t",
		"У" =>    "u",
		"Ф" =>    "f",
		"Х" =>    "h",
		"Ц" =>    "c",
		"Ч" =>    "ch",
		"Ш" =>    "sh",
		"Щ" =>    "shch",
		"Ъ" =>    "",
		"Ы" =>    "y",
		"Ь" =>    "",
		"Э" =>    "e",
		"Ю" =>    "yu",
		"Я" =>    "ya",
		" " => "-",
		"?" => "",
		"!" => "",
		"@" => "",
		"#" => "",
		"$" => "",
		"%" => "",
		"^" => "",
		"&" => "",
		"*" => "",
		"|" => "",
		"\\" => "",
		"/" => "",
		":" => "",
		";" => "",
		"    " => "-",
		"," => "",
		"." => "",
		"=" => "",
		"+" => "",
		"ї" => "yi",
		"Ї" => "yi",
		"?" => "i",
		"?" => "i",
		"є" => "e",
		">" => "",
		"<" => "",
		"'" => "",
		"-" => "",
		"--" => "",
		"]" => "-",
		"[" => "-",
		"'" => "",
		")" => "-",
		"(" => "-",
		"`" => "",
		"_" => "",
		"\"" => "",
		"----" => "-",
		"---" => "-",
		"--" => "-"
	);

	/**
	 * convert from Cyrillics to Translit
	 * @param string $str
	 * @return string
	 */
	public static function translateCyr($str)
	{
		return strtr($str, self::$cyr_eng);
	}

	/**
	 * convert from Cyrillics to Cache Translit
	 * @param string $method
	 * @return string
	 */
	public static function translateCacheCyr($str)
	{
		$str = self::translateCyr($str);
		//$str = strtr($str, self::$cyr_eng);

		$str = preg_replace("[^a-zA-Z0-9_]", "", $str);
		//$str = str_replace('__', '_', $str);
		$str = str_replace('.', '_', $str);

		return $str;
	}

	/**
	 * convert from Cyrillics to Google Translit
	 * @param string $str
	 * @return string
	 */
	public static function translitForGoogle($str)
	{
		$str = strtolower(self::translateCyr($str));

		$result = "";
		for($i=0;$i<strlen($str);$i++) {
		  $ch = $str[$i];
		  if(in_array($ch, self::$allow)) {
		  	$result .= $ch;
		  } else {
		  	//$result .= "_";
		  }
		}
		//$result = preg_replace("[^a-zA-Z0-9_\-]", "", $result);
		$result = str_replace('__', '_', $result);
		if(substr($result, 0, 1) == '_') {
			$result = substr($result, 1);
		}
		if(substr($result, strlen($result)-1, 1) == '_') {
			$result = substr($result, 0, strlen($result)-1);
		}

		return $result;
	}
	
}
