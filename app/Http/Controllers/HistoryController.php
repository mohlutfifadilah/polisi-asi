<?php

namespace App\Http\Controllers;

use App\DataTables\HistoryDataTable;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HistoryDataTable $dataTable)
    {
        //
        if (!Auth::check()) {
            return redirect()->back();
        }
        $pageConfigs = ['myLayout' => 'vertical'];
        $aduan = Aduan::all();
        // $aduan = Aduan::all();
        // dd($aduan);
        return $dataTable->render('admin.history.index', ['aduan' => $aduan]);
        // return view('admin.aduan.index', [
        //   'pageConfigs' => $pageConfigs,
        //   'aduan' => $aduan,
        // ]);
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
