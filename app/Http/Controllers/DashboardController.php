<?php

namespace App\Http\Controllers;

use App\Models\TagihanModel;
use Illuminate\Http\Request;
use App\Models\PelangganModel;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
   public function index(){
      $pelanggan = PelangganModel::select('id')->where('level', 'pelanggan')->count();
      $belum = TagihanModel::select('id')->whereIn('status', ['belum', 'proses'])->count();
      $sudah = TagihanModel::select('id', 'no_tagihan', 'ttl_byr', 'pelanggan_id')->where('status', 'sukses');
      $ttl = TagihanModel::select('ttl_byr')->where('status', 'sukses')->sum('ttl_byr');

      $data = ['menu' => 'dashboard', 'belum' => $belum, 'sudah' => $sudah, 'pelanggan' => $pelanggan, 'ttl' => "Rp ".$ttl];
      return view('admin/dashboard', $data);

   }
}
