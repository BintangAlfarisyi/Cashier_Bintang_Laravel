<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiExport;
use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Imports\PegawaiImport;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PDOException;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pegawai'] = Pegawai::orderBy('created_at', 'ASC')->get();

        return view('pegawai.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiRequest $request)
    {
        try {
            DB::beginTransaction(); #Mulai Transaksi
            Pegawai::create($request->all()); #Query Input Ke Table

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('pegawai')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        $pegawai->update($request->all());

        return redirect('pegawai')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect('pegawai')->with('success', 'Delete Data Berhasil!');
    }

    public function generateExcel()
    {
        $date = date('Y-m-d');
        return Excel::download(new PegawaiExport, $date . 'pegawai.xlsx');
    }

    public function generatepdf()
    {
        $data = Pegawai::all();

        $pdf = PDF::loadView('pegawai.pegawaiPdf', compact('data'));
        return $pdf->stream('pegawai.pdf');
    }

    public function importData(Request $request)
    {

        Excel::import(new PegawaiImport, $request->import);
        return redirect()->back()->with('success', 'Data berhasil di import');
    }
}
