<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use common\models\geobase\GeobaseCity;

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
}