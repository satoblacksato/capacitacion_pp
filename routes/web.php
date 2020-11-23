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

