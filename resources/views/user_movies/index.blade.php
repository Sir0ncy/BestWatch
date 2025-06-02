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

    @if (isset($favoriteMovies) && $favoriteMovies->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($favoriteMovies as $movie)
                <div class="bg-white dark:bg-zinc-800 shadow-lg rounded-lg overflow-hidden flex flex-col">
                    {{-- Kontainer untuk gambar dan tombol favorit yang diposisikan absolut --}}
                    <div class="relative group">
                        <a href="{{ route('movies.show', $movie->id) }}"> {{-- Arahkan ke detail movie jika ada --}}
                            @if ($movie->image_url)
                                <img src="{{ $movie->image_url ?? 'https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image' }}"
                                     onerror="this.onerror=null;this.src='https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image';"
                                     alt="{{ $movie->title }}" class="w-full h-72 object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                            @else
                                <div class="w-full h-72 bg-gray-200 dark:bg-zinc-700 flex items-center justify-center">
                                    <span class="text-gray-500 dark:text-gray-400">No Image</span>
                                </div>
                            @endif
                        </a>
                        {{-- Tombol Hapus Favorit (Ikon Bintang Terisi dengan Outline) - Diposisikan di atas gambar --}}
                        <form action="{{ route('my-list.remove', $movie->id) }}" method="POST" class="absolute top-0.5 right-0.5 z-10"> {{-- Lebih ke pojok --}}
                            @csrf
                            @method('DELETE')
                            {{-- Menambahkan border border-black. Padding disesuaikan menjadi p-1 --}}
                            <button type="submit" class="flex items-center justify-center p-0.7 bg-white rounded-full text-yellow-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 border border-black" title="Hapus dari Favorit">
                                {{-- Ukuran ikon tetap w-4 h-4 --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                  {{-- Outline SVG bintang tetap hitam dan tipis (stroke-width="1.5") --}}
                                  <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" stroke="black" stroke-width="1.5"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-md font-semibold text-gray-800 dark:text-white truncate" title="{{ $movie->title }}">
                            {{ $movie->title }}
                        </h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 flex-grow">
                            Tahun: {{ $movie->year ?? 'N/A' }} | Rating: {{ $movie->rating ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

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
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cari Film
                </a>
            </div>
        </div>
    @endif

@endsection
