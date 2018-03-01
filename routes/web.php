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

if (!function_exists('generateApiRoutes')) {
    /**
     * @param \Illuminate\Support\Facades\Route $router
     * @param string $pattern
     * @param string $destination
     */
    function generateApiRoutes($router, $pattern, $destination)
    {
        $router->get($pattern, $destination . '@index');
        $router->get($pattern . '/{id}', $destination . '@show');
        $router->post($pattern, $destination . '@store');
        $router->put($pattern . '/{id}', $destination . '@update');
        $router->delete($pattern . '/{id}', $destination . '@destroy');
    }
}

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['namespace' => 'Api'], function ($router) {
    $router->post('/login', 'AuthController@login');
    $router->group(['middleware' => 'auth'], function ($router) {
        generateApiRoutes($router, 'questions', 'QuestionController');
        $router->post('/history', 'HistoryController@store');
    });
});