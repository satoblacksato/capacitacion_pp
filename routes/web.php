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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');

})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-book/{category}',
    [\App\Http\Controllers\ComunController::class,'createBook'])
    ->name('create_book');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-book/{book}',
    [\App\Http\Controllers\ComunController::class,'editBook'])
    ->name('edit_book');

Route::get('/view-book/{book}',
    [\App\Http\Controllers\ComunController::class,'viewBook'])
    ->name('view_book');


Route::get('/get-books-c/{category}' ,[\App\Http\Controllers\ComunController::class,'getBooksByCategory'])->name('get_books')
    ->middleware('can:category-book');
Route::get('/get-books-a/{user}' ,[\App\Http\Controllers\ComunController::class,'getBooksByUser'])->name('get_books_users')
->middleware('can:user-book');

Route::get('change-lang/{lang}',[\App\Http\Controllers\ComunController::class,'changeLang'])
    ->where(['lang'=>'es|en'])
    ->name('change_lang')
    ->middleware('can:change-lang');



Route::get('/auth/redirect/{provider}',[\App\Http\Controllers\AuthSocialController::class,'redirect'])
->name('login_social');

Route::get('auth/{provider}/callback',[\App\Http\Controllers\AuthSocialController::class,'callback']);


Route::group(['middleware' => 'can-contact-us:5,6,7'],function (){
    Route::view('/contact-us','static.contact_us')->name('contact_us');
    Route::post('send-email',[\App\Http\Controllers\ComunController::class,'sendEmail'])->name('send_email');

});



Route::view('/policy-privacy','static.policy_privacy')->name('policy_privacy')->middleware('can:static-privacy');
Route::view('/about-us','static.about_us')->name('about_us')->middleware('can:static-about');
Route::view('/terms-conditions','static.terms_conditions')->name('terms_conditions')->middleware('can:static-terms');


Route::get('/asigna-role',function (){
    Bouncer::allow('admin')->to(['static-about','static-privacy','static-terms']);
    Bouncer::allow('admin')->to(['change-lang','list-user-book','user-book','category-book']);
    Bouncer::assign('admin')->to(\App\Models\User::find(13));


});


