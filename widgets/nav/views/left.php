<?php

use yii\bootstrap\Html;
use frontend\modules\tor_ads\models\TorAdsHelper;

$url = $_SERVER['REQUEST_URI'];
?>


<?php

function appendChild($link, $url) {
    echo Html::beginTag('ul', ['class' => 'list-unstyled']);
    foreach ($link->links as $child) {
        if ($child->child_exist  && strpos($url, $child->url) !== false) {
            echo Html::beginTag('li');
            echo Html::a($child->anchor.' ('.TorAdsHelper::getAdsAmount($child).')', [$child->url], ['class' => preg_match("/^\/".preg_replace('/\//', '\/', substr($child->url,1))."(\?id=\d+)?$/", $url) ? 'active' : '']);
            appendChild($child, $url);
            echo Html::endTag('li');
        }
        else {
            echo Html::beginTag('li');
            echo Html::a($child->anchor.' ('.TorAdsHelper::getAdsAmount($child).')', [$child->url], ['class' => preg_match("/^\/".preg_replace('/\//', '\/', substr($child->url,1))."(\?id=\d+)?$/", $url) ? 'active' : '']);
            echo Html::endTag('li');
        }
    }
    echo Html::endTag('ul');

}
echo Html::beginTag('div', ['class' => 'left-menu']);
echo Html::beginTag('ul', ['class' => 'list-unstyled']);
foreach ($links as $link) {
    if ($link->child_exist && strpos($url, $link->url) !== false) {
        echo Html::beginTag('li');
        echo Html::a($link->anchor.' ('.TorAdsHelper::getAdsAmount($link).')', [$link->url], ['class' => preg_match("/^\/".preg_replace('/\//', '\/', substr($link->url,1))."(\?id=\d+)?$/", $url) ? 'active' : '']);
        appendChild($link, $url);
        echo Html::endTag('li');
    } else {
        echo Html::beginTag('li');
        echo Html::a($link->anchor.' ('.TorAdsHelper::getAdsAmount($link).')', [$link->url], ['class' => preg_match("/^\/".preg_replace('/\//', '\/', substr($link->url,1))."(\?id=\d+)?$/", $url) ? 'active' : '']);
        echo Html::endTag('li');
    }
}
echo Html::endTag('ul');
echo Html::endTag('div');
?>

