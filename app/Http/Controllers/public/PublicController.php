<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Models\Carousel;
use App\Models\Pelayanan;
use App\Models\Subkategori;

class PublicController extends Controller
{
    //
    public function index(){
      $pageConfigs = ['myLayout' => 'horizontal'];
      $aduan = Aduan::select('id', 'id_subkategori', 'aduan', 'response', 'created_at')->where('id_status', 1)->where('id_aduan', null)->where('is_publish', 1)->limit(6)->orderBy('created_at', 'ASC')->get();
      $sub = Subkategori::all();
      $carousel = Carousel::all();
      $pelayanan = Pelayanan::all();
      return view('public.landing', [
        'pageConfigs' => $pageConfigs,
        'aduan' => $aduan,
        'sub' => $sub,
        'carousel' => $carousel,
        'pelayanan' => $pelayanan
      ]);
    }
}
