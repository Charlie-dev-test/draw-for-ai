<?

namespace frontend\controllers;

use yii\web\ErrorAction;

class Error extends ErrorAction
{
	private $errorAction = "error";
	
	public function run()
  {
    return parent::run();
  }
}
