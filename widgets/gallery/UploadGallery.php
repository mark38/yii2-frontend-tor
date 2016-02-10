<?php
namespace frontend\widgets\gallery;

use Yii;
use yii\base\InvalidConfigException;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use kartik\sortable\Sortable;
use common\models\gl\GlImgs;

class UploadGallery extends InputWidget
{
    public $options = ['class' => 'form-control TEST']; //?
    public $pluginOptions = [];

    public function init()
    {
        if (empty($this->pluginOptions['url'])) {
            throw new InvalidConfigException("The 'pluginOptions[\"url\"]' property has not been set.");
        }
        if (empty($this->pluginOptions['type'])) {
            throw new InvalidConfigException("The 'pluginOptions[\"type\"]' property has not been set.");
        }
    }

    public function run()
    {
        echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        $groups_id = $this->attribute;

        $items = array();
        if ($this->model->$groups_id) {
            foreach (GlImgs::find()->where(['groups_id' => $this->model->$groups_id])->orderBy(['seq' => SORT_ASC])->all() as $i => $image) {
                $items[] = [
                    'content' => Html::tag('div', Html::button(null, [
                        'class' => 'btn btn-default btn-xs glyphicon glyphicon-remove',
                        'onclick' => 'removeUploadImage("'.$this->pluginOptions['url'].'", '.$image->id.', "'.$image->basename_src.'", '.$image->groups_id.')',
                    ]), [
                        'style' => 'background:url("'.$image->img_small.'") 50% 50% no-repeat;',
                        'class' => 'upload-img',
                        'data-imgs-id' => $image->id,
                        'id' => 'upload-img-'.$image->id,
                    ]),
                ];
            }
        }
        $items[] = ['content' => '<span class="glyphicon glyphicon-plus"></span><br>Добавить фото' .
            Html::fileInput(null, null, [
                'multiple' => true,
                'data-url' => $this->pluginOptions['url'],
                'data-type' => $this->pluginOptions['type'],
                'data-input-id' => strtolower($this->model->formName()).'-'.$groups_id,
                'onchange' => 'prepareUpload($(this))',
                'id' => 'js-upload-action',
            ]),
            'disabled' => true,
            'options' => [
                'class' => 'js-upload',
                'onclick' => 'openFileDiaolg()',
            ]
        ];

        echo Html::beginTag('div', ['class' => 'upload-gallery-content']);
        echo Sortable::widget([
            'type' => 'grid',
            'items' => $items,
            'pluginEvents' => [
                'sortupdate' => 'function(data) {reSortGallery("'.$this->pluginOptions['url'].'")}',
            ],
            'options' => [
                'class' => 'js-upload-gallery',
            ],
        ]);
        echo Html::tag('div', 'Основное изображение', ['class' => 'js-upload-image-default']);
        echo Html::endTag('div');
        /*echo Html::tag('div', '<small>Вы можете прикрепить не более 5 фотографий</small>', [
            'class' => 'text-muted',
        ]);*/

        $view = $this->view;
        UploadGalleryAsset::register($view);
    }
}