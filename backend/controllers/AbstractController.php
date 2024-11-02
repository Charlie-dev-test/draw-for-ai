<?

namespace backend\controllers;

use Yii;
use backend\controllers\Controller;
use backend\controllers\ResourcesController;
use backend\models\AbstractModel;
use backend\models\AbstractModelSearch;
use backend\models\Resources;
use backend\models\Files;
use backend\models\Uploads;

use backend\models\Resources\ResourcesConditions;
use backend\models\Resources\ResourcesForms;
use backend\models\Resources\ResourcesJoins;
use backend\models\Resources\ResourcesRefers;

use yii\data\Pagination;
use yii\web\UploadedFile;

//-- AUTH
use backend\models\User;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AuthRule;

/**
 * AbstractController
 *
 * @author Tillypad-группа веб-разработки <webdevelopment@tillypad.ru>
 */
class AbstractController extends Controller
{

  private static $DEBUG = 0;
  public static $extraParams = array();
  
  private $numRecords = 0;
  private $numFolders = 0;

  private $externalModel = null;

  public function behaviors()
  {
    $actionRules = [];

    $sectionNameParameter = \Yii::$app->getRequest()->getQueryParam('section');

    //-- if the current user is not ROOT...
    if(!IS_ROOT) {
      //-- get Actions only!
      //$result = AuthRule::getAuthRules(AuthRule::TYPE_MENU, "system_menu");
      $role = null;
      $useCurrentUser = true;
      $result = AuthRule::getAuthRules(AuthRule::TYPE_ACTION, $role, $useCurrentUser);
      foreach($result as $rule) {
      	$actionRule = [];
      	$actionRule['roles'] = $rule["roles"];
      	$actionRule['controllers'] = $rule["controllers"];
      	$actionRule['ips'] = $rule["ips"];
      	$actionRule['allow'] = ($rule["allow"] == 1) ? true : false;
      
      	//-- check what denies...
      	if($rule["allow"] != 1) {
      		$ruleActions = $rule["actions"];
      		foreach($ruleActions as $action) {
      			//-- but permission allowed!
      			if(User::can($action)) {
      				//-- remove dened action
      				$rule["actions"] = \array_diff($rule["actions"], [$action]);
      			}
      		}
      	}
      	
      	//-- section "user": deny for everyone who can not "adduser"!
      	if($sectionNameParameter === "user") {
      	  $canAddUser = \Yii::$app->user->can('adduser');
          if(!$canAddUser) {
          	if(!in_array("create", $rule["actions"])) {
          		$rule["actions"][] = "create";
          	}
          	if(!in_array("update", $rule["actions"])) {
          		$rule["actions"][] = "update";
          	}
          	if(!in_array("delete", $rule["actions"])) {
          		$rule["actions"][] = "delete";
          	}
          }
      	}   
      	
      	$actionRule['actions'] = $rule["actions"];
      	
      	$actionRules[] = $actionRule;
      }
      
      //-- login + logout + error
      $actionRule = [];
      $actionRule['actions'] = ['logout','login', 'error'];
      $actionRule['allow'] = true;
      $actionRules[] = $actionRule;
    }  
      
    $actionRule = [];
    //-- list of actions
    $actionRule['actions'] = [];
    //-- list of roles
    $actionRule['roles'] = ['@'];
    //-- list of controllers
    $actionRule['controllers'] = [];
    //-- list of IPs
    $actionRule['ips'] = [];
    //-- allow | deny
    $actionRule['allow'] = true;
    //-- use when ALLOW
    $actionRule['matchCallback'] = function($rule, $action) {
      	return true;
      };
    //-- use when DENY
    $actionRule['denyCallback'] = function($rule, $action) {
      	return true;
      };
    $actionRules[] = $actionRule;

    //$methodsList = self::getAllActions();
    return [
    	'access' => [
        'class' => AccessControl::className(),
        'except' => ['error','login','logout'],
        //-- use the rules for the actions below
        //'only' => ['', 'index', 'login', 'logout', 'error'],
        //'rules' => $result,
        'rules' => $actionRules,
      ],
      /*
      'access' => [
        'class' => AccessControl::className(),
        //-- use the rules for the actions below
        'only' => ['', 'index', 'login', 'logout', 'error'],
        //'rules' => $result,
        'rules' => [
          //-- all users
          [
            //-- list of actions
            'actions' => ['index', 'error'],
            //-- list of roles
            'roles' => ['@'],
            //-- list of controllers
            'controllers' => ['site', 'adm', 'resources'],
            //-- list of IPs
            'ips' => [],
            //-- allow | deny
            'allow' => true,
            //-- use when ALLOW
            'matchCallback' => function($rule, $action) {
            	return true;
            	$cond1 = $cond2 = 123;
            	return $cond1 === $cond2;
            },
            //-- use when DENY
            'denyCallback' => function($rule, $action) {
            	return true;
            	$cond1 = 123;
            	$cond2 = 234;
            	return $cond1 !== $cond2;
            },
          ],
          //-- root & guest
          [
            'actions' => ['login'],
            'allow' => true,
            'roles' => ['root','?'],
          ],
          //-- authenticated user
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
          //[
          //  'actions' => ['index','user','ajaxuser','role'],
          //  'allow' => true,
          //  'roles' => ['root','test', '?'],
          //],
        ],
      ],
      'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
              'logout' => ['post'],
          ],
      ],
      */
    ];
  }

