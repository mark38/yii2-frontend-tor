<?php
namespace frontend\widgets\modules\gallery;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use common\models\gl\GlGroups;

class Gallery extends Widget
{
    public $group;

    public function init()
    {
        if (empty($this->group)) {
            throw new InvalidConfigException("The 'group' property has not been set.");
        }
    }

    public function run()
    {
        $gl_group = GlGroups::findOne($this->group);
        echo $this->render($gl_group->type->type, [
            'gl_group' => $gl_group,
        ]);

        $view = $this->view;
        GalleryAsset::register($view);
    }
}