<?php

Route::get('/', 'BoardController@index')->name('home');
Route::resource('boards', 'BoardController');

/* Authrization */
Route::get('/register', 'RegistrationController@create')->name('register.create');
Route::post('/register', 'RegistrationController@store')->name('register.store');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login.store');

Route::get('/logout', 'SessionsController@destroy')->name('logout');

// lists
Route::get('/list/{board}/create', 'ListsController@create')->name('lists.create');
Route::post('/list', 'ListsController@store')->name('lists.store');

Route::get('list/{list}/edit', 'ListsController@edit')->name('lists.edit');
Route::put('list/{list}', 'ListsController@update')->name('lists.update');

Route::delete('list/{list}', 'ListsController@destroy')->name('lists.destroy');