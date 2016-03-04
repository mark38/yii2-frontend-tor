<?php

use kartik\sidenav\SideNav;

?>


<?php

$items = [];

function appendChildren($link)
{
    $sub_items = [];
    foreach ($link->links as $child) {
        if ($child->child_exist) {
            $sub_items[] = ['label' => $child->anchor, 'url' => $child->url, 'items' => appendChildren($child)];
        } else {
            $sub_items[] = ['label' => $child->anchor, 'url' => $child->url];
        }
    }
    return $sub_items;
}

foreach ($links as $link) {
    if ($link->child_exist) {
        $items[] = ['label' => $link->anchor, 'url' => $link->url, 'items' => appendChildren($link)];
    }else {
        $items[] = ['label' => $link->anchor, 'url' => $link->url];
    }
}

echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'heading' => 'Категории',
    'items' => $items,
]);
?>

