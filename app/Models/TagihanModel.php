<?php

namespace App\Models;

use App\Models\PelangganModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagihanModel extends Model
{
    use HasFactory;

    protected $table = 'tagihan';
    protected $guarded = 'id';
    protected $fillable = ['no_tagihan', 'pelanggan_id', 'no_pembayaran', 'tgl_tagihan', 'jumlah', 'ttl_byr','denda', 'status','metode','is_active', 'paket_id', 'username', 'password', 'status','tgl_byr'];
    
    public function pelanggan(){
        return $this->belongsTo(PelangganModel::class);
    }
}
