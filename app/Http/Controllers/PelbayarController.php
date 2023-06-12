<?php

namespace App\Http\Controllers;


use App\Models\TagihanModel;
use App\Veritrans\Veritrans;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use App\Models\PembayaranModel;
use App\Models\PengaturanModel;
use Illuminate\Support\Facades\Http;

class PelbayarController extends Controller
{
private $ids;
        
public function __construct(){
        $this->middleware(function ($request, $next) {
                $this->ids = Session()->get('id_user');
                return $next($request);
        });
        $pengaturan = PengaturanModel::where('keterangan', 'simulasi')->get();
        if ($pengaturan[0]['status'] == 1) {
                \Midtrans\Config::$serverKey = env('P_MIDTRANS_SERVER_KEY');
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = true;
        }else{
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = false;
        }

        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
}

public function index(){
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        $pelanggan = PelangganModel::where('id', $this->ids)->get();
        $tagihan = TagihanModel::where('pelanggan_id', $this->ids)->where('status', 'belum')->get();
        if(count($tagihan) != 0){
                return redirect('pelanggan/bayar/belum');
        }
        $tagihan1 = TagihanModel::where('pelanggan_id', $this->ids)->where('status', 'proses')->get();
        if(count($tagihan1) != 0){
                return redirect('pelanggan/bayar/proses');
        }
        $data = ['menu' => "Bayar",
        'pelanggan' => $pelanggan,
        'tagihan'   =>  $tagihan, 
        'snapToken' =>  "",
        'order_id' => "",
        'tampilan' => 'sukses'
        ];
        return view('pelanggan/bayar', $data);
}
        
public function belum(){
        $pengaturan = PengaturanModel::where('keterangan', 'simulasi')->get();
        $pelanggan = PelangganModel::where('id', $this->ids)->get();
        $tagihan = TagihanModel::where('pelanggan_id', $this->ids)->where('status', 'belum')->get();
        $tagihanProses = TagihanModel::where('pelanggan_id', $this->ids)->where('status', 'proses')->get();
        if(count($tagihan) != 0){

        $jum = 0;
        $jum1 = 0;
        foreach ($tagihan as $key) {
                $jum=$jum+$key->ttl_byr;
                if ($key->tgl_tagihan < date('Y-m-d')) {
                        $jum=0;
                        $jum=$key->ttl_byr+10000;
                        $jum1=$jum+$jum1;
                }else{
                        $jum=0;
                        $jum=$key->ttl_byr;
                        $jum1=$jum+$jum1;
                }
        }
        $order_id = rand();

        $params = array(
        'transaction_details' => array(
                'order_id' =>  $order_id,
                'gross_amount' => $jum1,
        ),
        'customer_details' => array(
                'first_name' => $pelanggan[0]['nama'],
                'phone' => $pelanggan[0]['no_hp'],
        ),
        );
        $tampilan = 'belum';
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        }else if(count($tagihanProses) != 0){
                $snapToken ="";
                $order_id = "";
                $tampilan = 'proses';
                $tagihan = $tagihanProses;
        }else{
                $snapToken ="";
                $order_id = "";
                $tampilan = 'sukses';  
        }

        $data = ['menu' => "Bayar",
                        'pelanggan' => $pelanggan,
                        'tagihan'   =>  $tagihan, 
                        'snapToken' =>  $snapToken,
                        'order_id' => $order_id,
                        'tampilan' => $tampilan,
                        'pengaturan' => $pengaturan
                ];

        return view('pelanggan/bayar', $data);
        }

        public function proses(){

        $pelanggan = PelangganModel::where('id', $this->ids)->get();
        $tagihan = TagihanModel::where('pelanggan_id', $this->ids)->where('status', 'proses')->get();
        if(count($tagihan) == 0){
                return redirect('pelanggan/bayar/');    
        }
        $status = \Midtrans\Transaction::status($tagihan[0]['no_pembayaran']);
        // dd($status);
        $st = $status->transaction_status;
        if ($st == 'capture' || $st == 'settlement' ) {
                TagihanModel::where('no_pembayaran', $tagihan[0]['no_pembayaran'])->update(['status' => 'sukses']);
                return redirect('pelanggan/bayar/');
        }else if($st == 'deny' || $st == 'cancel' ||  $st == 'expire' || $st == 'refund' || $st == 'partial_refund'){
                TagihanModel::where('no_pembayaran', $tagihan[0]['no_pembayaran'])->update(['status' => 'belum']);
                return redirect('pelanggan/bayar/');
        }else if($st == 'pending'){
                $h = "proses";
        }else{
                $h = "tidak tahu";
        }
        if(count($tagihan) == 0){
                return redirect('pelanggan/bayar/');
        }
        $data = ['menu'         => "Bayar",
                'pelanggan'     => $pelanggan,
                'tagihan'       =>  $tagihan, 
                'snapToken'     =>  "",
                'order_id'      => "",
                'tampilan'      => 'proses',
                'status'        => $status
        ];
        return view('pelanggan/bayar', $data);
        }

        public function callback(Request $request){
        $serverKey =  config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hashed == $request->signature_key) {
                if ($request->transaction_status == 'capture') {
                      $order = TagihanModel::where('no_pembayaran', $request->order_id)->update(['status', 'sukses']);
                }
        }
        }

        public function updatePembayaran($order_id, $status){
        $id = $this->ids;
        $tagihan = TagihanModel::select('no_tagihan')->where('pelanggan_id', $id)->where('status', 'belum')->get();
        TagihanModel::where('pelanggan_id', $id)->where('status', 'belum')->update(['status' => 'proses', 'no_pembayaran' => $order_id]);
        PembayaranModel::create(['id' => $order_id, 'pelanggan_id' => $id, 'jumlah' => 0]);
        return redirect('pelanggan/bayar/');
        }

        public function cancelTransaksi($id){
                $status = \Midtrans\Transaction::status($id);
                $st = $status->transaction_status;
                if($st == 'deny' || $st == 'cancel' ||  $st == 'expire' || $st == 'refund' || $st == 'partial_refund'){
                        TagihanModel::where('no_pembayaran', $id)->update(['status' => 'belum']);
                }else if($st == 'pending'){
                        TagihanModel::where('no_pembayaran', $id)->update(['status' => 'belum']);
                        $status = \Midtrans\Transaction::cancel($id);
                }else{}
                return redirect()->to('pelanggan/bayar');
        }

        //transkasi sukses
        public function suksesTransaksi($id){
                TagihanModel::where('no_pembayaran', $id)->update(['status' => 'sukses']);
                $status = \Midtrans\Transaction::approve($id);
                dd($status);
                // redirect()->to('pelanggan/bayar');
        }
}       
