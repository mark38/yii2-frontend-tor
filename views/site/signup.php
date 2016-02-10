<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Регистрация новоро пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container content">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-7">
            <?php $form = ActiveForm::begin([
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-5',
                        'offset' => 'col-sm-offset-5',
                        'wrapper' => 'col-sm-7',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
                'options' => [
                    'class' => 'signup',
                ]
            ]); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7"><?= Html::submitButton('Зарегистрироваться <span class="glyphicon glyphicon-chevron-right"></span>', ['class' => 'btn btn-default', 'name' => 'signup-button']) ?></div>
                </div>
            <?php ActiveForm::end(); ?>
            <em class="text-muted"><small>* Все поля формы обязательны для заполнения.</small></em>
        </div>
    </div>

</div>
