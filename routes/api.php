<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
// Users
Route::get('/v1/user', 'DataController@index');
Route::post('/v1/createuser/{id?}','DataController@store');
Route::get('/v1/getupdateid/{id?}', 'DataController@show');
Route::post('/v1/updateuser/{id?}', 'DataController@update');
Route::delete('/v1/getid/{id?}', 'DataController@destroy');
// Roles
Route::post('/v1/createroles','RoleController@storerole');
Route::get('/v1/roles', 'RoleController@indexroles');
Route::get('/v1/getupdateidrole/{id?}', 'RoleController@showrole');
Route::post('/v1/updaterole/{id?}', 'RoleController@updaterole');
Route::delete('/v1/deleterole/{id?}', 'RoleController@destroyrole');
// Customers
Route::post('/v1/createcustomers/{id?}','CustomersController@store');
Route::get('/v1/customers', 'CustomersController@index');
Route::get('/v1/getupdateidcustomers/{id?}', 'CustomersController@show');
Route::post('/v1/updatecustomers/{id?}', 'CustomersController@update');
Route::delete('/v1/deletecustomers/{id?}', 'CustomersController@destroy');
// Menus
Route::post('/v1/createmenus/{id?}','MenuController@store');
Route::get('/v1/menus', 'MenuController@index');
Route::get('/v1/getupdateidmenus/{id?}', 'MenuController@show');
Route::post('/v1/updatemenus/{id?}', 'MenuController@update');
Route::delete('/v1/deletemenus/{id?}', 'MenuController@destroy');
// Menu Details
Route::post('/v1/createmenudetails/{id?}','MenuDetailController@store');
Route::get('/v1/menudetails', 'MenuDetailController@index');
Route::get('/v1/getupdateidmenudetails/{id?}', 'MenuDetailController@show');
Route::post('/v1/updatemenudetails/{id?}', 'MenuDetailController@update');
Route::delete('/v1/deletemenudetails/{id?}', 'MenuDetailController@destroy');