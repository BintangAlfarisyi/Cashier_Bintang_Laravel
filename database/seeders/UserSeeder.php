<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $User = [
            [
                'name' => 'Bintang Alfarisyi',
                'email' => 'bntngal7@gmail.com',
                'password' => bcrypt('Bintang12345'),
                'level' => 1,
                'alamat' => 'Pateken',
                'ponsel' => "0895326146997",
            ],

            [
                'name' => 'Yanti Febriyanti',
                'email' => 'yantif7@gmail.com',
                'password' => bcrypt('Yanti12345'),
                'level' => 2,
                'alamat' => 'Gombong',
                'ponsel' => "085871124255",
            ],

        ];
        foreach ($User as $key => $value) {
            User::create($value);
        }
    }
}
