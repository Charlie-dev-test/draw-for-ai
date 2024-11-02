<?

use yii\helpers\Html;
use kartik\grid\GridView;

use backend\models\Resources;
use backend\models\Resources\ResourcesColumns;

/**
 * Description of admin
 * 
 * @var $this yii\web\View
 * @var $searchModel backend\models\MenuSearch
 */

if(!$accessDenied) {

  $actionColumn = ['class' => 'yii\grid\ActionColumn',
    'template' => $templates,
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
      'up' => function ($url, $model, $key)
      {
        $url .= "&resourceid=".$model->resourceid;
        return Html::a('<i class="fas fa-chevron-circle-up"></i>', $url);
      },
      'down' => function ($url, $model, $key)
      {
        $url .= "&resourceid=".$model->resourceid;
        return Html::a('<i class="fas fa-chevron-circle-down"></i>', $url);
      },
      'active' => function ($url, $model, $key)
      {
        $url .= "&resourceid=".$model->resourceid;
        return Html::a('<i class="fas fa-check"></i>', $url);
      },
    ]
  ];
  
  $defaultAttrs = array_keys($searchModel->attributeLabels());
  if(in_array('active', $defaultAttrs)) {
  	//$columnsList[] = 'active';
  }
  if(!empty($extraActionColumnsList)) {
  	$columnsList[] = $extraActionColumnsList;
  }
  $columnsList[] = $actionColumn;

  $searchModel = [];
	
	?>
	<style>
	.table-striped tbody tr.danger:nth-of-type(even) {
		background-color: #fdd;
	}
	.table-striped tbody tr.danger:nth-of-type(odd) {
		background-color: #fcc;
	}
	</style>
	<div class="menu-index">
    <p>
    	<? 
    	echo Html::a('Добавить', ['add'.$globalExtraParams], ['class' => ['btn btn-primary']]);
    	?>
    </p>
    <?
    echo GridView::widget([
    	'bsVersion' => '4',
    	'dataProvider' => $dataProvider,
      //'filterModel' => $searchModel,
      'columns' => $columnsList,
      'showOnEmpty' => true,
      'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    	'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    	'filterRowOptions' => ['class' => 'kartik-sheet-style'],
      //-- !!! PJAX: should be set to FALSE for purpose of refreshing links on the page !!!
      'pjax' => false,
      'rowOptions' => function($model, $index, $widget, $grid) {
	      $rowOptions = [];
	      if(isset($model->active)) {
	      	$rowOptions = ['class' => ($model->active) ? '' : 'danger'];
	      }
	      return $rowOptions;
    	},
    	'bordered' => true,
      'striped' => true,
      'condensed' => true,
      'responsive' => true,
      'hover' => true,
      'showPageSummary' => false,
      'panel' => [
          'type' => GridView::TYPE_ACTIVE,
      		'heading' => false,
          'after' => false,
          'before' => false,
          'footer' => false,
      ],
      'persistResize' => false,
		]);
	?>
	</div>
<?
}
