<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Type;
use Illuminate\Routing\Controller;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with('type')->get();
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('movies.movies', compact('genres', 'movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = \App\Models\Type::all();
        $genres = Genre::all();
        return view('movies.create', compact('types', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string',
            'imdb_score' => 'nullable|numeric',
            'trailer_url' => 'nullable|string',
            'type_id' => 'required|exists:types,id',
            // 'genre_id' => 'required|exists:genres,id',
            'release_year' => 'required|integer',
            'duration' => 'nullable|integer',
            'total_episode' => 'nullable|integer',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $movie = Movie::create($validated);
        $movie->genres()->attach($validated['genres']);

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
        $movie = Movie::with('genres')->findOrFail($id);
        $genres = Genre::all();
        $types = Type::all();

        return view('movies.edit', compact('movie', 'genres', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string',
            'imdb_score' => 'nullable|numeric',
            'trailer_url' => 'nullable|string',
            'type_id' => 'required|exists:types,id',
            // 'genre_id' => 'required|exists:genres,id',
            'release_year' => 'required|integer',
            'duration' => 'nullable|integer',
            'total_episode' => 'nullable|integer',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $movie->update($validated);
        $movie->genres()->sync($validated['genres']);

        return redirect()->route('movies.index')->with('success', 'Movie berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil dihapus.');
    }
}
