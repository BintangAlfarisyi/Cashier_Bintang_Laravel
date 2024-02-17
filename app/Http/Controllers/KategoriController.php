<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kategori'] = Kategori::orderBy('created_at', 'ASC')->get();

        return view('kategori.index')->with($data);
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
    public function store(StoreKategoriRequest $request)
    {
        try {
            DB::beginTransaction(); #Mulai Transaksi
            Kategori::create($request->all()); #Query Input Ke Table

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('kategori')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $kategori->update($request->all());

        return redirect('kategori')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect('kategori')->with('success', 'Delete Data Berhasil!');
    }
}
