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
    return response('Desafio DataInfo. Serei seu novo parceiro!<br />Alex Barreto [alexssb2003@gmail.com - (61) 98162-5808]', '200');
});

$router->group(['prefix' => '/app/v1/to-do'], function() use ($router){
    $router->get('', [
        'uses' => 'Controller@index'
    ]);

    $router->get('/{id}', [
        'uses' => 'Controller@show'
    ]);

    $router->post('', [
        'uses' => 'Controller@add'
    ]);

    $router->put('/{id}', [
        'uses' => 'Controller@update'
    ]);

    $router->delete('/{id}', [
        'uses' => 'Controller@delete'
    ]);
});
