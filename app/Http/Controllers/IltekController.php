<?php

namespace App\Http\Controllers;

use App\Models\Iltek;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IltekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('bln') == '') {
            $lap = Iltek::orderBy('bulan', 'asc')->get();
            $judul = '';
        } else {
            $lap = Iltek::where('bulan', request('bln'))->get();
            $judul = '- ' . Iltek::bulan(request('bln'));
        }

        $bl = Iltek::select('bulan')->groupByRaw('bulan')->get();
        $pj = Pengurus::where('divisi', 'ILTEK')->get();

        return view('iltek.index', [
            'title' => 'Laporan Keuangan Iltek',
            'active' => 'laporan-iltek',
            'bln' => $bl,
            'judul' => $judul,
            'laporan' => $lap,
            'pj' => $pj
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kat)
    {
        if ($kat == 1) {
            return view('iltek.create-1', [
                'title' => 'Tambah Data Pemasukan',
                'active' => 'laporan-iltek'
            ]);
        }
        if ($kat == 2) {
            return view('iltek.create-2', [
                'title' => 'Tambah Data Pengeluaran Iltek',
                'active' => 'laporan-iltek'
            ]);
        }
        if ($kat == 3) {
            return view('iltek.create-3', [
                'title' => 'Tambah Data Pengeluaran diluar Iltek',
                'active' => 'laporan-iltek'
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

        Iltek::create($input);

        return back()->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Iltek  $iltek
     * @return \Illuminate\Http\Response
     */
    public function show(Iltek $iltek)
    {
        if (request('bln') == '') {
            $lap = Iltek::orderBy('bulan', 'asc')->get();
            $judul = '';
        } else {
            $lap = Iltek::where('bulan', request('bln'))->get();
            $judul = '- ' . Iltek::bulan(request('bln'));
        }

        $bl = Iltek::select('bulan')->groupByRaw('bulan')->get();

        return view('iltek.manage', [
            'title' => 'Edit Laporan Keuangan Iltek',
            'active' => 'laporan-iltek',
            'bln' => $bl,
            'judul' => $judul,
            'laporan' => $lap,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Iltek  $iltek
     * @return \Illuminate\Http\Response
     */
    public function edit(Iltek $laporan_ilte)
    {
        if ($laporan_ilte->kategori == 'Pemasukan') {
            return view('iltek.edit-1', [
                'title' => 'Perbarui Data Pemasukan',
                'active' => 'laporan-iltek',
                'data' => $laporan_ilte
            ]);
        }
        if ($laporan_ilte->kategori == 'Pengeluaran Iltek') {
            return view('iltek.edit-2', [
                'title' => 'Perbarui Data Pengeluaran Iltek',
                'active' => 'laporan-iltek',
                'data' => $laporan_ilte
            ]);
        }
        if ($laporan_ilte->kategori == 'Pengeluaran diluar Iltek') {
            return view('iltek.edit-3', [
                'title' => 'Perbarui Data Pengeluaran diluar Iltek',
                'active' => 'laporan-iltek',
                'data' => $laporan_ilte
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Iltek  $iltek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Iltek $laporan_ilte)
    {
        $input = $request->except(['_token', '_method']);

        Iltek::where('id', $laporan_ilte->id)->update($input);

        return back()->with('sukses', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Iltek  $iltek 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Iltek $laporan_ilte)
    {
        Iltek::destroy($laporan_ilte->id);

        return back()->with('sukses', 'Data berhasil dihapus.');
    }
}
