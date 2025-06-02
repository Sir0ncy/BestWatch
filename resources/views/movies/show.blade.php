@extends('layouts.app')

@section('title', 'Detail - ' . $movie->title)

@section('content')

<div class="max-w-5xl mx-auto py-10 px-4 text-gray-800 dark:text-white"> <h1 class="text-2xl font-bold mb-4">{{ $movie->title }}</h1>

<img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="rounded-lg w-full max-h-[500px] object-cover mb-6">

<div class="space-y-2">
    <p>
    <strong>Genre:</strong>
    @if ($movie->genres && $movie->genres->isNotEmpty())
        {{ $movie->genres->pluck('name')->join(', ') }}
    @else
        -
    @endif
</p>
    <p><strong>Type:</strong> {{ $movie->type->name ?? '-' }}</p>
    <p><strong>Release Year:</strong> {{ $movie->release_year }}</p>
    <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
    @if ($movie->total_episode)
    <p><strong>Total Episode:</strong> {{ $movie->total_episode }}</p>
    @endif
    <p><strong>IMDb Score:</strong> {{ $movie->imdb_score }}</p>
</div>

</div> @endsection