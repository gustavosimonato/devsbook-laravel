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

Route::get('/', 'HomeController@index')->name('index');

Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@auth');

Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/post/new', 'PostController@new');
Route::get('/post/{id}/delete', 'PostController@delete');

Route::get('/perfil/{id}/fotos', 'ProfileController@photos');
Route::get('/perfil/{id}/amigos', 'ProfileController@friends');
Route::get('/perfil/{id}/follow', 'ProfileController@follow');
Route::get('/perfil/{id}', 'ProfileController@index');
Route::get('/perfil', 'ProfileController@index');

Route::get('/amigos', 'ProfileController@friends');
Route::get('/fotos', 'ProfileController@photos');

Route::get('/pesquisa', 'SearchController@index');

Route::get('/config', 'ConfigController@index');
Route::post('/config', 'ConfigController@save');

Route::get('/ajax/like/{id}', 'AjaxController@like');
Route::post('/ajax/comment', 'AjaxController@comment');
Route::post('/ajax/upload', 'AjaxController@upload');
