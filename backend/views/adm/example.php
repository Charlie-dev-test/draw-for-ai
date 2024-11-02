<?

use backend\models\Languages;
use backend\models\Translates;
use backend\models\Menus;
use backend\models\Issues;
use backend\models\Files;
use backend\models\Uploads;

$this->title = 'CompleteCMS Example';

include("fancybox.php");

?>
<style>
img {
	padding: 1px;
	border: 1px solid #666;
}
img.inactive {
	padding: 1px;
	border: 3px solid #f00;
}
</style>
<div class="container" style="margin:0;padding:15px;max-width:100%;background-color:#eee;">
	<h1>ПРИМЕР ИСПОЛЬЗОВАНИЯ</h1>
	<?
	$issues = new Issues();
	$files = new Files();
	$uploads = new Uploads();

	$langs = Languages::langArrayList();
	foreach($langs as $lang) {
		$LANGUAGE_ID = $lang["id"];
		?>
		<h2><?=$lang["title"]?></h2>
		<?
		$parentid = 0;
		$menus = new Menus();
		
		$rows = $menus->getMenuLevels($parentid, $LANGUAGE_ID);
  
		$strToRepeat = "&nbsp;&nbsp;&nbsp;";
		
		foreach($rows as $row) {
			if(isset($row->active) && !$row->active) {
				echo "<i><span style=\"color:#fff;background-color:#f00;\">";
			}
			//echo str_repeat($strToRepeat, $row->lev)."Меню: <b>".$row->title."</b> (level:".$row->lev.", id:".$row->id.")";
			echo str_repeat($strToRepeat, $row->lev)."Меню: <b>".$row->title."</b>";
			if(isset($row->active) && !$row->active) {
				echo "&nbsp;</span> - неактивная запись!</i>";
			}
			echo "<br/>";
			$issueRows = $issues->getIssues($row->id, $LANGUAGE_ID, "menu");
			foreach($issueRows as $issueRow) {
				if(isset($issueRow->active) && !$issueRow->active) {
					echo "<i><span style=\"color:#fff;background-color:#f00;\">";
				}
				echo str_repeat($strToRepeat, $row->lev+2)."Статья: ".$issueRow->title;
				if(isset($issueRow->active) && !$issueRow->active) {
					echo "&nbsp;</span> - неактивная запись!</i>";
				}
				echo "<br/>";
  
				$picsRows = $files->getFiles($issueRow->id, $LANGUAGE_ID, "issue");
				foreach($picsRows as $picsRow) {
					if(!empty($picsRow->pics)) {
						echo str_repeat($strToRepeat, $row->lev+2);
					}
					if(!empty($picsRow->pics)) {
						//echo "&nbsp;&nbsp;&nbsp;- pics: ".$picsRow->pics." (язык: ".$picsRow->lang_id.")<br/>";
						$picsData = $uploads->getFile($picsRow->pics);
						$picsFileName = $picsData->getFullFileName();
						if(!empty($picsFileName)) {
							$url = "/".$picsFileName;
							$cls = "";
							if(isset($picsRow->active) && !$picsRow->active) {
								$cls = "inactive";
							}
							?>
							<a href="<?=$url?>" data-fancybox="admin_pics"><img class="<?=$cls?>" src="<?=$url?>" height="50" title="<?=$picsRow->title?>"/></a>
							<?
						}
					}
					if(!empty($picsRow->pics)) {
						$lngRow = Languages::getLanguage($picsRow->lang_id);
						if(isset($picsRow->active) && !$picsRow->active) {
							echo "<i><span style=\"color:#fff;background-color:#f00;\">";
						}
						echo "язык: ".$lngRow->title;
						if(isset($picsRow->active) && !$picsRow->active) {
							echo "&nbsp;</span> - неактивная запись!</i>";
						}
						echo "<br/>";
					}
				}
			}
		}
		?>
		<hr/>
		<?
	}
	?>
</div>
