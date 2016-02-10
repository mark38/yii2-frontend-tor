<?php
namespace frontend\widgets\gallery;

use yii\web\AssetBundle;

class UploadGalleryAsset extends AssetBundle
{
    public $sourcePath = '@frontend/widgets/gallery/assets';
    public $css = [
        'css/uploadGallery.css',
    ];
    public $js = [
        'js/uploadGallery.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}