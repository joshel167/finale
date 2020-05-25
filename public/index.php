<?php

require '../app/bootstrap.php';




$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'posts.php');

    $r->addRoute('GET', '/posts[/]', 'PostsController@index');
    $r->addRoute('GET', '/posts/{id:\d+}[/]', 'PostsController@show');
    $r->addRoute('POST', '/posts/new[/]', 'PostsController@store');
    $r->addRoute('GET', '/posts/new[/]', 'PostsController@add');
    $r->addRoute('GET', '/posts/{id:\d+}/edit[/]', 'PostsController@edit');
    $r->addRoute('GET', '/posts/{id:\d+}/delete[/]', 'PostsController@delete');
    $r->addRoute('POST', '/posts/{id:\d+}[/]', 'PostsController@update');


    $r->addRoute('GET', '/posts/{id:\d}/[tmp:.+]', 'posts.php');
    // {id} must be a number (\d+)

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
//    require "../app/" . $handler;
        $tmp = explode("@", $handler);
        $class = $tmp[0];
        $method = $tmp[1];
        $controller = new $class;
        $controller->$method($vars);



        break;

}