<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use App\Models\UsermanagModel;

class UsermanagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $data   = ['menu' => 'usermanage',
        'pelanggan' => PelangganModel::where('is_active', '1')->where('level', 'admin')->orWhere('level', 'karyawan')->get(),
        ];
        print_r($data['pelanggan']);
        // return view('admin/usermanag', $data);
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
     * @param  \App\Models\UsermanagModel  $usermanagModel
     * @return \Illuminate\Http\Response
     */
    public function show(UsermanagModel $usermanagModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsermanagModel  $usermanagModel
     * @return \Illuminate\Http\Response
     */
    public function edit(UsermanagModel $usermanagModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsermanagModel  $usermanagModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsermanagModel $usermanagModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsermanagModel  $usermanagModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsermanagModel $usermanagModel)
    {
        //
    }
}
