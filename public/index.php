<?php

session_start();

require_once '../vendor/autoload.php';

use Shop\core\Router;

$router = new Router();

$router->run();
