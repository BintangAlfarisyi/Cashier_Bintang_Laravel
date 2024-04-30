<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\TransaksiRequest;
use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Stok;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        //
    }

    public function makeTransaksi(Request $request)
    {
        try {
            DB::beginTransaction();

            $last_id = Transaksi::whereDate('tanggal', today())->orderBy('id', 'desc')->first();
            $last_id_number = $last_id ? substr($last_id->id, 8) : 0;
            $notrans = today()->format('Ymd') . str_pad($last_id_number + 1, 4, '0', STR_PAD_LEFT);

            $insertTransaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request->total,
                'metode_pembayaran' => 'cash', // Sesuaikan dengan logika bisnis Anda
                'keterangan' => ''
            ]);
            if (!$insertTransaksi) return 'error';

            foreach ($request->orderedList as $detail) {
                $stok = Stok::where('menu_id', $detail['menu_id'])->first();
                $stok->jumlah = $stok->jumlah - $detail['qty'];
                $stok->save();
                DetailTransaksi::create([
                    'transaksi_id' => $notrans,
                    'menu_id' => $detail['menu_id'],
                    'jumlah' => $detail['qty'],
                    'sub_total' => $detail['harga'] * $detail['qty']
                ]);
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil!', 'notrans' => $notrans]);
        } catch (QueryException | Exception | PDOException $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!', 'error' => $e->getMessage()]);
        }
    }

    public function faktur($nofaktur)
    {
        try {
            $transaksi = Transaksi::findOrFail($nofaktur);
            $data['transaksi'] = $transaksi->load('detailTransaksi.menu');

            return view('faktur.index', compact('data'));
        } catch (Exception $e) {
            $message = 'Transaksi tidak ditemukan!';
            return view('faktur.index', compact('message'));
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
