<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------- l;'
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', BooksController::class);
Route::resource('books', BooksController::class);

Route::get('/', [BooksController::class, 'index']);
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/create_book', [BooksController::class, 'create'])->name('create_book');
// Route::post('/books', [BooksController::class, 'store'])->name('book.store');

Route::get('/home_user', [BooksController::class, 'index'])->name('home_user');
Route::get('/profile', [UserController::class, 'index'])->name('profile');

Route::get('books/export', [BooksController::class, 'export'])->name('books.export');

// Route::get('/cat/{cat_id}', [BooksController::class, 'category'])->name('books.category');

Route::post('category', [BooksController::class, 'newCategory'])->name('books.category');