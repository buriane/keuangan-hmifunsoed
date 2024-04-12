@extends('layout.add')


@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Riwayat Pembayaran Uang Kas</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            <div class="d-inline">
                <button class="btn btn-success btn-icon-split">
                    <a data-toggle="modal" data-target="#bayar" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Bayar</span>
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
@if (session()->has('peringatan'))
    <div class="alert alert-warning" role="alert">
        {{ session('peringatan') }}
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
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Bulan</th>
                        <th>Media</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center" colspan="3">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp({{ $history->sum('nominal') }})) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($history as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->bulan }}</td>
                            <td style="text-align:left ;">{{ $data->dana->nama }}</td>
                            <td style="text-align:right ;"><script> document.write(rp({{ $data->nominal }})) </script></td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pembayaran Kas</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/kas/{{ $data->id }}" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date" class="form-control form-control-user" value="{{ $data->tanggal }}" id="tanggal" name="tanggal" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="dana_id">Media</label>
                                                    <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                                        @foreach ($dana as $dn)
                                                            <option {{ ($data->dana_id == $dn->id) ? 'selected' : '' }} value="{{ $dn->id }}">{{ $dn->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="dana_id">Nama Pengurus</label>
                                                    <input type="text" disabled value="{{ $data->kas->pengurus->nama }}" class="deposit_id form-control form-control-user" required>
                                                    <input type="text" hidden value="{{ $data->kas_id }}" name="kas_id" id="kas_id" class="deposit_id form-control form-control-user" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-7 mb-3 mb-sm-0">
                                                    <label for="bulan">Bulan</label>
                                                    <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                                        <option {{ ($data->bulan == 'April') ? 'selected' : '' }} value="April">April</option>
                                                        <option {{ ($data->bulan == 'Mei') ? 'selected' : '' }} value="Mei">Mei</option>
                                                        <option {{ ($data->bulan == 'Juni') ? 'selected' : '' }} value="Juni">Juni</option>
                                                        <option {{ ($data->bulan == 'Juli') ? 'selected' : '' }} value="Juli">Juli</option>
                                                        <option {{ ($data->bulan == 'Agustus') ? 'selected' : '' }} value="Agustus">Agustus</option>
                                                        <option {{ ($data->bulan == 'September') ? 'selected' : '' }} value="September">September</option>
                                                        <option {{ ($data->bulan == 'Oktober') ? 'selected' : '' }} value="Oktober">Oktober</option>
                                                        <option {{ ($data->bulan == 'November') ? 'selected' : '' }} value="November">November</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="nominal">Denda</label>
                                                    <select class="form-control form-control-user" name="nominal" id="nominal-1" required>
                                                        <option {{ ($data->nominal == 15000) ? 'selected' : '' }} value="15000">Tidak</option>
                                                        <option {{ ($data->nominal == 17000) ? 'selected' : '' }} value="17000">2.000</option>
                                                        <option {{ ($data->nominal == 19000) ? 'selected' : '' }} value="19000">4.000</option>
                                                        <option {{ ($data->nominal == 21000) ? 'selected' : '' }} value="21000">6.000</option>
                                                        <option {{ ($data->nominal == 23000) ? 'selected' : '' }} value="23000">8.000</option>
                                                        <option {{ ($data->nominal == 25000) ? 'selected' : '' }} value="25000">10.000</option>
                                                        <option {{ ($data->nominal == 27000) ? 'selected' : '' }} value="27000">12.000</option>
                                                        <option {{ ($data->nominal == 29000) ? 'selected' : '' }} value="29000">14.000</option>
                                                        <option {{ ($data->nominal == 31000) ? 'selected' : '' }} value="31000">16.000</option>
                                                        <option {{ ($data->nominal == 33000) ? 'selected' : '' }} value="33000">18.000</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <button id="up" type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="hapus-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <form action="/kas/{{ $data->id }}" method="post">
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Kas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/kas" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="dana_id">Media</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="kas_id" id="kas_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($divisi as $div)
                                    <?php
                                        $d = DB::table('kas')
                                            ->join('penguruses', 'kas.pengurus_id', '=', 'penguruses.id')
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
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan-1" id="bulan-1" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Denda</label>
                            <select class="form-control form-control-user" name="nominal-1" id="nominal-1" required>
                                <option selected value="15000">Tidak</option>
                                <option value="17000">2.000</option>
                                <option value="19000">4.000</option>
                                <option value="21000">6.000</option>
                                <option value="23000">8.000</option>
                                <option value="25000">10.000</option>
                                <option value="27000">12.000</option>
                                <option value="29000">14.000</option>
                                <option value="31000">16.000</option>
                                <option value="33000">18.000</option>
                            </select>
                        </div>
                    </div>
                    <div id='setB'></div>
                    <div class="form-group text-center my-4">
                        <a href="#up" class="DEL btn btn-danger">x</a>
                        <a href="#up" id="ADD" class="btn btn-secondary">+</a>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button id="up" type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection