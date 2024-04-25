<?php

namespace App\Exports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MenuExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Menu::all();

        // Ubah koleksi data menjadi koleksi baru dengan menambahkan nomor urut
        return $data->map(function ($menu, $index) {
            return [
                $index + 1,
                $menu->nama_menu,
                $menu->harga,
                $menu->gambar,
                $menu->keterangan,
                $menu->jenis_id,
            ];
        });
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set ukuran lebar kolom
                $event->sheet->getColumnDimension('A')->setWidth(5); // No
                $event->sheet->getColumnDimension('B')->setAutoSize(true); // Nama Menu
                $event->sheet->getColumnDimension('C')->setAutoSize(true); // Harga
                $event->sheet->getColumnDimension('D')->setAutoSize(true); // Gambar
                $event->sheet->getColumnDimension('E')->setAutoSize(true); // Keterangan
                $event->sheet->getColumnDimension('F')->setAutoSize(true); // Jenis Id

                // Judul di atas data
                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->setCellValue('A1', "DATA MENU");

                // Style judul
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Style border untuk seluruh data
                $event->sheet->getStyle('A3:F' . $event->sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            }
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Menu',
            'Harga',
            'Gambar',
            'Keterangan',
            'Jenis Id',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk baris judul
            1 => ['font' => ['bold' => true]],
            // Style untuk judul "DATA JENIS"
            'A1:F1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '17cfb6'],
                ],
            ],
        ];
    }
}