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
    return $router->app->version();
});

$router->group(['prefix' => '/api/{username}'], function () use ($router) {
    $router->group(['prefix' => '/series'], function () use ($router) {
        $router->get('', 'SeriesController@index');
        $router->get('{id}', 'SeriesController@show');
        $router->post('', 'SeriesController@store');
        $router->put('{id}', 'SeriesController@update');
        $router->delete('{id}', 'SeriesController@destroy');

        $router->get('{serieId}/seasons', 'SeasonsController@searchSeason');
    });

    $router->group(['prefix' => '/seasons'], function () use ($router) {
        $router->get('', 'SeasonsController@index');
        $router->get('{id}', 'SeasonsController@show');
        $router->post('', 'SeasonsController@store');
        $router->put('{id}', 'SeasonsController@update');
        $router->delete('{id}', 'SeasonsController@destroy');
    });

    $router->group(['prefix' => '/list'], function () use ($router) {
        $router->get('', 'SeriesListController@index');
        $router->get('{id}', 'SeriesListController@show');
        $router->post('', 'SeriesListController@store');
        $router->put('{id}', 'SeriesListController@update');
        $router->delete('{id}', 'SeriesListController@destroy');
    });

    $router->group(['prefix' => '/episodes'], function () use ($router) {
        $router->get('', 'WatchedEpisodesController@index');
        $router->get('{id}', 'WatchedEpisodesController@show');
        $router->post('', 'WatchedEpisodesController@store');
        $router->put('{id}', 'WatchedEpisodesController@update');
        $router->delete('{id}', 'WatchedEpisodesController@destroy');
    });
});

$router->post('/api/login', 'TokenController@generateToken');