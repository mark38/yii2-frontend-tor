<?php
namespace frontend\widgets\category\models;

use Yii;
use yii\base\Model;
use common\models\main\Links;

class Category extends Model
{
    public function getAnchorPath($links_id)
    {
        $link = Links::findOne($links_id);
        if ($link->parent !== null) {
            $anchor_path = $this->getAnchorPath($link->parent).' / '.$link->anchor;
        } else {
            $anchor_path = '/ '.$link->anchor;
        }

        return $anchor_path;
    }
}