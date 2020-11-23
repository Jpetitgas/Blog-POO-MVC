<?php

use App\Controller\Session;

$router->setNamespace('App\Controller');

//front

$router->get('/', 'PublicController@index');
$router->get('/403', 'PublicController@forbidden');
$router->get('/about', 'PublicController@about');


//form

$router->get('/form', 'FormController@index');
$router->post('/form/sent', 'FormController@sent');


//connexion
$router->before('GET', '/login', function () {
    if (isset($_SERVER['HTTP_REFERER'])){
    $undo = $_SERVER['HTTP_REFERER'];
    setcookie('undo', $undo);
    }
});

$router->before('POST', '/checklogin', function () {
    $undo = $_SERVER['HTTP_REFERER'];
    //$_COOKIE['undo']='/';
});

$router->get('/login', 'UsersController@login');
$router->post('/checklogin', 'UsersController@checkLogin');
$router->get('/unlocked', 'UsersController@unlogged');

$router->get('/registration', 'UsersController@registration');
$router->post('/validation', 'UsersController@validation');

$router->get('/articles', 'PostsController@all');
$router->get('/articles/(\d+)', 'PostsController@one');


$router->post('/admin/users/(\d+)/delete/(\w+)', 'UsersController@delete');
$router->post('/admin/users/(\d+)/valided', 'UsersController@valided');

$router->get('/admin/users/(\d+)/edit', 'UsersController@edit');
$router->post('/admin/users/(\d+)/update', 'UsersController@update');

//admin
$router->before('GET|POST', '/admin(/[^/]+)?(/[^/]+)?(/[^/]+)?', function () {
    $session = new Session;
    $a = $session::get('auth');
    if (!isset($a)) {

        header('location: /login');
        exit();
    }
    $b = $session::get('role');
    if ($b === "0") {
        header('location: /403');
        exit();
    }
});
$router->get('/admin', 'AdminController@index');

$router->get('/admin/articles/create', 'AdminController@create');
$router->post('/admin/articles/record', 'PostsController@record');

$router->get('/admin/articles/(\d+)/edit', 'AdminController@edit');
$router->post('/admin/articles/(\d+)/update', 'PostsController@update');

$router->post('/admin/articles/(\d+)/delete/(\w+)', 'PostsController@delete');

//comment
$router->post('/newcomment', 'CommentsController@record');
$router->post('/admin/comments/(\d+)/delete/(\w+)', 'CommentsController@delete');
$router->post('/admin/comments/(\d+)/valided', 'CommentsController@valided');


$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});
