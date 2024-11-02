<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\Languages;
use backend\models\Issues;
use backend\helpers\Meta;


class SiteController extends Controller
{

    private $langId = 1;
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                        [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                //'class' => 'frontend\controllers\Error',
                //'class' => 'frontend\controllers\SiteController',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'class' => 'common\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'fixedVerifyCode' => null,
            ],
        ];
    }

    public function beforeAction($action)
    {
      if(!parent::beforeAction($action)) {
        return false;
      }

      //-- save language into the session
      $session = Yii::$app->session;
      !$session->isActive ? $session->open() : $session->close();
      Yii::$app->language = $session->get('language');
      $session->close();

      //-- set meta-tags
			Meta::setMeta();

			if($action->id == 'error') {
      	//$this->layout = 'error';
      }
			
      return true;
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $params = [
        	"issues" => $this->getMenuIssues(),
        ];
        return $this->render('index', $params);
    }

    public function actionAbout()
    {
        $params = [
        	"issues" => $this->getMenuIssues(),
        ];
        return $this->render('about', $params);
    }
    public function actionContacts()
    {
        $params = [
        	"issues" => $this->getMenuIssues(),
        ];
        return $this->render('contacts', $params);
    }
    public function actionInfo()
    {
        $params = [
        	"issues" => $this->getMenuIssues(),
        ];
        return $this->render('info', $params);
    }
    public function actionNews()
    {
        $params = [
        	"issues" => $this->getMenuIssues(),
        ];
        return $this->render('news', $params);
    }
    public function actionForm()
    {
        $params = [];
        return $this->render('form', $params);
    }

    public function actionNewsCompany()
    {
        $params = [
        	"issues" => $this->getMenuIssues(),
        ];
        return $this->render('news_company', $params);
    }

    public function actionNewsDealers()
    {
        $params = [
        	"issues" => $this->getMenuIssues(),
        ];
        return $this->render('news_dealers', $params);
    }

    public function actionError()
    {
      \FB::log(__METHOD__);
      
      $app = Yii::app();
			if($error = $app->errorHandler->error->code) {
    		if($app->request->isAjaxRequest) {
        	echo $error['message'];
    		} else {
        	$this->render( 'error' . ( $this->getViewFile( 'error' . $error ) ? $error : '' ), $error );
				}
			}
        
      $params = [
      	"issues" => $this->getMenuIssues(),
      ];
      return $this->render('error', $params);
    }

    private function getMenuIssues()
    {
    	$issues = new Issues();
    	$showAll = false;
    	$menuIssues = $issues->getIssuesByResource("menus-issues", Meta::$PAGE_MENU_ID, Meta::$LANG_ID, $showAll);
    	$this->view->params["issues"] = $menuIssues;
    	return $menuIssues;
    }

    public function actionChangelanguage($lang = 'ru-RU')
    {
    	$lands = new Languages();
  		$langCodeArrayList = array_keys($lands->fetchPairs(["code", "id"]));
      $selectedLanguage = in_array($lang, $langCodeArrayList) ? $lang : 'ru';
      $session = Yii::$app->session;
      !$session->isActive ? $session->open() : $session->close();
      $session->set('language', $selectedLanguage);
      $session->close();

      return isset($_SERVER['HTTP_REFERER']) ? $this->redirect($_SERVER['HTTP_REFERER']) : $this->redirect(Yii::$app->homeUrl);
    }

    public function actionUsertask()
    {
        $params = [
        	//"issues" => $this->getMenuIssues(),
        ];
        return $this->render('usertask', $params);
    }
}
