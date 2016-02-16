<?php
namespace frontend\widgets\category;

use yii\web\AssetBundle;

class CategoryAsset extends AssetBundle
{
    public $sourcePath = '@frontend/widgets/category/assets';
    public $css = [
        'css/category.css',
    ];
    public $js = [
        'js/category.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = ['forceCopy' => true];
}