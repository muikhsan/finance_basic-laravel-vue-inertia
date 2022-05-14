<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiPostRequest;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_pengeluarans = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'k')->orderBy('tanggal_transaksi','DESC');
        $pengeluarans = $all_pengeluarans->paginate(10);
        $total_keluar = $all_pengeluarans->sum('nominal_transaksi');
        return Inertia::render('Pengeluaran/Index', [
            'pengeluarans' => $pengeluarans,
            'total_keluar' => $total_keluar,
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
        return Inertia::render('Pengeluaran/Create', [
            'user' => [
                'id' => Auth::id(),
            ],
            'jenis_transaksi' => 'k'
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

        return Redirect::route('pengeluarans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Transaksi  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Transaksi  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $pengeluaran)
    {
        return Inertia::render('Pengeluaran/Edit', [
            'user' => [
                'id' => Auth::id(),
            ],
            'pengeluaran' => [
                'id' => $pengeluaran->id,
                'nominal_transaksi' => $pengeluaran->nominal_transaksi,
                'tanggal_transaksi' => $pengeluaran->tanggal_transaksi,
                'deskripsi' => $pengeluaran->deskripsi,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Transaksi  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $pengeluaran)
    {
        $data = Request::validate([
                'user_id' => ['required'],
                'nominal_transaksi' => ['required', 'numeric', 'gt:0'],
                'tanggal_transaksi' => ['required'],
                'deskripsi' => ['required', 'max:360'],
                ]);
        $pengeluaran->update($data);
        

        return Redirect::route('pengeluarans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Transaksi  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $pengeluaran)
    {
        $pengeluaran->delete();
        
        return Redirect::route('pengeluarans.index');
    }
}