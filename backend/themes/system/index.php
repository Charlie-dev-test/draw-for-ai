<?php
use backend\models\Setting;
use yii\helpers\Url;

$this->title = Yii::t('backend', 'System');
?>

<?
/*
?>
<p><?= Yii::t('backend', 'Current version') ?>: <?= Setting::get('backend_version') ?>
    <?php if(\backend\AdminModule::VERSION > floatval(Setting::get('backend_version'))) : ?>
        <a href="<?= Url::to(['/system/update']) ?>" class="btn btn-success"><?= Yii::t('backend', 'Update') ?></a>
    <?php endif; ?>
</p>
<?
*/
?>
<p>
 <a href="<?= Url::to(['/system/flush-cache']) ?>" class="btn btn-secondary"><i class="fa fa-flash"></i> <?= Yii::t('backend', 'Flush cache') ?></a>
</p>

<p>
  <a href="<?= Url::to(['/system/clear-assets']) ?>" class="btn btn-secondary"><i class="fa fa-trash"></i> <?= Yii::t('backend', 'Clear assets') ?></a>
</p>
