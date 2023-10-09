<?php

namespace App\Http\Controllers;

use App\DataTables\PelayananDataTable;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PelayananDataTable $dataTable)
    {
        //
        if (!Auth::check()) {
            return redirect()->back();
        }
        $pageConfigs = ['myLayout' => 'vertical'];
        $pelayanan = Pelayanan::all();
        // return view('admin.carousel.index', [
        //   'pageConfigs' => $pageConfigs,
        //   'carousel' => $carousel,
        // ]);
        return $dataTable->render('admin.pelayanan.index', compact('pelayanan'));
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
                'image' => 'max:2048',
            ],
            [
                'image.max' => 'File jangan lebih dari 2 mb',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $image = $request->file('image')->store('pelayanan');
            $file->move('storage/pelayanan/', $image);
            $image = str_replace('pelayanan/', '', $image);
            // $bukti = $request->file('bukti')->getClientOriginalName();
        }
        Pelayanan::create([
            'image' => $image,
            'url' => $request->url,
        ]);

        Alert::success('Berhasil', 'Foto berhasil di upload');
        return redirect()->route('pelayanan.index');
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
        $pelayanan = Pelayanan::find($id);
        return view('admin.pelayanan.pelayanan_edit', compact('pelayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $pelayanan = Pelayanan::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'max:2048',
            ],
            [
                'image.max' => 'File jangan lebih dari 2 mb',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->file('image')) {
          $file = $request->file('image');
          $image = $request->file('image')->store('pelayanan');
          $file->move('storage/pelayanan/', $image);
          $image = str_replace('pelayanan/', '', $image);
          if($pelayanan->image){
            unlink(storage_path('app/pelayanan/' . $pelayanan->image));
            unlink(public_path('storage/pelayanan/' . $pelayanan->image));
          }
          // $bukti = $request->file('bukti')->getClientOriginalName();
        } else {
            $image = $pelayanan->image;
        }

        $pelayanan->image = $image;
        $pelayanan->url = $request->url;
        $pelayanan->save();

        Alert::success('Berhasil', 'Foto berhasil di diganti');
        return redirect()->route('pelayanan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pelayanan = Pelayanan::find($id);
        if($pelayanan->image){
            unlink(storage_path('app/pelayanan/' . $pelayanan->image));
            unlink(public_path('storage/pelayanan/' . $pelayanan->image));
          }
        $pelayanan->delete();

        Alert::success('Berhasil', 'Foto berhasil dihapus');
        return redirect()->route('pelayanan.index');
    }
}
