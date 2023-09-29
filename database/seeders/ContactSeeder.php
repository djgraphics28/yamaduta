<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data into the 'contacts' table
        DB::table('contacts')->insert([
            'location' => 'Pasig City',
            'contact_number' => '4343636346',
            'email' => 'yamaduta@mail.com',
            'created_at' => '2023-09-28 23:35:51',
            'updated_at' => '2023-09-28 23:35:51',
        ]);
    }
}
