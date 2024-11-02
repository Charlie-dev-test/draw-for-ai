<?

use backend\models\AbstractModel;
use backend\models\Languages;
use backend\models\Translates;
use backend\models\Helps;
use backend\models\Issues;
use backend\models\Files;
use backend\models\Uploads;

use backend\models\ScInfo;

//$this->title = 'CompleteCMS Help';
include("_globalview.php");

include("fancybox.php");

$storagePath = Yii::getAlias('@backend')."/web/";

?>
<style>
img {
	padding: 1px;
	border: 1px solid #bbb;
}
.div_help {
	padding: 0;
	color: orange;
}
.link_help.active,
.link_help2.active
{
	color: #000;
}
.link_help,
.link_help2
{
	text-decoration: underline;
	text-decoration: none;
	font-weight: bold;
	cursor: pointer;
}
.div_help.div_level0 {
	padding-left: 0;
}
.div_help.div_level1 {
	padding-left: 15px;
}
.div_help.div_level2 {
	padding-left: 30px;
}
.div_help.div_level3 {
	padding-left: 45px;
}
.div_help.div_level4 {
	padding-left: 60px;
}
.div_help.div_level5 {
	padding-left: 75px;
}
.content_help,
.content_help2
{
	display: none;
	color: #000;
}
.model_info_class_name {
	font-size: 20px;
	font-weight: bold;
}
.model_info_thin {
	font-weight: normal;
}
.model_info_comments {
	color: #999;
	text-decoration: italic;
	font-size: 12px;
}
.model_info_comments.method {
	padding-left: 20px;	
}
.model_info_comments.prop,
.model_info_comments.values
{
	padding-left: 20px;	
}
.model_info_comments.values {
	word-wrap: break-word;
	color: #2aa52a;
	padding-left: 40px;
}
.model_info_comments.param {
	padding-left: 40px;	
}
.model_info_params {
	color: #666;
	padding-left: 40px;
}
.model_info_link {
	color: orange;
	cursor: pointer;
}
.model_info_method_name, .model_info_prop_name {
	color: #a52a2a;
	padding-left: 20px;
	font-weight: bold;
}
.model_info_prop_name {
	color: #2a2aa5;
}
.small_subtitle {
	font-size: 12px;
	color: #666;
}
</style>
<script>
function switchHelp()
{
	var globalContentHelp = $('.content_help');
	var globalLinkHelp = $('.link_help');
	globalLinkHelp.click(function() {
		var contentHelp = $(this).parent().find('.content_help');
		contentHelp.toggle();
		if(contentHelp.css('display') !== 'none') {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});

	var globalContentHelp = $('.content_help2');
	var globalLinkHelp = $('.link_help2');
	globalLinkHelp.click(function() {
		var contentHelp = $(this).parent().find('.content_help2');
		contentHelp.toggle();
		if(contentHelp.css('display') !== 'none') {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});
}
$(document).ready(function()
{
	switchHelp();
	$('.model_info_tooltip').tooltip();
});
</script>

<div class="container" style="margin:0;padding:15px;max-width:100%;background-color:#eee;">
	<!--
	<h1>ПРИМЕР ИСПОЛЬЗОВАНИЯ</h1>
	-->
	<?
	$issues = new Issues();
	$files = new Files();
	$uploads = new Uploads();

	/*
	$langs = Languages::langArrayList();
	foreach($langs as $lang) {
		$LANGUAGE_ID = $lang["id"];
		if($LANGUAGE_ID != 1) {
			continue;
		}
		?>
		<h2><?=$lang["title"]?></h2>
		<?
		*/

		$LANGUAGE_ID = null;

		$parentid = 0;
		$helps = new Helps();
		
		$rows = $helps->getHelpLevels($parentid, $LANGUAGE_ID, 0);
  
		foreach($rows as $row) {
			$level = $row->lev;
			?>
			<div class="div_help div_level<?=$level?>">
				<?
				echo "<h".($level+1)." class=\"link_help\">".$row->title."</h".($level+1).">";
				?>
				<div class="content_help">
					<?
					$issueRows = $issues->getIssues($row->id, $LANGUAGE_ID, "help", 0);
					foreach($issueRows as $issueRow) {
						?>
						<div class="div_help div_level<?=$level?>">
							<?
							echo "<h".($level+2)." class=\"link_help2\">".$issueRow->title."</h".($level+2).">";
							?>
							<div class="content_help2">
								<?
								$picsList = [];
								$iconList = [];

								$picsRows = $files->getFiles($issueRow->id, $LANGUAGE_ID, "help", false);
								foreach($picsRows as $picsRow) {
									if(!empty($picsRow->pics)) {
										$picsData = $uploads->getFile($picsRow->pics);
										if(!empty($picsData)) {
											$picsFileName = $picsData->getFullFileName();
											if(!empty($picsFileName)) {
												$url = "/".$picsFileName;
												$picsList[] = $url;
												/*
												?>
												<a href="<?=$url?>" data-fancybox="admin_pics"><img src="<?=$url?>" height="50" title="<?=$picsRow->title?>"/></a>
												<?
												*/
											}
										}
									}
								}
								
								$text = $issueRow->text;

								$idx = 1;
								foreach($picsList as $url) {
									$fileName = $storagePath.substr($url, 1);
									if(file_exists($fileName)) {
										$imageInfo = getimagesize($fileName); 
										$w = 300;
										if((int)$imageInfo[0] > 0) {
											if($imageInfo[0] < $w) {
												$w = $imageInfo[0];
											}
										}
										$imgTag = "<a href=\"".$url."\" data-fancybox=\"admin_help_pics\"><img src=\"".$url."\" width=\"".$w."\" title=\"\"/></a><br/><span class=\"small_subtitle\"><i>Рис.".$idx."</i></span>";
										$text = preg_replace("{\[\@\!PICS\_".$idx."\!\@\]}si", $imgTag, $text);
									}
									$idx++;
								}
								//-- remove all placeholders for nonexistent pics
								$find = "{\[\@\!PICS\_\d+\!\@\]}si";
								while(preg_match($find, $text)) {
        					$text = preg_replace($find, "", $text);
    						}

    						//-- make the model info link
    						while(true) {
									if(preg_match("{\[\@\!MODEL\_(.*?)\!\@\]}si", $text, $matches)) {
										$modelName = $matches[1];
										include("_model_info.php");
										$text = preg_replace("{\[\@\!MODEL\_".$modelName."\!\@\]}si", $modelInfoHtml, $text);
									} else {
										break;
									}
								}

								echo $text;
								
								?>
							</div>
						</div>
						<?
					}
					?>
				</div>
			</div>
			<?
		}
	  /*
	}
	*/
	?>
</div>
