<?php
use yii\helpers\Html;
/**
 * Description of create
 */

include("_common.php");

if(!$accessDenied) {
?>
<div class="tree-create">
    <?= $this->render('_form', [
        'model' => $model,
    ])?>
</div>
<?
}
