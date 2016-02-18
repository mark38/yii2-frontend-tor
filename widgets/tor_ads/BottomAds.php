<?php
namespace frontend\widgets\tor_ads;

use Yii;
use yii\base\InvalidConfigException;
use yii\widgets\InputWidget;
use yii\bootstrap\Html;
use common\models\tor\TorAds;


class BottomAds extends InputWidget
{
    public $ads;

    public function init()
    {
        if (empty($this->ads)) {
            throw new InvalidConfigException("The 'ads' property has not been set.");
        }
    }

    public function run()
    {
        echo Html::beginTag('div', ['class' => 'row']);
        /** @var $ad TorAds */
        foreach ($this->ads as $ad) {
            $image = $ad->gallery_groups_id && $ad->galleryGroup->galleryImage ? Html::img($ad->galleryGroup->galleryImage->small, ['class' => 'img-rounded', 'style' => 'width:100%;']) : Html::tag('small', 'Нет фото', ['class' => 'text-muted']);

            echo '<div class="col-sm-4">';
            echo '<div class="row">' .
                     '<div class="col-sm-4">' .
                        '<div class="img-block">'.Html::a($image, [$ad->link->url, 'id' => $ad->id]).'</div>' .
                        '<div>'.Html::tag('small', $ad->user->username.' ('.$ad->user->rating.')', ['class' => 'text-muted']).'</div>' .
                     '</div><div class="col-sm-8">' .
                        '<div>'.Html::a($ad->name, [$ad->link->url, 'id' => $ad->id]).'</div>' .
                        '<div>'.Html::tag('small', mb_strimwidth($ad->description, 0, 70, "...", 'utf-8')).'</div>' .
                        '<br>' .
                        '<div class="row ad-price text-right">' .
                            '<div class="col-sm-6 text-left">'.preg_replace('/\,00/', '', number_format($ad->price, 2, ',', '&thinsp;')).' руб.</div>' .
                            '<div class="col-sm-6 text-left">'.preg_replace('/\,00/', '', number_format($ad->price, 2, ',', '&thinsp;')).' руб.</div>' .
                        '</div>' .
                     '</div>' .
                 '</div>';
            echo '</div>';
        }
        echo Html::endTag('div');

        $view = $this->view;
        TorAdsAsset::register($view);
    }
}