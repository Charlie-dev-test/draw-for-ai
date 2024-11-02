<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
/**
 * Description of view
 */

include("_common.php");

if(!$accessDenied) {
?>
<div class="menu-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить элемент?',
                'method' => 'post',
            ],
        ])?>
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'resourceid',
            'title',
            'model',
            //['attribute' => 'parentid', 'value' => $model->resources['title'],],
            //'text:ntext',
        ],
    ])?>
</div>
<?
}
