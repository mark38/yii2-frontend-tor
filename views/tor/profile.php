<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
use frontend\views\tor\TorAsset;
use frontend\widgets\nav\Account;
use yii\bootstrap\ActiveForm;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $user \common\models\User */

TorAsset::register($this);

$this->title = 'Контактная информация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <div class="row">
        <div class="col-sm-3">
            <?=Account::widget()?>
        </div>
        <div class="col-sm-9">
            <div class="content">
                <h1>Контактная информация</h1>
                <p>
                    Заполните достоверную контактную информацию, по которой с Вами будет осуществлять связь  потенциальный покупатель.<br>
                    Для каждого продаваемого Вами лота, возможно назначить персональные контактные данные, а также выбрать другой населённый пункт.
                </p>

                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4',
                            'offset' => 'col-sm-offset-4',
                            'wrapper' => 'col-sm-6',
                            'error' => '',
                            'hint' => '',
                        ],
                    ],
                ]); ?>

                <?=$form->field($user, 'username')->staticControl()?>
                <?/*=$form->field($model, 'contacts')*/?><!--
                --><?/*=$form->field($geobase_city, 'name')->widget(Typeahead::classname(), [
                    'scrollable' => false,
                    'pluginOptions' => ['highlight'=>true],
                    'dataset' => [
                        [
                            'remote' => [
                                'url' => Url::to(['/geobase/city-list']) . '?q=%QUERY',
                                'wildcard' => '%QUERY'
                            ],
                            'limit' => 10,
                        ]
                    ]
                ])*/?>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8"><?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> Сохранить', ['class' => 'btn btn-default', 'name' => 'ad-button']) ?></div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

</div>
