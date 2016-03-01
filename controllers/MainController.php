<?php
namespace frontend\controllers;

use common\models\main\Contents;
use common\models\tor\TorAds;
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
        if (!$link) {
            echo '404 Not found!';
            return false;
        }
        $this->layout = $link->layout->name;
        if ($link->description) Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $link->description]);
        if ($link->keywords) Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $link->keywords]);
        if (isset($link->id)) {
            $contents = Contents::find()->where(['links_id' => $link->id])->orderBy(['seq' => SORT_ASC])->all();
            for ($i=0; $i<count($contents); $i++) {
                $contents[$i]->text = preg_replace_callback('/(\{{)(\S+)(}})/', "self::getModule", $contents[$i]->text);
                $contents[$i]->text = preg_replace_callback('/(\[\[)(\S+)(]])/', "self::getWidget", $contents[$i]->text);
            }
        }
        return $this->render($link->view->name, [
            'link' => $link,
            'contents' => $contents
        ]);
    }

    public function actionCatchDef($url=null)
    {

        /////////////////////////
        $links = Links::find()->where(['categories_id' => 3])->all();
        $ads = TorAds::find()->all();
        /////////////////////////

        $link = Links::findOne(['url' => '/'.$url]);
        if (!$link) return $this->render('/site/develop', [
            'links' => $links,
            'ads' => $ads
        ]);

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