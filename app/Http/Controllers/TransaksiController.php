<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\TransaksiRequest;
use App\Models\DetailTransaksi;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['transaksi'] = Transaksi::orderBy('created_at', 'ASC')->get();

        return view('transaksi.index')->with($data);
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
    public function store(TransaksiRequest $request)
    {
        try {
            DB::beginTransaction();

            $last_id = Transaksi::where('tanggal', date('Y-m-d'))->orderBy('id', 'desc')->select('id')->first();
            $next_id_suffix = $last_id ? (int)substr($last_id->id, 10) + 1 : 1;

            $noTrans = date('Ymd') . sprintf('%03d', $next_id_suffix);

            $insertTransaksi = Transaksi::create([
                'id' => $noTrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request->total,
                'metode_pembayaran' => 'cash', // Sesuaikan dengan logika bisnis Anda
                'keterangan' => ''
            ]);
            if(!$insertTransaksi->exists) return 'error';

            foreach($request->orderedList as $detail){
                    DetailTransaksi::create([
                    'transaksi_id' => $noTrans,
                    'menu_id' => $detail['menu_id'],
                    'jumlah' => $detail['qty'],
                    'subTotal' => $detail['jumlah'] * $detail['qty']
                ]);
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil!', 'noTrans' => $insertTransaksi->id]);
        } catch (QueryException | Exception | PDOException $e) {
            
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!']);
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    public function faktur($noFaktur){
        try{
            $data['transaksi'] = Transaksi::where('id', $noFaktur)->with(['detailTransaksi' => function($query){
                $query->with('menu');
            }])->first();

            return view('faktur.index')->with($data);
        }catch(Exception | QueryException | PDOException $e){
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransaksiRequest $request, Transaksi $transaksi)
    {
        $transaksi->update($request->all());

        return redirect('transaksi')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect('transaksi')->with('success', 'Delete Data Berhasil!');
    }
}
