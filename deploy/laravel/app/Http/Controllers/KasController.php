<?php

namespace App\Http\Controllers;

use App\Kas_history;
use App\Kas;
use App\Dana;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kas.index', [
            'title' => 'Uang Kas',
            'active' => 'kas',
            'kas' => Kas::all(),

            'totalApril' => Kas::whereNotNull('april')->sum('april'),
            'totalMei' => Kas::whereNotNull('mei')->sum('mei'),
            'totalJuni' => Kas::whereNotNull('juni')->sum('juni'),
            'totalJuli' => Kas::whereNotNull('juli')->sum('juli'),
            'totalAgustus' => Kas::whereNotNull('agustus')->sum('agustus'),
            'totalSeptember' => Kas::whereNotNull('september')->sum('september'),
            'totalOktober' => Kas::whereNotNull('oktober')->sum('oktober'),
            'totalNovember' => Kas::whereNotNull('november')->sum('november')
        ]);
    }

    public function history()
    {
        $history = Kas_history::orderBy('tanggal', 'desc')->get();

        return view('kas.history', [
            'title' => 'Riwayat Pembayaran Uang Kas',
            'active' => 'kas',
            'history' => $history
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
        $nama = Kas::all();
        $divisi = DB::table('kas')
            ->select('divisi')
            ->groupBy('divisi')
            ->get();

        return view('kas.create', [
            'title' => 'Tambah Data Pembayaran Uang Kas',
            'active' => 'kas',
            'nama' => $nama,
            'dana' => $dana,
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
        $input = [
            'kas_id' => $request->kas_id,
            'tanggal' => $request->tanggal,
            'dana_id' => $request->dana_id
        ];
        $input2 = [
            'dana_id' => $request->dana_id,
            'tanggal' => $request->tanggal,
            'detail' => 'Kas HMIF',
            'keterangan' => 'Pemasukan'
        ];
        $kas = Kas::where('id', $request->kas_id)->first();

        $warn = null;

        for ($i = 1; $i <= 20; $i++) {
            if (isset($request["bulan-${i}"])) {
                $input['bulan'] = $request["bulan-${i}"];
                $input['nominal'] = $request["nominal-${i}"];
                $input2['nominal'] = $request["nominal-${i}"];

                // input kas history
                Kas_history::create($input);

                // input kas
                switch ($input['bulan']) {
                    case 'April':
                        $update = ['april' => $kas->april + $input['nominal']];
                        if ($kas->april != 0) {
                            $warn = $kas->nama . ' membayar kas bulan april lebih dari 1 kali.';
                        }
                        break;
                    case 'Mei':
                        $update = ['mei' => $kas->mei + $input['nominal']];
                        if ($kas->mei != 0) {
                            $warn = $kas->nama . ' membayar kas bulan mei lebih dari 1 kali.';
                        }
                        break;
                    case 'Juni':
                        $update = ['juni' => $kas->juni + $input['nominal']];
                        if ($kas->juni != 0) {
                            $warn = $kas->nama . ' membayar kas bulan juni lebih dari 1 kali.';
                        }
                        break;
                    case 'Juli':
                        $update = ['juli' => $kas->juli + $input['nominal']];
                        if ($kas->juli != 0) {
                            $warn = $kas->nama . ' membayar kas bulan juli lebih dari 1 kali.';
                        }
                        break;
                    case 'Agustus':
                        $update = ['agustus' => $kas->agustus + $input['nominal']];
                        if ($kas->agustus != 0) {
                            $warn = $kas->nama . ' membayar kas bulan agustus lebih dari 1 kali.';
                        }
                        break;
                    case 'September':
                        $update = ['september' => $kas->september + $input['nominal']];
                        if ($kas->september != 0) {
                            $warn = $kas->nama . ' membayar kas bulan september lebih dari 1 kali.';
                        }
                        break;
                    case 'Oktober':
                        $update = ['oktober' => $kas->oktober + $input['nominal']];
                        if ($kas->oktober != 0) {
                            $warn = $kas->nama . ' membayar kas bulan oktober lebih dari 1 kali.';
                        }
                        break;
                    default:
                        $update = ['november' => $kas->november + $input['nominal']];
                        if ($kas->november != 0) {
                            $warn = $kas->nama . ' membayar kas bulan november lebih dari 1 kali.';
                        }
                        break;
                }
                $kas->update($update);

                // input transaksi
                $transaksi = Transaksi::where('tanggal', $request->tanggal)->where('detail', 'Kas HMIF')->where('dana_id', $request->dana_id)->first();
                if ($transaksi) {
                    $update2 = ['nominal' => $transaksi->nominal + $input2['nominal']];
                    $transaksi->update($update2);
                } else {
                    Transaksi::create($input2);
                }
            }
        }

        if ($warn == null) {
            return redirect('/kas')->with('sukses', 'Data berhasil ditambahkan.');
        } else {
            return redirect('/kas')->with('peringatan', $warn);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kas_history  $kas_history
     * @return \Illuminate\Http\Response
     */
    public function show(Kas_history $ka)
    {
        //
    }

    public function manage($id)
    {
        $history = Kas_history::where('kas_id', $id)->orderBy('tanggal', 'asc')->get();
        $data = Kas::where('id', $id)->first(['nama', 'divisi']);

        return view('kas.manage', [
            'title' => 'Data Pembayaran Uang Kas',
            'active' => 'kas',
            'identitas' => $data,
            'history' => $history
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kas_history  $kas_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Kas_history $ka)
    {
        $dana = Dana::all();
        $nama = Kas::all();
        $divisi = DB::table('kas')
            ->select('divisi')
            ->groupBy('divisi')
            ->get();

        return view('kas.edit', [
            'title' => 'Perbarui Data Pembayaran Uang Kas',
            'active' => 'kas',
            'nama' => $nama,
            'dana' => $dana,
            'divisi' => $divisi,
            'edit' => $ka
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kas_history  $kas_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kas_history $ka)
    {
        $warn = null;
        $change = Kas_history::where('id', $ka->id)->first();
        // ganti tanggal
        if ($request->tanggal != $ka->tanggal) {
            $input_tanggal = [
                'dana_id' => $change->dana_id,
                'tanggal' => $request->tanggal,
                'detail' => 'Kas HMIF',
                'keterangan' => 'Pemasukan',
                'nominal' => $change->nominal
            ];
            $transaksi = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Kas HMIF')->where('dana_id', $change->dana_id)->first();
            $transaksi2 = Transaksi::where('tanggal', $request->tanggal)->where('detail', 'Kas HMIF')->where('dana_id', $change->dana_id)->first();
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
            // update kas history
            $tanggal = ['tanggal' => $request->tanggal];
            $change->update($tanggal);
        }

        // ganti sumber dana
        if ($request->dana_id != $ka->dana_id) {
            $change = Kas_history::where('id', $ka->id)->first();
            $input_dana = [
                'dana_id' => $request->dana_id,
                'tanggal' => $change->tanggal,
                'detail' => 'Kas HMIF',
                'keterangan' => 'Pemasukan',
                'nominal' => $change->nominal
            ];
            $transaksi = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Kas HMIF')->where('dana_id', $change->dana_id)->first();
            $transaksi2 = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Kas HMIF')->where('dana_id', $request->dana_id)->first();
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
            // update kas history
            $dana_id = ['dana_id' => $request->dana_id];
            $change->update($dana_id);
        }

        // ganti bulan
        if ($request->bulan != $ka->bulan) {
            $change = Kas_history::where('id', $ka->id)->first();
            $kas = Kas::where('id', $ka->kas_id)->first();

            // hapus data bulan lama
            if ($ka->bulan == 'April') {
                $update = ['april' => $kas->april - $ka->nominal];
            } elseif ($ka->bulan == 'Mei') {
                $update = ['mei' => $kas->mei - $ka->nominal];
            } elseif ($ka->bulan == 'Juni') {
                $update = ['juni' => $kas->juni - $ka->nominal];
            } elseif ($ka->bulan == 'Juli') {
                $update = ['juli' => $kas->juli - $ka->nominal];
            } elseif ($ka->bulan == 'Agustus') {
                $update = ['agustus' => $kas->agustus - $ka->nominal];
            } elseif ($ka->bulan == 'September') {
                $update = ['september' => $kas->september - $ka->nominal];
            } elseif ($ka->bulan == 'Oktober') {
                $update = ['oktober' => $kas->oktober - $ka->nominal];
            } else {
                $update = ['november' => $kas->november - $ka->nominal];
            }
            $kas->update($update);
            // tambah data bulan baru
            switch ($request->bulan) {
                case 'April':
                    $update = ['april' => $kas->april + $change->nominal];
                    if ($kas->april != 0) {
                        $warn = $kas->nama . ' membayar kas bulan april lebih dari 1 kali.';
                    }
                    break;
                case 'Mei':
                    $update = ['mei' => $kas->mei + $change->nominal];
                    if ($kas->mei != 0) {
                        $warn = $kas->nama . ' membayar kas bulan mei lebih dari 1 kali.';
                    }
                    break;
                case 'Juni':
                    $update = ['juni' => $kas->juni + $change->nominal];
                    if ($kas->juni != 0) {
                        $warn = $kas->nama . ' membayar kas bulan juni lebih dari 1 kali.';
                    }
                    break;
                case 'Juli':
                    $update = ['juli' => $kas->juli + $change->nominal];
                    if ($kas->juli != 0) {
                        $warn = $kas->nama . ' membayar kas bulan juli lebih dari 1 kali.';
                    }
                    break;
                case 'Agustus':
                    $update = ['agustus' => $kas->agustus + $change->nominal];
                    if ($kas->agustus != 0) {
                        $warn = $kas->nama . ' membayar kas bulan agustus lebih dari 1 kali.';
                    }
                    break;
                case 'September':
                    $update = ['september' => $kas->september + $change->nominal];
                    if ($kas->september != 0) {
                        $warn = $kas->nama . ' membayar kas bulan september lebih dari 1 kali.';
                    }
                    break;
                case 'Oktober':
                    $update = ['oktober' => $kas->oktober + $change->nominal];
                    if ($kas->oktober != 0) {
                        $warn = $kas->nama . ' membayar kas bulan oktober lebih dari 1 kali.';
                    }
                    break;
                default:
                    $update = ['november' => $kas->november + $change->nominal];
                    if ($kas->november != 0) {
                        $warn = $kas->nama . ' membayar kas bulan november lebih dari 1 kali.';
                    }
                    break;
            }
            $kas->update($update);
            // update kas history
            $bulan = ['bulan' => $request->bulan];
            $change->update($bulan);
        }

        // ganti nominal
        if ($request->nominal != $ka->nominal) {
            $change = Kas_history::where('id', $ka->id)->first();
            $kas = Kas::where('id', $ka->kas_id)->first();
            $transaksi = Transaksi::where('tanggal', $change->tanggal)->where('detail', 'Kas HMIF')->where('dana_id', $change->dana_id)->first();

            // nominal baru di tabel kas
            if ($change->bulan == 'April') {
                $update = ['april' => $kas->april + ($request->nominal - $ka->nominal)];
            } elseif ($change->bulan == 'Mei') {
                $update = ['mei' => $kas->mei + ($request->nominal - $ka->nominal)];
            } elseif ($change->bulan == 'Juni') {
                $update = ['juni' => $kas->juni + ($request->nominal - $ka->nominal)];
            } elseif ($change->bulan == 'Juli') {
                $update = ['juli' => $kas->juli + ($request->nominal - $ka->nominal)];
            } elseif ($change->bulan == 'Agustus') {
                $update = ['agustus' => $kas->agustus + ($request->nominal - $ka->nominal)];
            } elseif ($change->bulan == 'September') {
                $update = ['september' => $kas->september + ($request->nominal - $ka->nominal)];
            } elseif ($change->bulan == 'Oktober') {
                $update = ['oktober' => $kas->oktober + ($request->nominal - $ka->nominal)];
            } else {
                $update = ['november' => $kas->november + ($request->nominal - $ka->nominal)];
            }
            $kas->update($update);
            // nominal baru di tabel transaksi
            $update2 = ['nominal' => $transaksi->nominal + ($request->nominal - $ka->nominal)];
            $transaksi->update($update2);
            // update kas history
            $nominal = ['nominal' => $request->nominal];
            $change->update($nominal);
        }

        if ($warn == null) {
            return redirect("/kas/manage/$change->kas_id")->with('sukses', 'Data berhasil diperbarui.');
        } else {
            return redirect("/kas/manage/$change->kas_id")->with('peringatan', $warn);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kas_history  $kas_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kas_history $ka)
    {
        // delete kas
        $kas = Kas::where('id', $ka->kas_id)->first();
        if ($ka->bulan == 'April') {
            $update = ['april' => $kas->april - $ka->nominal];
        } elseif ($ka->bulan == 'Mei') {
            $update = ['mei' => $kas->mei - $ka->nominal];
        } elseif ($ka->bulan == 'Juni') {
            $update = ['juni' => $kas->juni - $ka->nominal];
        } elseif ($ka->bulan == 'Juli') {
            $update = ['juli' => $kas->juli - $ka->nominal];
        } elseif ($ka->bulan == 'Agustus') {
            $update = ['agustus' => $kas->agustus - $ka->nominal];
        } elseif ($ka->bulan == 'September') {
            $update = ['september' => $kas->september - $ka->nominal];
        } elseif ($ka->bulan == 'Oktober') {
            $update = ['oktober' => $kas->oktober - $ka->nominal];
        } else {
            $update = ['november' => $kas->november - $ka->nominal];
        }
        $kas->update($update);

        // delete transaksi
        $transaksi = Transaksi::where('tanggal', $ka->tanggal)->where('detail', 'Kas HMIF')->where('dana_id', $ka->dana_id)->first();
        if ($transaksi->nominal - $ka->nominal == 0) {
            Transaksi::destroy($transaksi->id);
        } else {
            $update2 = ['nominal' => $transaksi->nominal - $ka->nominal];
            $transaksi->update($update2);
        }

        // delete history
        Kas_history::destroy($ka->id);

        return redirect("/kas/manage/$kas->id")->with('sukses', 'Data berhasil dihapus.');
    }
}
