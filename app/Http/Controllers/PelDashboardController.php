<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TagihanModel;
use Illuminate\Http\Request;

class PelDashboardController extends Controller
{
    private $id;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->id = Session()->get('id_user');
            return $next($request);
        });
    }
    public function index(){
        $tagihan = TagihanModel::where('pelanggan_id', $this->id)->where('status', 'sukses')->get();
        $jatuh = TagihanModel::where('pelanggan_id', $this->id)->whereIn('status', ['proses', 'belum'])->get();
        $data = ['menu' => "Dashboard",
                'jatuh' => $jatuh,
                'tagihan' => $tagihan
        ];
        return view('pelanggan/dashboard', $data);
    }
}
