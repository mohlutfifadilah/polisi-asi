<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index(){
      $pageConfigs = ['myLayout' => 'horizontal'];
      $user = User::find(Auth::user()->id);
      $aduan = Aduan::where('id_user', Auth::user()->id)->where('id_status', 1)->get();
      return view('public.profile', [
        'pageConfigs' => $pageConfigs,
        'user' => $user,
        'aduan' => $aduan
      ]);
    }
}
