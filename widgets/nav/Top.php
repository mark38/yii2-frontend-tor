<?php

namespace frontend\widgets\nav;

use kartik\typeahead\TypeaheadBasic;
use Yii;
use yii\bootstrap\Html;
use yii\base\Widget;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;
use kartik\nav\NavX;
use common\models\User;
use common\models\main\Links;
use kartik\editable\Editable;
use yii\helpers\Url;
use kartik\typeahead\Typeahead;
use kartik\depdrop\DepDrop;
use yii\web\Session;

class Top extends Widget
{
    public $categories_id = 1;

    public function init()
    {
        parent::init();
    }

    public function topMenu()
    {
        $items = array();
        $links = Links::find()->where(['categories_id' => $this->categories_id, 'level' => 1])->orderBy(['seq' => SORT_ASC])->all();
        $url = '/'.Yii::$app->request->get('url');
        foreach ($links as $link) {
            $items[] = [
                'label' => $link->anchor,
                'url' => $link->url,
                'active' => $link->url == $url ? true : false,
            ];
        }

        return $items;
    }

    public function accountMenu()
    {
        $session = new Session;
        $session->open();
        $city = $session['city'];

        $items[] = '<li>'.Editable::widget([
            'name'=>'city',
            'asPopover' => false,
            'size'=>'sm',
            'value' => $city,
            'inputType' => Editable::INPUT_TYPEAHEAD,
            'buttonsTemplate' => false,
            'inlineSettings' => ['options' => ['class' => '']],
            'options' => [
                'dataset' => [
                    [
                        'remote' => [
                            'url' => Url::to(['/geobase/city-list']) . '?q=%QUERY',
                            'wildcard' => '%QUERY'
                        ],
                        'limit' => 10,
                    ]
                ],
                'pluginEvents' => [
                    'typeahead:select' => 'function(val, suggestion) {
                                $.post("/geobase/set-city-session", {
                                    "suggestion" : suggestion
                                }, "json").success(function(){
                                    window.location.reload();
                                });
                    }'
                ]
            ],
        ]).'</li>';

        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => 'Войти', 'url' => ['/site/login']];
            $items[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
        } else {
            $user = User::findOne(Yii::$app->user->id);
            $items[] = [
                'label' => $user->username.' '.Html::tag('span', preg_replace('/\,00/', '', number_format($user->money, 2, ',', '&thinsp;')).' '.Icon::show('user', ['class'=>'fa-btc'], Icon::FA), ['style' => 'margin: 0 2px 0 6px;']),
                'items' => [
                    ['label' => 'Добавить лот на продажу', 'url' => ['/tor/mng-ad']],
                    '<li class="divider"></li>',
                    ['label' => 'Сменить пароль', 'url' => ['#']],
                    ['label' => 'Выход', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ]
            ];
        }

        return $items;
    }

    public function run()
    {
        NavBar::begin([
            'brandLabel' => false,
            'options' => [
                'class' => 'top-nav',
            ]
        ]);

        echo NavX::widget([
            'items' => $this->topMenu(),
            'options' => ['class' => 'nav navbar-nav navbar-left nav-pills main-nav'],
            'encodeLabels' => false,
        ]);

        echo NavX::widget([
            'items' => $this->accountMenu(),
            'options' => ['class' => 'nav navbar-nav navbar-right nav-pills account-top-nav'],
            'encodeLabels' => false,
        ]);

        NavBar::end();

        $view = $this->view;
        NavAsset::register($view);
    }
}