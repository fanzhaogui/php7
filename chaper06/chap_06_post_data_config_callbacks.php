<?php

require __DIR__ . '/../Application/Autoload/Loader.php';

\Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Filter\CallbackInterface;
use Application\Filter\Messages;
use Application\Filter\Result;


// 通用
/*
    'callback_key' => new class () implements CallBackInterface
    {
        public function __invoke ($item, $params): \Application\Filter\Result
        {
            $changed = array();
            $filtered = ''; // perform filtering operation on $item
            if ($filtered !== $item) {
                $changed = Messages::$messages['callback_key'];
            }
            return new Result($filtered, $changed);
        }
    }
*/




$config = [
    'filters' => [
        'trim' => new class () implements CallBackInterface
        {
            public function __invoke ($item, $params): Result
            {
                $changed = array();
                $filtered = trim($item); /* perform filtering operation on $item */
                if ($filtered !== $item) {
                    $changed = Messages::$messages['trim'];
                }
                return new Result($filtered, $changed);
            }
        },
        'strip_tags' => new class () implements CallBackInterface
        {
            public function __invoke ($item, $params): Result
            {
                $changed = array();
                $filtered = strip_tags($item); // perform filtering operation on $item
                if ($filtered !== $item) {
                    $changed = Messages::$messages['strip_tags'];
                }
                return new Result($filtered, $changed);
            }
        }
        // such as more func
    ],
];