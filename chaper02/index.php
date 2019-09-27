<?php

function test ()
{
    return [
        1 => function () {
            return [
                1 => function ($a) {return 'Level 1/1:' . ++ $a; },
                2 => function ($a) {return 'Level 1/2:' . ++ $a; },
            ];
        },

        2 => function () {
            return [
                1 => function ($a) {return 'Level 2/1:' . ++ $a; },
                2 => function ($a) {return 'Level 2/2:' . ++ $a; },
            ];
        }
    ];
}


$a = 't';

$t = 'test';

// $$a == $t == 'test';
// test()[1] array
// test()[1]()[2] == function($a) {return 'Level 1/2 :' . ++ $a;}
// $a = 100
echo $$a()[1]()[2](100);
// Level 1/2 : 101