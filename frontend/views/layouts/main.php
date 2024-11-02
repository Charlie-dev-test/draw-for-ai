<?

use yii\helpers\Html;
use backend\helpers\Meta;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;

FontAwesomeAsset::register($this);
AppAsset::register($this);

$this->beginPage();
?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
<?= Html::csrfMetaTags() ?>
<?
/*
?>
<title><?= Html::encode($this->title) ?></title>
<?
*/
?>
<? $this->head() ?>
<title><?=Html::encode(Meta::$PAGE_SEO_TITLE)?></title>
<meta name="description" content="<?=Meta::$PAGE_SEO_DESCRIPTION?>"/>
<meta name="keywords" content="<?=Meta::$PAGE_SEO_KEYWORDS?>"/>
<style>
body {
	padding: 10px;
}
.header {
	background-color: #ddd;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
	color: #900;
}
</style>
</head>
<body>
<?
$this->beginBody();
  
  //include("header.php");
  
  ?>
  <div class="header">CONTENT</div>
  <?
  echo $content;
  
  //include("footer.php");

$this->endBody();
?>
</body>
</html>

<?
$this->endPage();
