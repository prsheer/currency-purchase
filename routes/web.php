<?php

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

Route::get('/', 'IndexController@index')->name('homepage');

Route::get('success/{order}', function(App\Order $order) {
    return view('success', compact('order'));
})->name('success');


Route::post('/create', 'IndexController@create');


