<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Manage Movies</title>
</head>

<body>
    <h1>Manage Movies</h1>

    @if(auth()->user()->isAdmin())
        <p><a href="{{ route('movies.create') }}">Tambah Movie</a></p>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Type</th>
                <th>Tahun</th>
                <th>Durasi</th>
                <th>IMDb Score</th>
                <th>Trailer</th>
                <th>Total Episode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>
                        <img src="{{ $movie->image_url }}" alt="Image" height="30">
                    </td>
                    <td>{{ $movie->type->name ?? '-' }}</td>
                    <td>{{ $movie->release_year }}</td>
                    <td>{{ $movie->duration }} menit</td>
                    <td>{{ $movie->imdb_score }}</td>
                    <td>
                        @if(Str::contains($movie->trailer_url, 'youtube.com') || Str::contains($movie->trailer_url, 'youtu.be'))
                            @php
                                // Ambil ID dari link YouTube
                                preg_match('/(?:youtube\.com.*v=|youtu\.be\/)([^&]+)/', $movie->trailer_url, $matches);
                                $videoId = $matches[1] ?? null;
                            @endphp

                            @if($videoId)
                                <iframe width="200" height="113" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <a href="{{ $movie->trailer_url }}" target="_blank">Lihat Trailer</a>
                            @endif
                        @else
                            <a href="{{ $movie->trailer_url }}" target="_blank">Lihat Trailer</a>
                        @endif
                    </td>
                    <td>{{ $movie->total_episode }}</td>
                    <td>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('movies.edit', $movie->id) }}">Edit</a> |
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin hapus movie ini?');">Hapus</button>
                            </form>
                        @else
                            Tidak ada aksi
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><a href="{{ route('dashboard') }}">Kembali ke Dashboard</a></p>
</body>

</html>