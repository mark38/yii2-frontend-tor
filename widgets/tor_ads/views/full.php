<?php
use yii\bootstrap\Html;
use frontend\widgets\gallery\GalleryAd;
/** @var $torAd \common\models\tor\TorAds */

$this->title = $torAd->name;
?>

<div class="row">
    <div class="col-sm-6">
        <?= GalleryAd::widget(['gallery_groups_id' => $torAd->gallery_groups_id]); ?>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-9">
                <h1><?= $torAd->name ?></h1>
            </div>
            <div class="col-sm-3 text-right"><small class="text-muted"><?= date('d.m.Y', $torAd->created_at) ?> | <small class="glyphicon glyphicon-eye-open"></small> <?= $torAd->views ?></small></div>
        </div>

        <div><?= $torAd->description ?></div>
        <br>
        <div class="author">
            <?= Html::tag('span', $torAd->city->name) . ' / ' .
            Html::tag('span', '<em class="text-muted">'.$torAd->user->username.' &mdash; <strong>'.$torAd->user->rating.'</strong></em>') ?>
        </div>
        <br>
        <div class="box">
            <div class="btn-group">
                <button class="btn btn-large btn-default"><?= $torAd->price ?> <small class="text-muted">руб</small></button>
                <button class="btn btn-large btn-default"><?= $torAd->price ?> <small class="text-muted">руб</small></button>
            </div>
        </div>

    </div>
</div>
