<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $movies = Movie::with('type')->get();
        return view('movies.movies', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $types = \App\Models\Type::all();
        return view('movies.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required',
            'image_url' => 'nullable',
            'description' => 'nullable',
            'imdb_score' => 'nullable|numeric',
            'trailer_url' => 'nullable',
            'type_id' => 'required|integer',
            'release_year' => 'required|integer',
            'duration' => 'nullable|integer',
            'total_episode' => 'nullable|integer',
        ]);

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Movie berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $movie = Movie::findOrFail($id);
        $genres = Genre::all();

        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $movie->update($validated);

        return redirect()->route('movies.index')->with('success', 'Movie berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil dihapus.');
    }
}
