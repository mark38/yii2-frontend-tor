<?php
namespace frontend\widgets\modules\contacts;

use yii\web\AssetBundle;

class ContactsAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@frontend/widgets/modules/contacts/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'css/contacts.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
        'js/contacts.js',
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