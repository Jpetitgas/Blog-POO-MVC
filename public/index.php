<?php
/**
 * page qui instancie le router
 * 
 */

session_start();
use Bramus\Router\Router;

define('ROOT', dirname(__DIR__));

require ROOT. '/vendor/autoload.php';
require ROOT. '/config/config.php';


$router = new Router;
require ROOT. '/config/routes.php';
$router->run();