<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'pending', 
            'user_id' => Auth::id(), 
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }
}
