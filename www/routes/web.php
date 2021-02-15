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
use App\Http\Controllers\UserController;

$router->get('/', function () use ($router) {
    return "<p>Bem vindo(a)!</p><br>".$router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    
    /**
     * User
     */
    $router->get('users',  ['uses' => 'UserController@getAll']);
    $router->get('user/{id}',  ['uses' => 'UserController@get']);
    $router->post('user', ['uses' => 'UserController@create']);
    $router->put('user/{id}', ['uses' => 'UserController@update']);
    $router->delete('user/{id}', ['uses' => 'UserController@delete']);    

    /**
     * Transaction
     */
    $router->post('transaction',  ['uses' => 'TransactionController@transaction']);

});
