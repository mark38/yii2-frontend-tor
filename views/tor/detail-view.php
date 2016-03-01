<?php
use mark38\galleryManager\Gallery;
/** @var $link \common\models\main\Links */
$this->title = $link->title;
$this->registerMetaTag(['name' => 'description', 'content' => $link->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $link->keywords]);
if ($link->start != 1) $this->params['breadcrumbs'][] = $link->anchor;

?>

<div class="container panel panel-default">
    <div class="row">
        <div class="col-sm-6">
<!--            --><?//= Gallery::widget(['1']); ?>
        </div>
        <div class="col-sm-6">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $link-> ?></h3>
            </div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>
</div>
