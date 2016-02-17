<?php
namespace frontend\widgets\tor_ads;

use Yii;
use yii\base\InvalidConfigException;
use yii\widgets\InputWidget;


class BottomAds extends InputWidget
{
    public $ads;

    public function init()
    {
        if (empty($this->ads)) {
            throw new InvalidConfigException("The 'ads' property has not been set.");
        }
    }

    public function run()
    {
        echo '<div class="row">';
            foreach ($this->ads as $ad) {
                echo '<div class="col-sm-4 ad-block">'; ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="img-block">
                                <?= $ad->gallery_groups_id ? '<a href="#"><img src="#"></a>' : '<a href="#"><small class="text-muted">нет фото</small></a>' ?>
                            </div>
                            <div>
                                <small class="text-muted"><?= $ad->user->username ?> (<?= $ad->user->rating ?>)</small>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <div><a href="#"><h5><?= $ad->name ?></h5></a></div>
                            <div><small><?= mb_strimwidth($ad->description , 0, 70, "...",'utf-8'); ?></small></div>
                            <br>
                            <div class="ad-price text-right">
                                <span class=""><?= $ad->price ?> руб</span>
                                <span class=""><abbr title="Стоимость с гарантом"><?= $ad->price ?> руб</abbr></span>
                            </div>
                        </div>
                    </div>
            <?php    echo '</div>';
            }
        echo '</div>';
        $view = $this->view;
        TorAdsAsset::register($view);
    }
}