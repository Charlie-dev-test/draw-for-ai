<?php

use yii\helpers\Html;

/**
 * Description of update
 */

include("_common.php");

if(!$accessDenied) {
?>
<div class="menu-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<?
}
