<?php

namespace backend\controllers;

use Yii;
use backend\models\AbstractModel;
use backend\models\AbstractModelSearch;

class AdmController extends AbstractController
{
  public function actionError()
  {
  	//echo __METHOD__;
  	return $this->render('error');
  }
  
  public function actionExample()
  {
    return $this->render('example');
  }
  public function actionHelp()
  {
    return $this->render('help');
  }
  public function actionWrong()
  {
    return $this->render('wrong');
  }
  public function actionGetsql()
  {
    return $this->render('getsql');
  }


  public function actionFlushCache()
  {
    Yii::$app->cache->flush();
    Yii::$app->session->addFlash("success", Yii::t('backend', 'Cache flushed'));
    return $this->back();
  }

  public function actionClearAssets()
  {
    foreach(glob(Yii::$app->assetManager->basePath . DIRECTORY_SEPARATOR . '*') as $asset){
      if(is_link($asset)){
        unlink($asset);
      } elseif(is_dir($asset)){
        $this->deleteDir($asset);
      } else {
        unlink($asset);
      }
    }
    Yii::$app->session->addFlash("success", Yii::t('backend', 'Assets cleared'));
    return $this->render('system');
    //return $this->back();
  }

  private function deleteDir($directory)
  {
    $iterator = new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);
    foreach($files as $file) {
      if($file->isDir()){
        rmdir($file->getRealPath());
      } else {
        unlink($file->getRealPath());
      }
    }
    return rmdir($directory);
  }

}
