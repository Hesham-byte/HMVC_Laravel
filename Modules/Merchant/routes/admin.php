<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('merchants/get-data', 'Admin\MerchantsController@getData')->name('merchants.get-data');
        Route::resource('merchants', 'Admin\MerchantsController');
    });
});