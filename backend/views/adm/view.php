<?php

use yii\helpers\Html;

/**
 * Description of view
 */

include("_globalview.php");
include("fancybox.php");

if(!$accessDenied) {
?>
<div class="menu-update">
    <?
    echo $this->render('_form',
    [
      'model' => $model,
      'admin_view_template' => true
    ]);
    ?>
</div>
<?
}
