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

//Home
Route::get('/', 'HomeController@index')->name('home.index');
//Logging
Route::get('/log', 'AuthController@log')->name('auth.login');
Route::post('/log', 'AuthController@logging')->name('auth.logging');
Route::get('/logout', 'AuthController@logout')->name('auth.logout');
Route::middleware(['check.auth'])->group(function () {
    //Author
    Route::get('/author', 'AuthorController@index')->name('author.index');
    Route::get('/author/{author}', 'AuthorController@show')->name('author.show');
    Route::delete('/author/{author}', 'AuthorController@delete')->name('author.delete');
    //Book
    Route::get('/book', 'BookController@index')->name('book.index');
    Route::get('/book/create', 'BookController@create')->name('book.create');
    Route::post('/book', 'BookController@store')->name('book.store');
    Route::delete('/book/{book}', 'BookController@delete')->name('book.delete');
});
