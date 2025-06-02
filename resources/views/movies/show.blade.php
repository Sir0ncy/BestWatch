@extends('layouts.app')

@section('title', 'Detail - ' . $movie->title)

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    {{-- Bagian Atas: Poster (kecil) dan Trailer (besar) --}}
    <div class="flex flex-col md:flex-row gap-6 lg:gap-8 mb-8">
        {{-- Kolom Kiri: Poster Film --}}
        {{-- Lebar diatur lebih kecil, misal 1/4 atau 1/5 pada layar medium ke atas --}}
        <div class="w-full md:w-1/4 lg:w-1/5 flex-shrink-0">
            <img src="{{ $movie->image_url ?? 'https://placehold.co/300x450/e2e8f0/cbd5e0?text=No+Image' }}"
                 alt="Poster {{ $movie->title }}"
                 class="rounded-lg shadow-xl w-full h-auto object-cover aspect-[2/3]"
                 onerror="this.onerror=null; this.src='https://placehold.co/300x450/e2e8f0/cbd5e0?text=No+Image';">
        </div>

        {{-- Kolom Kanan: Trailer Film --}}
        {{-- Lebar diatur lebih besar --}}
        <div class="w-full md:w-3/4 lg:w-4/5">
            @if ($movie->trailer_url)
                @php
                    // Mencoba mengubah URL YouTube biasa menjadi URL embed
                    $trailerUrl = $movie->trailer_url;
                    if (str_contains($trailerUrl, 'youtube.com/watch?v=')) { // Untuk URL YouTube biasa
                        $trailerUrl = str_replace('watch?v=', 'embed/', $trailerUrl);
                    } elseif (str_contains($trailerUrl, 'youtu.be/')) { // Untuk URL youtu.be
                        $trailerUrl = str_replace('youtu.be/', 'youtube.com/embed/', $trailerUrl);
                    }
                    // Hapus parameter tambahan setelah ID video jika ada (misalnya &list=...)
                    $trailerUrl = strtok($trailerUrl, '?');
                @endphp
                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-xl bg-black">
                    <iframe src="{{ $trailerUrl }}"
                            title="Trailer {{ $movie->title }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen
                            class="w-full h-full">
                    </iframe>
                </div>
            @else
                {{-- Jika tidak ada trailer, bisa tampilkan gambar film lagi atau placeholder yang lebih besar --}}
                <div class="aspect-w-16 aspect-h-9 rounded-lg bg-gray-200 dark:bg-zinc-700 flex items-center justify-center shadow-xl">
                    <p class="text-gray-500 dark:text-gray-400">Trailer tidak tersedia.</p>
                    {{-- Alternatif: tampilkan poster jika trailer tidak ada
                    <img src="{{ $movie->image_url ?? 'https://placehold.co/1600x900/e2e8f0/cbd5e0?text=No+Trailer' }}"
                         alt="Poster {{ $movie->title }}"
                         class="rounded-lg shadow-xl w-full h-full object-contain"
                         onerror="this.onerror=null; this.src='https://placehold.co/1600x900/e2e8f0/cbd5e0?text=No+Trailer';">
                    --}}
                </div>
            @endif
        </div>
    </div>

    {{-- Bagian Bawah: Judul, Detail, dan Deskripsi --}}
    <div class="text-gray-800 dark:text-white">
        <h1 class="text-3xl sm:text-4xl font-bold mb-1">{{ $movie->title }}</h1>
        <div class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            <span>{{ $movie->release_year ?? '-' }}</span>
            @if ($movie->duration)
                <span class="mx-1">&bull;</span>
                <span>{{ $movie->duration }} menit</span>
            @endif
            @if ($movie->type)
                <span class="mx-1">&bull;</span>
                <span>{{ $movie->type->name ?? '-' }}</span>
            @endif
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-8 gap-y-2 mb-6 text-sm sm:text-base">
            <p class="md:col-span-1">
                <strong>Genre:</strong>
                @if ($movie->genres && $movie->genres->isNotEmpty())
                    {{ $movie->genres->pluck('name')->join(', ') }}
                @else
                    <span class="text-gray-500 dark:text-gray-400">-</span>
                @endif
            </p>
            {{-- <p><strong>Tipe:</strong> {{ $movie->type->name ?? '-' }}</p> --}}
            {{-- <p><strong>Tahun Rilis:</strong> {{ $movie->release_year ?? '-' }}</p> --}}
            {{-- <p><strong>Durasi:</strong> {{ $movie->duration ? $movie->duration . ' menit' : '-' }}</p> --}}
            @if ($movie->total_episode)
                <p><strong>Total Episode:</strong> {{ $movie->total_episode }}</p>
            @endif
            <p><strong>Skor IMDb:</strong> {{ $movie->imdb_score ?? '-' }}</p>
        </div>

        @if ($movie->description)
            <div class="mt-6 prose prose-sm sm:prose-base dark:prose-invert max-w-none">
                <h2 class="text-xl font-semibold mb-2 border-b pb-1 border-gray-300 dark:border-zinc-600">Deskripsi</h2>
                <p>{{ $movie->description }}</p>
            </div>
        @else
             <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2 border-b pb-1 border-gray-300 dark:border-zinc-600">Deskripsi</h2>
                <p class="text-gray-500 dark:text-gray-400">Deskripsi tidak tersedia.</p>
            </div>
        @endif
    </div>
</div>
@endsection