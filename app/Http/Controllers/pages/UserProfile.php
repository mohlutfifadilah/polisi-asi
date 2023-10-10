<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Controller
{
  public function index()
  {
    $user = User::find(Auth::user()->id);
    if ($user->id_role === 5){
      return view('public.profile', compact('user'));
    } else {
      return view('admin.profile', compact('user'));
    }
  }
}
