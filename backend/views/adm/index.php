<?

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use leandrogehlen\treegrid\TreeGrid;
use backend\helpers\Form;
use backend\models\Resources;
use backend\models\Resources\ResourcesConditions;
use backend\models\AbstractModel;
use backend\models\AuthRule;
use backend\models\AuthView;
use backend\models\User;

use yii\widgets\LinkPager;
use yii\widgets\Pjax;

include("_globalview.php");
include("fancybox.php");


/**
 * Description of admin
 * 
 * @var $this yii\web\View
 * @var $searchModel backend\models\MenuSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

if(!$accessDenied) {
	
	include("index_columns_list.php");

	include("index_extra_links.php");

	include("index_extra_columns.php");
	

	if(!empty($extraColumns)) {
		$columnsList[] = $extraColumns;
	}
	if(!empty($extraLinks)) {
		$columnsList[] = $extraLinks;
	}
	if($resource->datatype === "band" && ($canUserDoAction["multipleactive"] || $canUserDoAction["multipledelete"])) {
		$checkboxColumns =
		[
      'class' => 'kartik\grid\CheckboxColumn',
      //'headerOptions' => ['class' => 'kartik-sheet-style'],
      //'pageSummary' => '<small>(amounts in $)</small>',
      //'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
      'rowSelectedClass' => 'selected',
      'options' => [
      	//'style' =>'background-color: #ff0000;'
      ],
		];
		$columnsList[] = $checkboxColumns;
	}


//if(!$accessDenied) {
	?>
	<div class="menu-index">
    <?
    include("_multiple_uploads.php");

    $showHeaderTags = false;
    if($canUserDoAction['create'] || $canUserDoAction['multipledelete'] || $isActive && $canUserDoAction['multipleactive']) {
    	$showHeaderTags = true;
    }
    if($showHeaderTags) {
    	?>
    	<p>
      <?
    }
    
    if($canUserDoAction['create']) {
    	echo Html::a('Добавить', ['create'.$globalExtraParams], [
    		'id' => 'admin-panel-button-create',
    		'class' => ['btn btn-primary'],
    	]);
    	echo "&nbsp;";
    }
    if($canUserDoAction['multipledelete']) {
    	echo Html::button('Удалить отмеченные', [
    		'id' => 'admin-panel-button-multipledelete',
    		'class' => ['btn btn-danger'],
    		'style' => 'display:none;',
    	]);
    }
    if($isActive && $canUserDoAction['multipleactive']) {
    	echo "&nbsp;";
    	echo Html::button('Сменить активность отмеченных', [
    		'id' => 'admin-panel-button-multipleactive',
    		'class' => ['btn btn-info'],
    		'style' => 'display:none;',
    	]);
    }
    
    $mainModel = null;
    foreach($rowsForms as $frmId => $frms) {
			$resModel = Resources::getResourceById($frms->resourceid);
			if(!empty($resModel->model)) {
				$mainModel = AbstractModel::initModel($resModel->model);
				if(!is_null($mainModel)) {
          break;
        }
      }
    }

    $url = parse_url(Yii::$app->request->url);
    parse_str($url['query'], $query);

    if($showHeaderTags) {
      ?>
    	</p>
			<?
		}
		?>
		<script>
		$(document).ready(function() {
			var kartikCheckboxColumns = $('.kv-row-checkbox');
			var adminPanelGridview = $('#admin-panel-gridview');
			var adminPanelGridviewFilters = $('#admin-panel-gridview-filters');
			var adminPanelButtonMultipleDelete = $('#admin-panel-button-multipledelete');
   		var adminPanelButtonMultipleActive = $('#admin-panel-button-multipleactive');
			
			showAdminPanelButtons();
			//-- checked or unchecked at least one CheckboxColumn row
			kartikCheckboxColumns.change(function(e) {
   			showAdminPanelButtons();
   		});
   		function showAdminPanelButtons()
   		{
   			if(adminPanelButtonMultipleDelete.length > 0) {
   				adminPanelButtonMultipleDelete.hide();
   			}
   			if(adminPanelButtonMultipleActive.length > 0) {
   				adminPanelButtonMultipleActive.hide();
   			}
   			try {
   				var cols = adminPanelGridview.yiiGridView('getSelectedRows');
   				if(cols.length > 0) {
   					if(adminPanelButtonMultipleDelete.length > 0) {
   						adminPanelButtonMultipleDelete.show();
   					}
   					if(adminPanelButtonMultipleActive.length > 0) {
   						adminPanelButtonMultipleActive.show();
   					}
   				}
   			} catch(e) {}
   		}
   		<?
   		if(!is_null($mainModel)) {
   			?>
   			//-- multiple deletion of selected rows
   			adminPanelButtonMultipleDelete.click(function(e) {
   				if(confirm("Вы хотите удалить ВСЕ отмеченные записи?")) {
   					adminPanelButtonMultipleDelete.prop('disabled', true);
   					if(adminPanelButtonMultipleActive.length > 0) {
   						adminPanelButtonMultipleActive.prop('disabled', true);
   					}
   					$.post(
    					"/adm/multiple-delete", 
    					{
            		'ids' : adminPanelGridview.yiiGridView('getSelectedRows'),
            		'query' : '<?=json_encode($query)?>',
            		'model' : '<?=urlencode(get_class($mainModel))?>'
    					},
						),
						function() {
          		adminPanelButtonMultipleDelete.prop('disabled', false);
          		if(adminPanelButtonMultipleActive.length > 0) {
   							adminPanelButtonMultipleActive.prop('disabled', false);
   						}
    				};
					}
   			});
   			//-- multiple activation of selected rows
   			adminPanelButtonMultipleActive.click(function(e) {
   				if(confirm("Вы хотите сменить активность ВСЕХ отмеченных записей?")) {
   					adminPanelButtonMultipleActive.prop('disabled', true);
   					if(adminPanelButtonMultipleDelete.length > 0) {
   						adminPanelButtonMultipleDelete.prop('disabled', true);
   					}
   					$.post(
    					"/adm/multiple-active", 
    					{
            		'ids' : adminPanelGridview.yiiGridView('getSelectedRows'),
            		'query' : '<?=json_encode($query)?>',
            		'model' : '<?=urlencode(get_class($mainModel))?>'
    					},
						),
						function() {
          		adminPanelButtonMultipleActive.prop('disabled', false);
          		if(adminPanelButtonMultipleDelete.length > 0) {
   							adminPanelButtonMultipleDelete.prop('disabled', false);
   						}
    				};
					}
   			});
   			<?
   		}
   		?>
		});
		
		</script>
		<style>
		.table-striped tbody tr.danger:nth-of-type(even) {
			background-color: #fdd;
		}
		.table-striped tbody tr.danger:nth-of-type(odd) {
			background-color: #fcc;
		}
		.table-striped tbody tr.selected:nth-of-type(even) {
			background-color: #fff3cd;
		}
		.table-striped tbody tr.selected:nth-of-type(odd) {
			background-color: #fff09a;
		}
		</style>
		<?
    $pjaxId = $modelTableName.$parentIdParameter.$pageParameter;
    //Pjax::begin(['id' => $pjaxId]);
    
    if($resource->datatype === "band") {
      //-- use GridView for the BAND-type of grid
      $exportConfig = [
      	GridView::HTML  => [
      		'label' => ' Сохранить как HTML',
      	],
      	GridView::CSV   => [
      		'label' => 'Сохранить как CSV',
      	],
      	GridView::TEXT  => [
      		'label' => 'Сохранить как Text',
      	],
      	GridView::EXCEL => [
      		'label' => 'Сохранить как Excel',
      	],
      	/*
      	GridView::PDF => [
      		'label' => 'Сохранить как PDF',
      	],
      	*/
      	GridView::JSON  => [
      		'label' => 'Сохранить как Json',
      	],
      ];

      //-- !!! pager.class=no_pagination - means, not to show default pagination !!!
      echo GridView::widget([
      	'bsVersion' => '4',
      	'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columnsList,
        'showOnEmpty' => true,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    		'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    		'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'options' => ['id' => 'admin-panel-gridview'],
        //-- !!! PJAX: should be set to FALSE for purpose of refreshing links on the page !!!
        'pjax' => false,
        'rowOptions' => function($model, $index, $widget, $grid) {
	        $rowOptions = [];
	        if(isset($model->active)) {
	        	$rowOptions = ['class' => ($model->active) ? '' : 'danger'];
	        }
	        return $rowOptions;
    		},
        'pager' => array(
          //'class' => 'yii\widgets\LinkPager',
          //'options' => ['class' => 'no_pagination'],
          'pagination' => $pagination,
          'prevPageLabel' => '&lsaquo;',
          'nextPageLabel' => '&rsaquo;',
          'lastPageLabel' => '&raquo',
          'firstPageLabel' => '&laquo',
          'disableCurrentPageButton' => true,
				),
				'toolbar' =>  [
					'{toggleData}',
					'{export}',
				],
				'exportContainer' => [
          //'class' => 'btn btn-outline-secondary',
          'class' => 'btn-group mr-2',
				],
				'export' => [
        	'fontAwesome' => true,
        	'icon' => 'fas fa-external-link-alt',
    		],
    		'toggleDataContainer' => [
    			//'class' => 'btn btn-outline-secondary',
    			'class' => 'btn-group mr-2',
    		],
    		'toggleDataOptions' => [
    			'minCount' => 10,
    		],

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
            //'before' => false,
            //'footer' => false,
        ],
        'persistResize' => false,
        'exportConfig' => $exportConfig,
			]);
    } else {
      //Pjax::begin(['id' => $pjaxId]);
      

      //-- set unique name for saveState
      $uniqueStateName = "tree-grid-state-adm";
      $dirs = array_reverse(explode("/", str_replace("\\", "/", __DIR__)));
      //-- $dirs[0] = adm
      //-- $dirs[1] = views
      //-- $dirs[2] = backend
      //-- $dirs[3] = [PROJECT-NAME]!!!
      if(!empty($dirs[3])) {
      	$uniqueStateName .= "-".str_replace("_", "-", $dirs[3]);
      }

      //-- use TreeGrid for the CATALOG-type of grid
      echo TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'id',
        'showOnEmpty' => false,
        'parentColumnName' => 'parentid',
        'pluginOptions' => [
      		'initialState' => 'collapsed', //'expanded',
    			'saveState' => true,
    			'saveStateMethod' => 'cookie', //'hash',
    			'saveStateName' => $uniqueStateName,
      	],
        'columns' => $columnsList,
        //'columns' => [
        //	'title',
        //],
        'rowOptions' => function($model, $index, $widget, $grid) {
	        $rowOptions = [];
	        if(isset($model->active)) {
	        	$rowOptions = ['class' => ($model->active) ? '' : 'danger'];
	        }
	        return $rowOptions;
    		},
      ]);

      //-- !!! show custom pagination !!!
      echo LinkPager::widget([
        'pagination' => $pagination,
        'prevPageLabel' => '&lsaquo;',
        'nextPageLabel' => '&rsaquo;',
        'lastPageLabel' => '&raquo',
        'firstPageLabel' => '&laquo',
        'disableCurrentPageButton' => true,
			]);
			
    }
  
    ?>
	</div>
	<?
}
