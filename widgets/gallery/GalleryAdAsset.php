<?php
namespace frontend\widgets\gallery;

use yii\web\AssetBundle;

class GalleryAdAsset extends AssetBundle
{
    public $sourcePath = '@frontend/widgets/gallery/assets';
    public $css = [
        'css/galleryAd.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = ['forceCopy' => true];
}