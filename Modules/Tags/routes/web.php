<?php

use Illuminate\Support\Facades\Route;
use Modules\Tags\app\Http\Controllers\TagsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
include __dir__.'/admin.php';

Route::group([], function () {
    Route::resource('tags', TagsController::class)->names('tags');
});
