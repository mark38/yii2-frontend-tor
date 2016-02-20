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
            $image = $ad->gallery_groups_id && $ad->galleryGroup->galleryImage ? Html::img($ad->galleryGroup->galleryImage->small, ['class' => '', 'style' => 'width:100%;']) : Html::tag('small', 'Нет фото', ['class' => 'text-muted']);
            echo '<div class="col-sm-6 col-md-3 bottom-ads" data-toggle="popover">';
                echo '<div class="thumbnail" data-trigger="hover" data-toggle="popover">'.
                    Html::a($image, [$ad->link->url, 'id' => $ad->id]).
                    '<div>'.Html::tag('small', $ad->user->username.' ('.$ad->user->rating.')', ['class' => 'text-muted']).'</div>' .
                    '<div class="caption">
                        <h4>'.Html::a($ad->name, [$ad->link->url, 'id' => $ad->id]).'</h4>
                        <p>'.Html::tag('small', mb_strimwidth($ad->description, 0, 70, "...", 'utf-8')).'</p>
                        <div class="row">
                            <div class="col-sm-6">'.preg_replace('/\,00/', '', number_format($ad->price, 2, ',', '&thinsp;')).' руб.</div>
                            <div class="col-sm-6 text-right">'.preg_replace('/\,00/', '', number_format($ad->price, 2, ',', '&thinsp;')).' руб.</div>
                        </div>
                    </div>';
                echo '</div>';
            echo '</div>';
        }
        echo Html::endTag('div');
        $view = $this->view;
        TorAdsAsset::register($view);
    }
}