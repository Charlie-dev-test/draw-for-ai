<?
use yii\helpers\Html;
use backend\models\AbstractModel;

	$orderId = AbstractModel::chkAttributes($model, "orderid", false);
	$isActive = AbstractModel::chkAttributes($model, "active", false);

	$actionsCol1 = [];
	$actionsCol2 = [];
	$actionsCol3 = [];
	$actionsCol4 = [];
	if($canUserDoAction["add"]) {
		$actionsCol3[] = "{add}";
		$actionsCol4[] = "{add}";
	}
	if($canUserDoAction["view"]) {
		$actionsCol1[] = "{view}";
		$actionsCol2[] = "{view}";
		$actionsCol3[] = "{view}";
		$actionsCol4[] = "{view}";
	}
	if($canUserDoAction["update"]) {
		$actionsCol1[] = "{update}";
		$actionsCol2[] = "{update}";
		$actionsCol3[] = "{update}";
		$actionsCol4[] = "{update}";
	}
	if($canUserDoAction["delete"]) {
		$actionsCol1[] = "{delete}";
		$actionsCol2[] = "{delete}";
		$actionsCol3[] = "{delete}";
		$actionsCol4[] = "{delete}";
	}
	if($canUserDoAction["up"]) {
		$actionsCol1[] = "{up}";
		$actionsCol3[] = "{up}";
	}
	if($canUserDoAction["down"]) {
		$actionsCol1[] = "{down}";
		$actionsCol3[] = "{down}";
	}
	if($canUserDoAction["left"]) {
		$actionsCol3[] = "{left}";
	}
	if($canUserDoAction["right"]) {
		$actionsCol3[] = "{right}";
	}

	$actionsStr1 = implode(" ", $actionsCol1);
	$actionsStr2 = implode(" ", $actionsCol2);
	$actionsStr3 = implode(" ", $actionsCol3);
	$actionsStr4 = implode(" ", $actionsCol4);

	$gridColumnsTemplate = $actionsStr1;// "{update} {delete} {up} {down}"; //-- actionsCol1
	if(is_null($orderId)) {
		$gridColumnsTemplate = $actionsStr2;// "{update} {delete}"; //-- actionsCol2
	}
	if(!empty($resource->datatype)) {
		if($resource->datatype === "catalog") {
			$gridColumnsTemplate = $actionsStr3;// "{add} {update} {delete} {up} {down} {left} {right}"; //-- actionsCol3
			if(is_null($orderId)) {
				$gridColumnsTemplate = $actionsStr4;// "{add} {update} {delete}"; //-- actionsCol4
			}
		}
	}
	if(!is_null($isActive) && $canUserDoAction["active"]) {
		$gridColumnsTemplate .= " {active}";
	}
	$modelTableName = $sectionNameParameter;

	$extraColumns = [];
	if(strlen($gridColumnsTemplate) > 0) {
		$extraColumns =
			['class' => 'yii\grid\ActionColumn',
        'template' => $gridColumnsTemplate,
        'buttons' => [
            'view' => function($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-eye"></i>', $url, [
                	'title' => Yii::t('yii', 'View'),
                ]);
            },
            'update' => function($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                	'title' => Yii::t('yii', 'Update'),
                ]);
            },
            'delete' => function ($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                	'title' => Yii::t('yii', 'Delete'),
                	'onclick' => 'return confirm("Вы хотите удалить запись?");'
            		]);
            },
            'add' => function ($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-plus"></i>', $url, [
                	'title' => Yii::t('yii', 'Добавить новый уровень'),
                ]);
            },
            'up' => function ($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-chevron-circle-up"></i>', $url, [
                	'title' => Yii::t('yii', 'Переместить на одну позицию вверх'),
                ]);
            },
            'right' => function ($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-chevron-circle-right"></i>', $url, [
                	'title' => Yii::t('yii', 'Переместить на один уровень вверх'),
                ]);
            },
            'down' => function ($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-chevron-circle-down"></i>', $url, [
                	'title' => Yii::t('yii', 'Переместить на одну позицию вниз'),
                ]);
            },
            'left' => function ($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-chevron-circle-left"></i>', $url, [
                	'title' => Yii::t('yii', 'Переместить на один уровень вниз'),
                ]);
            },
            'active' => function ($url, $model, $key) use ($parentIdParameter, $modelTableName, $pageParameter)
            {
                $url .= AbstractModel::fixUrl($url)."section=".$modelTableName;
                if(!empty($parentIdParameter)) {
                	$url .= "&parentid=".$parentIdParameter;
                }
                if(!empty($pageParameter)) {
                	$url .= "&page=".$pageParameter;
                }
                return Html::a('<i class="fas fa-check"></i>', $url, [
                	'title' => Yii::t('yii', 'Сменить флаг активности'),
                ]);
            },
        ]
			];
	}
