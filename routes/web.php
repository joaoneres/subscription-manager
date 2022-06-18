<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', App\Http\Controllers\UserController::class)->except('store', 'create')->middleware('auth');

Route::middleware('auth')->prefix('profile')->group(function() {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
    Route::post('{user}/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('{user}/simple-data', [App\Http\Controllers\ProfileController::class, 'simpleData'])->name('profile.simple-data');
});
