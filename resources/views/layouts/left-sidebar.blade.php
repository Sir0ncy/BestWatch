<!-- Left Sidebar -->
<aside class="w-1/6 py-10 pl-10 min-w-min border-r border-gray-300 dark:border-zinc-700 hidden md:block">

    <div class="font-bold text-lg flex items-center gap-x-3">
        <img src="{{ asset('gambar/logo_bestwatch_utuh.png') }}" alt="BestWatch Logo" class="h-16 w-50 object-contain">
    </div>

    <!-- Menu -->
    <div class="mt-12 flex flex-col gap-y-4  text-gray-500 fill-gray-500 text-sm">
        <!-- Common Menu Items -->
        <a class="flex items-center space-x-2 py-1 {{ request()->routeIs('dashboard') ? 'dark:text-white font-semibold border-r-4 border-r-red-600 pr-20' : 'group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white' }}"
            href="{{ route('dashboard') }}">
            <svg class="h-5 w-5 {{ request()->routeIs('dashboard') ? 'fill-red-600' : 'group-hover:fill-red-600' }}"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <!-- Home icon -->
                <path
                    d="M5 22h14v0c1.1 0 2-.9 2-2v-9 0c0-.27-.11-.53-.29-.71l-8-8v0c-.4-.39-1.02-.39-1.41 0l-8 8h0c-.2.18-.3.44-.3.71v9 0c0 1.1.89 2 2 2Zm5-2v-5h4v5Zm-5-8.59l7-7 7 7V20h-3v-5 0c0-1.11-.9-2-2-2h-4v0c-1.11 0-2 .89-2 2v5H5Z">
                </path>
            </svg>
            <span>Home</span>
        </a>

        @auth
            <a class="flex items-center space-x-2 py-1 {{ request()->routeIs('my-list') ? 'dark:text-white font-semibold border-r-4 border-r-red-600 pr-20' : 'group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white' }}"
                href="{{ route('my-list') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="h-5 w-5 {{ request()->routeIs('my-list') ? 'stroke-red-600' : 'group-hover:stroke-red-600' }}">
                    <!-- Star icon -->
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <span>My List</span>
            </a>
        @endauth
        @if (auth()->check() && auth()->user()->isAdmin())
            <div class="text-gray-400/70 font-medium uppercase mt-8">Admin</div>

            <a class="flex items-center space-x-2 py-1 {{ request()->routeIs('movies.*') ? 'dark:text-white font-semibold border-r-4 border-r-red-600 pr-20' : 'group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white' }}"
                href="{{ route('movies.index') }}">
                <svg class="h-5 w-5 {{ request()->routeIs('movies.*') ? 'fill-red-600' : 'group-hover:fill-red-600' }}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
                    <path d="M14 17H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                </svg>
                <span>Manage Movies</span>
            </a>

            <a class="flex items-center space-x-2 py-1 {{ request()->routeIs('genres.*') ? 'dark:text-white font-semibold border-r-4 border-r-red-600 pr-20' : 'group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white' }}"
                href="{{ route('genres.index') }}">
                <svg class="h-5 w-5 {{ request()->routeIs('genres.*') ? 'fill-red-600' : 'group-hover:fill-red-600' }}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M11 15H6l7-14v8h5l-7 14v-8z" />
                </svg>
                <span>Manage Genres</span>
            </a>
        @endif


        <div class="mt-8 text-gray-400/70 font-medium uppercase">General</div>
        <a class="flex items-center space-x-2 py-1 {{ request()->routeIs('setting') ? 'dark:text-white font-semibold border-r-4 border-r-red-600 pr-20' : 'group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white' }}"
            href="{{ route('setting') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:stroke-red-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>Settings</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left flex items-center space-x-2 py-1 group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white">
                <svg class="h-5 w-5 group-hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g>
                        <path d="M16 13v-2H7V8l-5 4 5 4v-3Z"></path>
                        <path
                            d="M20 3h-9c-1.11 0-2 .89-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.11-.9-2-2-2Z">
                        </path>
                    </g>
                </svg>
                <span>{{ __('Logout') }}</span>
            </button>
        </form>

        <div class="flex items-center space-x-2 py-1 mt-4">
            <button @click="isDark = !isDark" type="button"
                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-300 focus:outline-none"
                :class="isDark ? 'bg-white border border-gray-300' : 'bg-gray-300'">
                <span class="sr-only">Toggle Dark Mode</span>
                <span class="inline-block h-4 w-4 transform rounded-full transition-transform duration-300"
                    :class="isDark ? 'translate-x-6 bg-gray-800' : 'translate-x-1 bg-white'"></span>
            </button>
            <span class="text-gray-700 dark:text-gray-300">Dark Theme</span>
        </div>
    </div>
    <!-- /Menu -->

</aside><!-- /Left Sidebar -->