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

class Left extends Widget
{
    public $categories_id = 3;
    private $links;

    public function init()
    {
        $this->links = Links::find()->where(['categories_id' => $this->categories_id, 'level' => 1])->orderBy(['seq' => SORT_ASC])->all();
        parent::init();
    }

    public function run()
    {
        echo $this->render('left', [
            'links' => $this->links
        ]);
        $view = $this->view;
        NavAsset::register($view);
    }
}