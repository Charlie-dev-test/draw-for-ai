<?
use kartik\grid\GridView;
use backend\helpers\Form;

//-- it means: use placeholer for their input blocks
	$placeHolderAbleFilters = [
		GridView::FILTER_MONEY,
		GridView::FILTER_NUMBER,
		GridView::FILTER_SELECT2,
		GridView::FILTER_SLIDER,
		GridView::FILTER_SPIN,
		GridView::FILTER_DATE,
		GridView::FILTER_DATE_RANGE,
		GridView::FILTER_DATETIME,
	];

	//-- it means: use placeholer for their input blocks
	$readOnlyFilters = [
		GridView::FILTER_DATE,
		GridView::FILTER_DATE_RANGE,
		GridView::FILTER_DATETIME,
	];

	$columnsList = [];
	foreach($rowsColumns as $row) {
    if(!empty($row->field)) {
    	
    	$columnsItem = array(
    		'label' => $row->title,
    		'attribute' => $row->field,
      	'format' => 'html',
      	'value' => function($mainRow, $model) use ($row)
					{
						$fldName = $row->field;
						//-- check the value of the attribute, according to the "EVAL" clause
		  			if(!empty($row->eval)) {
		  				$query = $row->eval;
							$canDoIt = true;
							if(preg_match_all("{\{\{(.*?)\}\}}si", $query, $matches)) {
								$conds = $matches[0];
								$flds = $matches[1];
								$idx = 0;
								foreach($flds as $fld) {
									try {
										$value = $mainRow->$fld;
										if(!is_null($value)) {
											$query = str_replace($conds[$idx], $value, $query);
										} else {
											$canDoIt = false;
											break;
										}	
									} catch(Exception $ex) {
										$canDoIt = false;
									}
									$idx++;
								}
							}
							if($canDoIt) {
								$mainRows = null;
          			try {
      						$mainRows = @eval($query);
								} catch(ParseError $ex) {
									//Yii::$app->session->addFlash("warning", "Некорректная функция для EVAL: <b>".$query."</b> для поля ".$row->title." (".$row->field."). Необходимо ее исправить, в противном случае она будет проигнорирована!");
								}
								if(!is_null($mainRows)) {
		  						if(!empty($row->escape)) {
		  							$mainRows = Form::escape($mainRows);
		  							//-- the next row does the same as ESCAPE
		  							//$mainRows = Html::encode($mainRows);
		  						}
		              return $mainRows;
								} else {
									return "";
								}
							}
		  			}
		  			$value = $mainRow->$fldName;
		  			if(!empty($row->escape)) {
		  				$value = Form::escape($value);
		  				//-- the next row does the same as ESCAPE
		  				//$value = Html::encode($value);
		  			}
						return $mainRow->$fldName;
					},
      );
      
      //-- we use filters & sorting only for the BAND datatype
      if($resource->datatype === "band") {
      	//-- set column format to RAW
      	$columnsItem['format'] = 'raw';
      	//-- set column width
      	if(!empty($row->width)) {
      		$columnsItem['width'] = $row->width;
      		$columnsItem['noWrap'] = true;
      	}
    
      	//-- show/hide sorting link
      	if(!$row->sort_flag) {
      		$columnsItem["header"] = $columnsItem["label"];
      	}
      	//-- show/hide filter block
        if(!$row->filter_flag) {
        	$columnsItem['filter'] = false;
        } else {
          //-- set filter type
          if(!empty($row->filter_type)) {
          	$columnsItem['filterType'] = $row->filter_type;
          	if(in_array($row->filter_type, $placeHolderAbleFilters)) {
          		$columnsItem['filterWidgetOptions']['options']['class'] = 'form-control';
          	}
          	if($row->filter_type === GridView::FILTER_RANGE) {
          		$columnsItem['filterWidgetOptions']['pluginOptions'] = [
          			//'value' => null,
          		];
          	}
          	if($row->filter_type === GridView::FILTER_STAR) {
          		$columnsItem['filterWidgetOptions']['pluginOptions'] = [
          			'size' => 'sm',
          			'stars' => 5,
          			'min' => 0,
                'max' => 5,
                'step' => 1,
                'defaultCaption' => '<br/><strong>{rating} hearts</strong>',
                /*
                'starCaptions' => [
                  1 => '1',
                  2 => '2',
                  3 => '3',
                  4 => '4',
                  5 => '5',
                ],
                */
                'starCaptionClasses' => [
                	0.0 => 'text-muted',
                	0.5 => 'text-danger',
                  1.0 => 'text-muted',
                  1.5 => 'text-warning',
                  2.0 => 'text-warning',
                  2.5 => 'text-info',
                  3.0 => 'text-info',
                  3.5 => 'text-primary',
                  4.0 => 'text-primary',
                  4.5 => 'text-success',
                  5.0 => 'text-success',
                ],
          		];
          	}
          	if($row->filter_type === GridView::FILTER_SLIDER) {
          		$columnsItem['filterWidgetOptions']['options'] = [
          		  'style' => 'width:130px;',
          		];
          		$columnsItem['filterWidgetOptions']['pluginOptions'] = [
          			'value' => null,
          			'min' => 0,
                'max' => 10,
                'step' => 1,
                'range' => false,
          		];
          	}
          	if($row->filter_type === GridView::FILTER_MONEY) {
          		$columnsItem['filterWidgetOptions']['pluginOptions'] = [
                'prefix' => html_entity_decode('&#8381; '),
                'suffix' => '',
                'thousands' => '',
                'decimal' => '.',
                'precision' => 2,
                'allowNegative' => true,
                'allowZero' => true,
                'affixesStay' => false,
            	];
            }
          	if($row->filter_type === GridView::FILTER_COLOR) {
          		$columnsItem['value'] = function ($model, $key, $index, $widget) use ($dataProvider, $row)
          		{
         				$color = "";
         				$fld = $row->field;
         				if(!empty($model->$fld)) {
         					$color = $model->$fld;
         				}
         				return "<span class='badge' style='background-color:".$color.";'>&nbsp;</span>&nbsp;".$color;
      				};
          		$columnsItem['filterWidgetOptions']['showDefaultPalette'] = false;
          		$columnsItem['filterWidgetOptions']['pluginOptions'] = [
                'showInput' => false,
                'showInitial' => false,
                'showPalette' => true,
                'showPaletteOnly' => true,
                'showSelectionPalette' => true,
                'showAlpha' => false,
                'allowEmpty' => false,
                'preferredFormat' => 'name',
                'palette' => [
                  ["white", "black", "grey", "silver", "gold", "brown"],
                  ["red", "orange", "yellow", "indigo", "maroon", "pink"],
                  ["blue", "green", "violet", "cyan", "magenta", "purple"],
                ],
            	];
            }
          	if($row->filter_type === GridView::FILTER_SELECT2) {
          		$columnsItem['filterWidgetOptions']['pluginOptions']['allowClear'] = true;
            }
            if(in_array($row->filter_type, $readOnlyFilters)) {
            	$columnsItem['filterWidgetOptions']['options']['readonly'] = true;
            }
            if($row->filter_type === GridView::FILTER_DATE_RANGE) {
            	$columnsItem['filterWidgetOptions']['convertFormat'] = true;
          		$columnsItem['filterWidgetOptions']['presetDropdown'] = true;
          		$columnsItem['filterWidgetOptions']['pluginOptions'] = [
              	'opens'=>'right',
              	'locale' => [
                  'cancelLabel' => 'Очистить',
                  'format' => 'd.m.Y',
          			],
          		];
            }
            if($row->filter_type === GridView::FILTER_DATETIME) {
            	$columnsItem['filterWidgetOptions']['pluginOptions'] = [
              	'opens'=>'right',
              	'locale' => [
                  'cancelLabel' => 'Очистить',
                  'format' => 'd.m.Y H:i',
                  'format' => 'dd.mm.yyyy hh:ii',
          			],
          		];
            }
            if($row->filter_type === GridView::FILTER_CHECKBOX_X) {
            	$columnsItem['filterWidgetOptions']['name'] = 's_1';
      				$columnsItem['filterWidgetOptions']['options'] = ['id'=>'s_1'];
            	$pluginOptions = [
      					'inline' => false, 
                'iconChecked' => '<i class="fas fa-plus"></i>',
                'iconUnchecked' => '<i class="fas fa-minus"></i>',
                'iconNull' => '<i class="fas fa-times"></i>',
                'threeState' => true,
                'size' => 'lg',
							];
            	$columnsItem['filterWidgetOptions']['pluginOptions'] = $pluginOptions;
            }
          } else {
          	//-- simple text/select input filter
          	$columnsItem['filterInputOptions']['class'] = 'form-control';
          }
          //-- set filter values list
          if(!empty($row->filter)) {
          	$filterValues = [];
          	try {
      				$filterValues = @eval($row->filter);
						} catch(ParseError $ex) {
							Yii::$app->session->addFlash("danger", "Некорректный фильтр: <b>".$row->filter."</b> для поля ".$row->title." (".$row->field.")! Необходимо его исправить, в противном случае он будет проигнорирован!");
						}
          	if(!empty($filterValues)) {
          		if($row->filter_type === GridView::FILTER_TYPEAHEAD) {
          			$columnsItem['filterWidgetOptions'] = [
          				'pluginOptions' => ['highlight' => true],
          				'dataset' => [
          					[
          						'local' => $filterValues,
          						'limit' => 10,
          					]
          				],
          			];
          		} else {
          			$columnsItem['filter'] = $filterValues;
          		}
          	}
          }
        }
      }
    
      //-- add the item to the columns list
      $columnsList[] = $columnsItem;
    }
	}
