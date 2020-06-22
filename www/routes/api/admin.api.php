<?php
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('get', 'Categories\CategoryController@getCategories');
        Route::post('store', 'Categories\CategoryController@store');
        Route::put('update/{categoryId}', 'Categories\CategoryController@update');
        Route::delete('remove/{categoryId}', 'Categories\CategoryController@remove');
    });
    Route::group(['prefix' => 'products'], function () {
       Route::get('get', 'Admin\Products\ProductController@getProducts');
       Route::get('find/{productId}', 'Admin\Products\ProductController@findProduct');
       Route::post('store', 'Admin\Products\ProductController@store');
       Route::put('update/{productId}', 'Admin\Products\ProductController@update');
       Route::delete('remove/{productId}', 'Admin\Products\ProductController@remove');
    });
});
