<?php
use App\User;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->post('/auth','App\Http\Controllers\APIAuthController@getToken');

    //everything in this group requires token auth
    $api->group(['middleware' => 'api'],function($api){
        $api->get('/test',function(){
            return "authed";
        });
    });

});
