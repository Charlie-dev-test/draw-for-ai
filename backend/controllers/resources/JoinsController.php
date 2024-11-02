<?php

namespace backend\controllers\resources;

use Yii;
use backend\models\Resources\ResourcesJoins;
use backend\models\Resources\ResourcesJoinsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\AbstractController;
/**
 * Description of JoinsController
 */
class JoinsController extends AbstractController
{
    
    /*
    * @behaviors 
    */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST']
                ]
            ]
        ];
    }
    
    public function actionRender($id) {
        $model = ResourcesJoins::find()
                ->where(['id' => $id])
                ->one()->text;
        return $model;
    }
    
    public function actionIndex() {
        $searchModel = new ResourcesJoinsSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    /**
     * single ResourcesJoins model 
     * @return mixed
     * 
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionCreate() {
        $model = new ResourcesJoins();
        if($model->load(Yii::$app->request->post() && $model->save())) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionAdd() {
        $resourceId = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
        $model = new ResourcesJoins();
        $model->loadDefaultValues();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect([
      	'index',
      	//'id' => $model->id,
      	'resourceid' => $resourceId,
      ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionUpdate($id) {
        $resourceId = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
      	'index',
      	'resourceid' => $resourceId,
      ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionDelete($id) {
        $resourceId = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
        $this->findModel($id)->delete();
        return $this->redirect([
      	'index',
      	'resourceid' => $resourceId,
      ]);
    }
    
    protected function findModel($id) {
        if(($model = ResourcesJoins::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        };
    }
    
}