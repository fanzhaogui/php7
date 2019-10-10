<?php

require __DIR__ . '/../Application/Autoload/Loader.php';

\Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Filter\Messages;

Messages::setMessages([
    'length_too_short' => 'Length must be at least %d',
    'length_too_long'  => 'Length must be no more than %d',
    'required'         => 'Please be sure to enter a value',
    'alnum'            => 'Only letters and numbers allowed',
    'float'            => 'Only Numberrs or decimal point',
    'email'            => 'Invalid email address',
    'is_array'         => 'Not found in the list',
    'trim'             => 'Item was trimed',
    'strip_tags'       => 'Tags were removed from this item',
    'filter_float'     => 'Converted to a decimal Number',
    'phone'            => 'Phone number is [+n] nnn-nnn-nnnn',
    'test'             => 'TEST',
    'filter_length'    => 'Reduced to specified length',
]);

