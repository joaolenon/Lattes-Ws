<?php

define("ROOT_PATH", realpath('../'));
define("DS", DIRECTORY_SEPARATOR);

include ROOT_PATH.DS.'vendor'.DS.'autoload.php';

use Schoolnet\Application;

$app = new Application();
$app->init();