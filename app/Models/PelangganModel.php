<?php

namespace App\Models;

use App\Models\PaketModel;
use App\Models\TagihanModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PelangganModel extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $guarded = 'id';
    protected $fillable = ['no_langganan', 'ktp', 'nama', 'alamat', 'no_hp','email','jatuhtempo', 'paket_id', 'username', 'password', 'photo', 'status'];
    
    public function paket(){
        return $this->belongsTo(PaketModel::class);
    }

    public function tagihan(){
        return $this->hasMany(TagihanModel::class, 'pelanggan_id');
    }
}
