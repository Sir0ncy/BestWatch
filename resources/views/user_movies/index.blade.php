@extends('layouts.app') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'My Movie List')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">My Movie List</h1>
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
        <div class="grid grid-cols-2 gap-y-5 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-5">
            @foreach ($favoriteMovies as $movie)
                {{-- Menggunakan struktur kartu yang mirip dengan dashboard.blade.php --}}
                <div class="flex flex-col h-full rounded-xl overflow-hidden border dark:border-zinc-700 shadow-lg bg-white dark:bg-zinc-800">
                    {{-- Kontainer gambar dan tombol favorit --}}
                    <div class="h-4/5 relative group overflow-hidden">
                        <a href="{{ route('movies.show', $movie->id) }}"> {{-- Arahkan ke detail movie jika ada --}}
                            <img src="{{ $movie->image_url ?? 'https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image' }}"
                                 onerror="this.onerror=null;this.src='https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image';"
                                 alt="{{ $movie->title }}"
                                 class="object-cover w-full h-full transition-transform duration-300 ease-in-out group-hover:scale-105">
                        </a>
                        {{-- Tombol Hapus Favorit (Bintang Terisi) --}}
                        {{-- Karena ini halaman My List, semua sudah favorit, jadi hanya ada tombol hapus --}}
                        @auth
                        <div class="absolute top-2 right-2 z-10">
                            <form action="{{ route('my-list.remove', $movie->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus dari Favorit" class="p-1.5 bg-black bg-opacity-40 rounded-full text-yellow-400 hover:text-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24"> {{-- Ukuran ikon disesuaikan --}}
                                        <path d="M12 .587l3.668 7.431 8.207 1.193-5.938 5.787 1.402 8.173L12 18.896l-7.339 3.875 1.402-8.173-5.938-5.787 8.207-1.193z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        @endauth
                    </div>
                    {{-- Bagian konten teks di bawah gambar --}}
                    <div class="h-1/5 bg-white dark:bg-zinc-800 dark:text-white px-3 py-2 flex items-center justify-between border-t-2 border-t-red-600">
                        <span class="capitalize font-medium truncate text-sm" title="{{ $movie->title }}">{{ $movie->title }}</span>
                        <div class="flex space-x-2 items-center text-xs shrink-0">
                            <svg class="w-8 h-5" xmlns="http://www.w3.org/2000/svg" width="64" height="32" viewBox="0 0 64 32" version="1.1">
                                <g fill="#F5C518"><rect x="0" y="0" width="100%" height="100%" rx="4"></rect></g>
                                <g transform="translate(8.000000, 7.000000)" fill="#000000" fill-rule="nonzero">
                                    <polygon points="0 18 5 18 5 0 0 0"></polygon>
                                    <path d="M15.6725178,0 L14.5534833,8.40846934 L13.8582008,3.83502426 C13.65661,2.37009263 13.4632474,1.09175121 13.278113,0 L7,0 L7,18 L11.2416347,18 L11.2580911,6.11380679 L13.0436094,18 L16.0633571,18 L17.7583653,5.8517865 L17.7707076,18 L22,18 L22,0 L15.6725178,0 Z"></path>
                                    <path d="M24,18 L24,0 L31.8045586,0 C33.5693522,0 35,1.41994415 35,3.17660424 L35,14.8233958 C35,16.5777858 33.5716617,18 31.8045586,18 L24,18 Z M29.8322479,3.2395236 C29.6339219,3.13233348 29.2545158,3.08072342 28.7026524,3.08072342 L28.7026524,14.8914865 C29.4312846,14.8914865 29.8796736,14.7604764 30.0478195,14.4865461 C30.2159654,14.2165858 30.3021941,13.486105 30.3021941,12.2871637 L30.3021941,5.3078959 C30.3021941,4.49404499 30.272014,3.97397442 30.2159654,3.74371416 C30.1599168,3.5134539 30.0348852,3.34671372 29.8322479,3.2395236 Z"></path>
                                    <path d="M44.4299079,4.50685823 L44.749518,4.50685823 C46.5447098,4.50685823 48,5.91267586 48,7.64486762 L48,14.8619906 C48,16.5950653 46.5451816,18 44.749518,18 L44.4299079,18 C43.3314617,18 42.3602746,17.4736618 41.7718697,16.6682739 L41.4838962,17.7687785 L37,17.7687785 L37,0 L41.7843263,0 L41.7843263,5.78053556 C42.4024982,5.01015739 43.3551514,4.50685823 44.4299079,4.50685823 Z M43.4055679,13.2842155 L43.4055679,9.01907814 C43.4055679,8.31433946 43.3603268,7.85185468 43.2660746,7.63896485 C43.1718224,7.42607505 42.7955881,7.2893916 42.5316822,7.2893916 C42.267776,7.2893916 41.8607934,7.40047379 41.7816216,7.58767002 L41.7816216,9.01907814 L41.7816216,13.4207851 L41.7816216,14.8074788 C41.8721037,15.0130276 42.2602358,15.1274059 42.5316822,15.1274059 C42.8031285,15.1274059 43.1982131,15.0166981 43.281155,14.8074788 C43.3640968,14.5982595 43.4055679,14.0880581 43.4055679,13.2842155 Z"></path>
                                </g>
                            </svg>
                            <span>{{ $movie->imdb_score ?? 'N/A' }}</span>
                        </div>
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