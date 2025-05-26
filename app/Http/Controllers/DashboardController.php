<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $movies = Movie::with('type')->get(); 

        return view('dashboard', compact('movies'));
    }
}
