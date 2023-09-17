<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordCover extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('auth.forgot-password', ['pageConfigs' => $pageConfigs]);
  }

  public function actionLupaPassword(Request $request){
    // Cek apakah Email ada di tabel users
    // if (!User::where('email', $request->email)->first()) {
    //   Alert::error('Kesalahan', 'Email tidak terdaftar');
    //   return redirect()->back()->withInput()->with('email', 'Email tidak terdaftar');
    // }

    //Create Password Reset Token
    DB::table('password_reset_tokens')->insert([
      'email' => $request->email,
      'token' => Str::random(60)
    ]);
    //Get the token just created above
    $tokenData = DB::table('password_reset_tokens')->where('email', $request->email)->first();

    Mail::send('emails.lupaPassword', ['token' => $tokenData->token], function ($message) use ($request) {
      $message->to($request->email);
      $message->subject('Reset Password');
    });

    // Alert::success('Berhasil', 'Link reset password sudah terkirim, cek email anda');
    return redirect()->route('login');
  }
  public function submitResetPassword(Request $request)
  {
    // $validator = Validator::make($request->all(), [
    //   'password' => 'required|min:8|confirmed',
    //   'password_confirmation' => 'required'
    // ], [
    //   'password.required' => 'Password tidak boleh kosong',
    //   'password.min' => 'Password minimal 8 karakter',
    //   'password.confirmed' => 'Password tidak sama',
    //   'password_confirmation.required' => 'Password tidak boleh kosong',
    // ]);

    // if ($validator->fails()) {
    //   Alert::error('Kesalahan', $validator->errors()->first());
    //   return redirect()->back()->withErrors($validator)->withInput();
    // }

    $email = DB::table('password_reset_tokens')->where('token', $request->token)->first();
    $email = $email->email;
    $updatePassword = DB::table('password_reset_tokens')->where('email', $email)->where('token', $request->token)->first();
    // if (!$updatePassword) {
    //   Alert::error('Kesalahan', 'Token salah');
    //   return redirect()->back();
    // }
    $user = User::where('email', $email)->first();
    $user->update([
      'password' => Hash::make($request->password)
    ]);

    DB::table('password_reset_tokens')->where(['email' => $email])->delete();

    // Alert::success('Berhasil', 'Password berhasil diubah');
    return redirect()->route('login');
  }
}
