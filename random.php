<?php
$rand = mt_rand(0, 2);
switch ($rand) {
    case 0:
        $random_text = "ウホホ";
        break;
    case 1:
        $random_text = "ゴリゴリ";
        break;
    default:
        $random_text = "モグモグ";
        break;
}
?>