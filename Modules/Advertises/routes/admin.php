<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('advertises/get-data', 'Admin\AdvertiseController@getData')->name('advertises.get-data');
        Route::resource('advertises', 'Admin\AdvertiseController');
    });
});
