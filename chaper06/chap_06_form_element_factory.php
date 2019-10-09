<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/30
 * Time: 15:30
 */

require __DIR__ . '/../Application/Autoload/Loader.php';

\Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Form\Factory;
use Application\Form\Generic;

$email    = $_POST['email'] ?? '';
$checked0 = $_POST['status0'] ?? 'U';
$checked1 = $_POST['status1'] ?? 'U';
$checked2 = $_POST['status2'] ?? ['U'];
$checked3 = $_POST['status3'] ?? ['U'];

// 表单配置文件
$formConfig = [
    'name'         => 'status_form',
    'attributes'   => [
        'id'     => 'statusForm',
        'method' => 'post',
        'action' => 'chap_o6_form_factory.php',
    ],
    'row_wrapper'  => [
        'type'  => 'tr',
        'class' => 'row'
    ],
    'form_wrapper' => [
        'type'                    => 'table',
        'class'                   => 'table',
        'id'                      => 'statusTable',
        'cellspacing'             => '0',
        'border'                  => '1',
        'form_tag_inside_wrapper' => false,
    ]
];

$wrappers = [
    Generic::INPUT  => ['type' => 'td', 'class' => 'content'],
    Generic::LABEL  => ['type' => 'th', 'class' => 'label'],
    Generic::ERRORS => ['type' => 'td', 'class' => 'error'],
];

$statusList = [
    'U' => 'Unconfirmed',
    'P' => 'Pending',
    'T' => 'Temporary Approval',
    'A' => 'Approved',
];

$config = [
    'email'    => [
        'class'      => 'Application\Form\Generic',
        'type'       => Generic::TYPE_EMAIL,
        'label'      => 'Email',
        'wrappers'   => $wrappers,
        'attributes' => [
            'id'        => 'email',
            'maxLength' => 128,
            'title'     => 'Enter email',
            'required'  => '',
            'value'     => strip_tags($email),
        ],
    ],
    'password' => [
        'class'      => 'Application\Form\Generic',
        'type'       => Generic::TYPE_PASSWORD,
        'label'      => 'Password',
        'wrappers'   => $wrappers,
        'attributes' => [
            'id'       => 'password',
            'title'    => 'Enter youer password',
            'required' => '',
        ],
    ],
    'Status 0' => [
        'class'      => 'Application\Form\Element\Radio',
        'type'       => Generic::TYPE_RADIO,
        'label'      => 'Status',
        'wrappers'   => $wrappers,
        'attributes' => [
            'id' => 'status',
        ],
        'options'    => [
            $statusList,
            $checked0,
            '<br>',
            true
        ],
    ],
    'Status 1' => [
        'class'      => 'Application\Form\Element\Select',
        'type'       => Generic::TYPE_SELECT,
        'label'      => 'Status 1',
        'wrappers'   => $wrappers,
        'attributes' => [
            'id' => 'hobby',
        ],
        'options'    => [
            $statusList,
            $checked1,
        ],
    ],
    'Status 2' => [
        'class'      => 'Application\Form\Element\Radio',
        'type'       => Generic::TYPE_CHECKBOX,
        'label'      => 'Status 2',
        'wrappers'   => $wrappers,
        'attributes' => [
            'id' => 'status2',
        ],
        'options'    => [
            $statusList,
            $checked2,
            '<br>',
            true
        ],
    ],
    'Status 3' => [
        'class'      => 'Application\Form\Element\Select',
        'type'       => Generic::TYPE_SELECT,
        'label'      => 'Status 3',
        'wrappers'   => $wrappers,
        'attributes' => [
            'id' => 'hobby2',
            'multiple' => true, // 下拉框，单选和多选
            'size' => '4'
        ],
        'options'    => [
            $statusList,
            $checked1,
        ],
    ],
    'submit'   => [
        'class'      => 'Application\Form\Generic',
        'type'       => Generic::TYPE_SUBMIT,
        'label'      => '',
        'wrappers'   => $wrappers,
        'attributes' => [
            'id'       => 'submit',
            'required' => '',
        ],
    ],
];

$form = Factory::generate($config);


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

<h1>Status</h1>

<form action="" method="get">
    <?php echo $form->render($form, $formConfig); ?>
</form>

</body>
</html>


