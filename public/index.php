<?php


use Bramus\Router\Router;


define('ROOT', dirname(__DIR__));

require ROOT.  '/vendor/autoload.php';


$router = new Router;
$router->setNamespace('App\Controller');


$router->get('/articles', 'ArticlesController@index');
$router->get('/articles/(\d+)', 'ArticlesController@show');
$router->get('/articles/create', 'ArticlesController@create');
$router->post('/articles', 'ArticlesController@new');
$router->get('/articles/(\d+)/edit', 'ArticlesController@edit');
$router->post('/articles/(\d+)/edit', 'ArticlesController@update');
$router->post('/articles/(\d+)/delete', 'ArticlesController@delete');



$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});

$router->run();
