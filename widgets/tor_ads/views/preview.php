<?php
use yii\bootstrap\Html;

/** @var $ads \common\models\tor\TorAds */
/** @var $ads_promo \common\models\tor\TorAds */

?>

<div class="row">
    <div class="col-sm-7 col-md-9">
        <?php
        /** @var $ad \common\models\tor\TorAds */
        foreach ($ads as $ad) {
            $image = $ad->gallery_groups_id && $ad->galleryGroup->galleryImage ? Html::img($ad->galleryGroup->galleryImage->small, ['class' => '', 'style' => 'width:100%;']) : Html::tag('small', 'Нет фото', ['class' => 'text-muted']);

            echo '<div class="col-sm-6 col-md-4 tor-list">' .
                    Html::a($image, [$ad->link->url, 'id' => $ad->id]) .
                    '<div class="name">'.Html::a($ad->name, [$ad->link->url, 'id' => $ad->id]).'</div>' .
                    '<div class="author">' .
                        Html::tag('span', $ad->city->name) . ' / ' .
                        Html::tag('span', '<em class="text-muted">'.$ad->user->username.' &mdash; <strong>'.$ad->user->rating.'</strong></em>') .
                    '</div>' .
                    '<div class="price">' .
                        Html::tag('span', preg_replace('/\,00/', '', number_format($ad->price, 2, ',', '&thinsp;'))) .
                        Html::tag('span', ' <small class="text-muted">('.preg_replace('/\,00/', '', number_format($ad->reward, 2, ',', '&thinsp;')).')</small> руб.') .
                    '</div>' .
                '</div>';
        }
        ?>
    </div>
    <div class="col-sm-5 col-md-3">
        <div class="vip-tor-preview">
            <h2>VIP-объявления</h2>
            <?php
            foreach ($ads_promo as $i => $ad) {
                $image = $ad->gallery_groups_id && $ad->galleryGroup->galleryImage ? Html::img($ad->galleryGroup->galleryImage->small, ['class' => '', 'style' => 'width:100%;']) : Html::tag('small', 'Нет фото', ['class' => 'text-muted']);

                echo '<div>' .
                        Html::a($image, [$ad->link->url, 'id' => $ad->id]) .
                        Html::a($ad->name, [$ad->link->url, 'id' => $ad->id]) .
                        '<div>' .
                            Html::tag('span', $ad->city->name) . ' / ' .
                            Html::tag('span', '<em class="text-muted">'.$ad->user->username.' &mdash; <strong>'.$ad->user->rating.'</strong></em>') .
                        '</div>' .
                        '<div class="price">' .
                            Html::tag('span', preg_replace('/\,00/', '', number_format($ad->price, 2, ',', '&thinsp;'))) .
                            Html::tag('span', ' <small class="text-muted">('.preg_replace('/\,00/', '', number_format($ad->reward, 2, ',', '&thinsp;')).')</small> руб.') .
                        '</div>' .
                     '</div>';

                if ($i+1 < count($ads_promo)) echo '<hr>';
            }
            ?>
        </div>
    </div>
</div>
