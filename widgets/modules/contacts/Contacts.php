<?php
namespace frontend\widgets\modules\contacts;

use Yii;
use yii\base\Widget;

class Contacts extends Widget
{
    public function init()
    {
    }

    public function run()
    {
        echo $this->render('contacts');

        $view = $this->view;
        ContactsAsset::register($view);
    }
}