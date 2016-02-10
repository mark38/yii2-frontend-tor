<?php
use yii\helpers\Html;
use evgeniyrru\yii2slick\Slick;

/* @var $this \yii\web\View */
/* @var $gl_group \common\models\gl\GlGroups */

/*echo Html::beginTag('div', ['class' => 'owl-promo']);
foreach ($gl_group->glImgs as $img) {
    if ($img->url) {
        echo Html::tag('div',
            Html::a(Html::img($img->img_small, ['alt' => $img->title]), [$img->url], ['title' => $img->title,]),
            ['class' => 'item']
        );
    } else {
        echo Html::tag('div', Html::img($img->img_small, ['alt' => $img->title]), ['class' => 'item']);
    }
}
echo Html::endTag('div');*/

if ($gl_group) {
    foreach ($gl_group->glImgs as $img) {
        if ($img->url) {
            $items[] = Html::a(Html::img($img->img_small, ['alt' => $img->title, 'style' => 'width:100%;']), [$img->url], ['title' => $img->title]);
        } else {
            $items[] = Html::img($img->img_small, ['alt' => $img->title, 'style' => 'width:100%; margin:0 1px;']);
        }
    }

    echo Slick::widget([
        'itemContainer' => 'div',
        'containerOptions' => ['class' => ''],
        'items' => $items,
        'itemOptions' => ['class' => 'cat-image'],
        'clientOptions' => [
            'arrows' => false,
            'autoplay' => true,
            'dots'     => true,
            'forceFitColumns' => true,
            'autoplaySpeed' => 6500,
            /*'fade' => true,
            'speed' => 500,
            'cssEase' => 'linear',*/
        ],
    ]);
}
?>