  /**
   * @inheritdoc
   */
  public function actions()
  {
      //$id = Yii::$app->user->identity->id;
      $id = Yii::$app->user->id;
      $login_name = User::find()->where('id = :id', [':id' => $id])->one();

      return [
          'error' => [
              'class' => 'yii\web\ErrorAction',
          ],
      ];
  }

  private static function setExtraParams()
  {
  	self::$extraParams = array();
  	$sectionId = Yii::$app->getRequest()->getQueryParam('section');
  	if(!empty($sectionId)) {
  		self::$extraParams["section"] = $sectionId;
  	}
  	$resourceId = Yii::$app->getRequest()->getQueryParam('resourceid');
  	if(!empty($resourceId)) {
  		self::$extraParams["resourceid"] = $resourceId;
  	}
  	$parentId = Yii::$app->getRequest()->getQueryParam('parentid');
  	if(!empty($parentId)) {
  		self::$extraParams["parentid"] = $parentId;
  	}
  	$pageNum = Yii::$app->getRequest()->getQueryParam('page');
  	if(!empty($pageNum)) {
  		self::$extraParams["page"] = $pageNum;
  	}
  }

  private function initModel()
  {
  	self::setExtraParams();
  	return AbstractModel::initModel();
  }

  private function initModelSearch()
  {
  	self::setExtraParams();
  	return AbstractModel::initModelSearch();
  }

