<?php


namespace api\controllers;

use api\models\Offer;
use yii\rest\Controller;
use yii\filters\Cors;
use api\models\Client;
use Yii;

class OfferController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'cors' => Cors::class
        ]);
    }

    public function actionLast()
    {
        return Offer::getActiveOffer();
    }

    public function actionToken() {
        return Offer::getOfferToken();
    }
}