<?php
use yii\bootstrap\Html;
use common\models\User;
use kartik\icons\Icon;

?>
<?=Html::ul([
    '<small class="text-muted">Рейтинг:</small> '.User::findOne(Yii::$app->user->id)->rating,
    '<small class="text-muted">Баланс:</small> '.preg_replace('/\,00/', '', number_format(User::findOne(Yii::$app->user->id)->money, 2, ',', '&thinsp;')).' '.Icon::show('rub', [], Icon::FA),
], [
    'encode' => false,
    'class' => 'list-unstyled',
])?>
