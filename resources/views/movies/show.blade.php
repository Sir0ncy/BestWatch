@extends('layouts.app')

@section('title', 'Detail - ' . $movie->title)

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-gray-800 dark:text-white">

        {{-- Trailer Lebih Tinggi --}}
        @if ($movie->trailer_url)
            @php
                $trailerUrl = $movie->trailer_url;
                if (str_contains($trailerUrl, 'youtube.com/watch?v=')) {
                    $trailerUrl = str_replace('watch?v=', 'embed/', $trailerUrl);
                } elseif (str_contains($trailerUrl, 'youtu.be/')) {
                    $trailerUrl = str_replace('youtu.be/', 'youtube.com/embed/', $trailerUrl);
                }
                $trailerUrl = strtok($trailerUrl, '?');
            @endphp
            <div class="w-full h-[450px] mb-8 rounded-xl overflow-hidden shadow-xl bg-black">
                <iframe src="{{ $trailerUrl }}" title="Trailer {{ $movie->title }}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen class="w-full h-full">
                </iframe>
            </div>
        @else
            <div
                class="aspect-w-16 aspect-h-9 rounded-lg bg-gray-200 dark:bg-zinc-700 flex items-center justify-center shadow-xl mb-8">
                <p class="text-gray-500 dark:text-gray-400">Trailer tidak tersedia.</p>
            </div>
        @endif

        {{-- Poster + Info --}}
        <div class="flex flex-col md:flex-row items-start gap-6 lg:gap-10 mb-6">

            {{-- Poster 1/4 --}}
            <div class="w-1/4 flex-shrink-0">
                <img src="{{ $movie->image_url ?? 'https://placehold.co/300x450/e2e8f0/cbd5e0?text=No+Image' }}"
                    alt="Poster {{ $movie->title }}" class="rounded-lg shadow-md h-auto object-cover aspect-[2/3]"
                    onerror="this.onerror=null; this.src='https://placehold.co/300x450/e2e8f0/cbd5e0?text=No+Image';">
            </div>

            {{-- Info Film --}}
            <div class="flex-1">
                <h1 class="text-3xl sm:text-4xl font-bold mb-2">{{ $movie->title }}</h1>
                <div class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                    @if ($movie->release_year)
                        <span>{{ $movie->release_year }}</span>
                    @endif
                    @if ($movie->duration)
                        <span class="mx-1">&bull;</span>
                        <span>{{ $movie->duration }} menit</span>
                    @endif
                    @if ($movie->type)
                        <span class="mx-1">&bull;</span>
                        <span>{{ $movie->type->name ?? '-' }}</span>
                    @endif
                </div>
                <p class="mb-2">
                    <strong>Genre:</strong>
                    @if ($movie->genres && $movie->genres->isNotEmpty())
                        {{ $movie->genres->pluck('name')->join(', ') }}
                    @else
                        <span class="text-gray-500 dark:text-gray-400">-</span>
                    @endif
                </p>

                @if ($movie->total_episode)
                    <p><strong>Total Episode:</strong> {{ $movie->total_episode }}</p>
                @endif
            </div>
        </div>

        {{-- IMDb Score --}}
        <div class="mb-6">
            <p class="text-sm sm:text-base">
                <strong>Skor IMDb:</strong> {{ $movie->imdb_score ?? '-' }}
            </p>
        </div>

        {{-- Deskripsi --}}
        @if ($movie->description)
            <div class="prose prose-sm sm:prose-base dark:prose-invert max-w-none">
                <h2 class="text-xl font-semibold mb-2 border-b pb-1 border-gray-300 dark:border-zinc-600">Deskripsi</h2>
                <p>{{ $movie->description }}</p>
            </div>
        @else
            <div>
                <h2 class="text-xl font-semibold mb-2 border-b pb-1 border-gray-300 dark:border-zinc-600">Deskripsi</h2>
                <p class="text-gray-500 dark:text-gray-400">Deskripsi tidak tersedia.</p>
            </div>
        @endif

    </div>
@endsection