<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Type;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::with(['type', 'genres'])->latest();

        // Filter berdasarkan genre
        if ($request->has('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }

        // Filter berdasarkan type
        if ($request->has('type')) {
            $query->where('type_id', $request->type);
        }

        $movies = $query->paginate(6)->withQueryString();
        $genres = Genre::orderBy('name')->get();
        $types = Type::orderBy('name')->get();

        return view('dashboard', compact('movies', 'genres', 'types'));
    }
}

