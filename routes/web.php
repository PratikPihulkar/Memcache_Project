<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/cache/store', 'MemcachedController@store');
$router->get('/cache/retrieve/{key}', 'MemcachedController@retrieve');
$router->delete('/cache/delete/{key}', 'MemcachedController@delete');
$router->delete('/cache/clear', 'MemcachedController@clearAll');

