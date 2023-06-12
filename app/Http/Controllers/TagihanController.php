<?php

namespace App\Http\Controllers;

use App\Models\UmumModel;
use App\Traits\WablasTrait;
use App\Models\TagihanModel;
use Illuminate\Http\Request;
use App\Models\PelangganModel;
use Illuminate\Support\Carbon;
use App\Models\PengaturanModel;

class TagihanController extends Controller
{
    public function __construct(){
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
    }

    public function sudahbyr(){

        $tagihan = TagihanModel::where('status', 'sukses')->where('is_active', '1')->get();

        $data = ['menu' => 'sudahbayar', 'tagihan' => $tagihan];
        return view('admin/sudahbayar', $data);
    }

    public function bulanini(){

        $tagihan = TagihanModel::whereMonth('tgl_tagihan', date('m'))->where('is_active', '1')->whereYear('tgl_tagihan', date('Y'))->get();

        $data = ['menu' => 'bulanini', 'tagihan' => $tagihan];
        return view('admin/bulanini', $data);
    }

    public function jatuhtempo(){
        $tagihan = TagihanModel::where('is_active', '1')->whereIn('status', ['belum','proses'])->get();
        $data = ['menu' => 'jatuhtempo', 'tagihan' => $tagihan];
        return view('admin/jatuhtempo', $data);
    }

    public function bayartagihan(Request $request){
        $id = $request->no_pelanggan;
        if(isset($id)){
            $no_lang = PelangganModel::where('id', $id)->where('level', 'pelanggan')->get();
            $pelanggan = PelangganModel::where('id', $id)->where('level', 'pelanggan')->get();
            $tagihan = TagihanModel::where('pelanggan_id', $id)->whereIn('status', ['belum','proses'])->get();
        }else{
            $tagihan = [];
            $pelanggan = [];
        }

        $pelanggancari = PelangganModel::where('is_active', '1')->where('level', 'pelanggan')->get();
        $data = ['menu' => 'bayartagihan', 'pelanggancari' => $pelanggancari, 'pelanggan' => $pelanggan,'tagihan' => $tagihan];
        return view('admin/bayartagihan', $data);
    }
    public function bayartagihanproses(Request $request){
        $id = $request->id;
        $tagihan = TagihanModel::where('pelanggan_id', $id )->where('status', 'belum')->get();
    
        foreach ($tagihan as $key) {
            if($key->tgl_tagihan < date('Y-m-d')){
                $cek = TagihanModel::where('no_tagihan', $key->no_tagihan)->update(['status' => 'sukses', 'tgl_byr' => date('Y-m-d'), 'denda' => 10000,]);
            }else{
                $cek = TagihanModel::where('no_tagihan', $key->no_tagihan)->update(['status' => 'sukses', 'tgl_byr' => date('Y-m-d')]);
            }
        }
        return UmumModel::notif(1, 'update','tagihan/bayartagihan');
    }

    public function notif(Request $request){

        $pelanggan = PelangganModel::where('no_langganan', $request->id_pelanggan)->get();
        if (count($pelanggan) == 1) {
            $datas = ['keterangan' => 'sukses', 'id' => $pelanggan[0]['no_hp']];
            $tagihan = TagihanModel::where('no_tagihan', $request->id_tagihan)->get();
        }else{
            $datas = ['keterangan' => 'gagal'];
        }
        
        $kumpulan_data = [];
        $data['phone'] = $pelanggan[0]['no_hp'];
        $data['message'] = "
        Hai, *".$pelanggan[0]['nama']."*
        Terima kasih ya sudah berlangganan dari Wifi kami. Semoga produk dan layanan yang kami berikan benar-benar membantu Anda. Pesan ini hanya sebagai pengingat bahwa pembayaran Anda untuk bulan *".Carbon::parse($tagihan[0]['tgl_tagihan'])->translatedFormat('F')."* akan jatuh tempo pada tanggal *".date('d-m-Y', strtotime($tagihan[0]['tgl_tagihan']))."*. Anda bisa mengirimkan pembayaran secara online atau offline (secara langsung). Jangan ragu-ragu untuk menghubungi kami apabila ada pertanyaan mengenai pembayaran atau pelayanan kami, ya
        Salam,
        *WIFI TERCEPAT DI KOTA*";
        $data['secret'] = false;
        $data['retry'] = false;
        $data['isGroup'] = false;
        array_push($kumpulan_data, $data);
        // fungsi untuk mengirim data
        $curl = curl_init();
        $token = env('SECURITY_TOKEN_WABLAS');
        $payload = [
            "data" => $kumpulan_data
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_URL,  env('DOMAIN_SERVER_WABLAS') . "/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);

        curl_close($curl);
        return response($datas, 200);
    }
    public function perbarui(){
        $pelanggan = PelangganModel::select('id','jatuhtempo')->get();
        foreach ($pelanggan as $key ) {
            
            $tanggal = date('Y-m-d', strtotime('+1 month', strtotime($key['jatuhtempo'])));
            
            $paket = PelangganModel::find($key['id'])->paket->harga;
            TagihanModel::create(['pelanggan_id' => $key['id'], 'no_tagihan' => rand(),
                'no_pembayaran' => 0, 'tgl_tagihan' => $tanggal, 'ttl_byr'=>$paket,'metode'=>'',
                'status' => 'belum', 'is_active' => '1', 'tgl_byr' => date('Y-m-d'), 'denda' => 0]);
        }
    }
    public function cancelTransaksi($id){
                $status = \Midtrans\Transaction::status($id);
                $st = $status->transaction_status;

                if($st == 'deny' || $st == 'cancel' ||  $st == 'expire' || $st == 'refund' || $st == 'partial_refund'){
                        TagihanModel::where('no_pembayaran', $id)->update(['status' => 'belum']);
                }else if($st == 'pending'){
                        TagihanModel::where('no_pembayaran', $id)->update(['status' => 'belum']);
                        $status = \Midtrans\Transaction::cancel($id);
                }else{
                    TagihanModel::where('no_pembayaran', $id)->update(['status' => 'sukses']);
                }
                return UmumModel::notif(1, 'batalkan','tagihan/bayartagihan');
    }

    public function pembatalanTransaksi($id){
        TagihanModel::where('no_tagihan', $id)->update(['status' => 'belum']);
        return UmumModel::notif(1, 'batalkan','tagihan/sudahbayar');
    }
}
