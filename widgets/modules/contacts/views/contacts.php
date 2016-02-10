<?php
use yii\helpers\Html;

echo Html::beginTag('div', ['style' => 'border: 1px solid #f6e4ca;']);
echo Html::tag('div', null, [
    'id' => 'contacts-map',
    'style' => 'height: 380px;',
]);
echo Html::endTag('div');
?>