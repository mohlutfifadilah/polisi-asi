<?php

namespace App\Http\Controllers;

use App\DataTables\CarouselDataTable;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CarouselDataTable $dataTable)
    {
        //
        if (!Auth::check()) {
            return redirect()->back();
        }
        $pageConfigs = ['myLayout' => 'vertical'];
        $carousel = Carousel::all();
        // return view('admin.carousel.index', [
        //   'pageConfigs' => $pageConfigs,
        //   'carousel' => $carousel,
        // ]);
        return $dataTable->render('admin.carousel.index', compact('carousel'));
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
            $image = $request->file('image')->store('carousel');
            $file->move('storage/carousel/', $image);
            $image = str_replace('carousel/', '', $image);
            // $bukti = $request->file('bukti')->getClientOriginalName();
        }
        Carousel::create([
            'url' => $image,
        ]);

        Alert::success('Berhasil', 'Foto berhasil di upload');
        return redirect()->route('carousel.index');
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
        $carousel = Carousel::find($id);
        return view('admin.carousel.carousel_edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $carousel = Carousel::find($id);
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
          $image = $request->file('image')->store('carousel');
          $file->move('storage/carousel/', $image);
          $image = str_replace('carousel/', '', $image);
          if($carousel->url){
            unlink(storage_path('app/carousel/' . $carousel->url));
            unlink(public_path('storage/carousel/' . $carousel->url));
          }
          // $bukti = $request->file('bukti')->getClientOriginalName();
        } else {
            $image = $carousel->url;
        }

        $carousel->url = $image;
        $carousel->save();

        Alert::success('Berhasil', 'Foto berhasil di diganti');
        return redirect()->route('carousel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $carousel = Carousel::find($id);
        if($carousel->url){
            unlink(storage_path('app/carousel/' . $carousel->url));
            unlink(public_path('storage/carousel/' . $carousel->url));
          }
        $carousel->delete();

        Alert::success('Berhasil', 'Foto berhasil dihapus');
        return redirect()->route('carousel.index');
    }
}
