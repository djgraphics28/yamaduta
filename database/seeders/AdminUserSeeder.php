<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'is_admin' => true,
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10)
            ]
        ];

        // Create the admin user
        User::create($data[0]);
    }
}
