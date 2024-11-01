<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // ID otomatis
            $table->string('name'); // Nama tugas
            $table->text('description')->nullable(); // Deskripsi tugas
            $table->enum('status', ['pending', 'completed', 'in_progress'])->default('pending'); // Status tugas
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID pengguna yang terkait
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
