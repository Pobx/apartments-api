<?php

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

$router->get('/', function () use ($router)
{
    return $router->app->version();
});

$router->get('/key', function ()
{
    return str_random(32);
});

$router->post('room-categories/create', 'RoomCategoriesController@create');
$router->put('room-categories/update', 'RoomCategoriesController@update');

$router->post('apartments/create', 'ApartmentsController@create');
$router->put('apartments/update', 'ApartmentsController@update');

$router->post('renters/create', 'RentersController@create');
$router->put('renters/update', 'RentersController@update');

$router->post('renters-attached-files/create', 'RentersAttachedFilesController@create');
$router->post('renters-attached-files/remove-attached-file', 'RentersAttachedFilesController@remove_attached_file');

// $router->group(['namespace' => 'App\Http\Controllers'], function () use ($router)
// {
//     $router->post('room-categories/store', 'RoomCategoriesController@store');
// });
