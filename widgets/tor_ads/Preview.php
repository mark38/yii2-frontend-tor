<?php

namespace frontend\widgets\tor_ads;

use Yii;
use yii\base\Widget;
use common\models\tor\TorAds;
use common\models\main\Links;
use yii\bootstrap\Html;

class Preview extends Widget
{
    public $url;
    private $links_id = array();

    public function init()
    {
        parent::init();
    }

    public function getLinksId($parent=null)
    {
        $links = Links::find()->where(['parent' => $parent])->all();
        /** @var $link Links */
        foreach ($links as $link) {
            $this->links_id[] = $link->id;
            if ($link->child_exist == 1) $this->getLinksId($link->id);
        }
    }

    public function run()
    {
        $link = Links::findOne(['url' => '/'.$this->url]);
        $this->links_id[] = $link->id;
        if ($link->child_exist == 1) $this->getLinksId($link->id);

        $ads = TorAds::find()->where(['links_id' => $this->links_id])->orderBy(['created_at' => SORT_ASC, 'price' => SORT_ASC])->limit(20)->all();
        $ads_promo = TorAds::find()->where(['links_id' => $this->links_id])->limit(5)->orderBy(['created_at' => rand()])->all();

        if ($ads) {
            echo $this->render('preview', [
                'ads' => $ads,
                'ads_promo' => $ads_promo
            ]);
        } else {
            echo Html::tag('div', '<em>Для заданных параметров товар не найден</em>', ['class' => 'text-center text-muted']);
        }

        $view = $this->view;
        TorAdsAsset::register($view);
    }
}