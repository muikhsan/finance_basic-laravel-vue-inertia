<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LaporanController extends Controller
{
    public function index()
    {

        $all_transaksi = User::find(Auth::id())->transaksis()->orderBy('tanggal_transaksi', 'DESC');
        $transaksis = $all_transaksi->paginate(10);
        $total_masuk = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'm')->sum('nominal_transaksi');
        $total_keluar = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'k')->sum('nominal_transaksi');
        $saldo = $total_masuk - $total_keluar;

        return Inertia::render('Laporan/Index', [
            'transaksis' => $transaksis,
            'total_masuk' => $total_masuk,
            'total_keluar' => $total_keluar,
            'saldo' => $saldo,
            ]);
    }

    public function generatepdf()
    {
        $all_transaksi = User::find(Auth::id())->transaksis()->orderBy('tanggal_transaksi', 'DESC')->paginate();
        $total_masuk = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'm')->sum('nominal_transaksi');
        $total_keluar = User::find(Auth::id())->transaksis()->where('jenis_transaksi', 'k')->sum('nominal_transaksi');


        $pdf = PDF::loadView('transaksi_pdf', [
            'transaksi' => $all_transaksi,
            'total_masuk' => $total_masuk,
            'total_keluar' => $total_keluar,
        ]);
 

        return $pdf->download('transaksi.pdf');
    }
}
