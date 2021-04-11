<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profil', [App\Http\Controllers\HomeController::class, 'profil'])->name('profil');

Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('isadmin');

    Route::get('admin/books', [App\Http\Controllers\BookController::class, 'books'])
    ->name('admin.books')
    ->middleware('isadmin');
    Route::post('admin/books1', [App\Http\Controllers\BookController::class, 'submit_books'])
    ->name('admin.books.submit')
    ->middleware('isadmin');
    Route::post('admin/books/update', [App\Http\Controllers\BookController::class, 'update_books'])
    ->name('admin.books.update')
    ->middleware('isadmin');
    Route::post('admin/books/delete', [App\Http\Controllers\BookController::class, 'delete_books'])
    ->name('admin.books.delete')
    ->middleware('isadmin');