<?php
namespace frontend\controllers;

use mark38\galleryManager\GalleryManagerAction;
use common\models\geobase\GeobaseCity;
use common\models\tor\TorAds;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\User;

class TorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['profile', 'mng-ad', 'my-ads', 'gallery-manager'],
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

    public function actions()
    {
        return [
            'gallery-manager' => [
                'class' => GalleryManagerAction::className(),
            ],
        ];
    }

    public function actionProfile()
    {
        $model = User::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post())) {
            $city = GeobaseCity::findOne(['name' => $model->geobase_city]);
            $model->city_id = $city ? $city->id : null;
            $model->save();
            Yii::$app->getSession()->setFlash('success', 'Изменения приняты');
        } else {
            $model->geobase_city = $model->city_id ? GeobaseCity::findOne($model->city_id)->name : null;
        }

        return $this->render('/tor/profile', [
            'model' => $model
        ]);
    }

    public function actionMngAd($id=null)
    {
        if (!$id) {
            $model = new TorAds();
            $model->geobase_city = User::findOne(Yii::$app->user->id)->geobase_city_id ? GeobaseCity::findOne(User::findOne(Yii::$app->user->id)->geobase_city_id)->name : null;
        } else {
            $model = TorAds::findOne($id);
            $model->geobase_city = GeobaseCity::findOne($model->city_id)->name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Объявление добавлено');
            return $this->redirect('/tor/my-ads');
        }

        return $this->render('/tor/mngAd', [
            'model' => $model,
        ]);
    }

    public function actionMyAds()
    {
        $ads = TorAds::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['created_at' => SORT_ASC])->all();
        return $this->render('/tor/myAds', [
            'ads' => $ads,
        ]);
    }


}