<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_pemasukans = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'm')->sum('nominal_transaksi');
        $total_pengeluarans = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'k')->sum('nominal_transaksi');
        $saldo = $total_pemasukans - $total_pengeluarans;      

        return Inertia::render('Dashboard', [
            'total_pemasukan' => $total_pemasukans,
            'total_pengeluaran' => $total_pengeluarans,
            'saldo' => $saldo,
            ]);
    }
}
