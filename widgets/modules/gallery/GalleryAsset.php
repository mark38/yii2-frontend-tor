<?php
namespace frontend\widgets\modules\gallery;

use yii\web\AssetBundle;

class GalleryAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@frontend/widgets/modules/gallery/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'css/gallery.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        //'js/owl-promo.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}