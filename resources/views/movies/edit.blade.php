@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')
<div class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700">
    <main class="flex-1 py-10 px-5 sm:px-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Movie</h2>
            <a href="{{ route('movies.index') }}" class="text-sm text-red-600 hover:underline">&larr; Kembali</a>
        </div>

        <form action="{{ route('movies.update', $movie->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Judul</label>
                <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Image URL</label>
                <input type="text" name="image_url" value="{{ old('image_url', $movie->image_url) }}" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">{{ old('description', $movie->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">IMDB Score</label>
                    <input type="text" name="imdb_score" value="{{ old('imdb_score', $movie->imdb_score) }}" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Trailer URL</label>
                    <input type="text" name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Type</label>
                    <select name="type_id" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $movie->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Genres</label>
                <select name="genres[]" multiple class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ in_array($genre->id, $movie->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Gunakan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu genre.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Tahun Rilis</label>
                    <input type="number" name="release_year" value="{{ old('release_year', $movie->release_year) }}" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Durasi (menit)</label>
                    <input type="number" name="duration" value="{{ old('duration', $movie->duration) }}" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Total Episode</label>
                    <input type="number" name="total_episode" value="{{ old('total_episode', $movie->total_episode) }}" class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                </div>
            </div>

            <div class="flex items-center gap-4 mt-6">
                <button type="submit" class="inline-flex items-center px-5 py-2 text-white !bg-yellow-500 hover:!bg-yellow-600 rounded-md text-sm font-medium transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('movies.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Batal</a>
            </div>
        </form>
    </main>
</div>
@endsection