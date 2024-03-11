<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->name('admin.')->group(function () {
    //********************* Authenticated routes ***************************
    Route::middleware('auth:admin')->group(function () {
        Route::get('tags/get-data', 'Admin\TagsController@getData')->name('tags.get-data');
        Route::resource('tags', 'Admin\TagsController');
    });
});
