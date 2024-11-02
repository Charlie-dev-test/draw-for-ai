<?php

namespace backend\controllers\resources;

use Yii;
use backend\models\Resources\ResourcesFormsParams;
use backend\models\Resources\ResourcesFormsParamsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\AbstractController;
/**
 * Description of FormsController
 */
class FormsparamsController extends AbstractController
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
    
    public function actionRender($id)
    {
        $model = ResourcesFormsParams::find()
                ->where(['id' => $id])
                ->one()->text;
        return $model;
    }
    
    public function actionIndex() {
        $searchModel = new ResourcesFormsParamsSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    /**
     * single ResourcesFormsParams model 
     * @return mixed
     * 
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionCreate() {
        $model = new ResourcesFormsParams();
        if($model->load(Yii::$app->request->post() && $model->save())) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionAdd()
    {
        $formId = (int)Yii::$app->getRequest()->getQueryParam('formid');
        $resourceId = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
        
        $model = new ResourcesFormsParams();
        $model->loadDefaultValues();
        $id = Yii::$app->request->get('id');
        $model->parentid = 0;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect([
      	'index',
      	//'id' => $model->id,
      	'resourceid' => $resourceId,
      	'formid' => $formId,
      ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionUpdate($id) {
        $formId = (int)Yii::$app->getRequest()->getQueryParam('formid');
        $resourceId = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
        
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
      	'index',
      	'resourceid' => $resourceId,
      	'formid' => $formId,
      ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionDelete($id) {
        $formId = (int)Yii::$app->getRequest()->getQueryParam('formid');
        $resourceId = (int)Yii::$app->getRequest()->getQueryParam('resourceid');
        
        $this->findModel($id)->delete();
        return $this->redirect([
      	'index',
      	'resourceid' => $resourceId,
      	'formid' => $formId,
      ]);
    }
    
    protected function findModel($id) {
        if(($model = ResourcesFormsParams::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        };
    }
    
}
