<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMovieController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $movies = $user->movies()->get(); 
        return view('user_movies.index', compact('movies'));
    }

    public function store(Request $request, $movieId)
    {
        $user = Auth::user();
        $movie = Movie::findOrFail($movieId);

        $user->movies()->attach($movie);

        return redirect()->back()->with('success', 'Movie berhasil ditambahkan ke favorit.');
    }

    public function destroy($movieId)
    {
        $user = Auth::user();
        $user->movies()->detach($movieId);

        return redirect()->back()->with('success', 'Movie berhasil dihapus dari favorit.');
    }
}
