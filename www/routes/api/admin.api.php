<?php
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('get', 'Categories\CategoryController@getAllCategories');
        Route::post('store', 'Categories\CategoryController@store');
        Route::put('update/{categoryId}', 'Categories\CategoryController@update');
        Route::delete('remove/{categoryId}', 'Categories\CategoryController@remove');
        Route::get('items', 'Categories\CategoryController@getCategories');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('get', 'Admin\Products\ProductController@getProducts');
        Route::get('find/{productId}', 'Admin\Products\ProductController@findProduct');
        Route::post('store', 'Admin\Products\ProductController@store');
        Route::put('update/{productId}', 'Admin\Products\ProductController@update');
        Route::delete('remove/{productId}', 'Admin\Products\ProductController@remove');
        Route::post('archive/{productId}', 'Admin\Products\ProductController@archive');
    });
    Route::group(['prefix' => 'orders'], function () {
        //
        Route::group(['prefix' => 'shipments'], function () {
            Route::get('get', 'Admin\Orders\Shipments\ShipmentController@getAllShipments');
            Route::post('store', 'Admin\Orders\Shipments\ShipmentController@store');
            Route::put('update/{shipmentId}', 'Admin\Orders\Shipments\ShipmentController@update');
            Route::delete('remove/{shipmentId}', 'Admin\Orders\Shipments\ShipmentController@remove');
            Route::get('find/{shipmentId}', 'Admin\Orders\Shipments\ShipmentController@findShipment');
        });
    });
});
