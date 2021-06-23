<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'signin'])->name('login.signin');
Route::post('/login', [LoginController::class, 'signinAction']);

Route::get('/cadastro', [LoginController::class, 'signup'])->name('cadastro.signup');
Route::post('/cadastro', [LoginController::class, 'signupAction']);

Route::post('/post/new', [PostController::class, 'new']);
Route::get('/post/{id}/delete', [PostController::class, 'delete']);

Route::get('/perfil/{id}/fotos', [ProfileController::class, 'photos']);
Route::get('/perfil/{id}/amigos', [ProfileController::class, 'friends']);
Route::get('/perfil/{id}/follow', [ProfileController::class, 'follow']);
Route::get('/perfil/{id}', [ProfileController::class, 'index']);
Route::get('/perfil', [ProfileController::class, 'index']);

Route::get('/amigos', [ProfileController::class, 'friends']);
Route::get('/fotos', [ProfileController::class, 'photos']);

Route::get('/pesquisa', [SearchController::class, 'index']);

Route::get('/config', [ConfigController::class, 'index']);
Route::post('/config', [ConfigController::class, 'save']);

Route::get('/sair', [LoginController::class, 'logout']);

Route::get('/ajax/like/{id}', [AjaxController::class, 'like']);
Route::post('/ajax/comment', [AjaxController::class, 'comment']);
Route::post('/ajax/upload', [AjaxController::class, 'upload']);
