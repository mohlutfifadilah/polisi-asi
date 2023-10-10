<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $user = User::find(Auth::user()->id);
        $aduan = Aduan::where('id_user', Auth::user()->id)
            ->where('id_status', 1)
            ->where('id_aduan', null)
            ->get();
        return view('public.profile', [
            'pageConfigs' => $pageConfigs,
            'user' => $user,
            'aduan' => $aduan,
        ]);
    }

    public function edit()
    {
        $user = User::find(Auth::user()->id);
        $pageConfigs = ['myLayout' => 'horizontal'];
        return view('public.profile_edit', compact('user', 'pageConfigs'));
    }

    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'no_wa' => 'required',
                'profile_photo_path' => 'max:2048',
                'address' => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'no_wa.required' => 'No Handphone tidak boleh kosong',
                'profile_photo_path.required' => 'File jangan lebih dari 2 mb',
                'address.required' => 'Alamat tidak boleh kosong',
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
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('email', 'Email sudah ada');
            }

            if (in_array($request->no_wa, $existingNoWa->toArray())) {
                // Tampilkan pesan error jika no_wa sudah ada dalam database
                Alert::error('Kesalahan', 'No Whatsapp sudah ada');
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('no_wa', 'No Whatsapp sudah ada');
            }
        }

        // Validasi apakah input email valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Alert::error('Kesalahan', 'Format Email tidak valid');
            return redirect()
                ->back()
                ->withInput()
                ->with('email', 'Format Email tidak valid');
        }

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $profile_photo_path = $request->file('profile_photo_path')->store('profile');
            $file->move('storage/profile/', $profile_photo_path);
            $profile_photo_path = str_replace('profile/', '', $profile_photo_path);
            // $bukti = $request->file('bukti')->getClientOriginalName();
        }

        $user->update([
            'profile_photo_path' => $profile_photo_path,
            'name' => $request->name,
            'email' => $request->email,
            'job_or_position' => $request->job_or_position,
            'no_wa' => $request->no_wa,
            'age' => $request->age,
            'address' => $request->address,
        ]);

        Alert::success('Berhasil', 'Profile berhasil diperbarui');
        return redirect('/profile');
    }

    public function changePassword()
    {
        $user = User::find(Auth::user()->id);
        $pageConfigs = ['myLayout' => 'horizontal'];
        return view('public.change_password', compact('user', 'pageConfigs'));
    }

    public function updatePassword(Request $request, $id)
    {
      
        $user = User::find($id);

        # Match The Old Password
        if (!Hash::check($request->password_lama, $user->password)) {
            Alert::error('Kesalahan', 'Password lama tidak cocok');
            return back();
        }

        $validator = Validator::make(
            $request->all(),
            [
                'password_lama' => 'required',
                'password' => 'required|confirmed',
            ],
            [
                'password_lama.required' => 'Password Lama tidak boleh kosong',
                'password.required' => 'Password Baru tidak boleh kosong',
                'password.confirmed' => 'Password Baru tidak sama',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Alert::success('Berhasil', 'Password berhasil diperbarui');
        return redirect('/profile');
    }
}
