<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();

$router->post('register', ['uses' => 'UsersController@register']);


$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('tasks', ['uses' => 'TasksController@get']);
    $router->post('tasks', ['uses' => 'TasksController@create']);
    $router->post('tasks/{id}', ['uses' => 'TasksController@update']);
    $router->delete('tasks/{id}', ['uses' => 'TasksController@delete']);
    $router->post('tasks/mark-all/{completed}', ['uses' => 'TasksController@markAll']);
    

    $router->get('tasks/{tasksId}/tasksdescription', ['uses' => 'TasksDescriptionController@get']);
    $router->post('tasks/{tasksId}/tasksdescription', ['uses' => 'TasksDescriptionController@create']);
    $router->delete('tasks/{tasksId}/tasksdescription/{id}', ['uses' => 'TasksDescriptionController@get']);
});



