<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'AuthController@register');

Route::middleware('auth:api')
    ->group(function () {
        Route::get('user', function (Request $request) {
		    return $request->user();
	    });

        // Users
        Route::apiResource('users', 'UsersController');

        // Todo Listers
        Route::get('lists', 'TodoListsController@index');
        Route::get('lists/{id}', 'TodoListsController@show');
        Route::post('lists', 'TodoListsController@store');
        Route::put('lists/{id}', 'TodoListsController@update');
        Route::delete('lists/{id}', 'TodoListsController@destroy');

        Route::post('lists/{id}', 'TodoListsController@checked');

});
