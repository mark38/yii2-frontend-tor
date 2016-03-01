<?php

namespace frontend\widgets\tor_ads;

use Yii;
use yii\base\Widget;
use yii\bootstrap\Html;
use common\models\tor\TorAds;

class Full extends Widget
{
    public $adId;
    private $torAd;

    public function init()
    {
        $this->torAd = TorAds::findOne($this->adId);
        parent::init();
    }

    public function run()
    {
        if ($this->torAd) {
            echo $this->render('full', ['torAd' => $this->torAd]);
        } else {
            echo Html::tag('div', '<em>По Вашему запросу ничего не найдено</em>', ['class' => 'text-center text-muted']);
        }


        $view = $this->view;
        TorAdsAsset::register($view);
    }
}