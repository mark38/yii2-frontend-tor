<?php

namespace frontend\widgets\tor_ads;

use Yii;
use yii\base\Widget;
use common\models\tor\TorAds;

class Index extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $ads = TorAds::find()->orderBy(['created_at' => SORT_ASC, 'price' => SORT_ASC])->limit(20)->all();
        $ads_promo = TorAds::find()->limit(5)->orderBy(['created_at' => rand()])->all();

        if ($ads) {
            echo $this->render('preview', [
                'ads' => $ads,
                'ads_promo' => $ads_promo
            ]);
        }

        $view = $this->view;
        TorAdsAsset::register($view);
    }
}