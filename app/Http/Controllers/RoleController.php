<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $dataTable)
    {
        //
        if (!Auth::check()) {
      return redirect()->back();
    }
        $pageConfigs = ['myLayout' => 'vertical'];
        $role = Role::all();
        // return view('admin.aduan.index', [
        //   'pageConfigs' => $pageConfigs,
        //   'aduan' => $aduan,
        // ]);
        return $dataTable->render('admin.role.index', compact('role'));
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
        if (Role::where('name', $request->name)->exists()) {
            Alert::error('Kesalahan', 'Nama Role sudah digunakan');
            return redirect()
                ->back()
                ->withInput()
                ->with('name', 'Nama Role sudah digunakan');
        }
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Nama Role tidak boleh kosong',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        Role::create([
            'name' => $request->name,
        ]);

        Alert::success('Berhasil', 'Data Role berhasil ditambah');
        return redirect()->route('role.index');
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
        $role = Role::find($id);
        return view('admin.role.role_edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $role = Role::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Nama Role tidak boleh kosong',
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
        if ($request->name !== $role->name) {
            $existingName = DB::table('role')
                ->where('name', '!=', $role->name)
                ->pluck('name');

            if (in_array($request->name, $existingName->toArray())) {
                // Tampilkan pesan error jika email sudah ada dalam database
                Alert::error('Kesalahan', 'Nama Role sudah ada');
                return redirect()->back()->withInput()->with('name', 'Nama Role sudah ada');
            }
        }

        $role->update([
            'name' => $request->name,
        ]);

        Alert::success('Berhasil', 'Data Role berhasil diubah');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $role = Role::find($id);
        $role->delete();

        Alert::success('Berhasil', 'Data Role berhasil dihapus');
        return redirect()->route('role.index');
    }
}
