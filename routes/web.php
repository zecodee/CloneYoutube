<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/auth', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('auth', [AuthController::class, 'auth'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('register', [AuthController::class, 'register'])->middleware('guest');

Route::resource('/{username}/dashboard', DashboardController::class)->middleware('auth', 'verify.user');
Route::get('/{username}/dashboard/{vidTube}/edit', [DashboardController::class, 'edit'])
    ->middleware('auth', 'verify.user');


Route::get('/{username}/account', [AccountController::class, 'index'])->middleware('auth', 'verify.user');
Route::post('/{username}/account/update', [AccountController::class, 'update'])->middleware('auth', 'verify.user');
Route::post('/{username}/account/delete-image', [AccountController::class, 'deleteImage'])->middleware('auth', 'verify.user');

Route::resource('/{username}/upload', UploadController::class)->middleware('auth', 'verify.user');

Route::get('/{title}', [DetailController::class, 'detail']);
Route::post('like', [DetailController::class, 'like'])->middleware('auth');
Route::post('dislike', [DetailController::class, 'dislike'])->middleware('auth');
Route::post('comment', [DetailController::class, 'comment'])->middleware('auth');
Route::post('playlist', [DetailController::class, 'playlist'])->middleware('auth');

Route::get('/channel/{username}', [ChannelController::class, 'index']);

Route::post('/subscribe/{username}', [ChannelController::class, 'subscribe'])->middleware('auth');
Route::post('/unsubscribe/{username}', [ChannelController::class, 'unsubscribe'])->middleware('auth');

Route::get('/playlist/{username}', [PlaylistController::class, 'index'])->middleware('auth', 'verify.user');