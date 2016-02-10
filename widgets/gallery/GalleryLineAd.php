<?php
namespace frontend\widgets\gallery;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use evgeniyrru\yii2slick\Slick;
use newerton\fancybox\FancyBox;
use common\models\gl\GlImgs;

class GalleryLineAd extends Widget
{
    public $gl_groups_id;
    public $imageSliderForOtions = [];

    public function init()
    {
        if (empty($this->gl_groups_id)) {
            throw new InvalidConfigException("The 'gl_groups_id' property has not been set.");
        }
    }

    public function run()
    {
        $images = GlImgs::find()->where(['groups_id' => $this->gl_groups_id])->orderBy('seq')->all();
        if (!$images) return false;

        foreach ($images as $i => $image) {
            $items_small[] = Html::a(Html::img($image->img_small, ['class' => '']), $image->img_large, ['rel' => 'gl-linead-'.$this->gl_groups_id]);
        }

        echo Slick::widget([
            'items' => $items_small,
            'containerOptions' => count($items_small) > 4 ? ['class' => 'gallery-line-ad'] : ['class' => 'lonely-item gallery-line-ad'],
            'clientOptions' => [
                'slidesToShow' => 4,
                'slidesToScroll' => 1

            ],
            'itemOptions' => ['class' => 'lineAdItem well well-sm'],
        ]);

        echo FancyBox::widget([
            'target' => 'a[rel=gl-linead-'.$this->gl_groups_id.']',
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