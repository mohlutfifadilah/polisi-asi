<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        //
        $role = Role::all();
        return $dataTable->render('admin.users.index', compact('role'));
        // return view('admin.users.index');
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
        // // Cek apakah link website sudah ada di tabel desa
        // if (Desa::where('link_website', $request->link)->exists()) {
        //     Alert::error('Kesalahan', 'Link Website sudah digunakan');
        //     return redirect()->back()->withInput()->with('link', 'Link Website sudah digunakan');
        // }

        // // Cek apakah embed HTML sudah ada di tabel desa
        // if (Desa::where('embed_html', $request->embed)->exists()) {
        //     Alert::error('Kesalahan', 'Embed HTML sudah digunakan');
        //     return redirect()->back()->withInput()->with('embed', 'Embed HTML sudah digunakan');
        // }
        // $validator = Validator::make($request->all(), [
        //     'deskripsi' => 'required',
        //     'rt' => 'required',
        //     'rw' => 'required',
        //     'link' => 'required',
        //     'embed' => 'required',
        //     'clickedId' => 'required',
        // ], [
        //     'deskripsi.required' => 'Deskripsi tidak boleh kosong',
        //     'rt.required' => 'Jumlah RT tidak boleh kosong',
        //     'rw.required' => 'Jumlah RW tidak boleh kosong',
        //     'link.required' => 'Link Website tidak boleh kosong',
        //     'embed.required' => 'Embed HTML tidak boleh kosong',
        //     'clickedId.required' => 'Titik lokasi harus diisi',
        // ]);

        // if ($validator->fails()) {
        //     Alert::error('Kesalahan', $validator->errors()->first());
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        User::create([
            'id_role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'job_or_position' => $request->job_or_position,
            'age' => $request->age,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // Alert::success('Berhasil', 'Data Desa berhasil ditambah');
        return redirect()->route('users.index');
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
        $user = User::find($id);
        $role = Role::all();
        return view('admin.users.user_edit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $role = Role::find($user->id_role);
        if ($request->role){
          $id_role = $request->role;
        } else {
          $id_role = $role->id;
        }

        $user->update([
            'id_role' => $id_role,
            'name' => $request->name,
            'email' => $request->email,
            'job_or_position' => $request->job_or_position,
            'age' => $request->age,
            'address' => $request->address,
        ]);

        // Alert::success('Berhasil', 'Data Pengguna berhasil diubah');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);

        // validasi user tidak bisa menghapus usernya sendiri
        // if ($user->id == Auth::user()->id) {
        //     Alert::error('Kesalahan', 'Tidak bisa menghapus pengguna sendiri');
        //     // return redirect()->back()->withInput()->with('user', 'Tidak bisa menghapus pengguna sendiri');
        // }

        $user->delete();

        // Alert::success('Berhasil', 'Data Pengguna berhasil dihapus');
        return redirect()->route('users.index');
    }
}
