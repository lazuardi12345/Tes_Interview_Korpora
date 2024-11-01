<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
</head>
<body>
    <h1>Tambah Tugas Baru</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label for="name">Nama Tugas:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>

        <button type="submit">Tambahkan Tugas</button>
    </form>

    <a href="{{ url('/') }}">Kembali ke Home</a>
</body>
</html>
