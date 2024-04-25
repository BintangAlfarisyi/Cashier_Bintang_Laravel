<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelangganImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Pelanggan::create([
                'nama_pelanggan' => $row['nama_pelanggan'],
                'email' => $row['email'],
                'ponsel' => $row['ponsel'],
                'alamat' => $row['alamat'],
            ]);
        }
    }
}
