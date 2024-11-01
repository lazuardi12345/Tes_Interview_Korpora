<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Pastikan Anda sudah mengcompile CSS -->
    <script src="{{ asset('js/app.js') }}" defer></script> <!-- Pastikan Anda sudah mengcompile JS -->
</head>
<body>
    <div class="container">
        <nav>
            <!-- Tambahkan tautan navigasi jika diperlukan -->
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('tasks.index') }}">Daftar Tugas</a>
            <a href="{{ route('tasks.create') }}">Tambah Tugas</a>
            <!-- Tambahkan tautan untuk logout jika perlu -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>

        @yield('content') <!-- Ini adalah tempat di mana konten tampilan lain akan dimasukkan -->
    </div>
</body>
</html>
