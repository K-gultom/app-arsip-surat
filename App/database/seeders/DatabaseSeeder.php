<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Ulil Amri',
            'Jabatan' => 'Kepala Desa',
            'alamat' => 'Dusun I Blok A Desa Karya Mukti',
            'telp' => '082221493099',
            'email' => 'kadeskaryamukti@gmail.com',
            'password' => Hash::make('superadmin123456'),
            'level' => 'Super_Admin',
        ]);
    }
}
