<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama_poli' => 'Mata',
            ],
            [
                'nama_poli' => 'Anak',
            ],
            [
                'nama_poli' => 'Rambutan',
            ],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}