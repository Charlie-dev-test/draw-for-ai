<?

use yii\helpers\Html;
use backend\models\Resources\ResourcesFormsParams;

include("_common.php");

$columnsList = [
  'label',
  'field',
  'type',
];
$extraActionColumnsList = [
	'class' => 'yii\grid\ActionColumn',
  'template' => '{formsparams}',
  'buttons' => [
    'formsparams' => function ($url, $model, $key)
    {
    	$resourceIdParameter = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
    	$c = ResourcesFormsParams::find()->select('id')->where(['formid' => $model->id])->count();
      $s = ($c === 0) ? "" : " (".$c.")";
      return Html::a("Параметры".$s, ['resources/formsparams/index', 'resourceid' => $resourceIdParameter, 'formid' => $model->id]);
    },
  ]
];
$templates = '{update} {delete} {up} {down} {active}';

$globalFormsInc = realpath(__DIR__."/../")."/_globalforms.php";
include($globalFormsInc);



/*
use yii\helpers\Html;
use leandrogehlen\treegrid\TreeGrid;

use backend\models\Resources\ResourcesFormsParams;

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
                'label',
                'field',
                'type',
                ['class' => 'yii\grid\ActionColumn',
                  'template' => '{formsparams}',
                  'buttons' => [
                    'formsparams' => function ($url, $model, $key)
                    {
                    		$resourceIdParameter = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
                    		$c = ResourcesFormsParams::find()->select('id')->where(['formid' => $model->id])->count();
                        $s = ($c === 0) ? "" : " (".$c.")";
                        return Html::a("Параметры".$s, ['resources/formsparams/index', 'resourceid' => $resourceIdParameter, 'formid' => $model->id]);
                    },
                  ]
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete} {up} {down}',
                    'buttons' => [
                        'update' => function ($url, $model, $key)
                        {
                            $url .= "&resourceid=".$model->resourceid;
                            return Html::a('<i class="fas fa-pencil-alt"></i>', $url);
                        },
                        'delete' => function($url, $model, $key)
                        {
                            $url .= "&resourceid=".$model->resourceid;
                            return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                            	'title' => Yii::t('yii', 'Delete'),
                            	'onclick' => 'return confirm("Вы хотите удалить запись?");'
                        		]);
                        },
                        'up' => function ($url, $model, $key)
                        {
                            $url .= "&resourceid=".$model->resourceid;
                            return Html::a('<i class="fas fa-chevron-circle-up"></i>', $url);
                        },
                        'down' => function ($url, $model, $key)
                        {
                            $url .= "&resourceid=".$model->resourceid;
                            return Html::a('<i class="fas fa-chevron-circle-down"></i>', $url);
                        }
                    ]
                ]
            ]
        ]);
        ?>
</div>
<?
}
*/
