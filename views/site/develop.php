<?php
use common\models\main\Links;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $link common\models\main\Links */


?>
<!---->
<!--<div class="text-center text-muted" style="margin:250px 0 100px; font-size:22px;">Сайт находится в разработке.<br>Просим зайти позднее</div>-->
<!--<div class="text-center">--><?//=Html::a('<span class="glyphicon glyphicon-home"></span> Перейти на главную', ['/'], ['class' => 'btn btn-default'])?><!--</div>-->
<div class="container">
    <div class="categories">
        <?= \frontend\widgets\category\CategoriesLists::widget(['links' => $links]) ?>
    </div>
    <div class="ads">
        <div class="panel panel-default">
            <div class="row">
                <?php
                foreach ($ads as $ad) {
                    echo '<div class="col-sm-3">';
                        echo '<div class="">'.$ad->user->username.'<span class="pull-right">'.$ad->user->rating.'</span></div>';
                        echo '<div class="row">';
                            echo '<div class="col-sm-4"><img src="asd"></div>';
                            echo '<div class="col-sm-8">';
                                echo '<div class="">'.$ad->name.'</div>';
                                echo '<div class="">'.$ad->description.'</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="">'.$ad->city->name.'</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>