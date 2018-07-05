<?php
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

/**
 * Api Doc
 */
Route::get('/doc', '\App\Api\Common\ApiDoc@index');

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'node'], function ($api) {
            $api->get('/', 'NodeInfoController@index');
            $api->post('errors', 'NodeInfoController@create');
        });

        $api->group(['prefix' => 'client'], function ($api) {
            $api->get('/', 'ClientController@index');
            $api->post('check', 'ClientController@create');
        });
    });
});
