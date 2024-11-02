<?php
use yii\helpers\Html;
use leandrogehlen\treegrid\TreeGrid;
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
                'title',
                'value',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key)
                        {
                            $formIdParameter = (int)Yii::$app->getRequest()->getQueryParam('formid');
                            $resourceIdParameter = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
                            $url .= "&resourceid=".$resourceIdParameter;
                            $url .= "&formid=".$formIdParameter;
                            return Html::a('<i class="fas fa-pencil-alt"></i>', $url);
                        },
                        'delete' => function ($url, $model, $key)
                        {
                            $formIdParameter = (int)Yii::$app->getRequest()->getQueryParam('formid');
                            $resourceIdParameter = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
                            $url .= "&resourceid=".$resourceIdParameter;
                            $url .= "&formid=".$formIdParameter;
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
