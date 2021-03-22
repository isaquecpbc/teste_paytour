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

Route::prefix('contacts')->group(function () {
	Route::get('/', 'ContactsController@index')->name('contacts.index');
	Route::get('/create', 'ContactsController@create')->name('contacts.create');
	Route::post('/store', 'ContactsController@store')->name('contacts.store');
	Route::get('/{id}/edit', 'ContactsController@edit')->name('contacts.edit');
	Route::put('/{id}/update', 'ContactsController@update')->name('contacts.update');
	Route::get('/{id}/show', 'ContactsController@show')->name('contacts.show');
	Route::delete('/{id}/destroy', 'ContactsController@destroy')->name('contacts.destroy');
});

Route::get('/', 'ContactsController@create')->name('contacts.create');