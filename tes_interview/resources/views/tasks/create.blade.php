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

    <!-- Form untuk menambahkan tugas dengan unggahan gambar -->
    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama Tugas</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Unggah Gambar (JPG, PNG)</label>
            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png">
        </div>
        
        <button type="submit" class="btn btn-primary">Tambah Tugas</button>
    </form>

    <a href="{{ url('/') }}">Kembali ke Home</a>
</body>
</html>
