<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('products/get-data', 'Admin\ProductsController@getData')->name('products.get-data');
        Route::resource('products', 'Admin\ProductsController');
        Route::get('product/image/delete/{id}', 'Admin\ProductsController@delete_product_image')->name('product.image.delete');


    });
});
