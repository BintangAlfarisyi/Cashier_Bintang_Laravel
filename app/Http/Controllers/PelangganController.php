<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Imports\PelangganImport;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pelanggan'] = Pelanggan::orderBy('created_at', 'ASC')->get();

        return view('pelanggan.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        try {
            DB::beginTransaction(); #Mulai Transaksi
            Pelanggan::create($request->all()); #Query Input Ke Table

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('pelanggan')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());

        return redirect('pelanggan')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect('pelanggan')->with('success', 'Delete Data Berhasil!');
    }

    public function generateExcel()
    {
        $date = date('Y-m-d');
        return Excel::download(new PelangganExport, $date . 'pelanggan.xlsx');
    }

    public function generatepdf()
    {
        $data = Pelanggan::all();

        $pdf = PDF::loadView('pelanggan.pelangganPdf', compact('data'));
        return $pdf->stream('pelanggan.pdf');
    }

    public function importData(Request $request)
    {
        $file = $request->file('import');

        Excel::import(new PelangganImport, $file, \Maatwebsite\Excel\Excel::XLSX);

        return redirect()->back()->with('success', 'Data berhasil diimpor');
    }
}
