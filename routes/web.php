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
$router->put('renters/update-status', 'RentersController@update_status');


$router->get('renters-attached-files-by-renters-id/{id}', 'RentersAttachedFilesController@find_by_renters_id');
$router->post('renters-attached-files/create', 'RentersAttachedFilesController@create');
$router->put('renters-attached-files/update-attached-file-by-renters-id', 'RentersAttachedFilesController@update_by_renters_id');
$router->put('renters-attached-files/remove-attached-file', 'RentersAttachedFilesController@remove_attached_file');

$router->get('renters-partners-by-renter-id/{id}', 'RenterPartnersController@partners_by_renters_id');
$router->post('renters-partners/create', 'RenterPartnersController@create');
$router->put('renters-partners/update', 'RenterPartnersController@update');
$router->put('renters-partners/remove-partner', 'RenterPartnersController@remove_partner');

$router->get('rooms', 'RoomsController@index');
$router->get('rooms-by-id/{id}', 'RoomsController@find');
$router->get('rooms-by-apartment-id/{id}', 'RoomsController@find_rooms_by_apartment_id');
$router->post('rooms/create', 'RoomsController@create');
$router->put('rooms/update', 'RoomsController@update');

$router->post('utilities-monthly-usage/create', 'UtilitiesMonthlyUsageController@create');
$router->put('utilities-monthly-usage/update', 'UtilitiesMonthlyUsageController@update');

$router->get('utilities-packages', 'UtilitiesPackagesController@index');
$router->post('utilities-packages/create', 'UtilitiesPackagesController@create');
$router->put('utilities-packages/update', 'UtilitiesPackagesController@update');

$router->get('utilities-package-items', 'UtilitiesPackageItemsController@index');
$router->get('utilities-package-items-by-packages-id/{id}', 'UtilitiesPackageItemsController@find_by_packages_id');
$router->post('utilities-package-items/create', 'UtilitiesPackageItemsController@create');
$router->put('utilities-package-items/update', 'UtilitiesPackageItemsController@update');

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
