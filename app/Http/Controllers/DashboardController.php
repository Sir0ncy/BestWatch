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

        // 🔍 Filter berdasarkan search keyword
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $movies = $query->paginate(6)->withQueryString(); // withQueryString agar filter tetap tersimpan saat pindah halaman
        $genres = Genre::orderBy('name')->get();
        $types = Type::orderBy('name')->get();

        return view('dashboard', compact('movies', 'genres', 'types'));
    }
}

