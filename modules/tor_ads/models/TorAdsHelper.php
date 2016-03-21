<?php
namespace frontend\modules\tor_ads\models;

use Yii;
use yii\base\Model;
use common\models\tor\TorAds;

class TorAdsHelper extends Model
{
    public static function getAdsAmount($link)
    {
        $allAds = TorAds::find()->where(['links_id' => $link->id])->count();
        if ($link->child_exist) {
            foreach ($link->links as $child_link) {
                $allAds += TorAdsHelper::getAdsAmount($child_link);
            }
        }
        return $allAds;
    }
}
