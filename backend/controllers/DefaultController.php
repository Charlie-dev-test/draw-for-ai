<?php

namespace backend\controllers;

//use backend\controllers\SiteController;

class DefaultController extends SiteController//\backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}