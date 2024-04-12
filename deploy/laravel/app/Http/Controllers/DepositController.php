<?php

namespace App\Http\Controllers;

use App\Deposit_history;
use App\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deposit = Deposit::all();

        return view('deposit.index', [
            'title' => 'Uang Deposit',
            'active' => 'deposit',
            'deposit' => $deposit
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nama = Deposit::all();
        $divisi = Deposit::select('divisi')->groupBy('divisi')->get();

        return view('deposit.create', [
            'title' => 'Tambah Data Pengurangan Deposit',
            'active' => 'deposit',
            'nama' => $nama,
            'divisi' => $divisi
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
        // history
        $input = $request->all();
        Deposit_history::create($input);

        // deposit
        $depo = Deposit::where('id', $request->deposit_id)->first();
        if (request('keterangan') == 'Tidak mengikuti rapat pleno' or request('keterangan') == 'Terlambat mengikuti rapat pleno') {
            $update = ['raplen' => $depo->raplen + request('nominal')];
        } elseif (request('keterangan') == 'Tidak menggunakan jahim ketika jahim day') {
            $update = ['jahim' => $depo->jahim + request('nominal')];
        } elseif (request('keterangan') == 'Tidak mengikuti wisuda offline') {
            $update = ['wisuda' => $depo->wisuda + request('nominal')];
        } elseif (request('keterangan') == 'Tidak mengikuti piket pesek') {
            $update = ['pesek' => $depo->pesek + request('nominal')];
        } elseif (request('keterangan') == 'Tidak ada kabar saat menjalankan proker') {
            $update = ['proker' => $depo->proker + request('nominal')];
        } else {
            $update = ['lainya' => $depo->lainya + request('nominal')];
        }
        $depo->update($update);

        return redirect('/deposit')->with('sukses', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deposit_history  $deposit_history
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $history = Deposit_history::orderBy('tanggal', 'desc')->get();

        return view('deposit.history', [
            'title' => 'Riwayat Pengurangan Deposit',
            'active' => 'deposit',
            'history' => $history
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deposit_history  $deposit_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit_history $deposit)
    {
        $nama = Deposit::all();
        $divisi = Deposit::select('divisi')->groupBy('divisi')->get();

        return view('deposit.edit', [
            'title' => 'Perbarui Data Pengurangan Deposit',
            'active' => 'deposit',
            'nama' => $nama,
            'divisi' => $divisi,
            'edit' => $deposit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deposit_history  $deposit_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit_history $deposit)
    {
        // deposit
        $depo = Deposit::where('id', $deposit->deposit_id)->first();
        $depo2 = Deposit::where('id', $request->deposit_id)->first();
        if ($deposit->deposit_id == $request->deposit_id) {
            if ($deposit->keterangan == $request->keterangan) {
                if ($deposit->nominal != $request->nominal) {           // ganti nominal
                    if ($deposit->keterangan == 'Tidak mengikuti rapat pleno' or $deposit->keterangan == 'Terlambat mengikuti rapat pleno') {
                        $update = ['raplen' => $depo->raplen + ($request->nominal - $deposit->nominal)];
                    } elseif ($deposit->keterangan == 'Tidak menggunakan jahim ketika jahim day') {
                        $update = ['jahim' => $depo->jahim + ($request->nominal - $deposit->nominal)];
                    } elseif ($deposit->keterangan == 'Tidak mengikuti wisuda offline') {
                        $update = ['wisuda' => $depo->wisuda + ($request->nominal - $deposit->nominal)];
                    } elseif ($deposit->keterangan == 'Tidak mengikuti piket pesek') {
                        $update = ['pesek' => $depo->pesek + ($request->nominal - $deposit->nominal)];
                    } elseif ($deposit->keterangan == 'Tidak ada kabar saat menjalankan proker') {
                        $update = ['proker' => $depo->proker + ($request->nominal - $deposit->nominal)];
                    } else {
                        $update = ['lainya' => $depo->lainya + ($request->nominal - $deposit->nominal)];
                    }
                    $depo->update($update);
                }
            } else {                                                    // ganti keterangan
                // keterangan lama
                if ($deposit->keterangan == 'Tidak mengikuti rapat pleno' or $deposit->keterangan == 'Terlambat mengikuti rapat pleno') {
                    $update = ['raplen' => $depo->raplen - $deposit->nominal];
                } elseif ($deposit->keterangan == 'Tidak menggunakan jahim ketika jahim day') {
                    $update = ['jahim' => $depo->jahim - $deposit->nominal];
                } elseif ($deposit->keterangan == 'Tidak mengikuti wisuda offline') {
                    $update = ['wisuda' => $depo->wisuda - $deposit->nominal];
                } elseif ($deposit->keterangan == 'Tidak mengikuti piket pesek') {
                    $update = ['pesek' => $depo->pesek - $deposit->nominal];
                } elseif ($deposit->keterangan == 'Tidak ada kabar saat menjalankan proker') {
                    $update = ['proker' => $depo->proker - $deposit->nominal];
                } else {
                    $update = ['lainya' => $depo->lainya - $deposit->nominal];
                }
                $depo->update($update);
                // keterangan baru
                if ($request->keterangan == 'Tidak mengikuti rapat pleno' or $request->keterangan == 'Terlambat mengikuti rapat pleno') {
                    $update = ['raplen' => $depo->raplen + $request->nominal];
                } elseif ($request->keterangan == 'Tidak menggunakan jahim ketika jahim day') {
                    $update = ['jahim' => $depo->jahim + $request->nominal];
                } elseif ($request->keterangan == 'Tidak mengikuti wisuda offline') {
                    $update = ['wisuda' => $depo->wisuda + $request->nominal];
                } elseif ($request->keterangan == 'Tidak mengikuti piket pesek') {
                    $update = ['pesek' => $depo->pesek + $request->nominal];
                } elseif ($request->keterangan == 'Tidak ada kabar saat menjalankan proker') {
                    $update = ['proker' => $depo->proker + $request->nominal];
                } else {
                    $update = ['lainya' => $depo->lainya + $request->nominal];
                }
                $depo->update($update);
            }
        } else {                                                        // ganti nama
            // hapus data user lama
            if ($deposit->keterangan == 'Tidak mengikuti rapat pleno' or $deposit->keterangan == 'Terlambat mengikuti rapat pleno') {
                $update = ['raplen' => $depo->raplen - $deposit->nominal];
            } elseif ($deposit->keterangan == 'Tidak menggunakan jahim ketika jahim day') {
                $update = ['jahim' => $depo->jahim - $deposit->nominal];
            } elseif ($deposit->keterangan == 'Tidak mengikuti wisuda offline') {
                $update = ['wisuda' => $depo->wisuda - $deposit->nominal];
            } elseif ($deposit->keterangan == 'Tidak mengikuti piket pesek') {
                $update = ['pesek' => $depo->pesek - $deposit->nominal];
            } elseif ($deposit->keterangan == 'Tidak ada kabar saat menjalankan proker') {
                $update = ['proker' => $depo->proker - $deposit->nominal];
            } else {
                $update = ['lainya' => $depo->lainya - $deposit->nominal];
            }
            $depo->update($update);
            // tambah data user baru
            if ($request->keterangan == 'Tidak mengikuti rapat pleno' or $request->keterangan == 'Terlambat mengikuti rapat pleno') {
                $update = ['raplen' => $depo2->raplen + $request->nominal];
            } elseif ($request->keterangan == 'Tidak menggunakan jahim ketika jahim day') {
                $update = ['jahim' => $depo2->jahim + $request->nominal];
            } elseif ($request->keterangan == 'Tidak mengikuti wisuda offline') {
                $update = ['wisuda' => $depo2->wisuda + $request->nominal];
            } elseif ($request->keterangan == 'Tidak mengikuti piket pesek') {
                $update = ['pesek' => $depo2->pesek + $request->nominal];
            } elseif ($request->keterangan == 'Tidak ada kabar saat menjalankan proker') {
                $update = ['proker' => $depo2->proker + $request->nominal];
            } else {
                $update = ['lainya' => $depo2->lainya + $request->nominal];
            }
            $depo2->update($update);
        }

        // history
        $input = $request->except(['_token', '_method']);

        Deposit_history::where('id', $deposit->id)->update($input);

        return redirect('deposit/history')->with('sukses', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deposit_history  $deposit_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit_history $deposit)
    {
        // deposit
        $depo = Deposit::where('id', $deposit->deposit_id)->first();
        if ($deposit->keterangan == 'Tidak mengikuti rapat pleno' or $deposit->keterangan == 'Terlambat mengikuti rapat pleno') {
            $update = ['raplen' => $depo->raplen - $deposit->nominal];
        } elseif ($deposit->keterangan == 'Tidak menggunakan jahim ketika jahim day') {
            $update = ['jahim' => $depo->jahim - $deposit->nominal];
        } elseif ($deposit->keterangan == 'Tidak mengikuti wisuda offline') {
            $update = ['wisuda' => $depo->wisuda - $deposit->nominal];
        } elseif ($deposit->keterangan == 'Tidak mengikuti piket pesek') {
            $update = ['pesek' => $depo->pesek - $deposit->nominal];
        } elseif ($deposit->keterangan == 'Tidak ada kabar saat menjalankan proker') {
            $update = ['proker' => $depo->proker - $deposit->nominal];
        } else {
            $update = ['lainya' => $depo->lainya - $deposit->nominal];
        }
        $depo->update($update);

        // history
        Deposit_history::destroy($deposit->id);

        return redirect('/deposit/history')->with('sukses', 'Data berhasil dihapus.');
    }
}
