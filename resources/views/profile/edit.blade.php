<x-app-layout> {{-- Pastikan ini nama komponen layout Anda --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Test Halaman Profile Edit (Debug $genres)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @php
                        $userIsAvailable = isset($user) && $user !== null;
                        $genresIsAvailable = isset($genres) && $genres !== null;
                    @endphp

                    <p>User tersedia: {{ $userIsAvailable ? 'YA' : 'TIDAK' }}</p>
                    @if($userIsAvailable)
                        <p>Nama User: {{ $user->name }}</p>
                    @endif

                    <hr style="margin: 20px 0; border-color: #ccc;">

                    @if($genresIsAvailable)
                        <p style="color: green; font-weight: bold; font-size: 1.2em;">
                            Variabel $genres TERDEFINISI di profile.edit.blade.php.
                        </p>
                        @if(is_iterable($genres))
                            <p>Jumlah genre: {{ count($genres) }}</p>
                            <pre style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ddd; color: #333;">{{ print_r($genres->pluck('name')->toArray(), true) }}</pre>
                        @else
                            <p style="color: orange;">$genres terdefinisi TAPI bukan array atau objek yang bisa dihitung/di-pluck.</p>
                            <pre style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ddd; color: #333;">{{ print_r($genres, true) }}</pre>
                        @endif
                    @else
                        <p style="color: red; font-weight: bold; font-size: 1.2em;">
                            Variabel $genres TIDAK TERDEFINISI di profile.edit.blade.php!
                        </p>
                    @endif

                    <hr style="margin: 20px 0; border-color: #ccc;">
                    <p>Ini adalah akhir dari konten tes profile.edit.blade.php.</p>
                    <p style="font-size: 0.9em; color: #777;">
                        Jika '$genres' TIDAK TERDEFINISI di sini, masalahnya ada pada Controller yang tidak mengirim data dengan benar, atau masalah cache yang sangat persisten.
                        <br>
                        Jika '$genres' TERDEFINISI di sini TAPI error "Undefined variable $genres" tetap muncul saat Anda menggunakan kode asli `profile.edit.blade.php` (setelah mengembalikan kode aslinya), maka masalahnya hampir pasti ada pada `layouts/app.blade.php` atau `layouts/left-sidebar.blade.php` yang mencoba mengakses `$genres` dengan cara yang salah atau sebelum variabel tersebut benar-benar siap dalam scope rendering layout/sidebar tersebut.
                    </p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>