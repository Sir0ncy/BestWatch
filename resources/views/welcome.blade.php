{{-- resources/views/welcome.blade.php --}}
@extends('layouts.landing')

@section('title', 'BestWatch - Katalog Film, Anime, & Series Terlengkap')
@section('description', 'Jelajahi ribuan judul film, anime, dan serial TV. Dapatkan informasi detail, rating, dan kelola daftar tontonan pribadi Anda di BestWatch.')

@section('content')

{{-- 1. Hero Section --}}
<section class="bg-gradient-to-br from-zinc-900 via-red-900 to-zinc-800 text-white py-20 md:py-32 px-4 sm:px-6 lg:px-8 text-center">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
            Temukan Informasi Film, Anime, & Series di <span class="text-red-400">BestWatch.</span>
        </h1>
        <p class="text-lg sm:text-xl text-zinc-300 mb-10 max-w-2xl mx-auto">
            Jelajahi katalog ribuan judul, dapatkan detail lengkap, rating, dan kelola daftar tontonan pribadi Anda dengan mudah.
        </p>
        <div class="space-x-0 space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('register') }}" {{-- Atau bisa juga ke halaman browse jika tidak wajib login --}}
               class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg text-lg inline-block transition duration-300 ease-in-out transform hover:scale-105">
                Buat Akun & Mulai Kelola
            </a>
            {{-- Anda bisa menambahkan tombol lain, misalnya untuk langsung browse katalog --}}
            {{-- <a href="#katalog" class="border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white font-semibold py-3 px-8 rounded-lg text-lg inline-block transition duration-300 ease-in-out">
                Lihat Katalog
            </a> --}}
        </div>
    </div>
</section>

{{-- 2. Fitur Unggulan Section --}}
<section id="fitur" class="py-16 md:py-24 bg-white dark:bg-zinc-900 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-white mb-4">Semua Informasi Hiburan di Ujung Jari Anda</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                BestWatch menyediakan semua yang Anda butuhkan untuk menjadi penikmat film dan series yang terinformasi.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            {{-- Fitur 1 --}}
            <div class="text-center p-6 bg-gray-50 dark:bg-zinc-800 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-red-500 text-white mx-auto mb-4">
                    {{-- Ikon: Database, Kaca Pembesar, atau Tumpukan Film --}}
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10m16-5H4m16 0a2 2 0 100-4m0 4a2 2 0 110-4m0 4v1m0-1V4M4 7V4m0 0L4 7m0 0h16m0 0V4m0 0L4 4m12 9l-3-3m0 0l-3 3m3-3v12"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Katalog Terlengkap</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Akses informasi detail dari ribuan film, anime, dan serial TV dari berbagai negara dan genre.
                </p>
            </div>
            {{-- Fitur 2 --}}
            <div class="text-center p-6 bg-gray-50 dark:bg-zinc-800 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-red-500 text-white mx-auto mb-4">
                    {{-- Ikon: Bintang (rating), Info, atau Dokumen --}}
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Informasi Detail & Rating</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Dapatkan sinopsis, genre, poster, tahun rilis, skor IMDb, dan lainnya untuk setiap judul.
                </p>
            </div>
            {{-- Fitur 3 --}}
            <div class="text-center p-6 bg-gray-50 dark:bg-zinc-800 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-red-500 text-white mx-auto mb-4">
                    {{-- Ikon: Daftar/List, Bookmark, atau Kalender --}}
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Daftar Tontonan Pribadi</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Buat dan kelola daftar film yang sudah, sedang, atau akan Anda tonton. Beri rating dan bagikan opinimu!
                </p>
            </div>
        </div>
    </div>
</section>

{{-- (Opsional) Bagian "Baru Ditambahkan" atau "Populer Minggu Ini" --}}
{{-- Jika Anda punya data ini dari controller, bisa ditampilkan di sini --}}
{{-- <section class="py-16 md:py-24 bg-gray-100 dark:bg-zinc-800/50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8 text-center">Populer Saat Ini</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            Contoh card movie mini, Anda perlu loop data dari controller
            @for ($i = 0; $i < 6; $i++)
            <a href="#" class="block group">
                <img src="https://placehold.co/200x300/7C3AED/FFFFFF?text=Movie+{{$i+1}}" alt="Movie Poster" class="rounded-md shadow-md group-hover:opacity-75 transition-opacity duration-300 aspect-[2/3] object-cover w-full">
                <h4 class="mt-2 text-sm font-semibold text-gray-700 dark:text-gray-200 truncate group-hover:text-red-600 dark:group-hover:text-red-500">Judul Film Populer {{$i+1}}</h4>
            </a>
            @endfor
        </div>
    </div>
</section> --}}


{{-- 4. Call to Action (CTA) Section - Penguat --}}
<section class="py-16 md:py-24 bg-red-600 dark:bg-red-700">
    <div class="max-w-3xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
            Siap Menjelajahi Dunia Hiburan?
        </h2>
        <p class="text-lg text-red-100 dark:text-red-200 mb-8">
            Buat akun gratis untuk menyimpan preferensi, memberi rating, dan membangun daftar tontonan impian Anda.
        </p>
        <a href="{{ route('register') }}"
           class="bg-white hover:bg-gray-100 text-red-600 font-semibold py-3 px-10 rounded-lg text-lg inline-block transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
            Buat Akun Sekarang
        </a>
    </div>
</section>

@endsection