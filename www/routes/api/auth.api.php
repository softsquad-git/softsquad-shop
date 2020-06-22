<?php
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Auth\AuthController@registerUser');
    Route::post('login', 'Auth\AuthController@logout');
});
