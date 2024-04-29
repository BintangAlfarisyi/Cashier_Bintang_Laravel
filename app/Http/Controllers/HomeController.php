<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Transaksi;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $menu = Menu::get();
        $transaksi = Transaksi::get();

        if ($request->has('tanggal')) {
            $transaksi = $transaksi->whereDate('tanggal', $request->tanggal);
        }

        // Menampilkan transaksi per tanggal
        $pendapatanPerTanggal = $transaksi->groupBy(function ($date) {
            return Carbon::parse($date->tanggal)->format('m/d');
        })->map->sum('total_harga');

        $totalStok = $menu->map(function ($menu) {
            return $menu->stok()->sum('jumlah');
        })->sum();

        $menuSales = DetailTransaksi::select('menu_id', FacadesDB::raw('SUM(jumlah) as total_sales'))
            ->with('menu')
            ->groupBy('menu_id')
            ->orderBy('total_sales', 'desc')
            ->take(5)
            ->get();

        // Mengirimkan data ke view
        $data = [
            'totalTransaksi' => $transaksi->count(),
            'jumlahMenu' => $menu->count(),
            'totalPendapatan' => $transaksi->sum('total_harga'),
            'pendapatanPerTanggal' => $pendapatanPerTanggal->toArray(),
            'totalStok' => $totalStok,
            'menuData' => $menu,
            'menuSales'=> $menuSales
        ];

        return view('dashboard.index')->with($data);
    }
}
