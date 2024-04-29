<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Menu = [
            [
                'nama_menu' => 'Long Black',
                'harga' => 23000,
                'gambar' => 'image/longblack.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Espresso',
                'harga' => 23000,
                'gambar' => 'image/espresso.jpeg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Americano',
                'harga' => 23000,
                'gambar' => 'image/americano.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Cappucino',
                'harga' => 24000,
                'gambar' => 'image/cappucino.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Caffe Latte',
                'harga' => 24000,
                'gambar' => 'image/caffelatte.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Flat White',
                'harga' => 24000,
                'gambar' => 'image/flatwhite.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Piccolo',
                'harga' => 24000,
                'gambar' => 'image/piccolo.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Caramel Machiato',
                'harga' => 25000,
                'gambar' => 'image/caramelmachiato.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Affogato',
                'harga' => 25000,
                'gambar' => 'image/affogato.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Creme Brulee',
                'harga' => 26000,
                'gambar' => 'image/cremebrulee.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '1',
            ],
            [
                'nama_menu' => 'Lemon Tea',
                'harga' => 17000,
                'gambar' => 'image/lemontea.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '2',
            ],
            [
                'nama_menu' => 'Lychee Tea',
                'harga' => 20000,
                'gambar' => 'image/lycheetea.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '2',
            ],
            [
                'nama_menu' => 'Sweet Ice Tea',
                'harga' => 15000,
                'gambar' => 'image/sweeticetea.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '2',
            ],
            [
                'nama_menu' => 'Peach Tea',
                'harga' => 20,
                'gambar' => 'image/peachtea.jpg',
                'keterangan' => 'Long black adalah kopi yang dibuat dengan menuangkan dua seloki espreso atau ristreto ke atas air panas.',
                'jenis_id' => '2',
            ],

        ];
        foreach ($Menu as $key => $value) {
            Menu::create($value);
        }
    }
}
