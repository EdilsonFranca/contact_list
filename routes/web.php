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


Auth::routes();

Route::get('list_management', 'ContactListController@store')->name('list_contact');

Route::get('list_management/{id}', 'ContactListController@show');

Route::delete('list_management/{id}', 'ContactListController@destroy');

Route::post('list_management', 'ContactListController@create');

Route::get('list_management_creation', 'ContactListController@index');

Route::get('contact_report/{id}', 'ContactListController@report');

Route::post('contact', 'ContactController@create');

Route::get('/home', 'HomeController@index');

Route::put('list_management', 'ContactListController@edit');