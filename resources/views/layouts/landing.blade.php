<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': localStorage.getItem('isDark') === 'true' }" x-data="{ isDark: localStorage.getItem('isDark') === 'true' }" x-init="$watch('isDark', val => localStorage.setItem('isDark', val))">
<head>
    <meta charset="UTF-8"> {{-- Perbaikan dari UTF-P_8 --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BestWatch - Tonton Film dan Serial Favoritmu')</title>

    <meta name="description" content="@yield('description', 'Lihat ribuan film box office, serial TV populer, dan anime terbaru kapan saja, di mana saja, tanpa batas di BestWatch.')">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}"> --}}

    {{-- @yield('meta_tags') --}}
</head>
<body class="font-sans bg-white dark:bg-zinc-900 text-gray-800 dark:text-white antialiased">

    <header class="py-4 px-4 sm:px-6 lg:px-8 sticky top-0 z-50 bg-white/90 dark:bg-zinc-900/90 backdrop-blur-md shadow-sm">
        <div class="max-w-6xl mx-auto flex justify-between items-center h-12">
            {{-- Logo Anda --}}
            <a href="{{ url('/') }}" class="flex items-center gap-x-2">
                <img src="{{ asset('gambar/logo_bestwatch_utuh.png') }}" alt="BestWatch Logo" class="h-12 sm:h-12 w-auto">
            </a>
            <nav class="space-x-3 sm:space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm sm:text-base text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-500 transition-colors duration-300">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-md text-sm sm:text-base font-medium transition-colors duration-300">
                            Daftar Gratis
                        </a>
                    @endif
                @else
                    <a href="{{ route('dashboard') }}" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-md text-sm sm:text-base font-medium transition-colors duration-300">
                        Dashboard Saya
                    </a>
                @endguest
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="py-10 text-center text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-zinc-700 mt-12 sm:mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-sm">&copy; {{ date('Y') }} BestWatch. All rights reserved.</p>
            <div class="mt-2 space-x-4">
                {{-- <a href="#" class="hover:text-red-500 text-xs">Privacy Policy</a>
                <a href="#" class="hover:text-red-500 text-xs">Terms of Service</a> --}}
            </div>
        </div>
    </footer>

    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script> --}}
    {{-- @stack('scripts') --}}
</body>
</html>