<?php
use yii\helpers\Html;
use leandrogehlen\treegrid\TreeGrid;

use backend\models\AbstractModel;
use backend\models\Resources\ResourcesColumns;
use backend\models\Resources\ResourcesForms;
use backend\models\Resources\ResourcesConditions;
use backend\models\Resources\ResourcesRefers;
use backend\models\Resources\ResourcesJoins;

use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/**
 * Description of admin
 * 
 * @var $this yii\web\View
 * @var $searchModel backend\models\MenuSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

include("_common.php");

if(!$accessDenied) {
	?>
	<div class="menu-index">
    <p>
      <?
      //if($dataProvider->count == 0)
      echo Html::a('Добавить', ['create'], ['class' => ['btn btn-primary']]);
      $colorCollection = [
      	"def1" => "#fff",
      	"def2" => "#eee",
      	"inact1" => "#fdd",
      	"inact2" => "#fcc",
      	"invis1" => "#ffcf70",
      	"invis2" => "#ffba30",
      	"deny1" => "#999",
      	"deny2" => "#666",
      ];
      ?>
      <br/>
      <i><small><font color="brown">Правило заполнения Идентификатора ресурса: <b>имямодели1-имямодели2-имямодели3</b>
      <br/>
      Пример: <b>menus-issues-translates</b> (Меню-Статьи-Переводы)</font></small></i>
      <style>
			.table-striped tbody tr.danger:nth-of-type(even) {
				background-color: <?=$colorCollection["inact1"]?>;
			}
			.table-striped tbody tr.danger:nth-of-type(odd) {
				background-color: <?=$colorCollection["inact2"]?>;
			}
			.table-striped tbody tr.selected:nth-of-type(even) {
				background-color: #fff3cd;
			}
			.table-striped tbody tr.selected:nth-of-type(odd) {
				background-color: #fff09a;
			}
			.table-striped tbody tr.inactive:nth-of-type(even) {
				background-color: <?=$colorCollection["invis1"]?>;
			}
			.table-striped tbody tr.inactive:nth-of-type(odd) {
				background-color: <?=$colorCollection["invis2"]?>;
			}
			.table-striped tbody tr.dark:nth-of-type(even) {
				background-color: <?=$colorCollection["deny1"]?>;
			}
			.table-striped tbody tr.dark:nth-of-type(odd) {
				background-color: <?=$colorCollection["deny2"]?>;
			}
			table.activity_legend,
			table.activity_legend tbody,
			table.activity_legend tr,
			table.activity_legend td
			{
      	border: 0;
      	padding: 0;
      }
			table.activity_legend td
			{
      	padding-left: 5px;
      	padding-right: 25px;
			}
			table.activity_legend td.td_color
			{
      	border: 1px solid #999;
      	padding-right: 5px;
			}
			</style>
      <table class="activity_legend">
      	<tr>
      		<td bgcolor="<?=$colorCollection["def1"]?>" class="td_color">&nbsp;</td>
      		<td bgcolor="<?=$colorCollection["def2"]?>" class="td_color">&nbsp;</td>
      		<td>Активен и видим в меню</td>
      		<td bgcolor="<?=$colorCollection["inact1"]?>" class="td_color">&nbsp;</td>
      		<td bgcolor="<?=$colorCollection["inact2"]?>" class="td_color">&nbsp;</td>
      		<td>Неактивен</td>
      		<td bgcolor="<?=$colorCollection["invis1"]?>" class="td_color">&nbsp;</td>
      		<td bgcolor="<?=$colorCollection["invis2"]?>" class="td_color">&nbsp;</td>
      		<td>Невидим в меню</td>
      		<td bgcolor="<?=$colorCollection["deny1"]?>" class="td_color">&nbsp;</td>
      		<td bgcolor="<?=$colorCollection["deny2"]?>" class="td_color">&nbsp;</td>
      		<td>Неактивен и невидим в меню</td>
      	</tr>
      </table>
    </p>
    <?
   
    //$pjaxId = "resourcesPjaxId";
    //Pjax::begin(['id' => $pjaxId]);

    $attrs = $model->attributeLabels();

    //-- set unique name for saveState
    $uniqueStateName = "tree-grid-state-resources";
    $dirs = array_reverse(explode("/", str_replace("\\", "/", __DIR__)));
    //-- $dirs[0] = resources
    //-- $dirs[1] = views
    //-- $dirs[2] = backend
    //-- $dirs[3] = [PROJECT-NAME]!!!
    if(!empty($dirs[3])) {
    	$uniqueStateName .= "-".str_replace("_", "-", $dirs[3]);
    }
   
    echo TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'id',
        'showOnEmpty' => true,
        'parentColumnName' => 'parentid',
        'pluginOptions' => [
    			'initialState' => 'collapsed', //'expanded',
    			'saveState' => true,
    			'saveStateMethod' => 'cookie', //'hash',
    			'saveStateName' => $uniqueStateName,
    		],
    		'rowOptions' => function($model, $index, $widget, $grid) {
	        $rowOptions = [];
	        $rowOptions = ['class' => ''];
	        if(isset($model->active) && !$model->active && isset($model->visible) && !$model->visible) {
	        	$rowOptions = ['class' => 'dark'];
	        } elseif(isset($model->active) && !$model->active) {
	        	$rowOptions = ['class' => 'danger'];
	        } elseif(isset($model->visible) && !$model->visible) {
	        	$rowOptions = ['class' => 'inactive'];
	        }
	        return $rowOptions;
    		},
        'columns' => [
            array(
  						'header' => $attrs["title"],
  						'attribute' => $attrs["title"],
            	'format' => 'raw',
            	'value' => function($mainRow, $model)
								{
									return $mainRow->title;
								},
            ),
            //'title',
            'model',
            'resourceid',
            /*
            array(
  						'header' => $attrs["direct_link"],
  						'attribute' => $attrs["direct_link"],
            	'format' => 'raw',
            	'value' => function($mainRow, $model)
								{
									return !empty($mainRow->direct_link) ? "<b>Прямая ссылка</b>" : "";
								},
            ),
            */
            //'datatype',
            //'menu_icon',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{columns} | {forms} | {conditions} | {refers} | {joins}',
                'buttons' => [
                    'columns' => function ($url, $model, $key) {
                        $c = ResourcesColumns::find()->select('id')->where(['resourceid' => $key])->count();
                        $s = ($c === 0) ? "" : " (".$c.")";
                        return Html::a("Колонки".$s, ['resources/columns/index', 'resourceid' => $key]);
                    },
                    'forms' => function($url, $model, $key) {
                        $c = ResourcesForms::find()->select('id')->where(['resourceid' => $key])->count();
                        $s = ($c === 0) ? "" : " (".$c.")";
                        return Html::a("Форма".$s, ['resources/forms/index', 'resourceid' => $key]);
                    },
                    'conditions' => function ($url, $model, $key) {
                        $c = ResourcesConditions::find()->select('id')->where(['resourceid' => $key])->count();
                        $s = ($c === 0) ? "" : " (".$c.")";
                        return Html::a("Условия".$s, ['resources/conditions/index', 'resourceid' => $key]);
                    },
                    'refers' => function ($url, $model, $key) {
                        $c = ResourcesRefers::find()->select('id')->where(['resourceid' => $key])->count();
                        $s = ($c === 0) ? "" : " (".$c.")";
                        return Html::a("Связи".$s, ['resources/refers/index', 'resourceid' => $key]);
                    },
                    'joins' => function ($url, $model, $key) {
                        $c = ResourcesJoins::find()->select('id')->where(['resourceid' => $key])->count();
                        $s = ($c === 0) ? "" : " (".$c.")";
                        return Html::a("Джойны".$s, ['resources/joins/index', 'resourceid' => $key]);
                    },
                ]
            ],
            ['class' => 'yii\grid\ActionColumn',
                //'template' => '{view} {update} {delete} {add}',
                'template' => '{add} {update} {delete} {export} {up} {down} {left} {right} {active}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                        	'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        //return Html::a('<i class="fas fa-trash-alt"></i>', $url);
                        return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                        	'title' => Yii::t('yii', 'Delete'),
                        	'onclick' => 'return confirm("Вы хотите удалить запись?");'
                    		]);
                    },
                    'add' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-plus"></i>', $url, [
                        	'title' => Yii::t('yii', 'Добавить новый уровень'),
                        ]);
                    },
                    'up' => function ($url, $model, $key)
                    {
                        return Html::a('<i class="fas fa-chevron-circle-up"></i>', $url, [
                        	'title' => Yii::t('yii', 'Переместить на одну позицию вверх'),
                        ]);
                    },
                    'right' => function ($url, $model, $key)
                    {
                        return Html::a('<i class="fas fa-chevron-circle-right"></i>', $url, [
                        	'title' => Yii::t('yii', 'Переместить на один уровень вверх'),
                        ]);
                    },
                    'down' => function ($url, $model, $key)
                    {
                        return Html::a('<i class="fas fa-chevron-circle-down"></i>', $url, [
                        	'title' => Yii::t('yii', 'Переместить на одну позицию вниз'),
                        ]);
                    },
                    'left' => function ($url, $model, $key)
                    {
                        return Html::a('<i class="fas fa-chevron-circle-left"></i>', $url, [
                        	'title' => Yii::t('yii', 'Переместить на один уровень вниз'),
                        ]);
                    },
                    'export' => function ($url, $model, $key)
                    {
                        $returns = null;
                        if($model->parentid === 0) {
                        	$returns = Html::a('<i class="fas fa-file-export"></i>', $url, [
                        		'title' => Yii::t('yii', 'Экспортировать структуру ресурса'),
                        	]);
                        }
                        return $returns;
                    },
                    'active' => function ($url, $model, $key)
                    {
                        return Html::a('<i class="fas fa-check"></i>', $url, [
                        	'title' => Yii::t('yii', 'Сменить флаг активности'),
                        ]);
                    },
                ]
            ],
        ]
    ]);
    
    //Pjax::end();
    
    //-- !!! show custom pagination !!!
    echo LinkPager::widget([
      'pagination' => $pagination,
      'prevPageLabel' => '&lsaquo;',
      'nextPageLabel' => '&rsaquo;',
      'lastPageLabel' => '&raquo',
      'firstPageLabel' => '&laquo',
      'disableCurrentPageButton' => true,
		]);
	?>
	</div>
<?
}
