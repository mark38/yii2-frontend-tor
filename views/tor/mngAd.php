<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\icons\Icon;
use frontend\views\tor\TorAsset;
use frontend\widgets\gallery\UploadGallery;
use frontend\widgets\nav\TorNav;
use kartik\typeahead\Typeahead;
use frontend\widgets\category\CategoryLinkSelect;

/* @var $this yii\web\View */
/* @var $model \common\models\tor\TorAds */

TorAsset::register($this);

$this->title = 'Управление объявлением';
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
                <h1>Добавление объявления</h1>
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4',
                            'offset' => 'col-sm-offset-4',
                            'wrapper' => 'col-sm-8',
                            'error' => '',
                            'hint' => '',
                        ],
                    ],
                ]); ?>

                <?=$form->field($model, 'name')?>
                <?=$form->field($model, 'description')->textarea()?>
                <?=$form->field($model, 'geobase_city')->widget(Typeahead::classname(), [
                    'scrollable' => false,
                    'pluginOptions' => ['highlight' => true],
                    'dataset' => [
                        [
                            'remote' => [
                                'url' => Url::to(['/geobase/city-list']) . '?q=%QUERY',
                                'wildcard' => '%QUERY'
                            ],
                            'limit' => 10,
                        ]
                    ]
                ])?>
                <?=$form->field($model, 'links_id')->widget(CategoryLinkSelect::className(), [
                    'pluginOptions' => [
                        'url' => '/',
                        'categories_id' => 1,
                    ]
                ])?>
                <?=$form->field($model, 'gl_groups_id')->widget(UploadGallery::className(), [
                    'pluginOptions' => [
                        'url' => Url::to(['/gallery/upload']),
                        'type' => 'ads',
                    ],
                ]) ?>

                <?=$form->field($model, 'price', [
                    'template' => '{label}<div class="col-sm-3"><div class="input-group">{input}<div class="input-group-addon">'.Icon::show('rub', [], Icon::FA).'</div></div></div>{error}',
                ])->label($model->getAttributeLabel('price'), ['class' => 'col-sm-4 control-label'])?>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-unstyled" style="margin:0;">
                            <li>Комисия гаранта &mdash; <span id="sale-backer"><?=Yii::$app->params['saleBacker']?></span>% от суммы стоимости на сайте.</li>
                            <li>Моё вознаграждение &mdash; <span id="reward"><?=$model->price - ($model->price * Yii::$app->params['saleBacker'])/100?></span> <i class="fa fa-rub"></i></li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8"><?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> Добавить лот на продажу', ['class' => 'btn btn-default', 'name' => 'ad-button']) ?></div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
