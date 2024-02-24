<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['id', 'tanggal', 'total_harga', 'metode_pembayaran', 'keterangan'];


    public function menu()
    {
        return $this->belongsToMany(Menu::class, 'menu_transaksi', 'transaksi_id', 'menu_id');
    }
}
