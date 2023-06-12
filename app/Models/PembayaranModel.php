<?php

namespace App\Models;

use App\Models\PelangganModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranModel extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $fillable = ['id', 'pelanggan_id', 'jumlah'];
    
    public function paket(){
        return $this->belongsTo(PelangganModel::class);
    }
}
