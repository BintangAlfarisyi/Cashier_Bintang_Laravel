<?php

namespace App\Imports;

use App\Models\Produk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdukImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
            foreach ($collection as $row) {
                Produk::create([
                    'nama_produk' => $row['nama_produk'],
                    'nama_supplier' => $row['nama_supplier'],
                    'harga_jual' => $row['harga_jual'],
                    'harga_beli' => $row['harga_beli'],
                    'stok' => $row['stok'],
                    'keterangan' => $row['keterangan']
                ]);
            }
    }
}
