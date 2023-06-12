<?php

namespace App\Http\Controllers;

use App\Models\UmumModel;
use App\Models\PaketModel;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['menu' => 'paket',
                'paket' => PaketModel::where('is_active', '1')->get()
                ];

        return view('admin/paket', $data);
    }

    public function tambah(Request $request)
    {
        $data = ['nama' => $request->nama,
                'harga' => $request->harga
                ];
        $cek = PaketModel::create($data);
        return UmumModel::notif($cek, 'simpan','paket');
        
    }

    public function delete($id)
    {
        $cek = PaketModel::where('id', $id)->update(['is_active' => '0']);
        return UmumModel::notif($cek, 'hapus','paket');
    }

    public function edit(Request $request)
    {
        $cek = PaketModel::where('id', $request->id)->update(['nama' => $request->nama, 'harga' => $request->harga]);
        return UmumModel::notif($cek, 'update','paket');
    }

    
}
