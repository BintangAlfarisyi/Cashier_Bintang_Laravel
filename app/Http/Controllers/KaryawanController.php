<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['karyawan'] = Karyawan::orderBy('created_at', 'ASC')->get();

        return view('karyawan.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryawanRequest $request)
    {
        try {
            DB::beginTransaction(); // Mulai Transaksi
            Karyawan::create($request->all()); // Query Input Ke Table

            DB::commit(); // Menyimpan Data Ke Database

            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('karyawan')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback();

            // Tangani error di sini, misalnya:
            $errorMessage = $error->getMessage(); // Mendapatkan pesan kesalahan
            dd($errorMessage);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryawanRequest $request, Karyawan $karyawan)
    {
        $karyawan = Karyawan::find($request->id);
        
        if (!$karyawan) {
            return response()->json(['message' => 'Karyawan tidak ditemukan'], 404);
        }

        $karyawan->status = $request->status;
        $karyawan->save();

        return response()->json(['message' => 'Status berhasil diperbarui'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //
    }
}
