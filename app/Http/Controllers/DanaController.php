<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dana.index', [
            'title' => 'Sumber Dana',
            'active' => 'dana',
            'dana' => Dana::orderBy('nama', 'asc')->get()
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
        $input = $request->all();

        Dana::create($input);

        return redirect('/dana')->with('sukses', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function show(Dana $dana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function edit(Dana $dana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dana $dana)
    {
        $input = $request->except(['_token', '_method']);
        Dana::where('id', $dana->id)->update($input);
        return redirect('/dana')->with('sukses', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dana $dana)
    {
        $cek = Transaksi::where('dana_id', $dana->id)->first();
        if ($cek) {
            return redirect('/dana')->with('gagal', 'Sumber dana sedang digunakan.');
        } else {
            Dana::destroy($dana->id);
            return redirect('/dana')->with('sukses', 'Data berhasil dihapus.');
        }
    }
}
