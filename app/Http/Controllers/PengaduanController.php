<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Subkategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
          Alert::warning('Peringatan', 'Login terlebih dahulu');
            return redirect()->back();
        }
        $pageConfigs = ['myLayout' => 'horizontal'];
        $subkategori = Subkategori::all();
        return view('public.pengaduan.aduan', [
            'pageConfigs' => $pageConfigs,
            'subkategori' => $subkategori,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make(
          $request->all(),
          [
            'id_kategori' => 'required',
            'aduan' => 'required',
            'bukti' => 'max:2048',
          ],
          [
            'id_kategori.required' => 'Kategori tidak boleh kosong',
            'aduan.required' => 'Aduan tidak boleh kosong',
            'bukti.max' => 'File jangan lebih dari 2 mb'
          ],
        );

        if ($validator->fails()) {
          Alert::error('Kesalahan', $validator->errors()->first());
          return redirect()
          ->back()
          ->withErrors($validator)
          ->withInput();
        }

        $user = User::find(Auth::user()->id);

        if ($request->file('bukti')) {
            $file = $request->file('bukti');
            $bukti = $request->file('bukti')->store('aduan');
            $file->move('storage/aduan/', $bukti);
            $bukti = str_replace('aduan/', '', $bukti);
            // $bukti = $request->file('bukti')->getClientOriginalName();
        }
        Aduan::create([
            'id_user' => $request->id_user,
            'id_role' => 2, // pa kadin disposisi
            'id_subkategori' => $request->id_kategori,
            'id_status' => false,
            'bukti' => $bukti,
            'aduan' => $request->aduan,
        ]);

        Mail::send('emails.submitAduan', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Aduan telah di submit');
        });

        Alert::success('Berhasil', 'Aduan berhasil dilaporkan, Tunggu respon dari Dinas');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
