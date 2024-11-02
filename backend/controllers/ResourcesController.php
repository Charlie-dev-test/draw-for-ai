<?

namespace backend\controllers;

use Yii;
use backend\models\Resources;
use backend\models\ResourcesSearch;
use backend\models\Resources\ResourcesForms;
use backend\models\Resources\ResourcesColumns;
use backend\models\Resources\ResourcesConditions;
use backend\models\Resources\ResourcesRefers;
use backend\components\Controller;
use backend\controllers\AbstractController;
use yii\data\Pagination;

/**
 * Description of ResourcesController
 */
class ResourcesController extends AbstractController
{
    private $pageSize = 1000000;

    public function actionRender($id)
    {
      $model = Resources::find()->where(['id' => $id])->one()->text;
      return $model;
    }
    
    public function actionIndex()
    {
      $searchModel = new ResourcesSearch;
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      $dataProvider->pagination->pageSize = $this->pageSize;
    	$dataProvider->pagination->pageSizeLimit = [1, 500];

    	$query = $dataProvider->query;
  	  $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $this->pageSize]);
    	$pages->pageSizeParam = false;

    	$params = [
    		'model' => $searchModel,
    		'searchModel' => $searchModel,
	    	'dataProvider' => $dataProvider,
	      'pages' => $pages,
	      'pagination' => $pages,
  		];
	  	return $this->render('index', $params);
    }
    
    
    /**
     * single Resources model 
     * @return mixed
     * 
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionCreate()
    {
      $model = new Resources();
      $model->loadDefaultValues();

      if($model->load(Yii::$app->request->post()) && $model->save()) {
        //return $this->redirect(['index', 'id' => $model->id]);
        return $this->redirect(['index']);
      } else {
        return $this->render('create', ['model' => $model]);
      }
    }
    
    public function actionAdd()
    {
      $model = new Resources();
      $model->loadDefaultValues();
      $id = Yii::$app->request->get('id');
      $model->parentid = $id;
      
      if ($model->load(Yii::$app->request->post()) && $model->save()) {
         return $this->redirect(['index']); 
      } else {
          return $this->render('create', [
              'model' => $model,
          ]);
      }
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if($model->load($post)) {
        	if($model->save()) {
        		//return $this->redirect(['index', 'id' => $model->id]);
        		return $this->redirect(['index']);
        	}	else {
        		return $this->render('update', [
            	'model' => $model,
            ]);
        	}
        } else {
          return $this->render('update', [
            'model' => $model,
          ]);
        }
    }
    
    public function actionDelete($id)
    {
      //-- save ALL data before deleting...
      $result = $this->doExportSaveAction($id, Resources::MODE_SAVE);
      if($result === false) {
      	return $this->redirect(['index']);
      }

      //-- delete ALL data (resources, site data, files and folders)
      $res = new Resources();
      $result = $res->handleResources($id, Resources::MODE_DELETE);
      if($result === false) {
      	return $this->redirect(['index']);
      }
    	
    	if(Resources::$numRecordsRes > 0 || Resources::$numRecordsMod > 0) {
    		$mode = Resources::MODE_DELETE;
    		$str = "Ресурсов ".Resources::$modeMessage[$mode].": <b>".Resources::$numRecordsRes."</b><br/>";
    		$str .= "Записей ".Resources::$modeMessage[$mode].": <b>".Resources::$numRecordsMod."</b><br/>";
	    	$str .= "Папок ".Resources::$modeMessage[$mode].": <b>".Resources::$numRecordsFld."</b>";
	    	/*
	    	if($this->numRecordsFld > 0) {
    			$url = $this->downloadFile("zip");
		    	if(!empty($url)) {
  		  		$str .= "<br/><a href=\"".$url."\" target=\"_blank\">скачать ZIP-архив удаленных папок</a>";
    			}
    		}
    		*/
	    	Yii::$app->session->addFlash("danger", $str);
  	  }

    	return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if(($model = Resources::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        };
    }
    
    private function doExportSaveAction($id, $mode)
    {
    	$res = new Resources();
      $result = $res->handleResources($id, $mode);
      if($result === false) {
      	return false;
      }
    
      //Yii::$app->session->addFlash("danger", __METHOD__);
      if(Resources::$numRecordsRes > 0 || Resources::$numRecordsMod > 0) {
      	$str = "Ресурсов ".Resources::$modeMessage[$mode].": <b>".Resources::$numRecordsRes."</b><br/>";
      	$str .= "Записей ".Resources::$modeMessage[$mode].": <b>".Resources::$numRecordsMod."</b><br/>";
      	$str .= "Папок ".Resources::$modeMessage[$mode].": <b>".Resources::$numRecordsFld."</b>";
      	$url = $res->downloadFile("sql");
		    if(!empty($url)) {
    	  	$str .= "<br/><a href=\"".$url."\" target=\"_blank\">скачать SQL</a>";
      	}
      	if(Resources::$numRecordsFld > 0) {
      		$url = $res->downloadFile("zip");
		    	if(!empty($url)) {
    	  		$str .= "<br/><a href=\"".$url."\" target=\"_blank\">скачать ZIP-архив папок</a>";
      		}
      	}
      	Yii::$app->session->addFlash("success", $str);
      }

      return true;
    }
  
  /****************************************
  *
  *   !!! EXPORT RESOURCES AND DATA !!!
  *
  ****************************************/
  public function actionExport($id)
  {
    $this->doExportSaveAction($id, Resources::MODE_EXPORT);
    return $this->redirect(['index']);
  }

}
