<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Genre;             

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }


    public function boot(): void
    {

        View::composer('layouts.right-sidebar', function ($view) {
            $view->with('genres', Genre::orderBy('name')->get());
        });


    }
}