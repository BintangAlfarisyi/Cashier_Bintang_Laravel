<?php

namespace App\Http\Controllers;

use App\Exports\MejaExport;
use App\Models\Meja;
use App\Http\Requests\StoreMejaRequest;
use App\Http\Requests\UpdateMejaRequest;
use App\Imports\MejaImport;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['meja'] = Meja::orderBy('created_at', 'ASC')->get();

        return view('meja.index')->with($data);
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
    public function store(StoreMejaRequest $request)
    {
        try {
            DB::beginTransaction(); #Mulai Transaksi
            Meja::create($request->all()); #Query Input Ke Table

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('meja')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMejaRequest $request, Meja $meja)
    {
        $meja->update($request->all());

        return redirect('meja')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meja $meja)
    {
        $meja->delete();

        return redirect('meja')->with('success', 'Delete Data Berhasil!');
    }

    public function generateExcel()
    {
        $date = date('Y-m-d');
        return Excel::download(new MejaExport, $date . 'meja.xlsx');
    }

    public function generatepdf()
    {
        $data = Meja::all();

        $pdf = PDF::loadView('meja.mejaPdf', compact('data'));
        return $pdf->stream('meja.pdf');
    }

    public function importData(Request $request)
    {
        $file = $request->file('import');

        Excel::import(new MejaImport, $file, \Maatwebsite\Excel\Excel::XLSX);

        return redirect()->back()->with('success', 'Data berhasil diimpor');
    }
}
