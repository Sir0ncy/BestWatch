@extends('layouts.app')

@section('title', 'Manage Movies')

@section('content')
<div class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700">
    <main class="flex-1 py-10 px-5 sm:px-10">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Manage Movies</h1>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('movies.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Tambah Movie</span>
            </a>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm">
                <thead class="bg-gray-100 dark:bg-zinc-800 text-gray-600 dark:text-gray-200 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 text-left">Judul</th>
                        <th class="px-4 py-2 text-left">Gambar</th>
                        <th class="px-4 py-2 text-left">Type</th>
                        <th class="px-4 py-2 text-left">Tahun</th>
                        <th class="px-4 py-2 text-left">Durasi</th>
                        <th class="px-4 py-2 text-left">IMDb</th>
                        <th class="px-4 py-2 text-left">Trailer</th>
                        <th class="px-4 py-2 text-left">Episode</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-700 text-gray-700 dark:text-gray-200">
                    @foreach ($movies as $movie)
                    <tr>
                        <td class="px-4 py-2">{{ $movie->title }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ $movie->image_url }}" alt="Image" class="h-10 rounded">
                        </td>
                        <td class="px-4 py-2">{{ $movie->type->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $movie->release_year }}</td>
                        <td class="px-4 py-2">{{ $movie->duration }} menit</td>
                        <td class="px-4 py-2">{{ $movie->imdb_score }}</td>
                        <td class="px-4 py-2">
                            @if(Str::contains($movie->trailer_url, 'youtube.com') || Str::contains($movie->trailer_url, 'youtu.be'))
                            @php
                            preg_match('/(?:youtube\.com.*v=|youtu\.be\/)([^&]+)/', $movie->trailer_url, $matches);
                            $videoId = $matches[1] ?? null;
                            @endphp

                            @if($videoId)
                            <iframe width="200" height="113" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                            @else
                            <a href="{{ $movie->trailer_url }}" target="_blank" class="text-blue-500 underline">Lihat Trailer</a>
                            @endif
                            @else
                            <a href="{{ $movie->trailer_url }}" target="_blank" class="text-blue-500 underline">Lihat Trailer</a>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $movie->total_episode }}</td>
                        <td class="px-4 py-2">
                            @if(auth()->user()->isAdmin())
                            <div class="flex items-center gap-2">
                                <a href="{{ route('movies.edit', $movie->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus movie ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                            @else
                            Tidak ada aksi
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection