<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function index(){
      $pageConfigs = ['myLayout' => 'horizontal'];
      $aduan = Aduan::select('id_subkategori', 'aduan', 'created_at')->where('id_status', 1)->limit(6)->orderBy('created_at', 'DESC')->get();
      $sub = Subkategori::all();
      return view('public.landing', [
        'pageConfigs' => $pageConfigs,
        'aduan' => $aduan,
        'sub' => $sub
      ]);
    }
}
