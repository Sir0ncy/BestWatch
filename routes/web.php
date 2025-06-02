<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserMovieController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Models\Movie; // Mungkin tidak perlu di sini jika query hanya di controller
use App\Models\Genre; // Mungkin tidak perlu di sini jika query hanya di controller

Route::get('/', function () {
    $genres = \App\Models\Genre::orderBy('name')->get(); // Gunakan FQCN atau pastikan use App\Models\Genre ada
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

    // JIKA Anda ingin detail film hanya untuk pengguna yang sudah login (bukan publik):
    // Pindahkan definisi Route::get('/movies/{movie}', ...) ke dalam grup ini
    // dan hapus definisi publik di atas.
    // Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    // Kecualikan method 'show' dari resource movies untuk admin
    // agar tidak konflik dengan rute publik/pengguna biasa untuk detail film.
    Route::resource('/movies', MovieController::class)->except(['show']);
    Route::resource('/genres', GenreController::class);
    Route::resource('/users', UserController::class);
});

Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

require __DIR__.'/auth.php';