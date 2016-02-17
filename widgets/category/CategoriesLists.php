<?php
namespace frontend\widgets\category;

use frontend\widgets\category\models\Category;
use Yii;
use yii\base\InvalidConfigException;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use common\models\main\Links;

class CategoriesLists extends InputWidget
{
    public $links;

    public function init()
    {

    }

    public function run()
    {
        echo '<ul class="list-unstyled list-inline">';
        foreach ($this->links as $link) {
            if (!$link->parent) {
                if ($link->child_exist) {
                    echo '<li><h3><a href="category-'.$link->id.'">'.$link->anchor.'</a></h3>';
                    $this->appendChild($this->links, $link).'</li>';
                } else {
                    echo '<li><h3><a href="category-'.$link->id.'">'.$link->anchor.'</a></h3></li>';
                }
            }
        }
        echo '</ul>';
    }

    private function appendChild($allLinks, $currentLink) {
        if ($currentLink->child_exist) {
            echo '<ul class="list-unstyled">';
            foreach ($allLinks as $child) {
                if ($child->parent == $currentLink->id) {
                    if ($child->child_exist) {
                        echo '<li><a href="category-'.$child->id.'">'.$child->anchor.'</a></li>';
                        $this->appendChild($allLinks, $child);
                    } else {
                        echo '<li><a href="category-'.$child->id.'">'.$child->anchor.'</a></li>';
                    }
                }
            }
            echo '</ul>';
        }
    }
}