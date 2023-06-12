<?php

namespace App\Http\Controllers;

use App\Models\UmumModel;
use Illuminate\Http\Request;
use App\Models\PelangganModel;
use Illuminate\Support\Facades\File;

class PelProfileController extends Controller
{
    private $id;

    public function __construct(){
         $this->middleware(function ($request, $next) {
            $this->id = Session()->get('id_user');
            return $next($request);
        });
    }

    public function index(){
        $pelanggan = PelangganModel::where('id', $this->id)->get();
        $data = ['menu' => "Profile",
                'pelanggan' => $pelanggan
        ];
        return view('pelanggan/profile', $data);
    }
    public function updatePassword(Request $req){
        $pelanggan = PelangganModel::where('id', $this->id)->get();
        if($pelanggan[0]->password == md5($req->pass_old)){
            PelangganModel::where('id', $this->id)->update(['password' => md5($req->pass_new)]);
            return UmumModel::notifPelanggan(1, 'update password','profile');
        }else{
            return UmumModel::notifPelanggan(0, 'update password','profile');
        }
    }
    public function updatePhoto(Request $request)
    {
         $request->validate([
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        
        $videoLama = public_path('storage/' . session()->get('photo'));
        
        // Cek Apakah ada file videonya
        if(File::exists($videoLama)){
        	// Jika File tersebut ada
            // Hapus File tersebut
            File::delete($videoLama);
        }
        $imageName = time().'.'.$request->foto->extension();
        $image_path = $request->file('foto')->store('foto', 'public');
        session()->put('photo', $image_path);

        $cek = PelangganModel::where('id', $this->id)->update(['photo' => $image_path]);
         return UmumModel::notifPelanggan($cek, 'update','profile');
        
    }

}
