<?php

namespace frontend\widgets\tor_ads;

use Yii;
use yii\base\Widget;
use common\models\tor\TorAds;

class Homepage extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $ads = TorAds::find()->orderBy(['created_at' => SORT_ASC, 'price' => SORT_ASC])->limit(20)->all();

        if ($ads) {
            echo $this->render('preview', [
                'ads' => $ads
            ]);
        }

        $view = $this->view;
        TorAdsAsset::register($view);
    }
}