@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    {{-- Judul Halaman dan Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Daftar Pengguna</h1>
        {{-- Sesuaikan nama rute jika Anda menggunakan prefix 'admin.' pada grup rute resource user --}}
        {{-- Contoh: route('admin.users.create') --}}
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
            Tambah Pengguna Baru
        </a>
    </div>

    {{-- Notifikasi Sukses/Error --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-700 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 rounded-md" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-700 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-100 rounded-md" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel Daftar User --}}
    <div class="bg-white dark:bg-zinc-800 shadow-sm sm:rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead class="bg-gray-50 dark:bg-zinc-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Username</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($users as $user)
                    <tr class="text-gray-700 dark:text-gray-300">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->role_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- Sesuaikan nama rute jika menggunakan prefix 'admin.' --}}
                            {{-- <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 mr-3">Lihat</a> --}}
                            <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-3">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            Tidak ada data pengguna ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Link Pagination --}}
    @if ($users->hasPages())
        <div class="mt-6">
            {{ $users->links() }} {{-- Ini akan menggunakan view pagination default Tailwind dari Laravel --}}
        </div>
    @endif
@endsection