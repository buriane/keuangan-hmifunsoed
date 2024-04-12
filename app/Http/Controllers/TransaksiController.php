<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Filter
        if (request('dana') != null & request('bulan') != null) {
            $transaksi = Transaksi::where('dana_id', request('dana'))->whereMonth('tanggal', request('bulan'))->orderBy('tanggal', 'desc')->get();
        } elseif (request('dana') == null & request('bulan') != null) {
            $transaksi = Transaksi::whereMonth('tanggal', request('bulan'))->orderBy('tanggal', 'desc')->get();
        } elseif (request('dana') != null & request('bulan') == null) {
            $transaksi = Transaksi::where('dana_id', request('dana'))->orderBy('tanggal', 'desc')->get();
        } else {
            $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();
        }

        // Form filter
        $dana = Dana::all();
        $bulan = Transaksi::select(DB::raw("MONTH(tanggal) as bulan"))->groupBy('bulan')->get();

        return view('transaksi.index', [
            'title' => 'Riwayat Transaksi',
            'active' => 'transaksi',
            'dana' => $dana,
            'bulan' => $bulan,
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dana = Dana::all();

        return view('transaksi.create', [
            'title' => 'Tambah Transaksi',
            'active' => 'transaksi',
            'dana' => $dana
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Transaksi::create($input);

        return back()->with('sukses', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Filter
        if (request('dana') != null & request('bulan') != null) {
            $transaksi = Transaksi::where('dana_id', request('dana'))->whereMonth('tanggal', request('bulan'))->orderBy('tanggal', 'desc')->get();
        } elseif (request('dana') == null & request('bulan') != null) {
            $transaksi = Transaksi::whereMonth('tanggal', request('bulan'))->orderBy('tanggal', 'desc')->get();
        } elseif (request('dana') != null & request('bulan') == null) {
            $transaksi = Transaksi::where('dana_id', request('dana'))->orderBy('tanggal', 'desc')->get();
        } else {
            $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();
        }

        // Form filter
        $dana = Dana::all();
        $bulan = Transaksi::select(DB::raw("MONTH(tanggal) as bulan"))->groupBy('bulan')->get();

        return view('transaksi.manage', [
            'title' => 'Edit Riwayat Transaksi',
            'active' => 'transaksi',
            'dana' => $dana,
            'bulan' => $bulan,
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $dana = Dana::all();

        return view('transaksi.edit', [
            'title' => 'Perbarui Riwayat Transaksi',
            'active' => 'transaksi',
            'transaksi' => $transaksi,
            'dana' => $dana
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $input = $request->except('_token', '_method');

        Transaksi::where('id', $transaksi->id)->update($input);

        return back()->with('sukses', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        Transaksi::destroy($transaksi->id);
        return back()->with('sukses', 'Data berhasil dihapus.');
    }
}
