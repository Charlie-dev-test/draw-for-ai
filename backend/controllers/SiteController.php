<?php
namespace backend\controllers;

use Yii;
use backend\controllers\AbstractController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AccessLogs;
//use backend\models\User;
use backend\models\Formuser;
use yii\db\Query;
use yii\httpclient\Client;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends AbstractController
{

    public function actionIndex()
    {
        $data = "";
        return $this->render('index',['data'=> $data]);
    }

}
