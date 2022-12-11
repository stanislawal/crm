<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Tables\TableProject;
use App\Http\Controllers\User\UserController;
use PhpOption\Option;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestShowController;
use App\Http\Controllers\Auth\AuthController;
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


//Список проектов
//Route::get('/list_projects', function(){
//    return view('project.list_projects');
//})->name('project.list_projects');

//Список клиентов
// Route::get('list_clients', function(){
//     return view('client.list_clients');
// })->name('client.list_clients');


Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    // login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});


Route::middleware('auth')->group(function () {
    # Проекты
    Route::resource('project', ProjectController::class)->except('show');

    # Клиенты
    Route::resource('client', ClientController::class);

    # Рассчетные таблицы
    Route::resource('table_project', TableProject::class);

    # Добавление пунктов в select
    Route::resource('add_option_status', StatusController::class);
    Route::resource('add_option_theme', ThemeController::class);
    Route::resource('add_option_style', StyleController::class);

    #
    Route::resource('add_option_socialnetwork', SocialNetworkController::class);

    # Пользователи
    Route::resource('user', UserController::class);
});
