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
Route::middleware('auth:api')->post('/v1/createuser/{id?}','DataController@store');
Route::middleware('auth:api')->get('/v1/getupdateid/{id?}', 'DataController@show');
Route::middleware('auth:api')->post('/v1/updateuser/{id?}', 'DataController@update');
Route::middleware('auth:api')->delete('/v1/getid/{id?}', 'DataController@destroy');
// Roles
Route::middleware('auth:api')->post('/v1/createroles','RoleController@storerole');
Route::middleware('auth:api')->get('/v1/roles', 'RoleController@indexroles');
Route::middleware('auth:api')->get('/v1/getupdateidrole/{id?}', 'RoleController@showrole');
Route::middleware('auth:api')->post('/v1/updaterole/{id?}', 'RoleController@updaterole');
Route::middleware('auth:api')->delete('/v1/deleterole/{id?}', 'RoleController@destroyrole');
// Customers
Route::middleware('auth:api')->post('/v1/createcustomers/{id?}','CustomersController@store');
Route::middleware('auth:api')->get('/v1/customers', 'CustomersController@index');
Route::get('/v1/getupdateidcustomers/{id?}', 'CustomersController@show');
Route::middleware('auth:api')->post('/v1/updatecustomers/{id?}', 'CustomersController@update');
Route::middleware('auth:api')->delete('/v1/deletecustomers/{id?}', 'CustomersController@destroy');
// Menus
Route::middleware('auth:api')->post('/v1/createmenus/{id?}','MenuController@store');
Route::middleware('auth:api')->get('/v1/menus', 'MenuController@index');
Route::middleware('auth:api')->get('/v1/getupdateidmenus/{id?}', 'MenuController@show');
Route::middleware('auth:api')->post('/v1/updatemenus/{id?}', 'MenuController@update');
Route::middleware('auth:api')->delete('/v1/deletemenus/{id?}', 'MenuController@destroy');
// Menu Details
Route::middleware('auth:api')->post('/v1/createmenudetails/{id?}','MenuDetailController@store');
Route::middleware('auth:api')->get('/v1/menudetails', 'MenuDetailController@index');
Route::middleware('auth:api')->get('/v1/getupdateidmenudetails/{id?}', 'MenuDetailController@show');
Route::middleware('auth:api')->post('/v1/updatemenudetails/{id?}', 'MenuDetailController@update');
Route::middleware('auth:api')->delete('/v1/deletemenudetails/{id?}', 'MenuDetailController@destroy');