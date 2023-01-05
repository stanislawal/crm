<?php

use App\Helpers\UserHelper;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Tables\TableProject;
use App\Http\Controllers\User\UserController;
use PhpOption\Option;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestShowController;
use App\Http\Controllers\Option\StyleController;
use App\Http\Controllers\Option\ThemeController;
use App\Http\Controllers\Option\StatusController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Option\SocialNetworkController;

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


#Главная страница (пустая)

Route::get('/', function () {
    if (is_null(UserHelper::getUserId())) {
        return redirect()->route('login.index');
    } else {
        return redirect()->route('home');
    }
});

#Авторизация

Route::resource('login', AuthController::class)->only(['index', 'store']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Route::middleware('guest')->group(function () {
//    // login
//    Route::get('login', [AuthController::class, 'login'])->name('login');
//});


Route::middleware('auth')->group(function () {

    # Главная страница
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    # Проекты
    Route::resource('project', ProjectController::class)->except('show');

    # Клиенты
    Route::resource('client', ClientController::class)->except('show');

    # Добавление пунктов в select
    Route::resource('add_option_status', StatusController::class);
    Route::resource('add_option_theme', ThemeController::class);
    Route::resource('add_option_style', StyleController::class);
    Route::resource('add_option_socialnetwork', SocialNetworkController::class);

    # Пользователи
    Route::resource('user', UserController::class);

    # Статьи
    Route::resource('article', ArticleController::class)->only(['store', 'update']);
    Route::get('article-destroy/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
});


