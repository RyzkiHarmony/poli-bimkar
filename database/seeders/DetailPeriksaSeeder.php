<?php

namespace Database\Seeders;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $periksa = Periksa::first();
        $obat = Obat::first();

        $detail = [
            'id_periksa' => $periksa->id,
            'id_obat' => $obat->id,
        ];

        DetailPeriksa::create($detail);
    }
}