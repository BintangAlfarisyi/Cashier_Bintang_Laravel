<?php

namespace App\Imports;

use App\Models\Jenis;
use App\Models\Menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MenuImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
            Menu::create([
                'nama_menu' => $row['nama'],
                'harga' => $row['harga'],
                'gambar' => $row['gambar'],
                'keterangan' => $row['keterangan'],
                'jenis_id' => $row['jenis_id']
            ]);
        }
    }
}
