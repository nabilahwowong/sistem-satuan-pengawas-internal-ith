<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Unit;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $unitSPI = Unit::create(['kode_unit' => 'SPI', 'nama_unit' => 'Satuan Pengawas Internal']);
        $unitTI = Unit::create(['kode_unit' => 'TI', 'nama_unit' => 'Unit Teknologi Informasi']);

        User::create([
            'name' => 'admin',
            'email' => 'adminspi@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'unit_id' => $unitSPI->id,
        ]);

        User::create([
            'name' => 'Andi Auditor',
            'email' => 'anggotaspi@gmail.com',
            'password' => Hash::make('anggota123'),
            'role' => 'anggota',
            'unit_id' => $unitSPI->id,
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'kepalaupt@gmail.com', // Login pakai ini
            'password' => Hash::make('kepala123'),
            'role' => 'kepala_unit',
            'unit_id' => $unitTI->id,
        ]);

       User::create([
            'name' => 'Prof. Rektor',
            'email' => 'pimpinan@gmail.com', 
            'nip' => 'pimpinan123',
            'password' => Hash::make('pimpinan123'),
            'role' => 'pimpinan',
            'unit_id' => null,
        ]);

    }
}
