<x-guest-layout>
    <div class="p-6">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200 mb-6">Login to BestWatch</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email/Username -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email or Username')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email" class="block mt-1 w-full bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:border-red-500 focus:ring-red-500"
                    type="text" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-400" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password" class="block mt-1 w-full bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:border-red-500 focus:ring-red-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-red-600 shadow-sm focus:ring-red-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-sm text-red-600 dark:text-red-400 hover:text-red-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="mb-4">
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    {{ __('Log in') }}
                </button>
            </div>

            <!-- Sign Up Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    {{ __('Don\'t have an account?') }}
                    <a href="{{ route('register') }}" class="font-medium text-red-600 dark:text-red-400 hover:text-red-500">
                        {{ __('Sign up') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>