<?php
use common\models\main\Links;

/* @var $this yii\web\View */
/* @var $link common\models\main\Links */

$this->title = $link->title;

if ($link->parent) {
    $parents[] = Links::findOne($link->parent);
    while ($parents[count($parents)-1]->parent) $parents[] = Links::findOne($parents[count($parents)-1]->parent);
    for ($i=(count($parents)-1); $i >= 0; $i--) $this->params['breadcrumbs'][] = ['label' => $parents[$i]->anchor, 'url' => $parents[$i]->url];
}
if ($link->start != 1) $this->params['breadcrumbs'][] = $link->anchor;
?>

<?=$content?>
