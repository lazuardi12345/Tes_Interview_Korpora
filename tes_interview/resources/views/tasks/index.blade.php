@extends('layouts.app') <!-- Pastikan ini sesuai dengan layout yang Anda buat -->

@section('content')
<div class="container">
    <h1>Daftar Tugas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Tugas</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <!-- Tambahkan aksi seperti edit dan delete di sini -->
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada tugas yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Tambah Tugas Baru</a>
</div>
@endsection
