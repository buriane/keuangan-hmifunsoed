<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Kas;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurus = Pengurus::orderBy('divisi')->orderBy('id')->get();

        return view('pengurus.index', [
            'title' => 'Pengurus HMIF',
            'active' => 'pengurus',
            'pengurus' => $pengurus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $input = [
            'divisi' => $request->divisi,
            'nama' => ''
        ];

        for ($i = 1; $i <= 20; $i++) {
            if (isset($request["nama-${i}"])) {
                $input['nama'] = $request["nama-${i}"];
                $tambah = Pengurus::create($input);

                $input2 = ['pengurus_id' => $tambah->id];
                Kas::create($input2);
                Deposit::create($input2);
            }
        }

        return back()->with('sukses', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function show(Pengurus $pengurus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengurus $pengurus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengurus $pengurus)
    {
        $update = $request->except(['_token', '_method', 'id']);

        $pengurus = Pengurus::where('id', $request->id)->first();
        $pengurus->update($update);

        return back()->with('sukses', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengurus $pengurus, Request $request)
    {
        Kas::destroy($request->id);
        Deposit::destroy($request->id);
        Pengurus::destroy($request->id);

        return back()->with('sukses', 'Data berhasil dihapus.');
    }
}
