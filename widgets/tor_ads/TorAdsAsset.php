<?php
namespace frontend\widgets\tor_ads;

use yii\web\AssetBundle;

class TorAdsAsset extends AssetBundle
{
    public $sourcePath = '@frontend/widgets/tor_ads/assets';
    public $css = [
        'css/bottom-ads.css',
    ];
    public $js = [
        'js/bottom-ads.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = ['forceCopy' => true];
}