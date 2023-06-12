<?php

namespace App\Http\Controllers;

use App\Models\UmumModel;
use App\Models\PaketModel;
use App\Models\TagihanModel;
use Illuminate\Http\Request;
use App\Models\PelangganModel;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data   = ['menu' => 'pelanggan',
                'pelanggan' => PelangganModel::where('is_active', '1')->where('level', 'pelanggan')->get(),
                'paket' => PaketModel::where('is_active', '1')->get()
                ];
        return view('admin/pelanggan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    $data   = [ 'no_langganan' => $request->no_langganan,
            'ktp' => $request->ktp,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'paket_id' => $request->paket_id,
            'jatuhtempo' => $request->jatuhtempo,
            'username' => $request->ktp,
            'password' => md5('12345'),
            'photo' => '',
            'level' => 'pelanggan',
        ];
        $cek = PelangganModel::create($data);
        $pelanggan = PelangganModel::where('no_langganan', $request->no_langganan)->get();

        TagihanModel::create(['pelanggan_id' => $pelanggan[0]->id, 'no_tagihan' => rand(),
                'no_pembayaran' => 0, 'tgl_tagihan' => $request->jatuhtempo, 'ttl_byr'=>$pelanggan[0]->paket->harga, 'metode'=>'',
                'status' => 'belum', 'is_active' => '1', 'tgl_byr' => date('Y-m-d'), 'denda' => 0]);
        return UmumModel::notif($cek, 'simpan', 'pelanggan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function show(PelangganModel $pelangganModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PelangganModel $pelangganModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelangganModel $pelangganModel)
    {
        $data   = [
            'ktp' => $request->ktp,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'paket_id' => $request->paket_id,
            'jatuhtempo' => $request->jatuhtempo,
        ];
        $cek = PelangganModel::where('no_langganan', $request->no_langganan)->update($data);
        return UmumModel::notif($cek, 'update', 'pelanggan');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = PelangganModel::where('no_langganan', $id)->update(['is_active' => '0']);
        return UmumModel::notif($cek, 'hapus', 'pelanggan');
    }

    public function updatepassword($id)
    {   
        $password = md5(12345);
        $cek = PelangganModel::where('no_langganan', $id)->update(['password' => $password]);
        return UmumModel::notif($cek, 'Reset Password', 'pelanggan');
    }
}
