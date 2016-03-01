<?php
namespace frontend\widgets\gallery;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use evgeniyrru\yii2slick\Slick;
use newerton\fancybox\FancyBox;
use common\models\gallery\GalleryImages;

class GalleryAd extends Widget
{
    public $gallery_groups_id;
    public $imageSliderForOtions = [];

    public function init()
    {
        if (empty($this->gallery_groups_id)) {
            throw new InvalidConfigException("The 'gallery_groups_id' property has not been set.");
        }
    }

    public function run()
    {
        $images = GalleryImages::find()->where(['gallery_groups_id' => $this->gallery_groups_id])->orderBy('seq')->all();
        if (!$images) return false;



        foreach ($images as $i => $image) {
            $items_large[] = Html::a(Html::img($image->large, ['class' => 'img-rounded']), $image->large, ['rel' => 'gl-fancybox']);
            $items_small[] = Html::img($image->small, ['class' => 'gl-slider-prev']);
        }

        echo Slick::widget([
            'itemContainer' => 'div',
            'containerOptions' => ['class' => 'gl-slider-for'],
            'items' => $items_large,
            'clientOptions' => [
                'asNavFor' => '.gl-slider-nav',
                'slidesToShow' => 1,
                'slidesToScroll' => 1,
                'arrows' => false,
                'fade' => true,
            ],
        ]);

        echo Slick::widget([
            'itemContainer' => 'div',
            'containerOptions' => ['class' => 'gl-slider-nav'.(count($images) > 1 ? '' : ' hide')],
            'items' => $items_small,
            'clientOptions' => [
                'asNavFor' => '.gl-slider-for',
                'slidesToShow' => count($images),
                'slidesToScroll' => count($images),
                'dots' => false,
                'arrows' => false,
                'autoplay' => false,
                'focusOnSelect' => true,
            ],
        ]);

        echo FancyBox::widget([
            'target' => 'a[rel=gl-fancybox]',
            'helpers' => true,
            'mouse' => true,
            'config' => [
                'maxWidth' => '90%',
                'maxHeight' => '90%',
                'playSpeed' => 4000,
                'padding' => 0,
                'fitToView' => false,
                'width' => '70%',
                'height' => '70%',
                'autoSize' => false,
                'closeClick' => false,
                'openEffect' => 'elastic',
                'closeEffect' => 'elastic',
                'prevEffect' => 'elastic',
                'nextEffect' => 'elastic',
                'closeBtn' => false,
                'openOpacity' => true,
                'helpers' => [
                    'title' => ['type' => 'float'],
                    'buttons' => [],
                    'thumbs' => ['width' => 68, 'height' => 50],
                    'overlay' => [
                        'css' => [
                            'background' => 'rgba(0, 0, 0, 0.8)'
                        ]
                    ]
                ],
            ]
        ]);

        $view = $this->view;
        GalleryAdAsset::register($view);
    }
}