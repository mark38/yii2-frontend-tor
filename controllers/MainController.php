<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\GetWidget;
use common\models\main\Links;

class MainController extends Controller
{
    public $link = null;

    public function init()
    {
        if (!Yii::$app->session->isActive) Yii::$app->session->open();
    }

    public function actionCatch($url=null)
    {
        $link = Links::findOne(['url' => '/'.$url]);
        if (!$link) return $this->render('/site/develop');

        $link = Links::findOne(['url' => '/'.$url]);
        if (!$link) return $this->render('/site/develop');

        $this->layout = $link->layout->name;
        Yii::$app->view->registerMetaTag(['description' => $link->description]);
        Yii::$app->view->registerMetaTag(['keywords' => $link->keywords]);
        $parent = Links::findOne($link->parent);

        if (isset($link->id)) {
            $content = false;
            for ($c=0; $c<count($link->contents); $c++) {
                $reg = '/\{\{(.*)\}\}/';
                $content = preg_replace_callback('/(\{{)(\S+)(}})/', "self::getModule", $link->contents[0]->content);
                $content = preg_replace_callback('/(\[\[)(\S+)(]])/', "self::getWidget", $content);
            }
        }

        return $this->render($link->view->name, ['link' => $link, 'content' => $content]);
    }

    public function getModule($matches)
    {
        $model = new GetWidget();
        return $model->getModule($matches[2]);
    }

    public function getWidget($matches)
    {
        $model = new GetWidget();
        return $model->getWidget($matches[2]);
    }
}