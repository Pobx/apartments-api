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

$router->get('room-categories', 'RoomCategoriesController@index');
$router->post('room-categories/create', 'RoomCategoriesController@create');
$router->put('room-categories/update', 'RoomCategoriesController@update');

$router->get('apartments', 'ApartmentsController@index');
$router->post('apartments/create', 'ApartmentsController@create');
$router->put('apartments/update', 'ApartmentsController@update');

$router->get('renters', 'RentersController@index');
$router->get('renters-by-id/{id}', 'RentersController@find');
$router->post('renters/create', 'RentersController@create');
$router->put('renters/update', 'RentersController@update');

$router->post('renters-attached-files/create', 'RentersAttachedFilesController@create');
$router->put('renters-attached-files/remove-attached-file', 'RentersAttachedFilesController@remove_attached_file');

$router->get('renters-partners-by-renter-id/{id}', 'RenterPartnersController@partners_by_renters_id');
$router->post('renters-partners/create', 'RenterPartnersController@create');
$router->put('renters-partners/remove-partner', 'RenterPartnersController@remove_partner');

$router->get('rooms', 'RoomsController@index');
$router->post('rooms/create', 'RoomsController@create');
$router->put('rooms/update', 'RoomsController@update');

$router->post('utilities-monthly-usage/create', 'UtilitiesMonthlyUsageController@create');
$router->put('utilities-monthly-usage/update', 'UtilitiesMonthlyUsageController@update');

$router->post('utilities-packages/create', 'UtilitiesPackagesController@create');
$router->put('utilities-packages/update', 'UtilitiesPackagesController@update');

$router->post('utilities-package-list/create', 'UtilitiesPackageListController@create');
$router->put('utilities-package-list/update', 'UtilitiesPackageListController@update');

$router->get('utilities-categories', 'UtilityCategoriesController@index');
$router->post('utilities-categories/create', 'UtilityCategoriesController@create');
$router->put('utilities-categories/update', 'UtilityCategoriesController@update');

// upload files maybe public methods
$router->post('uploads/image', 'UploadController@upload_image');
$router->post('uploads/file', 'UploadController@upload_file');

// $router->group(['namespace' => 'App\Http\Controllers'], function () use ($router)
// {
//     $router->post('room-categories/store', 'RoomCategoriesController@store');
// });
