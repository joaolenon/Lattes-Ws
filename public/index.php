<?php

define("ROOT_PATH", realpath('../'));
define("DS", DIRECTORY_SEPARATOR);

include ROOT_PATH.DS.'vendor'.DS.'autoload.php';

use Lattes\Application;

try {
    $app = new Application();
    $app->init();
} catch (Exception $e) {
    echo '<h1>' . $e->getMessage() . '</h1>';
    exit;
}
