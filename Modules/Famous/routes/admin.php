<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('famous/get-data', 'Admin\FamousController@getData')->name('famous.get-data');
        Route::resource('famous', 'Admin\FamousController')->parameters([
            'famous' => 'famous:user_id'
        ]);;
    });
});