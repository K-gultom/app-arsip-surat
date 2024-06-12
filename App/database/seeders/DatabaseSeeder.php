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
            'name' => 'Ulil Amri, S.T',
            'Jabatan' => 'Kepala Desa',
            'alamat' => 'Dusun I Blok A Desa Karya Mukti',
            'telp' => '082221493099',
            'email' => 'kadeskaryamukti@gmail.com',
            'password' => Hash::make('superadmin123'),
            'level' => 'Super_Admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Putra Ragil',
            'Jabatan' => 'Kepala Urusan Tata Usaha & Kaur Umum',
            'alamat' => 'Dusun I Blok A Desa Karya Mukti',
            'telp' => '081367790713',
            'email' => 'kaurumumkaryamukti@gmail.com',
            'password' => Hash::make('admin123'),
            'level' => 'Admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sunarno',
            'Jabatan' => 'Sekretaris Desa',
            'alamat' => 'Dusun II Blok B Desa Karya Mukti',
            'telp' => '082289147323',
            'email' => 'sekdeskaryamukti@gmail.com',
            'password' => Hash::make('user123'),
            'level' => 'User',
        ]);

    }
}
