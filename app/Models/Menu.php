<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = ['nama_menu', 'harga', 'gambar', 'keterangan', 'jenis_id'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
