<!DOCTYPE html>
<html lang="en" :class="isDark ? 'dark' : 'light'" x-data="{ isDark: false }">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css']) 
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-sm bg-white dark:bg-zinc-900">
    <div class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 border-gray-200 dark:border-zinc-700">

        {{-- Left Sidebar --}}
        @include('layouts.left-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 py-10 px-6">
            @yield('content')
        </main>

        {{-- Right Sidebar --}}
        @include('layouts.right-sidebar')

    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>