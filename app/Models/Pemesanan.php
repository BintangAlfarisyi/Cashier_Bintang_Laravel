<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $fillable = ['nama_pemesan', 'tanggal_pemesanan', 'jam_mulai', 'jam_selesai', 'jumlah_pelanggan', 'meja_id'];
}
