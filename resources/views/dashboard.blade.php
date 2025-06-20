@extends('layouts.app')

@section('title', 'BestWatch - Dashboard')

@section('content')
    <div
        class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700">
        <main class="flex-1 py-10 px-5 sm:px-10">

            <header class="font-bold text-lg flex items-center gap-x-3 md:hidden mb-12">
                <span class="mr-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700 dark:text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </span>
                <svg class="h-8 w-8 fill-red-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M10 15.5v-7c0-.41.47-.65.8-.4l4.67 3.5c.27.2.27.6 0 .8l-4.67 3.5c-.33.25-.8.01-.8-.4Zm11.96-4.45c.58 6.26-4.64 11.48-10.9 10.9 -4.43-.41-8.12-3.85-8.9-8.23 -.26-1.42-.19-2.78.12-4.04 .14-.58.76-.9 1.31-.7v0c.47.17.75.67.63 1.16 -.2.82-.27 1.7-.19 2.61 .37 4.04 3.89 7.25 7.95 7.26 4.79.01 8.61-4.21 7.94-9.12 -.51-3.7-3.66-6.62-7.39-6.86 -.83-.06-1.63.02-2.38.2 -.49.11-.99-.16-1.16-.64v0c-.2-.56.12-1.17.69-1.31 1.79-.43 3.75-.41 5.78.37 3.56 1.35 6.15 4.62 6.5 8.4ZM5.5 4C4.67 4 4 4.67 4 5.5 4 6.33 4.67 7 5.5 7 6.33 7 7 6.33 7 5.5 7 4.67 6.33 4 5.5 4Z">
                    </path>
                </svg>
                <div class="tracking-widest flex-1 text-xl font-bold">
                    <span class="text-gray-800 dark:text-white">BestWatch</span><span class="text-red-600">.</span>
                </div>

                <div class="relative items-center content-center flex ml-2">
                    <span class="text-gray-400 absolute left-4 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text"
                        class="text-xs ring-1 bg-transparent ring-gray-200 dark:ring-zinc-600 focus:ring-red-300 pl-10 pr-5 text-gray-600 dark:text-white py-3 rounded-full w-full outline-none focus:ring-1"
                        placeholder="Search ...">
                </div>
            </header>

            <section>
                <nav class="flex space-x-6 text-gray-400 font-medium">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request('type') == null ? 'text-gray-700 dark:text-white font-semibold' : 'hover:text-gray-700 dark:hover:text-white' }}">
                        All
                    </a>
                    @foreach($types as $type)
                        <a href="{{ route('dashboard', ['type' => $type->id]) }}"
                            class="{{ request('type') == $type->id ? 'text-gray-700 dark:text-white font-semibold' : 'hover:text-gray-700 dark:hover:text-white' }}">
                            {{ $type->name }}
                        </a>
                    @endforeach
                </nav>
            </section>
            <br>
            <div class="flex items-center justify-between mb-4">
                <span class="font-semibold text-gray-700 text-base dark:text-white">Movie List</span>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-y-5 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-5">
                @forelse ($movies as $movie)
                    <div class="flex flex-col h-full rounded-xl overflow-hidden border dark:border-zinc-700 shadow-lg bg-white dark:bg-zinc-800">
                        <div class="h-4/5 relative group overflow-hidden">
                            <a href="{{ route('movies.show', $movie) }}">
                                <img src="{{ $movie->image_url ?? 'https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image' }}"
                                    onerror="this.onerror=null;this.src='https://placehold.co/300x450/e2e8f0/94a3b8?text=No+Image';"
                                    alt="{{ $movie->title }}"
                                    class="object-cover w-full h-full transition-transform duration-300 ease-in-out group-hover:scale-105">
                            </a>
                            @auth
                            <div class="absolute top-0.5 right-0.5 z-10">
                                @if (Auth::user()->hasFavorited($movie))
                                    <form action="{{ route('my-list.remove', $movie->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus dari Favorit" class="flex items-center justify-center p-0.7 bg-white rounded-full text-yellow-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 border border-black">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" stroke="black" stroke-width="1.5"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('my-list.add', $movie->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" title="Tambah ke Favorit" class="flex items-center justify-center p-1 bg-white rounded-full text-gray-400 hover:text-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 border border-gray-400 hover:border-black">
                                            {{-- Ikon Bintang Outline --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            @endauth
                        </div>
                        <div
                            class="h-1/5 bg-white dark:bg-zinc-800 dark:text-white px-3 py-2 flex items-center justify-between border-t-2 border-t-red-600">
                            <span class="capitalize font-medium truncate text-sm">{{ $movie->title }}</span>
                            <div class="flex space-x-2 items-center text-xs shrink-0">
                                <svg class="w-8 h-5" xmlns="http://www.w3.org/2000/svg" width="64" height="32"
                                    viewBox="0 0 64 32" version="1.1">
                                    <g fill="#F5C518">
                                        <rect x="0" y="0" width="100%" height="100%" rx="4"></rect>
                                    </g>
                                    <g transform="translate(8.000000, 7.000000)" fill="#000000" fill-rule="nonzero">
                                        <polygon points="0 18 5 18 5 0 0 0"></polygon>
                                        <path
                                            d="M15.6725178,0 L14.5534833,8.40846934 L13.8582008,3.83502426 C13.65661,2.37009263 13.4632474,1.09175121 13.278113,0 L7,0 L7,18 L11.2416347,18 L11.2580911,6.11380679 L13.0436094,18 L16.0633571,18 L17.7583653,5.8517865 L17.7707076,18 L22,18 L22,0 L15.6725178,0 Z">
                                        </path>
                                        <path
                                            d="M24,18 L24,0 L31.8045586,0 C33.5693522,0 35,1.41994415 35,3.17660424 L35,14.8233958 C35,16.5777858 33.5716617,18 31.8045586,18 L24,18 Z M29.8322479,3.2395236 C29.6339219,3.13233348 29.2545158,3.08072342 28.7026524,3.08072342 L28.7026524,14.8914865 C29.4312846,14.8914865 29.8796736,14.7604764 30.0478195,14.4865461 C30.2159654,14.2165858 30.3021941,13.486105 30.3021941,12.2871637 L30.3021941,5.3078959 C30.3021941,4.49404499 30.272014,3.97397442 30.2159654,3.74371416 C30.1599168,3.5134539 30.0348852,3.34671372 29.8322479,3.2395236 Z">
                                        </path>
                                        <path
                                            d="M44.4299079,4.50685823 L44.749518,4.50685823 C46.5447098,4.50685823 48,5.91267586 48,7.64486762 L48,14.8619906 C48,16.5950653 46.5451816,18 44.749518,18 L44.4299079,18 C43.3314617,18 42.3602746,17.4736618 41.7718697,16.6682739 L41.4838962,17.7687785 L37,17.7687785 L37,0 L41.7843263,0 L41.7843263,5.78053556 C42.4024982,5.01015739 43.3551514,4.50685823 44.4299079,4.50685823 Z M43.4055679,13.2842155 L43.4055679,9.01907814 C43.4055679,8.31433946 43.3603268,7.85185468 43.2660746,7.63896485 C43.1718224,7.42607505 42.7955881,7.2893916 42.5316822,7.2893916 C42.267776,7.2893916 41.8607934,7.40047379 41.7816216,7.58767002 L41.7816216,9.01907814 L41.7816216,13.4207851 L41.7816216,14.8074788 C41.8721037,15.0130276 42.2602358,15.1274059 42.5316822,15.1274059 C42.8031285,15.1274059 43.1982131,15.0166981 43.281155,14.8074788 C43.3640968,14.5982595 43.4055679,14.0880581 43.4055679,13.2842155 Z">
                                        </path>
                                    </g>
                                </svg>
                                <span>{{ $movie->imdb_score }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-white col-span-full text-center">Belum ada movie tersedia.</p>
                @endforelse
            </div>
            <div class="mt-10 flex justify-center">
                {{-- Navigasi halaman --}}
                @if($movies->hasPages())
                    <div class="flex items-center space-x-2 fill-gray-500">
                        {{-- Tombol sebelumnya --}}
                        @if($movies->onFirstPage())
                            <span class="h-7 w-7 rounded-full border p-1 text-gray-300 dark:text-gray-600 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24">
                                    <path d="M13.293 6.293L7.58 12l5.7 5.7 1.41-1.42 -4.3-4.3 4.29-4.293Z"></path>
                                </svg>
                            </span>
                        @else
                            <a href="{{ $movies->previousPageUrl() }}"
                                class="h-7 w-7 rounded-full border p-1 hover:border-red-600 hover:fill-red-600 dark:fill-white dark:hover:fill-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24">
                                    <path d="M13.293 6.293L7.58 12l5.7 5.7 1.41-1.42 -4.3-4.3 4.29-4.293Z"></path>
                                </svg>
                            </a>
                        @endif

                        {{-- Tombol selanjutnya --}}
                        @if($movies->hasMorePages())
                            <a href="{{ $movies->nextPageUrl() }}"
                                class="h-7 w-7 rounded-full border p-1 hover:border-red-600 hover:fill-red-600 dark:fill-white dark:hover:fill-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24">
                                    <path d="M10.7 17.707l5.7-5.71 -5.71-5.707L9.27 7.7l4.29 4.293 -4.3 4.29Z"></path>
                                </svg>
                            </a>
                        @else
                            <span class="h-7 w-7 rounded-full border p-1 text-gray-300 dark:text-gray-600 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24">
                                    <path d="M10.7 17.707l5.7-5.71 -5.71-5.707L9.27 7.7l4.29 4.293 -4.3 4.29Z"></path>
                                </svg>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </main>
    </div>
@endsection
