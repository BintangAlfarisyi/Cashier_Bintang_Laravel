<?php

namespace App\Http\Controllers;

use App\Exports\StokExport;
use App\Models\Stok;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use App\Imports\StokImport;
use App\Models\Menu;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stok = Stok::with('menu')->get();
        $menu = Menu::all();

        return view('stok.index', compact('menu', 'stok'));
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
    public function store(StoreStokRequest $request)
    {
        try {
            $isStok = Stok::where('menu_id', $request->menu_id)->first();
            if (isset($isStok)) {
                return redirect()->back()->withErrors(['Stok sudah ada']);
            }
            DB::beginTransaction(); #Mulai Transaksi
            Stok::create($request->all()); #Query Input Ke Table

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('stok')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $stok)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokRequest $request, Stok $stok)
    {
        $stok->update($request->all());

        return redirect('stok')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $stok)
    {
        $stok->delete();

        return redirect('stok')->with('success', 'Delete Data Berhasil!');
    }

    public function generateExcel()
    {
        $date = date('Y-m-d');
        return Excel::download(new StokExport, $date . 'stok.xlsx');
    }

    public function generatepdf()
    {
        $data = Stok::all();

        $pdf = PDF::loadView('stok.stokPdf', compact('data'));
        return $pdf->stream('stok.pdf');
    }

    public function importData(Request $request)
    {
        $file = $request->file('import');

        Excel::import(new StokImport, $file, \Maatwebsite\Excel\Excel::XLSX);

        return redirect()->back()->with('success', 'Data berhasil diimpor');
    }
}
