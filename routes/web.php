<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ScenarioController;
use App\Http\Controllers\CharacterController;

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
    Route::post('/users/login_update', [UserController::class, 'login_update'])->name('users.login_update');
    
    Route::get('/friends/manage', [FriendController::class, 'manage'])->name('friends.manage');
    Route::get('/friends/follow/{friendCode}', [FriendController::class, 'follow'])->name('friends.follow');
    Route::post('/friends/remove', [FriendController::class, 'remove'])->name('friends.remove');
    Route::get('/friends/add', [FriendController::class, 'add'])->name('friends.add');
    Route::post('/friends/insert', [FriendController::class, 'insert'])->name('friends.insert');

    Route::get('/scenarios/list', [ScenarioController::class, 'list'])->name('scenarios.list');
    Route::get('/scenarios/detail/{id}', [ScenarioController::class, 'detail'])->name('scenarios.detail');
    Route::post('/scenarios/join', [ScenarioController::class, 'join'])->name('scenarios.join');
    Route::get('/scenarios/manage', [ScenarioController::class, 'manage'])->name('scenarios.manage');
    Route::get('/scenarios/manage_detail/{id}', [ScenarioController::class, 'manage_detail'])->name('scenarios.manage_detail');
    Route::get('/scenarios/add', [ScenarioController::class, 'add'])->name('scenarios.add');
    Route::post('/scenarios/insert', [ScenarioController::class, 'insert'])->name('scenarios.insert');
    Route::get('/scenarios/edit/{id}', [ScenarioController::class, 'edit'])->name('scenarios.edit');
    Route::post('/scenarios/update', [ScenarioController::class, 'update'])->name('scenarios.update');
    Route::post('/scenarios/delete', [ScenarioController::class, 'delete'])->name('scenarios.delete');

    Route::get('/characters/manage', [CharacterController::class, 'manage'])->name('characters.manage');
    Route::get('/characters/manage_detail/{id}', [CharacterController::class, 'manage_detail'])->name('characters.manage_detail');
    Route::get('/characters/edit/{id}', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::post('/characters/update', [CharacterController::class, 'update'])->name('characters.update');
    Route::post('/characters/delete', [CharacterController::class, 'delete'])->name('characters.delete');
});
