<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/30
 * Time: 15:30
 */

require  __DIR__ . '/../Application/Autoload/Loader.php';

\Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Form\Generic;
use Application\Form\Element\Select;

$wrappers = [
    Generic::INPUT => ['type' => 'td', 'class' => 'content'],
    Generic::LABEL => ['type' => 'th', 'class' => 'label'],
    Generic::ERRORS => ['type' => 'td', 'class' => 'error'],
];

// select
$ballList = [
    'A' => 'FootBall',
    'B' => 'BasketBall',
    'C' => 'BingBang',
    'D' => 'Approved',
];

// 下拉单选
$hobby = new Select('hobby', Generic::TYPE_SELECT, 'Hobby', $wrappers, [
    'id' => 'hobby',
    // 'multiple' => true, // 下拉框，单选和多选
]);

$checkeds = $_GET['hobby'] ?? [];
$hobby->setOptions($ballList, $checkeds);

// 下拉多选
$hobby2 = new Select('hobby2', Generic::TYPE_SELECT, 'Hobby mul', $wrappers, [
    'id' => 'hobby2',
    'multiple' => true, // 下拉框，单选和多选
    'size' => '4'
]);

$checkeds2 = $_GET['hobby2'] ?? [];
$hobby2->setOptions($ballList, $checkeds2);

$submit = new Generic('submit', Generic::TYPE_SUBMIT, 'Process', $wrappers, [
    'id' => 'submit',
    'title' => 'Click to Process',
    'value' => 'Click Here'
]);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Form Element</h1>

<form action="" name="login">
    <table id="login" class="display" border="1" cellspacing="0" width="100%">
        <tr><?= $hobby->render();?></tr>
        <tr><?= $hobby2->render();?></tr>
        <tr><?= $submit->render();?></tr>
        <tr>
            <td colspan="2">
                <br>
                <?php var_dump($_GET); ?>
            </td>
        </tr>
    </table>
</form>

</body>
</html>


