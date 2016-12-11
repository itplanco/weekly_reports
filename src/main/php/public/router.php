<?php

$path = __DIR__ . $_SERVER['REQUEST_URI'];
if (substr($path, strlen($path) - 1) == "/") {
    $path = $path . "index.html";
}

if (is_file($path)) {
    return FALSE;
}
require_once __DIR__ . "/../app/bootstrap.php";