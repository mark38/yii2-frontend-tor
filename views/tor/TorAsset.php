<?php
namespace frontend\views\tor;

use yii\web\AssetBundle;

class TorAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@frontend/views/tor/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'css/tor.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'js/tor.js',
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