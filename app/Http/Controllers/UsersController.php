<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
        // Cek apakah link website sudah ada di tabel desa
        if (User::where('email', $request->email)->exists()) {
            Alert::error('Kesalahan', 'Email sudah digunakan');
            return redirect()->back()->withInput()->with('email', 'Email sudah digunakan');
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        if (User::where('no_wa', $request->no_wa)->exists()) {
            Alert::error('Kesalahan', 'No Handphone sudah digunakan');
            return redirect()->back()->withInput()->with('no_wa', 'No Handphone sudah digunakan');
        }
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
            'no_wa' => 'required',
            'address' => 'required',
            'password' => 'required',
        ], [
            'role.required' => 'Role tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'no_wa.required' => 'No Handphone tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Validasi apakah input email valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Alert::error('Kesalahan', 'Format Email tidak valid');
            return redirect()->back()->withInput()->with('email', 'Format Email tidak valid');
        }
        User::create([
            'id_role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'job_or_position' => $request->job_or_position,
            'no_wa' => $request->no_wa,
            'age' => $request->age,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        Alert::success('Berhasil', 'Data Pengguna berhasil ditambah');
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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'no_wa' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'no_wa.required' => 'No Handphone tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lakukan validasi hanya jika ada perubahan email atau no_wa
        if ($request->email !== $user->email || $request->no_wa !== $user->no_wa) {
            $existingEmails = DB::table('users')
                ->where('email', '!=', $user->email)
                ->pluck('email');

            $existingNoWa = DB::table('users')
                ->where('no_wa', '!=', $user->no_wa)
                ->pluck('no_wa');

            if (in_array($request->email, $existingEmails->toArray())) {
                // Tampilkan pesan error jika email sudah ada dalam database
                Alert::error('Kesalahan', 'Email sudah ada');
                return redirect()->back()->withInput()->with('email', 'Email sudah ada');
            }

            if (in_array($request->no_wa, $existingNoWa->toArray())) {
                // Tampilkan pesan error jika no_wa sudah ada dalam database
                Alert::error('Kesalahan', 'No Whatsapp sudah ada');
                return redirect()->back()->withInput()->with('no_wa', 'No Whatsapp sudah ada');
            }
        }

        // Validasi apakah input email valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Alert::error('Kesalahan', 'Format Email tidak valid');
            return redirect()->back()->withInput()->with('email', 'Format Email tidak valid');
        }

        $user->update([
            'id_role' => $id_role,
            'name' => $request->name,
            'email' => $request->email,
            'job_or_position' => $request->job_or_position,
            'no_wa' => $request->no_wa,
            'age' => $request->age,
            'address' => $request->address,
        ]);

        Alert::success('Berhasil', 'Data Pengguna berhasil diubah');
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
        if ($user->id == Auth::user()->id) {
            Alert::error('Kesalahan', 'Tidak bisa menghapus pengguna sendiri');
            return redirect()->back()->withInput()->with('user', 'Tidak bisa menghapus pengguna sendiri');
        }

        $user->delete();

        Alert::success('Berhasil', 'Data Pengguna berhasil dihapus');
        return redirect()->route('users.index');
    }
}
