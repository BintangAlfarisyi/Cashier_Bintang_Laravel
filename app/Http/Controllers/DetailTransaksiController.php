<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Http\Requests\StoreDetailTransaksiRequest;
use App\Http\Requests\UpdateDetailTransaksiRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['detail_transaksi'] = DetailTransaksi::orderBy('created_at', 'ASC')->get();

        return view('detail_transaksi.index')->with($data);
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
    public function store(StoreDetailTransaksiRequest $request)
    {
        try {
            DB::beginTransaction(); #Mulai Transaksi
            DetailTransaksi::create($request->all()); #Query Input Ke Table

            DB::commit(); #Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('detail_transaksi')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback(); #Undo Perubahan Query/Table
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailTransaksi $detailTransaksi)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailTransaksi $detailTransaksi)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailTransaksiRequest $request, DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->update($request->all());

        return redirect('detail_transaksi')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->delete();

        return redirect('detail_transaksi')->with('success', 'Delete Data Berhasil!');
    }
}
