<?php
use yii\bootstrap\Html;
use frontend\views\tor\TorAsset;
use frontend\widgets\nav\TorNav;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $ads \common\models\tor\TorAds */

TorAsset::register($this);

$this->title = 'Мои объявления';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <div class="row">
        <div class="col-sm-3">
            <?=TorNav::widget()?>
            <div class="well well-account">
                <?=$this->render('myProfileInfo')?>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="content">
                <h1>Все мои лоты на продажу</h1>
                <?php if ($ads) {
                    echo '<table class="table">' .
                        '<tbody>';

                    foreach ($ads as $ad) {
                        if (!$ad->gl_groups_id) {
                            $image = Html::tag('small', 'Нет фото', ['class' => 'text-muted']);
                        } else {
                            $image = Html::img($ad->glImage->img_small, ['class' => 'img-rounded', 'height' => 64]);
                        }
                        echo '<tr>' .
                                '<td>'.$image.'</td>' .
                                '<td><strong>'.$ad->name.'</strong><br>'.Html::tag('small', $ad->description, ['class' => 'text-muted']).'</td>' .
                                '<td>'.$ad->geobaseCity->name.'</td>' .
                                '<td>' .
                                    $ad->price.' ('.($ad->price - ($ad->price * Yii::$app->params['saleBacker'])/100).') '.Icon::show('rub', [], Icon::FA).'<br>' .
                                '</td>' .
                                '<td>'.$ad->views.' '.Html::tag('small', 'просмотров', ['class' => 'text-muted']).'</td>' .
                             '</tr>';
                    }

                    echo '</tbody></table>';
                }  else {?>
                    <div class="text-center text-muted">В данный момент у вас нет объявлений</div>
                    <?=Html::a('Добавить объявление', ['/tor/mng-ad'], ['class' => 'btn btn-default'])?>
                <?php }?>
            </div>
        </div>
    </div>

</div>
