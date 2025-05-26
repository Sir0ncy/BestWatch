@extends('layouts.app')

@section('title', 'Tambah Movie')

@section('content')
<div class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700">
    <main class="flex-1 py-10 px-5 sm:px-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Movie</h2>
            <a href="{{ route('movies.index') }}" class="text-sm text-red-600 hover:underline">&larr; Kembali</a>
        </div>

        <form action="{{ route('movies.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Judul</label>
                <input type="text" name="title" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Image URL</label>
                <input type="text" name="image_url" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">IMDB Score</label>
                    <input type="text" name="imdb_score" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Trailer URL</label>
                    <input type="text" name="trailer_url" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Type</label>
                    <select name="type_id" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Genres</label>
                <select name="genres[]" multiple class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                <small class="text-sm text-gray-500 dark:text-gray-400">* Tekan Ctrl (Windows) atau Cmd (Mac) untuk pilih lebih dari satu genre</small>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Tahun Rilis</label>
                    <input type="number" name="release_year" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Durasi (menit)</label>
                    <input type="number" name="duration" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Total Episode</label>
                    <input type="number" name="total_episode" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
            </div>

            <button type="submit" class="inline-flex items-center px-5 py-2 mt-4 text-white bg-red-600 hover:bg-red-700 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Tambah Movie
            </button>
        </form>
    </main>
</div>
@endsection