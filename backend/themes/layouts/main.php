<?

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AdminAsset;
use yii\widgets\Breadcrumbs;

use backend\models\Resources;
use backend\models\AuthRule;
use backend\models\User;

$viewsPath = Yii::getAlias('@backend')."/views/";
include($viewsPath."_access.php");


$confDbCheck = Yii::$app->get('db');

/*
if(!$accessDenied && !empty($confDbCheck->dsn)) {
	$c1 = preg_match("{mysql\:host\=localhost}si", $confDbCheck->dsn);
	$c2 = preg_match("{mysql\:host\=192\.168\.}si", $confDbCheck->dsn);
	$c3 = preg_match("{mysql\:host\=127\.0\.0\.1}si", $confDbCheck->dsn);
	if($c1 || $c2 || $c3) {
		Yii::$app->session->addFlash("info", "<h4><b>ТЕСТОВАЯ БАЗА...</b></h4>");
	} else {
		Yii::$app->session->addFlash("danger", "<h1><b>БОЕВАЯ БАЗА!</b></h1>");
	}
}
*/

$IS_USER_REGISTERED = !is_null(Yii::$app->user->identity);

$asset = AdminAsset::register($this);

$moduleName = $this->context->module->id;

?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Yii::t('backend', 'Control Panel') ?> - <?= Html::encode(strip_tags($this->title)) ?></title>
        <?
        /*
        ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
        <?
        */
        ?>
        <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic'>
        <link rel="shortcut icon" href="<?= $asset->baseUrl ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= $asset->baseUrl ?>/favicon.ico" type="image/x-icon">
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div id="admin-body">
            <div class="container666">
                <div class="wrapper">
                    <div class="header">
                        <div class="logo text-left">
                            <a href="/">CompleteCMS</a>
                        </div>
                        <div class="nav-adm">
                            <div class="float-md-left">
                                <a href="<?= Yii::$app->homeUrl ?>" target="_blank"><i class="fa fa-home"></i> <?= Yii::t('backend', 'Open site') ?></a>
                            </div>
                            <?
                            if($IS_USER_REGISTERED) {
                              ?>
                              <div class="float-md-right">
                                  <a href="<?= Url::to(['/sign/out']) ?>"><i class="fa fa-sign-out"></i> <?= Yii::t('backend', 'Logout') ?>: <?=User::getUserName()?> (<?=User::getUserRole()?>)</a>
                              </div>
                              <?
                            }
                            ?>
                        </div>
                    </div>
                    <div class="main">
                        <div class="box sidebar">
                          <?
                          //-- the whole list of the Resources menu items
                          $insertCode = "<span>&nbsp;&nbsp;&nbsp;</span>";
                          $isHtml = true;
                          $useMenuRulesList = !IS_ROOT;
                          echo Resources::getResourcesMenu($insertCode, $isHtml, $menuRulesList, $useMenuRulesList);
                          
                          /*
                          //-- extra menu items (not from the Resources list)
                          if(IS_ROOT) {
                            ?>
                            <a href="<?= Url::to(['/system']) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
                              <i class="fa fa-hdd"></i>
                              <?= Yii::t('backend', 'System') ?>
                            </a>
                            <a class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
                              <i class="fa fa-hdd"></i>
                              Система
                            </a>
                            <a href="<?= Url::to(['/adm/example']) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
                              <?=$insertCode?><i class="fa fa-hashtag"></i>
                              Example
                            </a>
                            <a href="<?= Url::to(['/system/flush-cache']) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
 															<?=$insertCode?><i class="fa fa-eraser"></i>
                              <?= Yii::t('backend', 'Flush cache') ?>
                            </a>
                            <a href="<?= Url::to(['/system/clear-assets']) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
 															<?=$insertCode?><i class="fa fa-eraser"></i>
                              <?= Yii::t('backend', 'Clear assets') ?>
                            </a>
                            <a href="<?= Url::to(['/adm/wrong']) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
                              <?=$insertCode?><i class="fa fa-folder-open"></i>
                              Хранилище
                            </a>
                            <a href="<?= Url::to(['/adm/getsql']) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
                              <?=$insertCode?><i class="fa fa-file-export"></i>
                              Файлы экспорта
                            </a>
                          	<a href="<?= Url::to(['/adm/help']) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
                              <?=$insertCode?><i class="fa fa-question"></i>
                              Help
                            </a>
                          	<?
                          }
                          if(!empty(Yii::$app->params["CMS_USERS_ACCESS"])) {
                          	$configRoleAccess = Yii::$app->params["CMS_USERS_ACCESS"];
                          	foreach($configRoleAccess as $confRole => $confRoleData) {
                          		$role = User::getUserRole();
                          		if(IS_ROOT || ($confRole === $role)) {
                          			if(!empty($confRoleData["links"])) {
                          				$confLinks = $confRoleData["links"];
                          				foreach($confLinks as $confLinkTitle => $confLink) {
                          					?>
                          					<a href="<?= Url::to([$confLink]) ?>" class="menu-item <?= ($moduleName == 'admin' && $this->context->id == 'system') ? 'active' : '' ?>">
                                			<?=$insertCode?><i class="fa fa-globe"></i>
                                			<?=$confLinkTitle?>
                            				</a>
                          					<?
                          				}
                          			}
                          		}
                          	}
                          }
                          */
                          ?>
                        </div>
                        <div class="box content">
                            <?
                            //if(!$accessDenied) {
                            	//-- set unique name for saveState
                              $uniqueStateName = "admin-left-menu-state";
                              $dirs = array_reverse(explode("/", str_replace("\\", "/", __DIR__)));
                              //-- $dirs[0] = adm
                              //-- $dirs[1] = views
                              //-- $dirs[2] = backend
                              //-- $dirs[3] = [PROJECT-NAME]!!!
                              if(!empty($dirs[3])) {
                              	$uniqueStateName .= "-".str_replace("_", "-", $dirs[3]);
                              }
                            	?>
	                            <div class="page-title">
                                <i class="fa fa-angle-double-left left-menu-state" id="<?=$uniqueStateName?>"></i>
                                <?= $this->title ?>
  	                          </div>
    	                        <?
                            //}
                            ?>
                            <div class="container-fluid">
                            	<?
                              foreach(Yii::$app->session->getAllFlashes() as $type => $messages) {
      													foreach($messages as $message) {
      														?>
      														<div class="alert alert-<?=$type?>"><?=$message?></div>
      														<?
	                            	}
  	                          }
	  	                          echo Breadcrumbs::widget([
  	                              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    	                            'homeLink' => false,
      	                        ]);
        	                    if(!$accessDenied) {
        	                      echo $content;
                              }
                             	?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
