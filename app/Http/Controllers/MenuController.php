<?php

namespace App\Http\Controllers;

use App\Exports\MenuExport;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Imports\MenuImport;
use App\Models\Jenis;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::with('jenis')->get();
        $jenis = Jenis::all();

        return view('menu.index', compact('jenis', 'menu'));
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
    public function store(StoreMenuRequest $request)
    {
        try {
            DB::beginTransaction(); #Mulai Transaksi
            $menu = Menu::create($request->all()); #Query Input Ke Table

            $file = $request->file('gambar');

            $file_name = $file->getClientOriginalName();
            $file_path = $file->storeAs('image', $file_name);

            $menu->gambar = $file_path;
            $menu->save();

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('menu')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->update($request->all());

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            if ($file->isValid()) {
                $file_name = $file->getClientOriginalName();
                $file_path = $file->storeAs('image', $file_name);

                $menu->gambar = $file_path;
                $menu->save();

                return redirect('menu')->with('success', 'Update Data Berhasil!');
            } else {
                return redirect('menu')->with('error', 'Gagal mengunggah gambar.');
            }
        } else {
            return redirect('menu')->with('error', 'Tidak ada gambar yang diunggah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect('menu')->with('success', 'Delete Data Berhasil!');
    }

    public function generateExcel()
    {
        $date = date('Y-m-d');
        return Excel::download(new MenuExport, $date . 'menu.xlsx');
    }

    public function generatePdf()
    {
        $data = Menu::all();

        $pdf = PDF::loadView('menu.menuPdf', compact('data'));
        return $pdf->stream('menu.pdf');
    }

    public function importData(Request $request)
    {
        Excel::import(new MenuImport, $request->import);
        return redirect()->back()->with('success', 'Data berhasil di import');
    }
}
