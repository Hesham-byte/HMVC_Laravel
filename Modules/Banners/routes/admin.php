<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('banners/get-data', 'Admin\BannersController@getData')->name('banners.get-data');
        Route::resource('banners', 'Admin\BannersController');
    });
});
