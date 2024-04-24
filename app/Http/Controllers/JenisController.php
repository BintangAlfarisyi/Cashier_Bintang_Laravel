<?php

namespace App\Http\Controllers;

use App\Exports\JenisExport;
use App\Models\Jenis;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;
use App\Imports\JenisImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return Excel::download(new JenisExport, $date . 'jenis.xlsx');
    }

    public function generatepdf()
    {
        $data = Jenis::all();

        $pdf = PDF::loadView('jenis.jenisPdf', compact('data'));
        return $pdf->stream('jenis.pdf');
    }

    public function importData(Request $request)
    {

        Excel::import(new JenisImport, $request->import);
        return redirect()->back()->with('success', 'Data berhasil di import');
    }

    // public function hapusJenis($jenis_id)
    // {
    //     // Cari jenis berdasarkan ID
    //     $jeni = Jenis::find($jenis_id);

    //     if ($jeni) {
    //         // Temukan semua menu yang terkait dengan jenis yang akan dihapus
    //         $menus = Menu::where('jenis_id', $jenis_id)->get();

    //         // Hapus semua menu yang terkait
    //         foreach ($menus as $menu) {
    //             $menu->delete();
    //         }

    //         // Hapus jenis itu sendiri
    //         $jeni->delete();

    //         return redirect('jenis')->with('success', 'Data berhasil dihapus beserta semua menu yang terkait.');
    //     } else {
    //         return redirect('jenis')->with('error', 'Jenis tidak ditemukan.');
    //     }
    // }

}
