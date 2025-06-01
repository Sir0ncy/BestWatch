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
                                <a href="{{ route('movies.edit', $movie->id) }}" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Edit</a>
                                <!-- Modal Trigger -->
                                <button data-modal-target="popup-modal-{{ $movie->id }}" data-modal-toggle="popup-modal-{{ $movie->id }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-800" type="button">
                                    Hapus
                                </button>

                                <!-- Modal -->
                                <div id="popup-modal-{{ $movie->id }}" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full overflow-y-auto bg-black/50">
                                    <div class="relative p-4 w-full max-w-md max-h-full mx-auto mt-24">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $movie->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Tutup</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin ingin menghapus movie ini?</h3>

                                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                                <button data-modal-hide="popup-modal-{{ $movie->id }}" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            Tidak ada aksi, role bukan admin!
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