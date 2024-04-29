<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Jenis = [
            [
                'nama_jenis' => 'Coffee',
            ],
            [
                'nama_jenis' => 'Tea',
            ],
            [
                'nama_jenis' => 'Mocktail',
            ],
            [
                'nama_jenis' => 'Heavy Meal',
            ],
            [
                'nama_jenis' => 'Fried Rice',
            ],
            [
                'nama_jenis' => 'Pasta',
            ],
            [
                'nama_jenis' => 'Light Meal',
            ],
            [
                'nama_jenis' => 'Desert',
            ],
        ];
        foreach ($Jenis as $key => $value) {
            Jenis::create($value);
        }
    }
}
