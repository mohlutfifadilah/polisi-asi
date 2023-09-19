<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
  {
    $pageConfigs = ['myLayout' => 'horizontal'];
    return view('public.pengaduan.aduan', ['pageConfigs' => $pageConfigs]);
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //
    // $validator = Validator::make($request->all(), [
    //   'aduan' => 'required',
    // ], [
    //   'aduan.required' => 'Aduan tidak boleh kosong',
    // ]);

    // if ($validator->fails()) {
    //   Alert::error('Kesalahan', $validator->errors()->first());
    //   return redirect()->back()->withErrors($validator)->withInput();
    // }

    Aduan::create([
      'id_user' => $request->id_user,
      'id_status' => $request->id_status,
      'aduan' => $request->aduan
    ]);

    // Alert::success('Berhasil', 'Data Desa berhasil ditambah');
    return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
