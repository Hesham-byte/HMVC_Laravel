<?php

use App\Http\Middleware\Locale;

Route::prefix('admin')->middleware(Locale::class)->namespace('App\Http\Controllers\admin')->name('admin.')->group(function () {
    //================= Login =========================
    Route::get('login', 'AuthController@login')->name('login');
    Route::post('auth', 'AuthController@auth')->name('auth');

    //================= Forgot Password =========================
    Route::get('forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
    Route::post('request-forgot-password', 'AuthController@requestForgotPassword')->name('request-forgot-password');

    //================== Reset Password =====================
    Route::get('reset-password/{token}', 'AuthController@getResetPassword')->name('reset-password');
    Route::post('request-forgot', 'AuthController@postResetPassword')->name('post-reset-password');

    //===================== Authenticated routes ===========================
    Route::middleware('auth:admin')->group(function () {

        Route::get('logout', 'AuthController@logout')->name('logout');

        //=============================== Dashboard =============================================
        Route::get('/', 'DashboardController@index')->name('dashboard');

        //================================ Admins ===================================================
        Route::get('admins/ajax-select2', 'AdminsController@getSelect2Ajax')->name('admins.ajax-select2');
        Route::resource('admins', 'AdminsController');

        //================================ Users ===================================================
        Route::get('users/ajax-select2', 'UsersController@getSelect2Ajax')->name('users.ajax-select2');
        Route::resource('users', 'UsersController');

        //============================= Authorization =================================
        Route::resource('pages', 'authorization\PagesController');
        Route::resource('roles', 'authorization\RolesController');


        //================================ countries ===================================================
        Route::get('countries/get-data', 'CountryController@getData')->name('countries.get-data');
        Route::resource('countries', 'CountryController');

    });
});
