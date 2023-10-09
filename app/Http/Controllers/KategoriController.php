<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\SubkategoriDataTable;
use App\Models\Subkategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubkategoriDataTable $dataTable)
    {
        //
        if (!Auth::check()) {
            return redirect()->back();
        }
        $pageConfigs = ['myLayout' => 'vertical'];
        $kategori = Kategori::all();
        $subkategori = Subkategori::all();
        return $dataTable->render('admin.kategori.index', compact('kategori', 'subkategori'));
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
        // Cek apakah embed HTML sudah ada di tabel desa
        if (Subkategori::where('name', $request->name)->exists()) {
            Alert::error('Kesalahan', 'Nama Kategori sudah digunakan');
            return redirect()
                ->back()
                ->withInput()
                ->with('name', 'Nama Kategori sudah digunakan');
        }
        $validator = Validator::make(
            $request->all(),
            [
                'bidang' => 'required',
                'name' => 'required',
            ],
            [
                'bidang.required' => 'Bidang tidak boleh kosong',
                'name.required' => 'Nama Kategori tidak boleh kosong',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        Subkategori::create([
            'id_kategori' => $request->bidang,
            'name' => Str::upper($request->name),
        ]);

        Alert::success('Berhasil', 'Data Kategori berhasil ditambah');
        return redirect()->route('kategori.index');
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
        $subkategori = Subkategori::find($id);
        $kategori = Kategori::all();
        return view('admin.kategori.kategori_edit', compact('subkategori', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $subkategori = Subkategori::find($id);
        $kategori = Kategori::find($subkategori->id_kategori);
        if ($request->bidang){
          $id_kategori = $request->bidang;
        } else {
          $id_kategori = $kategori->id;
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Nama Kategori tidak boleh kosong',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Lakukan validasi hanya jika ada perubahan email atau no_wa
        if ($request->name !== $subkategori->name) {
            $existingName = DB::table('subkategori')
                ->where('name', '!=', $subkategori->name)
                ->pluck('name');

            if (in_array($request->name, $existingName->toArray())) {
                // Tampilkan pesan error jika email sudah ada dalam database
                Alert::error('Kesalahan', 'Nama Kategori sudah ada');
                return redirect()->back()->withInput()->with('name', 'Nama Kategori sudah ada');
            }
        }

        $subkategori->update([
            'id_kategori' => $id_kategori,
            'name' => $request->name,
        ]);

        Alert::success('Berhasil', 'Data Kategori berhasil diubah');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subkategori = Subkategori::find($id);
        $subkategori->delete();

        Alert::success('Berhasil', 'Data Kategori berhasil dihapus');
        return redirect()->route('kategori.index');
    }
}
