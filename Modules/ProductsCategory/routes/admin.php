<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('productscategory/get-data', 'Admin\ProductsCategoryController@getData')->name('productscategory.get-data');
        Route::resource('productscategory', 'Admin\ProductsCategoryController');
    });
});
