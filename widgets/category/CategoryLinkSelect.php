<?php
namespace frontend\widgets\category;

use frontend\widgets\category\models\Category;
use Yii;
use yii\base\InvalidConfigException;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use common\models\main\Links;

class CategoryLinkSelect extends InputWidget
{
    public $options = ['class' => 'form-control'];
    public $pluginOptions = [];

    public function init()
    {
        if (empty($this->pluginOptions['url'])) {
            throw new InvalidConfigException("The 'pluginOptions[\"url\"]' property has not been set.");
        }
        if (empty($this->pluginOptions['categories_id'])) {
            throw new InvalidConfigException("The 'pluginOptions[\"categories_id\"]' property has not been set.");
        }
    }

    public function run()
    {
        echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        $input_id = $this->attribute;
        if ($this->model[$this->attribute]) {
            $label = (new Category)->getAnchorPath($this->model[$this->attribute]);
        } else {
            $label = 'Выберете категорию';
        }

        Modal::begin([
            'header' => null,
            'toggleButton' => ['label' => $label, 'class' => 'btn-link category-link-select', 'id' => 'btn-categories-modal'],
            'options' => [
                'id' => 'categories-modal',
                'data-input-id' => strtolower($this->model->formName()).'-'.$input_id,
                'data-categories-id' => $this->pluginOptions['categories_id'],
            ]
        ]);

        echo Html::beginTag('div', ['class' => 'category-list']);
        echo Html::beginTag('ul', ['class' => 'list-inline', 'id' => 'categories-lists-null']);
        echo Html::endTag('ul');
        echo Html::endTag('div');

        Modal::end();
        //echo Html::a('Выберете категорию', null, ['id' => 'category-link-select']);

        $view = $this->view;
        CategoryAsset::register($view);
    }
}