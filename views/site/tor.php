<?php
use common\models\main\Links;
use frontend\widgets\tor_ads\Preview;
use frontend\widgets\tor_ads\Full;

/** @var $this \yii\web\View */
/** @var $link common\models\main\Links */
/** @var $contents \common\models\main\Contents */

$this->title = $link->title;

if ($link->parent) {
    $parents[] = Links::findOne($link->parent);
    while ($parents[count($parents)-1]->parent) $parents[] = Links::findOne($parents[count($parents)-1]->parent);
    for ($i=(count($parents)-1); $i >= 0; $i--) $this->params['breadcrumbs'][] = ['label' => $parents[$i]->anchor, 'url' => $parents[$i]->url];
}
if ($link->start != 1) $this->params['breadcrumbs'][] = $link->anchor;

?>

<div class="container">
    <div class="content">
        <?php if (Yii::$app->request->get('id')) {
            echo Full::widget(['adId' => Yii::$app->request->get('id')]);
        } else {
            echo Preview::widget(['url' => Yii::$app->request->get('url')]);
        }?>
        <?=$contents[0]->text?>
    </div>
</div>
