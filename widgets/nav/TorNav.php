<?php
namespace frontend\widgets\nav;

use common\models\User;
use common\models\tor\TorAds;
use Yii;
use yii\base\Widget;
use yii\bootstrap\Nav;
Use kartik\icons\Icon;

class TorNav extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $user = User::findOne(Yii::$app->user->id);
        echo Nav::widget([
            'items' => [
                ['label' => 'Контактная информация', 'url' => ['/tor/profile']],
                ['label' => 'Добавить лот на продажу', 'url' => ['/tor/mng-ad']],
                ['label' => 'Мои объявления <span class="badge">'.TorAds::find()->count().'</span>', 'url' => ['/tor/my-ads']],
                ['label' => 'Пополнить баланс '.Icon::show('rub', [], Icon::FA).'</span>', 'url' => ['/']],
                ['label' => 'История платежей', 'url' => ['/']],
                ['label' => 'Реферальная ссылка', 'url' => ['/']],
            ],
            'options' => [
                'class' => 'tor-nav',
            ],
            'encodeLabels' => false,
        ]);

        $view = $this->view;
        NavAsset::register($view);
    }
}