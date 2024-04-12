<?php

namespace App\Http\Controllers;

use App\Models\Deposit_history;
use App\Models\Deposit;
use App\Models\Deposit_payment;
use App\Models\Dana;
use App\Models\Transaksi;
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
        $deposit = DB::table('deposits')
            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
            ->select('*')
            ->orderBy('divisi')
            ->orderBy('pengurus_id')
            ->get();

        $nama = Deposit::all();
        $dana = Dana::all();
        $divisi = DB::table('deposits')
            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
            ->select('divisi')
            ->groupBy('divisi')
            ->orderBy('divisi')
            ->get();

        return view('deposit.index', [
            'title' => 'Uang Deposit',
            'active' => 'deposit',
            'deposit' => $deposit,
            'nama' => $nama,
            'divisi' => $divisi,
            'dana' => $dana
        ]);
    }

    public function manage($id)
    {
        $bayar = Deposit_payment::where('deposit_id', $id)->orderBy('tanggal', 'asc')->get();
        $denda = Deposit_history::where('deposit_id', $id)->orderBy('tanggal', 'asc')->get();
        $data = Deposit::where('id', $id)->first();

        $nama = Deposit::all();
        $dana = Dana::all();
        $divisi = DB::table('deposits')
            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
            ->select('divisi')
            ->groupBy('divisi')
            ->orderBy('divisi')
            ->get();

        return view('deposit.manage', [
            'title' => 'Riwayat Pembayaran dan Pengurangan Deposit',
            'active' => 'deposit',
            'identitas' => $data,
            'denda' => $denda,
            'bayar' => $bayar,
            'nama' => $nama,
            'divisi' => $divisi,
            'dana' => $dana
        ]);
    }

    public function bayar(Request $request)
    {
        // riwayat pembayaran
        $history = $request->except('_token');
        Deposit_payment::create($history);

        // riwayat transaksi
        $input_transaksi = [
            'dana_id' => $request->dana_id,
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'detail' => 'Uang Deposit',
            'keterangan' => 'Pemasukan'
        ];
        $transaksi = Transaksi::where('tanggal', $request->tanggal)->where('detail', 'Uang Deposit')->where('dana_id', $request->dana_id)->first();
        if ($transaksi) {
            $input_transaksi = ['nominal' => $transaksi->nominal + $input_transaksi['nominal']];
            $transaksi->update($input_transaksi);
        } else {
            Transaksi::create($input_transaksi);
        }

        // update deposit
        $deposit = Deposit::where('id', $request->deposit_id)->first();
        $input_deposit = ['sisa' => $deposit->sisa + $request->nominal];
        $deposit->update($input_deposit);

        return back()->with('sukses', 'Data berhasil ditambahkan.');
    }

    public function edit_bayar($id, Request $request)
    {
        // dd($id, $request);
        $change = Deposit_payment::where('id', $id)->first();

        // ganti tanggal
        if ($request->tanggal != $change->tanggal) {
            $input_tanggal = [
                'dana_id' => $change->dana_id,
                'tanggal' => $request->tanggal,
                'detail' => 'Uang Deposit',
                'keterangan' => 'Pemasukan',
                'nominal' => $change->nominal
            ];
            $transaksi = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Uang Deposit')->where('dana_id', $change->dana_id)->first();
            $transaksi2 = Transaksi::where('tanggal', $request->tanggal)->where('detail', 'Uang Deposit')->where('dana_id', $change->dana_id)->first();
            // hapus data di tanggal lama
            if ($transaksi->nominal - $change->nominal == 0) {
                Transaksi::destroy($transaksi->id);
            } else {
                $update = ['nominal' => $transaksi->nominal - $change->nominal];
                $transaksi->update($update);
            }
            // tambah data tanggal baru
            if ($transaksi2) {
                $update2 = ['nominal' => $transaksi2->nominal + $change->nominal];
                $transaksi2->update($update2);
            } else {
                Transaksi::create($input_tanggal);
            }
            // update deposit payment
            $tanggal = ['tanggal' => $request->tanggal];
            $change->update($tanggal);
        }

        // ganti sumber dana
        if ($request->dana_id != $change->dana_id) {
            $input_dana = [
                'dana_id' => $request->dana_id,
                'tanggal' => $change->tanggal,
                'detail' => 'Uang Deposit',
                'keterangan' => 'Pemasukan',
                'nominal' => $change->nominal
            ];
            $transaksi = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Uang Deposit')->where('dana_id', $change->dana_id)->first();
            $transaksi2 = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Uang Deposit')->where('dana_id', $request->dana_id)->first();
            // hapus data di dana lama
            if ($transaksi->nominal - $change->nominal == 0) {
                Transaksi::destroy($transaksi->id);
            } else {
                $update = ['nominal' => $transaksi->nominal - $change->nominal];
                $transaksi->update($update);
            }
            // tambah data tanggal baru
            if ($transaksi2) {
                $update2 = ['nominal' => $transaksi2->nominal + $change->nominal];
                $transaksi2->update($update2);
            } else {
                Transaksi::create($input_dana);
            }
            // update deposit payment
            $dana_id = ['dana_id' => $request->dana_id];
            $change->update($dana_id);
        }

        // ganti nominal
        if ($request->nominal != $change->nominal) {
            $deposit = Deposit::where('id', $change->deposit_id)->first();
            $transaksi = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Uang Deposit')->where('dana_id', $change->dana_id)->first();

            // nominal baru di tabel deposit
            $update = ['sisa' => $deposit->sisa + ($request->nominal - $change->nominal)];
            $deposit->update($update);
            // nominal baru di tabel transaksi
            $update2 = ['nominal' => $transaksi->nominal + ($request->nominal - $change->nominal)];
            $transaksi->update($update2);
            // update deposit payment
            $nominal = ['nominal' => $request->nominal];
            $change->update($nominal);
        }

        return back()->with('sukses', 'Data berhasil diperbarui.');
    }

    public function hapus_bayar($id)
    {
        $hapus = Deposit_payment::where('id', $id)->first();

        // update deposit
        $deposit = Deposit::where('id', $hapus->deposit_id)->first();
        $deposit->update(['sisa' => $deposit->sisa - $hapus->nominal]);

        // delete transaksi
        $transaksi = Transaksi::where('tanggal', $hapus->tanggal)->where('detail', 'Uang Deposit')->where('dana_id', $hapus->dana_id)->first();
        if ($transaksi->nominal - $hapus->nominal == 0) {
            Transaksi::destroy($transaksi->id);
        } else {
            $update2 = ['nominal' => $transaksi->nominal - $hapus->nominal];
            $transaksi->update($update2);
        }

        // delete history
        Deposit_payment::destroy($id);

        return back()->with('sukses', 'Data berhasil dihapus.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nama = Deposit::all();
        $divisi = DB::table('deposits')
            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
            ->select('divisi')
            ->groupBy('divisi')
            ->orderBy('divisi')
            ->get();

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
        } elseif (request('keterangan') == 'Tidak bertanggung jawab dalam menjalankan proker') {
            $update = ['proker' => $depo->proker + request('nominal')];
        } else {
            $update = ['lainya' => $depo->lainya + request('nominal')];
        }
        $depo->update($update);

        return back()->with('sukses', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit_history  $deposit_history
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $history = Deposit_history::orderBy('tanggal', 'desc')->get();
        $nama = Deposit::all();
        $divisi = DB::table('deposits')
            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
            ->select('divisi')
            ->groupBy('divisi')
            ->orderBy('divisi')
            ->get();


        return view('deposit.history', [
            'title' => 'Riwayat Pengurangan Deposit',
            'active' => 'deposit',
            'history' => $history,
            'nama' => $nama,
            'divisi' => $divisi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit_history  $deposit_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit_history $deposit)
    {
        $nama = Deposit::all();
        $divisi = DB::table('deposits')
            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
            ->select('divisi')
            ->groupBy('divisi')
            ->orderBy('divisi')
            ->get();

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
     * @param  \App\Models\Deposit_history  $deposit_history
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
                    } elseif ($deposit->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') {
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
                } elseif ($deposit->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') {
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
                } elseif ($request->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') {
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
            } elseif ($deposit->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') {
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
            } elseif ($request->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') {
                $update = ['proker' => $depo2->proker + $request->nominal];
            } else {
                $update = ['lainya' => $depo2->lainya + $request->nominal];
            }
            $depo2->update($update);
        }

        // history
        $input = $request->except(['_token', '_method']);

        Deposit_history::where('id', $deposit->id)->update($input);

        return back()->with('sukses', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit_history  $deposit_history
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
        } elseif ($deposit->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') {
            $update = ['proker' => $depo->proker - $deposit->nominal];
        } else {
            $update = ['lainya' => $depo->lainya - $deposit->nominal];
        }
        $depo->update($update);

        // history
        Deposit_history::destroy($deposit->id);

        return back()->with('sukses', 'Data berhasil dihapus.');
    }
}
