<?php

use Illuminate\Http\Request;

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


$router->post('register', ['uses' => 'UsersController@register']);

 $router->get('tasks', ['uses' => 'TasksController@get']);
    $router->post('tasks', ['uses' => 'TasksController@create']);
    $router->post('tasks/{id}', ['uses' => 'TasksController@update']);
    $router->delete('tasks/{id}', ['uses' => 'TasksController@delete']);
    $router->post('tasks/mark-all/{completed}', ['uses' => 'TasksController@markAll']);
    

    $router->get('tasks/{tasksId}/tasksdescription', ['uses' => 'TasksDescriptionController@get']);
    $router->post('tasks/{tasksId}/tasksdescription', ['uses' => 'TasksDescriptionController@create']);
    $router->delete('tasks/{tasksId}/tasksdescription/{id}', ['uses' => 'TasksDescriptionController@get']);
