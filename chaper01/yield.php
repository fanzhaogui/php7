<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/2
 * Time: 15:14
 */


function test() {
    $arr = [1, 2, 3, 4, 5, 6];

    foreach ($arr as $v) {
//        yield from $v; // Can use "yield from" only with arrays and Traversables
        yield $v;
    }
    return true;
}


foreach (test() as $item) {
    echo "CURRENT VALUE : " . $item . "<br/>";
    // sleep(2);
}