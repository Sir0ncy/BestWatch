<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserMovieController;
use App\Models\Genre;
use App\Models\Movie;

Route::get('/', function () {
    $genres = \App\Models\Genre::orderBy('name')->get();
    return view('welcome', compact('genres'));
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/my-list', [UserMovieController::class, 'index'])->name('my-list'); 
    Route::post('/my-list/{movie}/add', [UserMovieController::class, 'addFavorite'])->name('my-list.add');
    Route::delete('/my-list/{movie}/remove', [UserMovieController::class, 'removeFavorite'])->name('my-list.remove');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('/movies', MovieController::class)->except(['show']);
    Route::resource('/genres', GenreController::class);
    Route::resource('/users', UserController::class);
});

Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/setting', [SettingController::class, 'index'])->name('setting');
Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
Route::post('/setting/delete-account', [SettingController::class, 'destroy'])->name('setting.destroy')->middleware('auth');

require __DIR__.'/auth.php';