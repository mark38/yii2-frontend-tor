<?php

namespace frontend\widgets\tor_ads;

use Yii;
use yii\base\Widget;
use yii\bootstrap\Html;

class Full extends Widget
{
    public $url;
    private $links_id = array();

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        echo Html::tag('div', '<em>Страница в разработке, зайдите позднее</em>', ['class' => 'text-center text-muted']);

        $view = $this->view;
        TorAdsAsset::register($view);
    }
}