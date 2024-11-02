<?

use backend\helpers\Funcs;
use backend\models\Files;
use backend\models\Uploads;

/***
 * 
 * GET WRONG FOLDER IN THE STORAGE
 * 
 */

define("REALLY_REMOVE_ALL_WRONG_FOLDERS", 0);


@set_time_limit(0);
error_reporting(0);
ini_set("display_errors", 0);

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

include("_globalview.php");

$remove = "";
if(!empty($_GET["remove"])) {
	$remove = $_GET["remove"];
}
if(!REALLY_REMOVE_ALL_WRONG_FOLDERS) {
	$remove = "";
}


$dataPath   = "/web/data/storage/";
$dataFolder = Yii::getAlias('@backend').$dataPath;

$funcs = new Funcs();

?>
<style>
html, body {
	font-family: Courier New, Courier;
	font-size: 16px;
}
b {
	font-size: 18px;
}
</style>
<?

$picsUploaded = Uploads::find()->all();
echo "Файлов в базе данных: <b>".count($picsUploaded)."</b><br/>";
$idx = 0;
$uploadsList = array();
foreach($picsUploaded as $upload) {
	$path = $upload["path"];
	$picsUploaded = Uploads::find()->all();
	$id = $upload["id"];
	$picRows = Files::find()
		->where(["pics"=>$id])
		->all()
	;
	$foundInParent = false;
	foreach($picRows as $picRow) {
		if($picRow->pics == $id) {
			$foundInParent = true;
		}
	}
	//if($foundInParent) {
		$uploadsList[] = $path;
	//}
}

natcasesort($uploadsList);
$idx = 0;
foreach($uploadsList as $path) {
	$fld = $dataFolder.$path;
	if(!file_exists($fld)) {
		?>
		<font color="red"><?=($idx+1)?>) ПАПКА <b><?=$path?></b> НЕ НАЙДЕНА!</font><br/>
		<?
		$idx++;
	}
}

if($idx > 0) {
	?>
	<hr/><font color="red">ПАПОК НЕ НАЙДЕНО: <b><?=$idx?></b></font><br/>
	<?
} else {
	?>
	<font color="#0c0"><b>НЕТ ПРОБЛЕМ С ПАПКАМИ В ХРАНИЛИЩЕ!</b></font><br/>
	<?
}
 
echo "<br/>";

$folders = $funcs->getFolderTree($dataFolder, array(), "D");
echo "Папок в хранилище: <b>".count($folders)."</b><br/>";
$idx = 0;
foreach($folders as $fld) {
	$fld = substr($fld, strlen($dataFolder));
	if(!in_array($fld, $uploadsList)) {
		?>
		<font color="black">ПАПКА <b><?=$fld?></b> НЕ НАЙДЕНА В БАЗЕ ДАННЫХ!</font>
		<?
		$idx++;
		if(!empty($remove) && $remove === "yes") {
			echo "удаление: ".$dataFolder.$fld;
			$funcs->deleteNotEmptyDir($dataFolder.$fld);
			$funcs->deleteEmptyDir($dataFolder.$fld);
			echo " ... <b>УДАЛЕНА!</b>";
		}
		?>
		<br/>
		<?
	}
}
if($idx > 0) {
	?>
	<hr/><font color="black">В БАЗЕ ДАННЫХ НЕ НАЙДЕНО ПАПОК: <b><?=$idx?></b>!</font><br/>
	<?
	/*
	if(!isset($remove) || $remove === "" || $remove !== "yes") {
		echo "WOULD YOU LIKE TO REMOVE THE WRONG STORAGES? So, press <a href=\"?remove=yes\">here</a>...<br/>";
		echo "Parameter <b>REALLY_REMOVE_ALL_WRONG_FOLDERS</b> is ";
		echo REALLY_REMOVE_ALL_WRONG_FOLDERS ? "<b><font color=\"#0c0\">ON!</font></b><br/>" : "<b><font color=\"red\">OFF!</font></b><br/>";
	}
	*/
} else {
	?>
	<font color="#0c0"><b>НЕТ ПРОБЛЕМ С ПАПКАМИ В БАЗЕ ДАННЫХ!</b></font><br/>
	<?
}
?>
