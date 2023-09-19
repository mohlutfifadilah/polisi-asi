<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCover extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('auth.login', ['pageConfigs' => $pageConfigs]);
  }

  public function actionLogin(Request $request)
  {
    $data = [
      'email' => $request->input('email'),
      'password' => $request->input('password'),
    ];

    if (Auth::Attempt($data)) {
      $user = Auth::getProvider()->retrieveByCredentials($data);

      Auth::login($user, $request->get('remember'));
      return redirect('dashboard')->with('alert', 'Selamat Datang');
      // if (Auth::user()->id_role == 1 || Auth::user()->id_role == 5 || Auth::user()->id_role == 6 || Auth::user()->id_role == 7) {
      //   Alert::success('Berhasil', 'Selamat Datang');
      //   return redirect('dashboard');
      // } else {
      //   Alert::error('Kesalahan', 'Hanya admin yang bisa login');
      //   return redirect('/');
      // }
    } else {
      return redirect()->back()->with('alert', 'Email atau Password Salah');
    }
  }
  public function actionLogout(){
    Auth::logout();
    return redirect('/');
  }
}
