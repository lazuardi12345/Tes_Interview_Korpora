@extends('layouts.app')

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
                <th>Gambar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr data-task-id="{{ $task->id }}">
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if($task->image_path)
                            <img src="{{ asset('storage/' . $task->image_path) }}" alt="Gambar Tugas" width="100">
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td class="task-status">{{ $task->status }}</td>
                    <td>
                        <button class="btn btn-success btn-sm mark-complete" data-id="{{ $task->id }}">Selesaikan</button>
                        <button class="btn btn-danger btn-sm delete-task" data-id="{{ $task->id }}">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada tugas yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Tambah Tugas Baru</a>
</div>

<!-- Menyertakan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Mengatur CSRF token untuk semua request AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Menandai tugas sebagai selesai
    $('.mark-complete').click(function() {
        var taskId = $(this).data('id');
        var row = $(this).closest('tr');

        $.ajax({
            url: '/tasks/' + taskId + '/complete',
            type: 'PATCH',
            success: function(response) {
                row.find('.task-status').text('completed');
                alert(response.success);
            },
            error: function(xhr) {
                alert('Terjadi kesalahan. Tugas tidak bisa ditandai sebagai selesai.');
            }
        });
    });

    // Menghapus tugas
    $('.delete-task').click(function() {
        var taskId = $(this).data('id');
        var row = $(this).closest('tr');

        if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
            $.ajax({
                url: '/tasks/' + taskId,
                type: 'DELETE',
                success: function(response) {
                    row.remove();
                    alert(response.success);
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan. Tugas tidak bisa dihapus.');
                }
            });
        }
    });
});
</script>
@endsection
