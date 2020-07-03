<?php
Route::post('create-order', 'Orders\OrderController@store');
Route::group(['prefix' => 'products'], function () {
   Route::get('get', 'Products\ProductController@getProducts');
   Route::get('find/{productId}', 'Products\ProductController@findProduct');
   Route::get('category/{alias}', 'Products\ProductController@getProductsCategory');
});
Route::get('categories', 'Categories\CategoryController@getAllCategories');
Route::get('category/{alias}', 'Categories\CategoryController@findCategory');
