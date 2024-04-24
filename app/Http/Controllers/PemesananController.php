<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Models\Jenis;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function tampil()
    {
        $data['jenis'] = Jenis::with(['menu'])->get();

        return view('pemesanan.index')->with($data);
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
    public function store(StorePemesananRequest $request)
    {
        $data['jenis'] = Jenis::with(['menu'])->get();

        return view('pemesanan.index')->with($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemesananRequest $request, Pemesanan $pemesanan)
    {
        $pemesanan->update($request->all());

        return redirect('pemesanan')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect('pemesanan')->with('success', 'Delete Data Berhasil!');
    }
}
