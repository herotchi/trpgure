<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\UserController;
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

/*
Route::get('/', function () {
    return view('welcome');
});*/
/*
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show_login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/users/insert', [UserController::class, 'insert'])->name('users.insert');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', TopController::class)->name('top');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
    Route::get('/friends/manage', [FridendController::class, 'manage'])->name('friends.manage');
    Route::get('/friends/add', [FridendController::class, 'add'])->name('friends.add');
});
