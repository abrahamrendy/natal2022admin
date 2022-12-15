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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [App\Http\Controllers\IndexController::class, 'verificator'])->name('index');
Route::post('/submit', [App\Http\Controllers\IndexController::class, 'submit'])->name('submit');
Route::post('/temp_verify', [App\Http\Controllers\IndexController::class, 'scan'])->name('temp_verify');


// Route::post('/login_user', [App\Http\Controllers\UserController::class, 'login'])->name('login_user');

Route::prefix('user')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user')->middleware('checkuserlogin');
    Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login_user')->middleware('checkuserlogin');
    Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout_user');
    Route::post('/submit_edit', [App\Http\Controllers\UserController::class, 'edit'])->name('submit_edit');
});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings');
    Route::post('/submit_ibadah', [App\Http\Controllers\HomeController::class, 'submit_ibadah'])->name('submit_ibadah');
});
