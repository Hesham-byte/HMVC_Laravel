<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('customers/get-data', 'Admin\CustomersController@getData')->name('customers.get-data');
        Route::resource('customers', 'Admin\CustomersController');
    });
});