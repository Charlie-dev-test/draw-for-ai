<?php

namespace frontend\controllers;

use yii\web\Controller;

class UsertaskController extends Controller
{

  public function actionIndex()
  {
    $params = [
    	//"issues" => $this->getMenuIssues(),
    ];
    return $this->render('index', $params);
  }

}
