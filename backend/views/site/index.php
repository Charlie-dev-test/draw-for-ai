<?php

use backend\helpers\Funcs;

$this->title = "CompleteCMS";
?>

<div class="site-index">
	<?
	$webDateTime = "1.0";
	$webPath = \Yii::getAlias('@backend')."/web";
	if(file_exists($webPath)) {
		$mt = filemtime($webPath);
		$tmpDT = date("Y-m-d H:i:s", $mt);
		if(strtotime($tmpDT) !== false) {
			$webDateTime = str_replace(["-"," ",":"], [".",".",""], $tmpDT);
		}
	}
	?>
	<b>CompleteCMS <?=$webDateTime?></b> (построена на Yii <?=Yii::getVersion()?>, PHP <?=phpversion()?>)<br/>
	<?
	$extraStr = "";
	if(IS_ROOT) {
		if(!empty(Yii::$app->components["db"]["dsn"])) {
			$values = Yii::$app->components["db"]["dsn"];
			if(preg_match("{mysql\:host\=(.*?)\;(|port\=(.*?);)dbname=(.*)}si", $values, $matched)) {
				$hostName = $matched[1];
				$portNum = $matched[3];
				$strPortNum = !empty($portNum) ? "<br/>Порт: <b><i>".$portNum."</i></b>" : "";
				$dbName = $matched[4];
				$ip = Funcs::getRealIP();
				echo "<hr/>Хост: <b><i>".$hostName." (".$ip.")</i></b>".$strPortNum."<br/>База данных: <b><i>".$dbName."</i></b><hr/>";
			}
		}
		$extraStr .= " и ресурсами CMS";
	}
	?>
	<br/>Для управления сайтом<?=$extraStr?> воспользуйтесь меню в левой части страницы.
</div>
