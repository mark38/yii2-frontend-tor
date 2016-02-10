<?php
namespace frontend\widgets\nav;

use common\models\User;
use Yii;
use yii\base\Widget;
use kartik\nav\NavX;
use common\models\main\Links;
use kartik\icons\Icon;
use yii\helpers\Html;

class TopNav extends Widget
{
    public $categories_id = [2];
    public $options;
    private $accountMenu;

    public function init()
    {
        parent::init();

        if (Yii::$app->user->isGuest) {
            $this->accountMenu[] = ['label' => 'Войти', 'url' => ['/site/login']];
            $this->accountMenu[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
        } else {
            $user = User::findOne(Yii::$app->user->id);
            $this->accountMenu[] = [
                'label' => Icon::show('user', [], Icon::BSG).' '.$user->username.' '.Html::tag('span', preg_replace('/\,00/', '', number_format($user->money, 2, ',', '&thinsp;')).' '.Icon::show('user', ['class'=>'fa-btc'], Icon::FA), ['style' => 'margin: 0 2px 0 6px;']),
                'items' => [
                    ['label' => '<i class="glyphicon glyphicon-plus"></i> Добавить лот на продажу', 'url' => ['/tor/mng-ad']],
                    '<li class="divider"></li>',
                    ['label' => 'Сменить пароль', 'url' => ['#']],
                    ['label' => 'Выход', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ]
            ];
        }
    }

    public function getLinks($parent=null)
    {
        $items = array();
        $links = Links::find()->where(['parent' => $parent, 'categories_id' => $this->categories_id, 'state' => 1])->orderBy(['seq' => SORT_ASC])->all();
        foreach ($links as $l => $link) {
            if ($link->child_exist == 1 && $link->level < 2) {
                $items[] = [
                    'label' => $link->anchor,
                    'items' => $this->getLinks($link->id),
                    'active' => (preg_match('/'.preg_quote($link->url, "/").'/', '/'.Yii::$app->request->get('url')) ? true : false),
                ];
            } else {
                $items[] = [
                    'label' => $link->anchor,
                    'url' => [$link->url],
                    'options' => [
                        'class' => ($link->url == '/'.Yii::$app->request->get('url') ? 'active' : ''),
                    ],
                ];
            }
        }

        return $items;
    }

    public function run()
    {
        /*$items = $this->getLinks();
        if (isset($items)) {
            echo NavX::widget([
                'items' => $items,
                'options' => [
                    'class' => 'navbar-nav '.$this->options['class'],
                    'dropDownCaret' => null,
                ],
            ]);
        }*/

        echo NavX::widget([
            'items' => $this->accountMenu,
            'options' => [
                'class' => 'navbar-nav navbar-right account-nav',
                //'dropDownCaret' => null,
            ],
            'encodeLabels' => false,
        ]);

        $view = $this->view;
        NavAsset::register($view);
    }
}