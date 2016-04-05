<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use common\models\geobase\GeobaseCity;
use yii\web\Response;
use yii\web\Session;

class GeobaseController extends Controller
{
    public function actionCityList()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $city_list = ArrayHelper::getColumn(GeobaseCity::find()->where(['like', 'name', Yii::$app->request->get('q')])->all(), 'name');
            return $city_list;
        }
    }

    public function actionSetCitySession() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $city = Yii::$app->request->post('suggestion');
            $session = new Session;
            $session->open();
            $session['city'] = $city;  // set session variable 'name3'
            return true;
        }
    }

    public function actionGetCitySession() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $session = new Session;
            $session->open();
            if ($city = $session['city']) {
                return $city;
            }
        }
        return false;
    }
}