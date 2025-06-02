@extends('layouts.app')

@section('title', 'Tambah Genre')

@section('content')
<div class="flex min-h-screen 2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 border-gray-200 dark:border-zinc-700">
    <main class="flex-1 py-10 px-5 sm:px-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Tambah Genre Baru</h1>
            <a href="{{ route('genres.index') }}" class="text-sm text-red-600 hover:underline">&larr; Kembali</a>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded dark:bg-red-900 dark:text-red-100">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('genres.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Nama Genre</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-5 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md text-sm font-medium transition">
                    Simpan
                </button>
                <a href="{{ route('genres.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Batal</a>
            </div>
        </form>
    </main>
</div>
@endsection
