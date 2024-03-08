<?php

$controllers = [
    'Student' => [
        'index',
        'create',
        'update',
        'delete'
    ]
];

// if (!array_key_exists($controller, $controllers) || !in_array($method, $controller[$method])) {
//     return 123;
// }

$file = __DIR__ . '/Controllers/' . $controller . '.php';
require_once $file;

$specContro = new $controller();
$specContro->$method();

