<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Dana;
use App\Models\Kreus;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Filter
        if (request('bulan') != null) {
            $transaksi = Transaksi::whereMonth('tanggal', request('bulan'))->get();
            $judul = '- ' . Kreus::bulan(request('bulan'));
        } else {
            $transaksi = Transaksi::all();
            $judul = '';
        }

        $dana = Dana::all();
        $bulan = Transaksi::select(DB::raw("MONTH(tanggal) as bulan"))->groupBy('bulan')->get();

        return view('saldo.index', [
            'title' => 'Rekapitulasi Saldo',
            'active' => 'saldo',
            'judul' => $judul,
            'bulan' => $bulan,
            'dana' => $dana,
            'total' => [
                'masuk' => $transaksi->where('keterangan', 'Pemasukan')->sum('nominal'),
                'keluar' => $transaksi->where('keterangan', 'Pengeluaran')->sum('nominal')
            ],
            'transaksi' => $transaksi
        ]);
    }
}
