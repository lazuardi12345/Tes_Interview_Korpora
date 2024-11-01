<?php

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\TaskController;

Route::middleware(['web'])
    ->group(function () {
        // Rute untuk login
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->name('login')
            ->middleware('guest');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);

        // Rute untuk registrasi
        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->name('register')
            ->middleware('guest');
        Route::post('/register', [RegisteredUserController::class, 'store']);

        // Rute untuk logout
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout'); // Tambahkan rute logout

        // Rute untuk halaman utama
        Route::get('/', function () {
            return view('home');
        })->middleware('auth');

        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    
    // Rute untuk membuat dan menyimpan tugas
         Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    });

