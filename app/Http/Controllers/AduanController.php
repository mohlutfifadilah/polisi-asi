<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Subkategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (!Auth::check()) {
      return redirect()->back();
    }
    $pageConfigs = ['myLayout' => 'horizontal'];
    $subkategori = Subkategori::all();
    return view('public.pengaduan.aduan', [
      'pageConfigs' => $pageConfigs,
      'subkategori' => $subkategori,
    ]);
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
      'id_subkategori' => $request->id_kategori,
      'id_status' => false,
      'aduan' => $request->aduan,
    ]);

    // Alert::success('Berhasil', 'Data Desa berhasil ditambah');
    return redirect('/');
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
