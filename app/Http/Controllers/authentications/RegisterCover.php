<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterCover extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('auth.register', ['pageConfigs' => $pageConfigs]);
    }

    public function actionRegister(Request $request)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required', // Input login yang dapat berisi email atau nomor handphone
                'email' => 'required',
                'no_wa' => 'required',
                'password' => 'required',
                'address' => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'No Handphone.required' => 'No Handphone tidak boleh kosong',
                'address.required' => 'Alamat tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
          }

          if (User::where('email', $request->email)->exists()) {
          Alert::error('Kesalahan', 'Email sudah ada');
            return redirect()
                ->back()
                ->withInput()
                ->with('email', 'Email sudah ada');
        }

        // Cek apakah nomor WhatsApp sudah ada di tabel users
        if (User::where('no_wa', $request->no_wa)->exists()) {
            Alert::error('Kesalahan', 'No Whatsapp sudah ada');
            return redirect()
                ->back()
                ->withInput()
                ->with('no_wa', 'No Whatsapp sudah ada');
        }

        // Validasi apakah input email valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Alert::error('Kesalahan', 'Format Email tidak valid');
            return redirect()
                ->back()
                ->withInput()
                ->with('email', 'Format Email tidak valid');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'id_role' => 5,
        ]);

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $user = Auth::getProvider()->retrieveByCredentials($data);

        Auth::login($user, $request->get('remember'));
        return redirect('/');
    }
}
