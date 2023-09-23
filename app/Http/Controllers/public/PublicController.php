<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function index(){
      $pageConfigs = ['myLayout' => 'horizontal'];
      $aduan = Aduan::select('id_subkategori', 'aduan', 'created_at')->get();
      return view('public.landing', [
        'pageConfigs' => $pageConfigs,
        'aduan' => $aduan
      ]);
    }
}
