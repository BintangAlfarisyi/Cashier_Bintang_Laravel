<?php

namespace App\Http\Controllers;

use App\Exports\JenisExport;
use App\Models\Jenis;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;
use App\Imports\JenisImport;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis'] = Jenis::orderBy('created_at', 'ASC')->get();

        return view('jenis.index')->with($data);
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
    public function store(StoreJenisRequest $request)
    {
        try {
            DB::beginTransaction(); #Mulai Transaksi
            Jenis::create($request->all()); #Query Input Ke Table

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('jenis')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisRequest $request, Jenis $jeni)
    {
        $jeni->update($request->all());

        return redirect('jenis')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jeni)
    {
        $jeni->delete();

        return redirect('jenis')->with('success', 'Delete Data Berhasil!');
    }

    public function generateExcel()
    {
        $date = date('Y-m-d');
        $jenisExport = new JenisExport;

        return Excel::download($jenisExport, $date . 'jenis.xlsx');
    }

    public function generatepdf()
    {
        $data = Jenis::all();

        $pdf = PDF::loadView('jenis.jenisPdf', compact('data'));
        return $pdf->stream('jenis.pdf');
    }

    public function importData(Request $request)
    {
        $file = $request->file('import');

        Excel::import(new JenisImport, $file, \Maatwebsite\Excel\Excel::XLSX);

        return redirect()->back()->with('success', 'Data berhasil diimpor');
    }
}
