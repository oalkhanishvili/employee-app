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

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    return view('documentation');
});



Route::group([
    'prefix' => 'api'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');


    Route::get('employees', 'EmployeeController@index');
    Route::get('employees/{id}', 'EmployeeController@show');
    Route::get('employees/{id}/subordinates', 'EmployeeController@subordinates');
    Route::post('employees', 'EmployeeController@create');
    Route::put('employees/{id}', 'EmployeeController@update');
    Route::delete('employees/{id}', 'EmployeeController@delete');

});
