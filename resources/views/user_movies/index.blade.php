@extends('layouts.app') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'My Movie List')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">My Movie List</h1>
        {{-- Mungkin ada tombol lain di sini jika relevan --}}
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-700 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 rounded-md" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('info'))
        <div class="mb-4 p-4 bg-blue-100 dark:bg-blue-700 border border-blue-400 dark:border-blue-600 text-blue-700 dark:text-blue-100 rounded-md" role="alert">
            {{ session('info') }}
        </div>
    @endif

    {{-- Variabel yang dikirim dari controller adalah $favoriteMovies --}}
    @if (isset($favoriteMovies) && $favoriteMovies->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            {{-- Loop menggunakan $favoriteMovies --}}
            @foreach ($favoriteMovies as $movie) {{-- Langsung gunakan $movie jika $favoriteMovies berisi objek Movie --}}
                <div class="bg-white dark:bg-zinc-800 shadow-lg rounded-lg overflow-hidden flex flex-col">
                    <a href="#"> {{-- Ganti # dengan route('movies.show', $movie->id) jika ada halaman detail film --}}
                        @if ($movie->image_url)
                            <img src="{{ $movie->image_url ?? 'https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image' }}"
                                 onerror="this.onerror=null;this.src='https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image';"
                                 alt="{{ $movie->title }}" class="w-full h-72 object-cover">
                        @else
                            <div class="w-full h-72 bg-gray-200 dark:bg-zinc-700 flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">No Image</span>
                            </div>
                        @endif
                    </a>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-md font-semibold text-gray-800 dark:text-white mb-1 truncate" title="{{ $movie->title }}">
                            {{ $movie->title }}
                        </h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-2 flex-grow">
                            Tahun: {{ $movie->year ?? 'N/A' }} | Rating: {{ $movie->rating ?? 'N/A' }}
                        </p>
                        {{-- Tombol untuk menghapus dari My List --}}
                        <form action="{{ route('my-list.remove', $movie->id) }}" method="POST" class="mt-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 text-xs bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">
                                Hapus dari Favorit
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination menggunakan $favoriteMovies --}}
        @if ($favoriteMovies->hasPages())
            <div class="mt-8">
                {{ $favoriteMovies->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-10">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">My List Anda Kosong</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai tambahkan film favorit Anda untuk melihatnya di sini.</p>
            <div class="mt-6">
                <a href="{{ route('dashboard') }}" {{-- Atau halaman utama film Anda --}}
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cari Film
                </a>
            </div>
        </div>
    @endif

@endsection
