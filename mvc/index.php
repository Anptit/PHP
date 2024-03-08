<?php

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    $method =  $_GET['method'] ?? 'index';
} else {
    $controller = 'StudentController';
    $method = 'index';
}

require_once 'routes.php';
