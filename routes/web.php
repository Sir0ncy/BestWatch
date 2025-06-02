<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserMovieController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Models\Movie;
use App\Models\Genre;

Route::get('/', function () {
    $genres = Genre::orderBy('name')->get();
    return view('welcome', compact('genres'));
});

// Route::get('/dashboard', function () {
//     $movies = Movie::with('type')->latest()->take(6)->get();
//     $genres = \App\Models\Genre::orderBy('name')->get();
//     return view('dashboard', compact('genres', 'movies'));
// })->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::resource('/movies', MovieController::class);
    Route::resource('/genres', GenreController::class);
    Route::resource('/users', UserController::class);
});

require __DIR__.'/auth.php';
