<?php

namespace App\Http\Controllers;

use App\Models\Movie; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMovieController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $favoriteMovies = $user->favoriteMovies()
                               ->orderByPivot('created_at', 'desc') // <--- INI PERUBAHAN PENTING
                               ->paginate(12); 

        return view('user_movies.index', compact('favoriteMovies'));
    }


    public function addFavorite(Request $request, Movie $movie)
    {
        $user = Auth::user();

        if ($user->hasFavorited($movie)) { 
            return back()->with('info', $movie->title . ' sudah ada di daftar favorit Anda.');
        }

        $user->listedMovies()->syncWithoutDetaching([
            $movie->id => ['status' => 'favorite', 'created_at' => now(), 'updated_at' => now()]
        ]);

        return back()->with('success', $movie->title . ' berhasil ditambahkan ke favorit!');
    }

    public function removeFavorite(Request $request, Movie $movie) 
    {
        $user = Auth::user();
        $detachedCount = $user->favoriteMovies()->detach($movie->id);

        if ($detachedCount > 0) {
            $message = $movie->title . ' berhasil dihapus dari daftar favorit.';
            $statusType = 'success';
        } else {

            $message = $movie->title . ' tidak ditemukan di daftar favorit Anda atau sudah dihapus.';
            $statusType = 'info';
        }

        if ($request->headers->get('referer') && str_contains($request->headers->get('referer'), route('my-list', [], false))) {
            return redirect()->route('my-list')->with($statusType, $message);
        }

        return back()->with($statusType, $message);
    }
}