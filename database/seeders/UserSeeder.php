<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(1)->create()->each(function ($user) {
            $statuses = ['pending', 'backlog', 'complete'];

            foreach ($statuses as $status) {
                Todo::factory()->count(5)->create([
                    'user_id' => $user->id,
                    'status' => $status,
                ]);
            }

            echo "User: {$user->name}, Email: {$user->email}, Password: {$user->password}\n";
        });
    }
}
