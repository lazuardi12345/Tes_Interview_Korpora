<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
</head>
<body>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

    <h1>Selamat Datang</h1>
    <a href="{{ route('tasks.create') }}">Tambah Tugas Baru</a>
</body>
</html>
