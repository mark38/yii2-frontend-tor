<?php
namespace frontend\models;

use yii\base\Model;

class GetWidget extends Model
{
    public function getModule($module)
    {
        preg_match('/(\S+)\((.*)\)/', $module, $matches);
        $widget_name = '\\frontend\\widgets\\modules\\'.mb_strtolower($matches[1]).'\\'.$matches[1];
        $items = false;
        if ($matches[2]) {
            $params = preg_split('/,/', $matches[2]);
            for ($i=0; $i<count($params); $i++) {
                $tmp = preg_split('/:/', $params[$i]);
                $items[$tmp[0]] = $tmp[1];
            }
        }

        return $widget_name::widget($items);
    }

    public function getWidget($widget)
    {
        $base = preg_split('/\_/', $widget);
        preg_match('/(\S+)\((.*)\)/', $base[1], $matches);
        $widget_name = '\\frontend\\widgets\\'.mb_strtolower($base[0]).'\\'.$matches[1];
        $items = false;
        if ($matches[2]) {
            $params = preg_split('/,/', $matches[2]);
            for ($i=0; $i<count($params); $i++) {
                $tmp = preg_split('/:/', $params[$i]);
                $items[$tmp[0]] = $tmp[1];
            }
        }

        return $widget_name::widget($items);
    }
}