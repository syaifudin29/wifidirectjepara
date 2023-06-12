<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmumModel extends Model
{
    public static function notif($cek, $ket, $url){
        if($cek) {
            return redirect('admin/'.$url)->with(['status' => 'success', 'ket' => $ket]);
        }else{
            return redirect('admin/'.$url)->with(['status' => 'error', 'ket' => $ket]);
        }
    }

    public static function notifPelanggan($cek, $ket, $url){
        if($cek) {
            return redirect('pelanggan/'.$url)->with(['status' => 'success', 'ket' => $ket]);
        }else{
            return redirect('pelanggan/'.$url)->with(['status' => 'error', 'ket' => $ket]);
        }
    }

    public static function selisih($awal, $akhir){
        $tgl1 = strtotime($awal); 
        $tgl2 = strtotime($akhir); 
        $jarak = $tgl2 - $tgl1;
        $hari = $jarak / 60 / 60 / 24;
        return $hari;
    }
    
}
