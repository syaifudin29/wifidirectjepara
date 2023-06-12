<?php

namespace App\Http\Controllers;

use App\Models\UmumModel;
use App\Models\ProfileModel;
use Illuminate\Http\Request;
use App\Models\PelangganModel;
use App\Models\PengaturanModel;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    private $id;
    function __construct() {
        $this->middleware(function ($request, $next) {
            $this->id = Session()->get('id_user');
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaturan = PengaturanModel::where('keterangan', 'simulasi')->get();

        $user = PelangganModel::where('id', $this->id)->get();
        $data = ['menu' => 'profile',
                'user' => $user,
                'pengaturan' => $pengaturan
                ];
           
        return view('admin/profile', $data);
    }

    public function updatePassword(Request $request)
    {
        $baru = md5($request->ps_baru);
        $lama = md5($request->ps_lama);    
        $query = PelangganModel::where('id', $this->id)->where('password', $lama)->get();
        if(count($query) != 0){
            $cek = PelangganModel::where('id', $this->id)->update(['password' => $baru]);
        }else{
            $cek = 0;
        }
        return UmumModel::notif($cek, 'update', 'profile');
       
    }

    public function updateProfile(Request $request)
    {
        $data = ['nama' => $request->nama,
                 'no_hp' => $request->no_hp,
                 'alamat' => $request->alamat,
                 'email' => $request->email,
                ];   

        $cek = PelangganModel::where('id', $this->id)->update($data);
        return UmumModel::notif($cek, 'update', 'profile');
       
    }

    
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->foto->extension();
        $image_path = $request->file('foto')->store('foto', 'public');
        $videoLama = public_path('storage/' . session()->get('photo'));
        
        // Cek Apakah ada file videonya
        if(File::exists($videoLama)){
        	// Jika File tersebut ada
            // Hapus File tersebut
            File::delete($videoLama);
        }
        // // Public Folder
        // $request->foto->move(public_path('gambar'), $imageName);
        session()->put('photo', $image_path);
        
        $cek = PelangganModel::where('id', $this->id)->update(['photo' => $image_path]);
        return UmumModel::notif($cek, 'update', 'profile');
        
    }

    public function updateSimulasi($status){
        if($status == 1){
            $no = 0;
        }else{
            $no = 1;
        }
        $cek = PengaturanModel::where('keterangan', 'simulasi')->update(['status' => $no]);
        return UmumModel::notif($cek, 'update', 'profile');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfileModel  $profileModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileModel $profileModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileModel  $profileModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileModel $profileModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfileModel  $profileModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileModel $profileModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileModel  $profileModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileModel $profileModel)
    {
        //
    }
}
