@extends('layout.main')


@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Riwayat Pembayaran dan Pengurangan Deposit</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            <div class="d-inline">
                <button class="btn btn-dark btn-icon-split">
                    <a data-toggle="modal" data-target="#bayar" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Bayar</span>
                    </a>
                </button>
            </div>
            <div class="d-inline">
                <button class="btn btn-dark btn-icon-split">
                    <a data-toggle="modal" data-target="#denda" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-minus"></i>
                        </span>
                        <span class="text">Denda</span>
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>

@if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif

<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Menampilkan hasil untuk : </h6>
        <table>
            <tr>
                <td>Nama</td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ $identitas->pengurus->nama }}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>&nbsp;:&nbsp;</td>
                <td>{{ $identitas->pengurus->divisi }}</td>
            </tr>
        </table>
    </div>
    <div class="card-body">
        <h4 class="h5 mb-4 text-gray-800 text-center">Pembayaran Deposit</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Media</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="3">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp({{ $bayar->sum('nominal') }})) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($bayar as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->dana->nama }}</td>
                            <td style="text-align:right ;"><script> document.write(rp({{ $data->nominal }})) </script></td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-bayar-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-bayar-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit-bayar-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pembayaran Deposit</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/deposit/{{ $data->id }}/edit_bayar" autocomplete="off">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input value="{{ $data->tanggal }}" type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="dana_id">Nama Pengurus</label>
                                                    <input class="form-control form-control-user" type="text" required disabled value="{{ $identitas->pengurus->nama }}">
                                                    <input class="form-control form-control-user" type="text" name="deposit_id" id="deposit_id" hidden value="{{ $identitas->pengurus->id }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="dana_id">Media</label>
                                                    <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                                        <option value="" selected hidden>Pilih</option>
                                                        @foreach ($dana as $dn)
                                                            <option {{ ($dn->id == $data->dana_id) ? 'selected' : '' }} value="{{ $dn->id }}">{{ $dn->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="nominal">Nominal</label>
                                                    <input value="{{ $data->nominal }}" type="number" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="hapus-bayar-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Apakah anda yakin? Tekan tombol lanjutkan untuk menghapus data.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <form action="/deposit/{{ $data->id }}/hapus_bayar" method="post">
                                            @csrf
                                            <button class="btn btn-primary">Lanjutkan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-5">
    <div class="card-body">
        <h4 class="h5 mb-4 text-gray-800 text-center">Pengurangan Deposit</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="3">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp({{ $denda->sum('nominal') }})) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($denda as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->keterangan }}</td>
                            <td style="text-align:right ;"><script> document.write(rp({{ $data->nominal }})) </script></td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-denda-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-denda-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit-denda-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pengurangan Deposit</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/deposit/{{ $data->id }}" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <div class="form-group row">
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date" value="{{ $data->tanggal }}" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="dana_id">Nama Pengurus</label>
                                                    <select class="form-control form-control-user" name="deposit_id" id="deposit_id" required>
                                                        @foreach ($divisi as $div)
                                                            <?php
                                                                $d = DB::table('deposits')
                                                                    ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
                                                                    ->select('*')
                                                                    ->where('penguruses.divisi', '=', $div->divisi)
                                                                    ->get();
                                                            ?>
                                                            <option value="" class="font-weight-bold" disabled>{{ $div->divisi }}</option>
                                                            @foreach ($d as $depo)
                                                                <option {{ ($data->deposit_id == $depo->id) ? 'selected' : '' }} value="{{ $depo->id }}">{{ $depo->nama }}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-7 mb-3 mb-sm-0">
                                                    <label for="keterangan">Keterangan</label>
                                                    <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                                        <option {{ ($data->keterangan == 'Tidak mengikuti rapat pleno') ? 'selected' : '' }} value="Tidak mengikuti rapat pleno">Tidak mengikuti rapat pleno</option>
                                                        <option {{ ($data->keterangan == 'Terlambat mengikuti rapat pleno') ? 'selected' : '' }} value="Terlambat mengikuti rapat pleno">Terlambat mengikuti rapat pleno</option>
                                                        <option {{ ($data->keterangan == 'Tidak menggunakan jahim ketika jahim day') ? 'selected' : '' }} value="Tidak menggunakan jahim ketika jahim day">Tidak menggunakan jahim ketika jahim day</option>
                                                        <option {{ ($data->keterangan == 'Tidak mengikuti wisuda offline') ? 'selected' : '' }} value="Tidak mengikuti wisuda offline">Tidak mengikuti wisuda offline</option>
                                                        <option {{ ($data->keterangan == 'Tidak mengikuti piket pesek') ? 'selected' : '' }} value="Tidak mengikuti piket pesek">Tidak mengikuti piket pesek</option>
                                                        <option {{ ($data->keterangan == 'Tidak bertanggung jawab dalam menjalankan proker') ? 'selected' : '' }} value="Tidak bertanggung jawab dalam menjalankan proker">Tidak bertanggung jawab dalam menjalankan proker</option>
                                                        <option {{ ($data->keterangan == 'Lainya') ? 'selected' : '' }} value="Lainya">Lainya</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="nominal">Nominal</label>
                                                    <input type="number" value="{{ $data->nominal }}" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="hapus-denda-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Apakah anda yakin? Tekan tombol lanjutkan untuk menghapus data.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <form action="/deposit/{{ $data->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-primary">Lanjutkan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Deposit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/deposit/bayar" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="deposit_id" id="deposit_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($divisi as $div)
                                    <?php
                                        $d = DB::table('deposits')
                                            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
                                            ->select('*')
                                            ->where('penguruses.divisi', '=', $div->divisi)
                                            ->get();
                                    ?>
                                    <option value="" class="font-weight-bold" disabled>{{ $div->divisi }}</option>
                                    @foreach ($d as $data)
                                        <option value="{{ $data->id }}" {{ ($data->id == $identitas->pengurus_id) ? 'selected' : '' }}>{{ $data->nama }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="dana_id">Media</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="denda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengurangan Deposit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/deposit" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="deposit_id" id="deposit_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($divisi as $div)
                                    <?php
                                        $d = DB::table('deposits')
                                            ->join('penguruses', 'deposits.pengurus_id', '=', 'penguruses.id')
                                            ->select('*')
                                            ->where('penguruses.divisi', '=', $div->divisi)
                                            ->get();
                                    ?>
                                    <option value="" class="font-weight-bold" disabled>{{ $div->divisi }}</option>
                                    @foreach ($d as $data)
                                        <option value="{{ $data->id }}" {{ ($data->id == $identitas->pengurus_id) ? 'selected' : '' }}>{{ $data->nama }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="Tidak mengikuti rapat pleno">Tidak mengikuti rapat pleno</option>
                                <option value="Terlambat mengikuti rapat pleno">Terlambat mengikuti rapat pleno</option>
                                <option value="Tidak menggunakan jahim ketika jahim day">Tidak menggunakan jahim ketika jahim day</option>
                                <option value="Tidak mengikuti wisuda offline">Tidak mengikuti wisuda offline</option>
                                <option value="Tidak mengikuti piket pesek">Tidak mengikuti piket pesek</option>
                                <option value="Tidak bertanggung jawab dalam menjalankan proker">Tidak bertanggung jawab dalam menjalankan proker</option>
                                <option value="Lainya">Lainya</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection