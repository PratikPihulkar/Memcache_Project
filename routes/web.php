<?php



use App\Http\Controllers\MemcachedController;





$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/cache/store', 'MemcachedController@store');
$router->get('/cache/retrieve/{key}', 'MemcachedController@retrieve');
$router->delete('/cache/delete/{key}', 'MemcachedController@delete');
$router->delete('/cache/clear', 'MemcachedController@clearAll');


$router->post('/storeInCache/{id}', 'MemcachedController@storeInCache');
Route::post('/storeInCaches/{id}', [MemcachedController::class, 'storeInCache']);