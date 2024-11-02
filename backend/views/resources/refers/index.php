<?

include("_common.php");

$columnsList = [
  'field',
  'model',
  'field1',
  'field2',
];
$templates = '{update} {delete}';

$globalFormsInc = realpath(__DIR__."/../")."/_globalforms.php";
include($globalFormsInc);

/*
use yii\helpers\Html;
use leandrogehlen\treegrid\TreeGrid;

include("_common.php");

if(!$accessDenied) {
?>
<div class="menu-index">
    <p>
        <? 
        //if($dataProvider->count == 0)
            echo Html::a('Добавить', ['add'.$globalExtraParams], ['class' => ['btn btn-primary']]);
        ?>
    </p>
    <?=
        TreeGrid::widget([
            'dataProvider' => $dataProvider,
            'keyColumnName' => 'id',
            'showOnEmpty' => FALSE,
            'parentColumnName' => 'parentid',
            'columns' => [
                'field',
                'model',
                'field1',
                'field2',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key)
                        {
                            $url .= "&resourceid=".$model->resourceid;
                            return Html::a('<i class="fas fa-pencil-alt"></i>', $url);
                        },
                        'delete' => function ($url, $model, $key)
                        {
                            $url .= "&resourceid=".$model->resourceid;
                            return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                            	'title' => Yii::t('yii', 'Delete'),
                            	'onclick' => 'return confirm("Вы хотите удалить запись?");'
                        		]);
                        },
                    ]
                ]
            ]
        ]);
        ?>
</div>
<?
}
*/
