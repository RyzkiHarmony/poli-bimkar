<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dr. Budi Santoso, Sp.PD',
                'email' => 'budi.santoso@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Pahlawan No. 123, Jakarta Selatan',
                'no_ktp' => '3175062505800001',
                'no_hp' => '081234567890',
                'id_poli' => '2',
            ],
            [
                'name' => 'Dr. Siti Rahayu, Sp.A',
                'email' => 'siti.rahayu@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Anggrek No. 45, Jakarta Pusat',
                'no_ktp' => '3175064610790002',
                'no_hp' => '081234567891',
                'id_poli' => '1',
            ],
            [
                'name' => 'Dr. Ahmad Wijaya, Sp.OG',
                'email' => 'ahmad.wijaya@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Melati No. 78, Jakarta Barat',
                'no_ktp' => '3175061505780003',
                'no_hp' => '081234567892',
                'id_poli' => '1',
            ],
            [
                'name' => 'Dr. Rina Putri, Sp.M',
                'email' => 'rina.putri@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Dahlia No. 32, Jakarta Timur',
                'no_ktp' => '3175062708850004',
                'no_hp' => '081234567893',
                'id_poli' => '3',
            ],
            [
                'name' => ' Doni Pratama',
                'email' => 'doni.pratama@klinik.com',
                'password' => Hash::make('dokter123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Kenanga No. 56, Jakarta Utara',
                'no_ktp' => '3175061002820005',
                'no_hp' => '081234567894',
                'no_rm' => '202504-001',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}