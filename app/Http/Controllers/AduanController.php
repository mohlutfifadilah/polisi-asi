<?php

namespace App\Http\Controllers;

use App\DataTables\AduanDataTable;
use App\Models\Aduan;
use App\Models\Subkategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AduanDataTable $dataTable)
    {
        if (!Auth::check()) {
            return redirect()->back();
        }
        // $pageConfigs = ['myLayout' => 'vertical'];
        if (Auth::user()->id_role === 1) {
            $aduan = Aduan::all();
        } elseif (Auth::user()->id_role === 2) {
            $aduan = Aduan::where('id_role', 2)
                ->where('id_status', 0)
                ->get();
        } elseif (Auth::user()->id_role === 3) {
            $aduan = Aduan::where('id_role', 3)
                ->where('id_status', 0)
                ->get();
        } elseif (Auth::user()->id_role === 4) {
            $aduan = Aduan::where('id_role', 4)
                ->where('id_status', 0)
                ->get();
        }
        $aduan = Aduan::all();
        // dd($aduan);
        return $dataTable->render('admin.aduan.index', ['aduan' => $aduan]);
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
        if ($request->has('id_status')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'aduan' => 'required',
                ],
                [
                    'aduan.required' => 'Aduan tidak boleh kosong',
                ],
            );

            if ($validator->fails()) {
                Alert::error('Kesalahan', $validator->errors()->first());
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Aduan::create([
                'id_aduan' => $request->id_aduan,
                'id_user' => $request->id_user,
                'id_subkategori' => $request->id_subkategori,
                'id_status' => $request->id_status,
                'id_role' => $request->id_role,
                'bukti' => $request->bukti,
                'aduan' => $request->aduan,
            ]);

            Alert::success('Berhasil', 'Jawaban telah dikirim');
            return redirect('/');
        }
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
        $selectedAduan = Aduan::find($id);
        $aduan = Aduan::where('id', $selectedAduan->id_aduan)
            ->orWhere('id', $id)
            ->orWhere('bukti', $selectedAduan->bukti)
            ->orderBy('created_at', 'ASC')
            ->get();

        $user = User::find($selectedAduan->id_user);
        return view('admin.aduan.aduan_response_answer', compact('aduan', 'user', 'selectedAduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'response' => 'required',
            ],
            [
                'response.required' => 'Respon tidak boleh kosong',
            ],
        );

        if ($validator->fails()) {
            Alert::error('Kesalahan', $validator->errors()->first());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $aduan = Aduan::find($id);
        $user = User::find($aduan->id_user);
        $aduan->update([
            'id_status' => 1,
            'response' => $request->response,
            // 'is_publish' => false
        ]);

        //Create Password Reset Token
        DB::table('response_aduan_token')->insert([
            'email' => $user->email,
            'token' => Str::random(60),
        ]);
        //Get the token just created above
        $tokenData = DB::table('response_aduan_token')
            ->where('email', $user->email)
            ->first();

        Mail::send('emails.responAduan', ['token' => $tokenData->token, 'user' => $user, 'aduan' => $aduan->id], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Aduan telah direspon');
        });

        Alert::success('Berhasil', 'Aduan berhasil direspon');
        return redirect()->route('aduan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
