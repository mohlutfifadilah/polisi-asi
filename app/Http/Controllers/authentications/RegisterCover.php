<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterCover extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('auth.register', ['pageConfigs' => $pageConfigs]);
  }

  public function actionRegister(Request $request){
    //
    // Cek apakah nomor Email sudah ada di tabel users
    // if (User::where('email', $request->email)->exists()) {
    //   return redirect()->back()->withInput()->with('email', 'Email sudah ada');
    // }

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'id_role' => 5
    ]);
    $data = [
      'email' => $request->input('email'),
      'password' => $request->input('password'),
    ];

    $user = Auth::getProvider()->retrieveByCredentials($data);

    Auth::login($user, $request->get('remember'));
    return redirect('/')->with('alert', 'Selamat Datang');
  }
}