  public function actionIndex()
  {
  	$model = $this->initModel();
    
    //-- form for the multiple uploads
    $className = AbstractModel::getClassName(get_class($model));
    if(!empty($_POST[$className])) {
    	if(!empty($_POST[$className]["multiple_uploads_field"])) {
    		$multipleUploadsFieldName = $_POST[$className]["multiple_uploads_field"];
    		
    		if($model->load(Yii::$app->request->post())) {
        	$picsFile = UploadedFile::getInstances($model, $multipleUploadsFieldName);
        	if(is_array($picsFile)) {
            foreach($picsFile as $file) {
            	if(isset($file->extension)) {
                if($picsId = (int)$model->saveImage($file, 0, 0, 0)) {
                  $model->$multipleUploadsFieldName = $picsId;
                  $model->id = $model->getMaxId('id') + 1;
                  $model->multipleUploads = true;
                  //-- must be set to TRUE for create new record in database
                  $model->isNewRecord = true;
                  if($model->save()) {
                  	if(!empty($model->id)) {
          						$this->saveRefers($model, $model->id);
          					}
          					Yii::$app->session->addFlash("success", "Файл (".$multipleUploadsFieldName." -> $picsId) успешно сохранен");
          				} else {
          					Yii::$app->session->addFlash("danger", 'Ошибка сохранения файла (pics): '.$picsId);
          				}
                } else {
                  Yii::$app->session->addFlash("danger", 'Ошибка сохранения файла (pics): '.$picsId);
                }
              }
            }
          }
        }

    		return $this->redirect(array_merge(['index'], self::$extraParams));
    	}
    }
  	
    $queryParams = Yii::$app->request->queryParams;

    $pageSize = 0;
    if(!empty($queryParams["section"])) {
    	//-- set orderBy clause for the searchModel
    	$res = Resources::getResourceByResourceName($queryParams["section"]);
    	if(!is_null($res)) {
    		if(!empty($res->order)) {
    			self::$extraParams["orderby"] = $res->order;
    		}

    		//-- get resources pagination
    		if(!empty($res->id)) {
        	if(!empty($res->paginate)) {
        		$pageSize = (int)$res->paginate;
        	}
    		}


    		//-- get resources joins
    		$resourceid = $res->id;
    		$m = new ResourcesJoins();
    		$rows = $m->find()->where(['resourceid' => $resourceid])->all();
	      if(!is_null($rows)) {
	      	foreach($rows as $row) {
  					if(!is_null($row) && !empty($row->model)) {
  						self::$extraParams["joins"][] = array(
  							"model" => $row->model,
  							"condition" => $row->condition,
  							"fields" => $row->fields,
  						);
  						//$this->getResourceChildren($row->id, $parentField, $titleField, false);
  					}
  				}
  			}
    	}
    }
  	$queryParams = array_merge($queryParams, self::$extraParams);
  	if(isset($queryParams["page"])) {
  		unset($queryParams["page"]);
  	}

  	$searchModel = $this->initModelSearch();
  	$dataProvider = $searchModel->search($queryParams);

  	$models = null;
  	$pages = null;
  	if(!empty($pageSize)) {
      //$pageSize = 3;
    	$dataProvider->pagination->pageSize = $pageSize;
    	$dataProvider->pagination->pageSizeLimit = [1, 500];

      $query = $dataProvider->query;
      $countQuery = clone $query;

      //$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
      $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $pageSize]);
      $pages->pageSizeParam = false;
    }

  	$params = [
    	'model' => $searchModel,
    	'searchModel' => $searchModel,
    	'dataProvider' => $dataProvider,
    	//'models' => $models,
      'pages' => $pages,
      'pagination' => $pages,
  	];

  	return $this->render('index', $params);
  }

  private function getUnderstandableMessage($ex)
  {
  	$msg = $ex->getMessage();
    if(preg_match("{Duplicate entry '(.*?)' for key '(.*?)'}si", $msg, $matches)) {
    	$val = $matches[1];
    	$fld = $matches[2];
    	$msg = "Значение \"".$val."\" уже существует!";
    	/*
    	$attrs = $model->attributeLabels();
    	if(!empty($attrs[$fld])) {
    		$fldName = $attrs[$fld];
    		$msg = "Значение \"".$val."\" поля \"".$fldName."\" уже существует!";
    	}
    	*/
    	Yii::$app->session->addFlash("danger", $msg);
    } else {
    	Yii::$app->session->addFlash("danger", $msg);
    }
  }

  public function actionCreate()
  {
    $model = $this->initModel();
    $model->loadDefaultValues();

    try {
      if($model->load(Yii::$app->request->post()) && $model->save()) {
      	if(!empty($model->id)) {
      		$id = $model->id;
        	$this->saveRefers($model, $id);
        }
        return $this->redirect(array_merge(['index'], self::$extraParams));
      } else {
        return $this->render('create', ['model' => $model]);
      }
    } catch(yii\db\IntegrityException $ex) {
    	$this->getUnderstandableMessage($ex);
    }
    return $this->render('create', ['model' => $model]);
  }

  public function actionAdd()
  {
    $model = $this->initModel();
    $model->loadDefaultValues();

    $id = Yii::$app->request->get('id');
    $model->parentid = $id;

    try {
      if($model->load(Yii::$app->request->post()) && $model->save()) {
        /*
        if(!empty($model->id)) {
        	$model->upload();
        }
        */
        return $this->redirect(array_merge(['index'], self::$extraParams));
      } else {
        return $this->render('create', ['model' => $model]);
      }
    } catch(yii\db\IntegrityException $ex) {
    	$this->getUnderstandableMessage($ex);
    }
    return $this->render('create', ['model' => $model]);
  }

  private function saveRefers($model, $id)
  {
  	$className = AbstractModel::getClassName(get_class($model));
  	$formPost = $_POST[$className];

  	$sectionNameParameter = Yii::$app->getRequest()->getQueryParam('section');
		$parentIdParameter = Yii::$app->getRequest()->getQueryParam('parentid');
		$resource = Resources::getResourceByResourceName($sectionNameParameter);
		if(!empty($resource->id)) {
			$m = new ResourcesForms();
			$m->getResourceChildrenFull(
				$resource->id,
				Resources::$resourcesData["ResourcesForms"]["parentField"],
				Resources::$resourcesData["ResourcesForms"]["titleField"]
			);
			$rowsForms = $m->resourcesChildren;
			foreach($rowsForms as $row) {
    		if(!empty($row->field)) {
    			if($row->type === "MultiCheckbox") {
						$rowField = $row->field;
						//-- get all refers for the resource
						$rowsRefers = ResourcesRefers::getResourcesByResourceId($resource->id);
						//-- get refers info for the $rowField
						$refersInfo = ResourcesRefers::getRefersInfo($rowsRefers, $rowField);
						//-- $modelObj = model-refferer (where to save the data from the MultiCheckbox)
						if(!is_null($refersInfo) && !empty($refersInfo->model_object)) {
							$modelObj = $refersInfo->model_object;
							$refField1 = $refersInfo->field1;
							$refField2 = $refersInfo->field2;

							//-- delete all rows for the ID
							$modelObj->deleteAll([$refField2 => $id]);

							//-- get values to add for the POST
							$values = $formPost[$rowField];
							if(is_array($values)) {
								foreach($values as $value) {
									$mod = new $modelObj();
									$mod->$refField1 = $value;
									$mod->$refField2 = $id;
									$mod->save();
								}
							}
						}
					}
    		}
			}
		}
  }

  public function actionUpdate($id)
  {
    $modelObj = $this->initModel();
    $model = $modelObj::findOne($id);
    try {
      if($model->load(Yii::$app->request->post()) && $model->save()) {
        $this->saveRefers($model, $id);
        $params = self::$extraParams;
        $params["model"] = $model;
        return $this->redirect(array_merge(['index'], $params));
      } else {
        return $this->render('update', ['model' => $model]);
      }
    } catch(yii\db\IntegrityException $ex) {
    	$this->getUnderstandableMessage($ex);
    }
    return $this->render('update', ['model' => $model]);
  }

  public function actionView($id)
  {
    $modelObj = $this->initModel();
    $model = $modelObj::findOne($id);
    return $this->render('view', ['model' => $model]);
  }

  public function actionDelete($id)
  {
  	if(!is_null($this->externalModel)) {
  		$modelObj = $this->externalModel;
  	} else {
  		$modelObj = $this->initModel();
  	}
  	$modelId = $id;

  	$mode = Resources::MODE_DELETE;

  	$this->numRecords = 0;
  	$this->numFolders = 0;

  	$this->handleChildren($modelObj, $modelId);

  	//-- handle ALL children
  	AbstractModel::getChildrenList($modelObj, $modelId);
  	foreach(AbstractModel::$childrenList as $itemId) {
  		$this->handleChildren($modelObj, $itemId);
  	}
  	
  	if($this->numRecords > 0) {
    	$str = "Записей ".Resources::$modeMessage[$mode].": <b>".$this->numRecords."</b><br/>";
	    $str .= "Папок ".Resources::$modeMessage[$mode].": <b>".$this->numFolders."</b>";
    	Yii::$app->session->addFlash("warning", $str);
    }
    return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
  }

  private function handleChildren($modelObj, $modelId)
  {
  	$id = $modelId;

  	if(!empty(self::$extraParams["section"])) {
  		$sectionId = self::$extraParams["section"];

  		$rowsResource = Resources::getResourceByResourceName($sectionId);
  		if(!empty($rowsResource->id)) {
  			$resourceid = $rowsResource->id;
  			
  			//-- get all children for ResourcesRefers
  			$m = new ResourcesRefers();
  			$m->getResourceChildren(
  				$resourceid,
  				Resources::$resourcesData["ResourcesRefers"]["parentField"],
  				Resources::$resourcesData["ResourcesRefers"]["titleField"]
  			);
  			$rowsRefers = $m->resourcesChildren;
  			if(!empty($rowsRefers)) {
  				//-- look for the field name to get RefersInfo
  				foreach($rowsRefers as $refId => $rowField) {
  					//-- get all ResourcesRefers
  					$rowsRefersAll = ResourcesRefers::getResourcesByResourceId($resourceid);
  					//-- get all RefersInfo
  					$refersInfo = ResourcesRefers::getRefersInfo($rowsRefersAll, $rowField);
						//-- $modelObj = model-refferer (where to delete from)
						if(!is_null($refersInfo->model_object)) {
							$modelObject = $refersInfo->model_object;
							$refField1 = $refersInfo->field1;
							$refField2 = $refersInfo->field2;

							//-- delete all refers
							$modelRefers = $modelObject::find()->where([$refField2 => $id])->all();
							$this->numRecords += count($modelRefers);
							$modelObject->deleteAll([$refField2 => $id]);
						}
  				}
  			}

  			$result = Resources::getResourcesList($resourceid, $id);
  			if(is_null($result)) {
  				return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
  			}

  			foreach(Resources::$resourcesList as $resourcesItem) {
  				$className = $resourcesItem["className"];
  				$id = $resourcesItem["id"];
  	      $uploads = $resourcesItem["uploads"];

  	      //-- delete uploads rows and folders/files
  				$uploadsModel = new Uploads();
  				foreach($uploads as $uploadId) {
  					$row = $uploadsModel->getFile($uploadId);
  					if(!empty($row->id)) {
							$uploadsModel->removeFileDir($uploadId);
  						$this->numFolders++;
  						$this->numRecords++;
  					}
  				}

  				//-- delete children rows
  				$modelInstance = AbstractModel::getAbstractModel($className, true);
  				if(($model = $modelInstance->findOne($id))) {
						$model->delete();
    				$this->numRecords++;
    			}
  			}
      }
      //-- delete current row
	  	if(($model = $modelObj->findOne($modelId))) {
				$model->delete();
  	  	$this->numRecords++;
    	}
  	}
  }

  public function getAbstractModel($id, $isParamId=true)
  {
  	$abstractModel = new AbstractModel();
  	$model = $abstractModel->getAbstractModel($id, $isParamId);
  	return $model;
  }

  public function actionUp()
  {
    	$model = $this->initModel();

      if(isset($_GET['id'])) {

          $actionRow = $model->findOne($_GET['id']);
          if(!empty($actionRow)) {
          		//порядковый номер следующего элемента @return string

              $parentId = AbstractModel::chkAttributes($actionRow, "parentid");
              $orderId = AbstractModel::chkAttributes($actionRow, "orderid");
              $orderPrev = $this->getPrevOrder($parentId, $orderId);
              $decrementOnly = false;
              if(is_null($orderPrev) && $orderId > 1) {
              	$orderPrev = $orderId - 1;
              	$decrementOnly = true;
              }
              if(!is_null($orderPrev)) {
                  if($decrementOnly) {
                  	//-- decrement current OrderID only!
                  	$actionRow->orderid = $orderPrev;
                  	if(!$actionRow->update(false)) {
                      //echo ("Ошибка: обновление текущего элемента не завершено корректно. Необходимо сбросить порядок следования.");
                      //exit();
                    } else {
                      return $this->redirect(array_merge(['index'], self::$extraParams));
                    }
                  } else {
                  	//-- switch two OrderIDs...
                    $switchRow = $this->findOneByKey($parentId, $orderPrev);
                    $tempOrder = $actionRow->orderid;
                    $actionRow->orderid = $switchRow->orderid;
                    $switchRow->orderid = $tempOrder;
                    
                    if(!($switchRow->update(false) && $actionRow->update(false))) {
                        //echo ("Ошибка: обновление перемещаемых элементов не завершено корректно. Необходимо сбросить порядок следования.");
                        //exit();
                    } else {
                        return $this->redirect(array_merge(['index'], self::$extraParams));
                    }
                  }

              } else {
                  //echo("Сообщение: элемент уже находится в начале списка");
              }

          } else {
              //echo("Ошибка: элемент не найден в базе данных");
              //exit();
          }
      } else {
          //echo ("Ошибка: не найден id перемещаемого элемента");
          //exit();
      }
      return $this->redirect(array_merge(['index'], self::$extraParams));
  }

  public function actionDown()
  {
      $model = $this->initModel();
      if(isset($_GET['id'])) {
          $actionRow = $model->findOne($_GET['id']);
          if(!empty($actionRow)) {
              //порядковый номер следующего элемента @return string

              $parentId = AbstractModel::chkAttributes($actionRow, "parentid");
              $orderId = AbstractModel::chkAttributes($actionRow, "orderid");
              $orderNext = $this->getNextOrder($parentId, $orderId);
              $incrementOnly = false;
              if(is_null($orderNext)) {
              	$orderNext = $orderId + 1;
              	$incrementOnly = true;
              }
              if(!empty($orderNext)) {
                  if($incrementOnly) {
                  	//-- increment current OrderID only!
                  	$actionRow->orderid = $orderNext;
                  	if(!$actionRow->update(false)) {
                      //echo ("Ошибка: обновление текущего элемента не завершено корректно. Необходимо сбросить порядок следования.");
                      //exit();
                    } else {
                      return $this->redirect(array_merge(['index'], self::$extraParams));
                    }
                  } else {
                  	//-- switch two OrderIDs...
                    $switchRow = $this->findOneByKey($parentId, $orderNext);
                    $tempOrder = $actionRow->orderid;
                    $actionRow->orderid = $switchRow->orderid;
                    $switchRow->orderid = $tempOrder;
                    
                    if(!($switchRow->update(false) && $actionRow->update(false))) {
                      //echo ("Ошибка: обновление перемещаемых элементов не завершено корректно. Необходимо сбросить порядок следования.");
                      //exit();
                    } else {
                      return $this->redirect(array_merge(['index'], self::$extraParams));
                    }
                  }

              } else {
                  //echo("Сообщение: элемент уже находится в конце списка");
                  //exit();
              }

          } else {
              //echo("Ошибка: элемент не найден в базе данных");
              //exit();
          }
      } else {
          //echo ("Ошибка: не найден id перемещаемого элемента");
          //exit();
      }
      return $this->redirect(array_merge(['index'], self::$extraParams));
  }

  public function actionLeft()
  {
      $model = $this->initModel();

      if(isset($_GET['id'])) {
          //сам эелемент
          $actionRow = $model::findOne($_GET['id']);
          //если id получен, то элемент скорее всего существует.. исключение - запрос, сделанный вручную...
          if(!empty($actionRow) && !empty($actionRow->parentid)) {
              //текущий родитель
              $parentRow = $model::findOne($actionRow->parentid);
              //маловероятное исключение
              if(!empty($parentRow)) {

                  $queryCondition = ['and', ['parentid' => $parentRow->parentid], ['>', 'orderid', $parentRow->orderid]];

                  if($model::find()->where($queryCondition)->count() !== 0) {
                      if (!($model::find()->where($queryCondition)->count() == $model::updateAllCounters(['orderid' => 1], $queryCondition))) {
                          //echo ("Ошибка: изменение порядка следования в списке. Необходимо сбросить порядок следования.");
                          //exit();
                      }
                  }

                  $tempOrder = $actionRow->orderid;
                  $actionRow->parentid = $parentRow->parentid;
                  $actionRow->orderid = $parentRow->orderid + 1;

                  if($actionRow->update(false)) {

                      $queryCondition = ['and', ['parentid' => $parentRow->id], ['>', 'orderid', $tempOrder]];

                      if($model::find()->where($queryCondition)->count() !== 0) {
                          if(!($model::find()->where($queryCondition)->count() == $model::updateAllCounters(['orderid' => -1], $queryCondition))) {
                              //echo ("Ошибка: восстановление порядка следования в списке. Необходимо сбросить порядок следования");
                              //exit();
                          }
                      }
                      return $this->redirect(array_merge(['index'], self::$extraParams));
                  } else {
                      //echo ("Ошибка: обновление перемещаемого элемента не завершено корректно. Необходимо сбросить порядок следования элементов.");
                      //exit();
                  }
              } else {
                  //echo("Ошибка: не найден родительский элемент");
                  //exit();
              }
          } else {
              //echo("Ошибка: элемент не найден в базе данных");
              //exit();
          }
      } else {
          //echo ("Ошибка: не найден id перемещаемого элемента");
          //exit();
      }
      return $this->redirect(array_merge(['index'], self::$extraParams));
  }

  public function actionRight()
  {
      $model = $this->initModel();

      if(isset($_GET['id'])) {
          //сам элемент
          $actionRow = $model::findOne($_GET['id']);
          //убедиться что имеем эелемент
          if(!empty($actionRow)) {
              /*предыдущий элемент - будущий родитель
               * @return string
               */

              $parentId = AbstractModel::chkAttributes($actionRow, "parentid");
              $orderId = AbstractModel::chkAttributes($actionRow, "orderid");
              $prevRowOrder = $this->getPrevOrder($parentId, $orderId);
              // Важная проверка - если предыдущего элемента не существует - прервать перемещение
              if(!is_null($prevRowOrder)) {

                  // строка-модель будущего родителя @return string, аргумент - метод, возвращающий нужный id по паре родитель-порядок)
                  $parentRow = $this->findOneByKey($parentId, $prevRowOrder);
                  $actionRow->parentid = $parentRow->id;
                  //будущее положение - помещаем в конец списка, если эелементов нет, то -1 (тогда элемент окажется в 0)
                  $orderMax = $model::find()->where(['parentid' => $parentRow->id])->max('orderid');
                  $orderMax = !is_null($orderMax) ? $orderMax : -1;
                  $actionRow->orderid = $orderMax + 1;

                  if($actionRow->update(false)) {

                      $condition = ['and', ['parentid' => $parentRow->parentid], ['>', 'orderid', $parentRow->orderid + 1]];
                      //восстановление порядка при перемещении элемента
                      if($model::find()->where($condition)->count() !== 0) {
                          if(!($model::find()->where($condition)->count() == $model::updateAllCounters(['orderid' => -1], $condition))) {
                              //echo("Ошибка: восстановление порядка следования в списке. Необходимо сброить порядок следования на родительском уровне.");
                              //exit();
                          }
                      }
                      return $this->redirect(array_merge(['index'], self::$extraParams));
                  } else {
                      //echo("Ошибка: ошибка обновления элемента в списке");
                      //exit();
                  }
              } else {
                  //echo('Сообщение: нельзя переместить элемент, находящийся на верхнем уровне иерархии');
                  //exit();
              }
          } else {
              //echo("Ошибка: элемент не найден в базе данных");
              //exit();
          }
      } else {
          //echo("Ошибка: не найден id перемещаемого элемента");
          //exit();
      }
      return $this->redirect(array_merge(['index'], self::$extraParams));
  }

  public function actionActive($id)
  {
  	if(!is_null($this->externalModel)) {
  		$model = $this->externalModel;
  	} else {
  		$model = $this->initModel();
  	}
    $actionRow = $model::findOne($id);
    if(!empty($actionRow)) {
      $activeValue = AbstractModel::chkAttributes($actionRow, "active");
      if(!is_null($activeValue)) {
        //-- save inversive value of the field "active"
        try {
          \Yii::$app->db->createCommand("UPDATE `".$model::tableName()."` SET `active`=:active WHERE id=:id")
						->bindValue(':id', $id)
						->bindValue(':active', !empty($activeValue) ? 0 : 1)
						->execute()
					;
				} catch(yii\db\Exception $e) {
					Yii::$app->session->addFlash("warning", 'Ошибка активации/деактивации: <b>'.$e->getMessage().'</b>');
				}
      }
    }
    return $this->redirect(array_merge(['index'], self::$extraParams));
  }

  

	public function getPrevOrder($parentid, $orderid)
  {
    $model = $this->initModel();

    //-- check if "orderid" exists
    if(is_null($orderid)) {
    	Yii::$app->session->addFlash("warning", "Сортировка невозможна: отсутствует поле \"orderid\"!");
    	return null;
    }

    $obj = $model::find()
      ->where(['<', 'orderid', $orderid])
    ;
    //-- check if "parentid" exists
    if(!is_null($parentid)) {
    	$obj->andWhere(['parentid' => $parentid]);
    }

    return $obj->max('orderid');
  }

  public function findOneByKey($parentid, $orderid)
  {
    $model = $this->initModel();

    //-- check if "orderid" exists
    if(is_null($orderid)) {
    	Yii::$app->session->addFlash("warning", "Сортировка невозможна: отсутствует поле \"orderid\"!");
    	return null;
    }

    $obj = $model::find()
      ->where(['orderid' => $orderid])
    ;
    //-- check if "parentid" exists
    if(!is_null($parentid)) {
    	$obj->andWhere(['parentid' => $parentid]);
    }

    return $obj->one();
  }

  public function getNextOrder($parentid, $orderid)
  {
    $model = $this->initModel();

    //-- check if "orderid" exists
    if(is_null($orderid)) {
    	Yii::$app->session->addFlash("warning", "Сортировка невозможна: отсутствует поле \"orderid\"!");
    	return null;
    }

    $obj = $model::find()
      ->where(['>', 'orderid', $orderid])
    ;
    //-- check if "parentid" exists
    if(!is_null($parentid)) {
    	$obj->andWhere(['parentid' => $parentid]);
    }
    
    return $obj->min('orderid');
  }

  public function getMaxOrder()
  {
    $model = $this->initModel();

    return $model::find()
      ->max('orderid');
  }

	protected function findModel($id)
  {
    if(($model = AbstractModel::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    };
  }

  public static function getAllActions()
	{
    $controllerList = [];
    if($handle = opendir('../controllers')) {
      while(false !== ($file = readdir($handle))) {
        if($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
          $controllerList[] = $file;
        }
      }
      closedir($handle);
    }
    asort($controllerList);
    $fullList = [];
    foreach($controllerList as $controller) {
      $handle = fopen('../controllers/'.$controller, "r");
      if($handle) {
        while(($line = fgets($handle)) !== false) {
          if(preg_match('/public function action(.*?)\(/', $line, $display)) {
            if(strlen($display[1]) > 1) {
              $controllerName = strtolower(str_replace("Controller", "", $controller));
              $fullList[substr($controllerName, 0, -4)][] = strtolower($display[1]);
            }
          }
        }
      }
      fclose($handle);
    }
    return $fullList;
	}

	public function actionMultipleDelete()
	{
		$this->multipleActions("delete");
	}

	public function actionMultipleActive()
	{
		$this->multipleActions("active");
	}

	private function multipleActions($action)
	{
		$ids = Yii::$app->request->post('ids');
		$model = urldecode(Yii::$app->request->post('model'));
		$query = json_decode(Yii::$app->request->post('query'));
		foreach($query as $k => $v) {
			self::$extraParams[$k] = $v;
		}
		if(is_array($ids) && count($ids) > 0) {
			$this->externalModel = AbstractModel::initModel($model);
			foreach($ids as $id) {
				if($action === "delete") {
					$this->actionDelete($id);
				}
				if($action === "active") {
					$this->actionActive($id);
				}
			}
			$this->externalModel = null;
		}
		return $this->redirect(array_merge(['index'], self::$extraParams));
	}

}
