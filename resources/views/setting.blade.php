@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div
        class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700">
        <main class="flex-1 py-10 px-5 sm:px-10">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Settings</h2>
            </div>

            {{-- Account Settings --}}
            <form action="{{ route('setting.update') }}" method="POST"
                class="space-y-6 bg-white dark:bg-zinc-800 rounded-lg shadow p-6 mb-10">
                @csrf
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Account</h3>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Password Baru</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2 mt-4 text-white bg-red-600 hover:bg-red-700 rounded-md">
                    Simpan Perubahan
                </button>
            </form>

            {{-- Danger Zone --}}
            <div x-data="{ showModal: false }" class="bg-white dark:bg-zinc-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h3>

                <button @click="showModal = true"
                    class="inline-flex items-center px-5 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md">
                    Hapus Akun
                </button>

                <!-- Modal konfirmasi -->
                <div x-data="{ showModal: false }">
                    <button @click="showModal = true" class="...">Hapus Akun</button>

                    <!-- Overlay + Modal -->
                    <div x-show="showModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 w-full max-w-md">
                            <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus Akun</h2>
                            <p class="mb-4">Yakin ingin menghapus akun Anda? Data tidak bisa dikembalikan.</p>
                            <form method="POST" action="{{ route('setting.destroy') }}">
                                @csrf
                                <input type="password" name="password" placeholder="Masukkan password" required
                                    class="w-full mb-4 px-3 py-2 border rounded" />
                                <div class="flex justify-end space-x-2">
                                    <button type="button" @click="showModal = false"
                                        class="px-4 py-2 bg-gray-200 rounded">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
@endsection