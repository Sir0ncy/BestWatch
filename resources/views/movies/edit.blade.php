<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Movie</title>
</head>
<body>
    <h1>Edit Movie</h1>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="title">Judul:</label><br>
            <input type="text" id="title" name="title" value="{{ $movie->title }}" required>
        </p>

        <p>
            <label for="genre_id">Genre:</label><br>
            <select id="genre_id" name="genre_id" required>
                <option value="">Pilih Genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" @if($movie->genre_id == $genre->id) selected @endif>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="year">Tahun:</label><br>
            <input type="number" id="year" name="year" value="{{ $movie->year }}" required>
        </p>

        <p>
            <button type="submit">Update</button>
            <a href="{{ route('movies.index') }}">Batal</a>
        </p>
    </form>
</body>
</html>
