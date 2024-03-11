<?php

use Illuminate\Support\Facades\Route;

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

include __DIR__.'/admin.php';

Route::get('login',function(){ dd('login'); })->name('login');

Route::get('change-locale/{locale}',function($locale){
    if(!in_array($locale,['ar','en']))
        abort(404);
    session()->put('locale',$locale);
    return redirect()->back();
})->name('change-locale');

Route::get('/mailable', function () {
    $user = App\Models\User::find(1);
 
    return new App\Mail\ResetPasswordMail($user);
    // return new App\Mail\InvoicePaid($invoice);
});
