<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    // Menampilkan daftar tugas
    public function index()
    {
        // Mengambil semua tugas yang terkait dengan pengguna yang sedang login
        $tasks = Task::where('user_id', Auth::id())->get();

        return view('tasks.index', compact('tasks'));
    }

    // Menampilkan formulir untuk menambah tugas
    public function create()
    {
        return view('tasks.create');
    }

    // Menyimpan tugas baru
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,png|max:2048', // Validasi gambar
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Upload file gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('task_images', 'public');
    }

    // Menyimpan tugas ke database
    Task::create([
        'name' => $request->name,
        'description' => $request->description,
        'status' => 'pending',
        'user_id' => Auth::id(),
        'image_path' => $imagePath, // Simpan path gambar
    ]);

    return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
}

    // Menandai tugas sebagai selesai
    public function markAsComplete(Task $task): JsonResponse
    {
        $task->status = 'completed'; // Ubah status tugas menjadi selesai
        $task->save();

        return response()->json(['success' => 'Tugas berhasil ditandai sebagai selesai.']);
    }

    // Menghapus tugas
    public function destroy(Task $task): JsonResponse
    {
        try {
            $task->delete();
            return response()->json(['success' => 'Tugas berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tugas tidak bisa dihapus.'], 500);
        }
    }
}
