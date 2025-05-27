<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JanjiPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasien = User::where('role', 'pasien')->first();
        $jadwal = JadwalPeriksa::first();

        $janjis = [
            [
                'id_pasien' => $pasien->id,
                'id_jadwal_periksa' => $jadwal->id,
                'keluhan' => 'Sakit kepala dan demam',
                'no_antrian' => 1,
            ],
            [
                'id_pasien' => $pasien->id,
                'id_jadwal_periksa' => $jadwal->id,
                'keluhan' => 'Batuk kering berkepanjangan',
                'no_antrian' => 2,
            ],
        ];

        foreach ($janjis as $janji) {
            JanjiPeriksa::create($janji);
        }
    }
}