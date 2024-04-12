<?php

namespace App\Http\Controllers;

use App\Models\Kreus;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KreusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('bln') == '') {
            $lap = Kreus::orderBy('bulan', 'asc')->get();
            $judul = '';
        } else {
            $lap = Kreus::where('bulan', request('bln'))->get();
            $judul = '- ' . Kreus::bulan(request('bln'));
        }

        $bl = Kreus::select('bulan')->groupByRaw('bulan')->get();
        $pj = Pengurus::where('divisi', 'KREUS')->get();

        return view('kreus.index', [
            'title' => 'Laporan Keuangan Kreus',
            'active' => 'laporan-kreus',
            'bln' => $bl,
            'judul' => $judul,
            'laporan' => $lap,
            'pj' => $pj
        ]);
    }

    public function create($kat)
    {
        if ($kat == 1) {
            return view('kreus.create-1', [
                'title' => 'Tambah Data Pemasukan',
                'active' => 'laporan-kreus'
            ]);
        }
        if ($kat == 2) {
            return view('kreus.create-2', [
                'title' => 'Tambah Data Pengeluaran Kreus',
                'active' => 'laporan-kreus'
            ]);
        }
        if ($kat == 3) {
            return view('kreus.create-3', [
                'title' => 'Tambah Data Pengeluaran diluar Kreus',
                'active' => 'laporan-kreus'
            ]);
        }
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

        Kreus::create($input);

        return back()->with('sukses', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kreus  $kreus
     * @return \Illuminate\Http\Response
     */
    public function show(Kreus $kreus)
    {
        if (request('bln') == '') {
            $lap = Kreus::orderBy('bulan', 'asc')->get();
            $judul = '';
        } else {
            $lap = Kreus::where('bulan', request('bln'))->get();
            $judul = '- ' . Kreus::bulan(request('bln'));
        }

        $bl = Kreus::select('bulan')->groupByRaw('bulan')->get();

        return view('kreus.manage', [
            'title' => 'Edit Laporan Keuangan Kreus',
            'active' => 'laporan-kreus',
            'bln' => $bl,
            'judul' => $judul,
            'laporan' => $lap
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kreus  $kreus
     * @return \Illuminate\Http\Response
     */
    public function edit(Kreus $laporan_kreu)
    {
        if ($laporan_kreu->kategori == 'Pemasukan') {
            return view('kreus.edit-1', [
                'title' => 'Perbarui Data Pemasukan',
                'active' => 'laporan-kreus',
                'data' => $laporan_kreu
            ]);
        }
        if ($laporan_kreu->kategori == 'Pengeluaran Kreus') {
            return view('kreus.edit-2', [
                'title' => 'Perbarui Data Pengeluaran Kreus',
                'active' => 'laporan-kreus',
                'data' => $laporan_kreu
            ]);
        }
        if ($laporan_kreu->kategori == 'Pengeluaran diluar Kreus') {
            return view('kreus.edit-3', [
                'title' => 'Perbarui Data Pengeluaran diluar Kreus',
                'active' => 'laporan-kreus',
                'data' => $laporan_kreu
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kreus  $kreus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kreus $laporan_kreu)
    {
        $input = $request->except(['_token', '_method']);

        Kreus::where('id', $laporan_kreu->id)->update($input);

        return back()->with('sukses', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kreus  $kreus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kreus $laporan_kreu)
    {
        Kreus::destroy($laporan_kreu->id);

        return back()->with('sukses', 'Data berhasil dihapus.');
    }
}
