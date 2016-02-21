<?php

namespace frontend\widgets\nav;

use Yii;
use yii\bootstrap\Html;
use yii\base\Widget;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;
use kartik\nav\NavX;
use common\models\User;
use common\models\main\Links;

class Tor extends Widget
{
    public $categories_id = 3;

    public function init()
    {
        parent::init();
    }

    public function torMenu($parent=null, $level=1)
    {
        $links = Links::find()->where(['categories_id' => $this->categories_id, 'parent' => $parent])->orderBy(['seq' => SORT_ASC])->all();
        $items = Html::beginTag('ul', ['class' => 'tor-nav-'.$level.' '.($level > 2 ? 'list-unstyled' : 'list-inline')]);

        /** @var $link Links */
        foreach ($links as $link) {
            $items .= '<li>'.Html::a($link->anchor, $link->url);
            if ($link->child_exist == 1) {
                if ($link->level == 1) {
                    $items .= '<span class="caret"></span>'.Html::tag('div', $this->torMenu($link->id, ($link->level+1)), ['class' => 'tor-sub-nav']);
                } else {
                    $items .= $this->torMenu($link->id, ($link->level+1));
                }
            }
            $items .= '</li>';
        }

        $items .= Html::endTag('ul');

        return $items;
    }

    public function run()
    {
        NavBar::begin([
            'brandLabel' => false,
            'options' => [
                'class' => 'tor-nav',
            ]
        ]);

        echo Html::tag('div', $this->torMenu(), ['class' => 'container']);

        NavBar::end();

        $view = $this->view;
        NavAsset::register($view);
    }
}