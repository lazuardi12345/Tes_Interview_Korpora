<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Membuat 10 pengguna
        User::factory(10)->create()->each(function ($user) {
            // Setiap pengguna akan memiliki 5 tugas
            Task::factory(5)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
