<?php
namespace frontend\widgets\nav;

use yii\web\AssetBundle;

class NavAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@frontend/widgets/nav/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'css/nav.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'js/nav.js',
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