<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiPostRequest;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_pemasukans = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'm')->orderBy('tanggal_transaksi','DESC');
        $pemasukans = $all_pemasukans->paginate(10);
        $total_masuk = $all_pemasukans->sum('nominal_transaksi');
        return Inertia::render('Pemasukan/Index', [
            'pemasukans' => $pemasukans,
            'total_masuk' => $total_masuk,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function create()
    {
        return Inertia::render('Pemasukan/Create', [
            'user' => [
                'id' => Auth::id(),
            ],
            'jenis_transaksi' => 'm'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiPostRequest $request)
    {
        sleep(2);
        Transaksi::create($request->validated());

        return Redirect::route('pemasukans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $pemasukan)
    {
         return Inertia::render('Pemasukan/Edit', [
            'user' => [
                'id' => Auth::id(),
            ],
            'pemasukan' => [
                'id' => $pemasukan->id,
                'nominal_transaksi' => $pemasukan->nominal_transaksi,
                'tanggal_transaksi' => $pemasukan->tanggal_transaksi,
                'deskripsi' => $pemasukan->deskripsi,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemasukan  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $pemasukan)
    {
        $data = Request::validate([
                    'user_id' => ['required'],
                    'nominal_transaksi' => ['required', 'numeric', 'gt:0'],
                    'tanggal_transaksi' => ['required'],
                    'deskripsi' => ['required', 'max:360'],
                ]);
        $pemasukan->update($data);
        

        return Redirect::route('pemasukans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasukan  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $pemasukan)
    {
        $pemasukan->delete();
        
        return Redirect::route('pemasukans.index');
    }
}