<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;

class LoginController extends Controller
{
    public function index(){

        return view('login');
    }

    public function prosesLogin(Request $req){
        $user = PelangganModel::where('no_langganan', $req->no_langganan)->where('password', md5($req->password))->get();

        $this->validate($req,[
            'no_langganan' => 'required',
            'password' => 'required',
        ]);

        if(count($user) != 0){
            $data = ['id_user' => $user[0]->id, 'nama_user' => $user[0]->nama, 'photo' => $user[0]->photo, 'level' => $user[0]->level];
            session()->put($data);
            if($user[0]->level == "admin"){
                return redirect('admin');
            }else{
                return redirect('pelanggan');
            }
        }else{
            return Redirect('masuk')->with('message', 'id pelanggan atau password salah!');
        }
    }

    public function logout(){
        session()->forget(['id_user', 'nama_user', 'photo', 'level']);
         return Redirect('masuk');
    }
}
