<?php
use common\models\main\Links;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $link common\models\main\Links */
?>

<div class="text-center text-muted" style="margin:250px 0 100px; font-size:22px;">Сайт находится в разработке.<br>Просим зайти позднее</div>
<div class="text-center"><?=Html::a('<span class="glyphicon glyphicon-home"></span> Перейти на главную', ['/'], ['class' => 'btn btn-default'])?></div>
