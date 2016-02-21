<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use kartik\icons\Icon;
use frontend\widgets\Alert;
use frontend\widgets\nav\Top;
use frontend\widgets\nav\Tor;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
Icon::map($this, Icon::FA);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msvalidate.01" content="6D13525167F7CE9637DAA897715EF0CE" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="wrap">
        <?=Top::widget()?>
        <?=Tor::widget()?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb']
            ]) ?>
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left"></p>
        </div>
    </footer>

    <?= uran1980\yii\widgets\scrollToTop\ScrollToTop::widget() ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
