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

});
$router->get('employees', 'EmployeeController@index');
$router->get('employees/{id}', 'EmployeeController@show');
$router->get('employees/{id}/subordinates', 'EmployeeController@subordinates');
$router->post('employees', 'EmployeeController@create');
$router->put('employees', 'EmployeeController@update');
$router->delete('employees/{id}', 'EmployeeController@delete');
