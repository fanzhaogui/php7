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

$wrappers = [
    Generic::INPUT => ['type' => 'td', 'class' => 'content'],
    Generic::LABEL => ['type' => 'th', 'class' => 'label'],
    Generic::ERRORS => ['type' => 'td', 'class' => 'error'],
];


$email = new Generic('email', Generic::TYPE_EMAIL, "Email", $wrappers, [
    'id' => 'email',
    'maxLength' => 128,
    'title' => 'Enter address',
    'required' => ''
]);

$password = new Generic('password', $email);
$password->setType(Generic::TYPE_PASSWORD);
$password->setLabel('Password');
$password->setAttribute([
    'id' => 'password',
    'title' => 'Enter your password',
    'required' => '',
]);


$submit = new Generic('submit', Generic::TYPE_SUBMIT, 'Login', $wrappers, [
    'id' => 'submit',
    'title' => 'Click to login',
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

    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->


    <title>Document</title>
</head>
<body>

<h1>Login</h1>

<form action="" name="login">
    <table id="login" class="display" border="1" cellspacing="0" width="100%">
        <tr><?= $email->render();?></tr>
        <tr><?= $password->render();?></tr>
        <tr><?= $submit->render();?></tr>
        <tr>
            <td colspan="2">
                <br>
                <?php var_dump($_POST); ?>
            </td>
        </tr>
    </table>
</form>

<!--<script src="https://cdn.bootcss.com/jquery/3.4.0/jquery.min.js"></script>-->
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
</body>
</html>


