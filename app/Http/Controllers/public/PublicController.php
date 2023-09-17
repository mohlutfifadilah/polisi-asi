<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function index(){
      $pageConfigs = ['myLayout' => 'horizontal'];
      return view('public.landing', ['pageConfigs' => $pageConfigs]);
    }
}
