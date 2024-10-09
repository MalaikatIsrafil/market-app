<?php

namespace Database\Seeders;

use App\Models\skripsi;
use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::create([
            'name' => 'user1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456789'),
            'point' => 10000,
        ]);

        Admin::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
            

        ]);

        

        skripsi::create([
            'judul' => 'Ternak_Uang',
            'nama' => 'Malaikat_Israfil',
            'nim' => '6304221510',
            'angkatan' => '2024',
            'dosen_pembimbing_1' => 'jibril',
            'dosen_pembimbing_2' => 'mikail',            

        ]);

    
    }
}
