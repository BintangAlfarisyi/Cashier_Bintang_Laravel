<?php

namespace App\Imports;

use App\Models\Pegawai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class PegawaiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Pegawai::create([
                'nama_karyawan' => $row['nama_karyawan'],
                'tanggal_masuk' => $row['tanggal_masuk'],
                'waktu_masuk' => $row['waktu_masuk'],
                'status' => $row['status'], 
                'waktu_keluar' => $row['tanggal_masuk']
            ]);
        }
    }
}
