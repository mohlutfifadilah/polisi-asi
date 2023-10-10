<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
      $aduan = Aduan::where('id_aduan', null)->orderBy('created_at', 'ASC')->limit(3)->get();
      $pelayanan = Pelayanan::all();
      $monthlyData = Aduan::monthlyData()->get();
      return view('admin.dashboard', compact('aduan', 'pelayanan', 'monthlyData'));
    }
}
