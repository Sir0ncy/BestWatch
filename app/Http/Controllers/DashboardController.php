<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $movies = Movie::all(); // Ambil semua data film
        return view('dashboard', ['movies' => $movies]);
    }
}
