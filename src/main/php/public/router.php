<?php
$path = __DIR__ . $_SERVER['REQUEST_URI'];
if (is_file($path)) {
    return FALSE;
}
require_once __DIR__ . "/../app/bootstrap.php";