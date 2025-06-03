<!DOCTYPE html>
<html lang="en"
      x-data="{ isDark: JSON.parse(localStorage.getItem('isDark')) || false }"
      x-init="$watch('isDark', val => localStorage.setItem('isDark', JSON.stringify(val)))"
      :class="{ 'dark': isDark }">
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
            <a href="{{ url('/') }}" class="flex items-center gap-x-2">
                <img src="{{ asset('gambar/logo_bestwatch_utuh.png') }}" alt="BestWatch Logo" class="h-12 sm:h-12 w-auto">
            </a>
            <nav class="space-x-3 sm:space-x-4">
                <button @click="isDark = !isDark"
                    class="ml-4 p-2 rounded-full bg-gray-200 dark:bg-zinc-700 hover:bg-gray-300 dark:hover:bg-zinc-600 transition"
                    :aria-label="isDark ? 'Light Mode' : 'Dark Mode'">
                    <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-800" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 2zm0 12a4 4 0 100-8 4 4 0 000 8zm7.25-3.25a.75.75 0 010 1.5h-1.5a.75.75 0 010-1.5h1.5zM4.25 10a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5h1.5zm9.47-4.72a.75.75 0 011.06 1.06l-1.06 1.06a.75.75 0 01-1.06-1.06l1.06-1.06zm-8.94 8.94a.75.75 0 011.06 1.06l-1.06 1.06a.75.75 0 01-1.06-1.06l1.06-1.06zm8.94 1.06a.75.75 0 01-1.06 0l-1.06-1.06a.75.75 0 011.06-1.06l1.06 1.06a.75.75 0 010 1.06zm-8.94-8.94a.75.75 0 011.06 0L5.53 6.34a.75.75 0 01-1.06-1.06l1.06-1.06a.75.75 0 010 1.06z" />
                    </svg>
                    <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.293 13.95a8 8 0 01-11.242-11.24A8 8 0 0017.293 13.95z" />
                    </svg>
                </button>
                @guest
                <a href="{{ route('login') }}" class="text-sm sm:text-base text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-500 transition-colors duration-300">
                    Log In
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-md text-sm sm:text-base font-medium transition-colors duration-300">
                    Register
                </a>
                @endif
                @else
                <a href="{{ route('dashboard') }}" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-md text-sm sm:text-base font-medium transition-colors duration-300">
                    Dashboard
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