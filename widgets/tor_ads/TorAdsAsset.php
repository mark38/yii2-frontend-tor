<?php
namespace frontend\widgets\tor_ads;

use yii\web\AssetBundle;

class TorAdsAsset extends AssetBundle
{
    public $sourcePath = '@frontend/widgets/tor_ads/assets';
    public $css = [
        'bottom-ads.css',
        'tor.css',
    ];
    public $js = [
        'bottom-ads.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = ['forceCopy' => true];
}