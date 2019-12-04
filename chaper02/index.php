<html>
<body>
<h2>PHP 7 中的高级功能</h2>
<ul>
    <li>
        <a href="chap_02_foreach.php">chap_02_foreach.php</a></li>
    <li>
        <a href="chap_02_file_iterator_throgh_a_massive_file.php">chap_02_file_iterator_throgh_a_massive_file.php</a>
    </li>
    <li>
        <a href="chap_02_performace_using_php7_enchancement_call.php">chap_02_performace_using_php7_enchancement_call.php</a>
    </li>
    <li>
        <a href="chap_02_uploading_csv_to_database.php">chap_02_uploading_csv_to_database.php</a>
    </li>
    <li>
        <a href="chap_02_web_filtering_ast_example.php">chap_02_web_filtering_ast_example.php</a>
    </li>
    <li>
        <a href="chap_02_recursive_directory_iteratory.php">chap_02_recursive_directory_iteratory.php</a>
    </li>
</ul>
</body>
</html>
<?php

die;
$foo = new class
{

    public $baz = ['bada' => 'boom'];
};

$bar = 'baz';
echo $foo->$bar['bada']; // boom

die;
$foo = 'bar';
$bar = ['bar' => ['baz' => 'bat']];

echo $$foo['bar']['baz'];

// bat 7.0 ， 从左往右 $bar['bar']['baz'] -- ['baz' => 'bzt]['bzt']
// 5.5及以下报错，运行方式是从右往左 ${$foo['bar']['baz']}

die;

function test()
{
    return [
        1 => function () {
            return [
                1 => function ($a) {
                    return 'Level 1/1:' . ++$a;
                },
                2 => function ($a) {
                    return 'Level 1/2:' . ++$a;
                },
            ];
        },

        2 => function () {
            return [
                1 => function ($a) {
                    return 'Level 2/1:' . ++$a;
                },
                2 => function ($a) {
                    return 'Level 2/2:' . ++$a;
                },
            ];
        },
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