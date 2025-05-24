<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Tambah Movie</title>
</head>

<body>
    <h2>Tambah Movie</h2>

    <form action="{{ route('movies.store') }}" method="POST">
        @csrf
        <label>Judul:</label><br>
        <input type="text" name="title"><br><br>

        <label>Image URL:</label><br>
        <input type="text" name="image_url"><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>IMDB Score:</label><br>
        <input type="text" name="imdb_score"><br><br>

        <label>Trailer URL:</label><br>
        <input type="text" name="trailer_url"><br><br>

        <label>Type:</label><br>
        <select name="type_id">
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select><br><br>

        <label>Tahun Rilis:</label><br>
        <input type="number" name="release_year"><br><br>

        <label>Durasi (menit):</label><br>
        <input type="number" name="duration"><br><br>

        <label>Total Episode:</label><br>
        <input type="number" name="total_episode"><br><br>

        <button type="submit">Simpan</button>
    </form>

</body>

</html>