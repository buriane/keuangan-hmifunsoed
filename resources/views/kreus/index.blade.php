@extends('layout.main')


@section('content')
<?php use App\Models\Kreus; ?> 
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Laporan Keuangan Kreus {{ $judul }}</h1>

<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="mb-3">
            <div class="dropdown no-arrow d-inline">
                <button class="btn btn-dark btn-icon-split dropdown-toggle" type="button"
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" data-toggle="modal" data-target="#create-1" href="#">Pemasukan</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#create-2" href="#">Pengeluaran Kreus</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#create-3" href="#">Pengeluaran diluar Kreus</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="div">
            <form action="" method="get" role="form">
                @csrf
                <div class="form-group">
                    <div class="row justify-content-lg-end d-flex">
                        <div class="col-5 col-lg-6 col-md-4">
                            <select id="bln" name="bln" type="text" class="form-control">
                                <option hidden selected value="">Pilih Bulan</option>
                                @foreach ($bln as $data)
                                    <option value="{{ $data->bulan }}">{{ Kreus::bulan($data->bulan) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif

<h2 class="h4 mb-3 text-gray-800">Pemasukan</h2>
<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pemasukan Divisi Kreasi dan Usaha</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Program Kerja</th>
                        <th>Sumber Dana</th>
                        <th>Penanggung Jawab</th>
                        <th>Pemasukan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="4">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->where('kategori', 'Pemasukan')->sum('pemasukan') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan->where('kategori', 'Pemasukan') as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->proker }}</td>
                            <td style="text-align:left ;">{{ $data->sumber }}</td>
                            <td style="text-align:left ;">{{ $data->pj }}</td>
                            <td style="text-align:right ;"><script> document.write(rp( {{ $data->pemasukan }} )) </script></td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pemasukan Divisi Kreasi dan Usaha</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/laporan-kreus/{{ $data->id }}" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <div class="form-group row">
                                                <input type="text" name="kategori" id="kategori" value="Pemasukan" hidden>
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="bulan">Bulan</label>
                                                    <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                                        <option value="" selected hidden>Pilih</option>
                                                        <option {{ ($data->bulan == 1) ? 'selected' : '' }} value="1">Januari</option>
                                                        <option {{ ($data->bulan == 2) ? 'selected' : '' }} value="2">Februari</option>
                                                        <option {{ ($data->bulan == 3) ? 'selected' : '' }} value="3">Maret</option>
                                                        <option {{ ($data->bulan == 4) ? 'selected' : '' }} value="4">April</option>
                                                        <option {{ ($data->bulan == 5) ? 'selected' : '' }} value="5">Mei</option>
                                                        <option {{ ($data->bulan == 6) ? 'selected' : '' }} value="6">Juni</option>
                                                        <option {{ ($data->bulan == 7) ? 'selected' : '' }} value="7">Juli</option>
                                                        <option {{ ($data->bulan == 8) ? 'selected' : '' }} value="8">Agustus</option>
                                                        <option {{ ($data->bulan == 9) ? 'selected' : '' }} value="9">September</option>
                                                        <option {{ ($data->bulan == 10) ? 'selected' : '' }} value="10">Oktober</option>
                                                        <option {{ ($data->bulan == 11) ? 'selected' : '' }} value="11">November</option>
                                                        <option {{ ($data->bulan == 12) ? 'selected' : '' }} value="12">Desember</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="proker">Program Kerja</label>
                                                    <input value="{{ $data->proker }}" type="text" class="form-control form-control-user" id="proker" name="proker" placeholder="Masukkan Program Kerja" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-7 mb-3 mb-sm-0">
                                                    <label for="sumber">Sumber Dana</label>
                                                    <input value="{{ $data->sumber }}" type="text" class="form-control form-control-user" id="sumber" name="sumber" placeholder="Masukkan Sumber Dana" required>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="pemasukan">Nominal</label>
                                                    <input value="{{ $data->pemasukan }}" type="number" class="form-control form-control-user" id="pemasukan" name="pemasukan" placeholder="Masukkan Nominal" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pj">Penanggung Jawab</label>
                                                <select class="form-control form-control-user" name="pj" id="pj" required>
                                                    <option value="" selected hidden>Pilih</option>
                                                    @foreach ($pj as $item)
                                                        <option {{ ($data->pj == $item->nama) ? 'selected' : '' }} value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
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
                                        <form action="/laporan-kreus/{{ $data->id }}" method="post">
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

<h2 class="h4 mb-3 text-gray-800">Pengeluaran</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <ol class="mb-0">
                <li>Pengeluaran Dana untuk Program Kerja Divisi Kreasi dan Usaha</li>
            </ol>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Program Kerja</th>
                        <th>Keterangan</th>
                        <th>Penanggung Jawab</th>
                        <th>Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="4">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->where('kategori', 'Pengeluaran Kreus')->sum('pengeluaran') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan->where('kategori', 'Pengeluaran Kreus') as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->proker }}</td>
                            <td style="text-align:left ;">{{ $data->keterangan }}</td>
                            <td style="text-align:left ;">{{ $data->pj }}</td>
                            <td style="text-align:right ;"><script> document.write(rp( {{ $data->pengeluaran }} )) </script></td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pemasukan Divisi Kreasi dan Usaha</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/laporan-kreus/{{ $data->id }}" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <div class="form-group row">
                                                <input type="text" name="kategori" id="kategori" value="Pengeluaran Kreus" hidden>
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="bulan">Bulan</label>
                                                    <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                                        <option value="1" {{ ($data->bulan === 1) ? 'selected' : '' }}>Januari</option>
                                                        <option value="2" {{ ($data->bulan === 2) ? 'selected' : '' }}>Februari</option>
                                                        <option value="3" {{ ($data->bulan === 3) ? 'selected' : '' }}>Maret</option>
                                                        <option value="4" {{ ($data->bulan === 4) ? 'selected' : '' }}>April</option>
                                                        <option value="5" {{ ($data->bulan === 5) ? 'selected' : '' }}>Mei</option>
                                                        <option value="6" {{ ($data->bulan === 6) ? 'selected' : '' }}>Juni</option>
                                                        <option value="7" {{ ($data->bulan === 7) ? 'selected' : '' }}>Juli</option>
                                                        <option value="8" {{ ($data->bulan === 8) ? 'selected' : '' }}>Agustus</option>
                                                        <option value="9" {{ ($data->bulan === 9) ? 'selected' : '' }}>September</option>
                                                        <option value="10" {{ ($data->bulan === 10) ? 'selected' : '' }}>Oktober</option>
                                                        <option value="11" {{ ($data->bulan === 11) ? 'selected' : '' }}>November</option>
                                                        <option value="12" {{ ($data->bulan === 12) ? 'selected' : '' }}>Desember</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="proker">Program Kerja</label>
                                                    <input type="text" class="form-control form-control-user" id="proker" value="{{ $data->proker }}" name="proker" placeholder="Masukkan Program Kerja" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-7 mb-3 mb-sm-0">
                                                    <label for="sumber">Keterangan</label>
                                                    <input type="text" class="form-control form-control-user" id="keterangan" value="{{ $data->keterangan }}" name="keterangan" placeholder="Masukkan Keterangan" required>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="pemasukan">Nominal</label>
                                                    <input type="number" class="form-control form-control-user" id="pengeluaran" value="{{ $data->pengeluaran }}" name="pengeluaran" placeholder="Masukkan Nominal" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pj">Penanggung Jawab</label>
                                                <select class="form-control form-control-user" name="pj" id="pj" required>
                                                    <option value="" selected hidden>Pilih</option>
                                                    @foreach ($pj as $item)
                                                        <option {{ ($data->pj == $item->nama) ? 'selected' : '' }} value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
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
                                        <form action="/laporan-kreus/{{ $data->id }}" method="post">
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
<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <ol start="2" class="mb-0">
                <li>Pengeluaran Dana untuk Program Kerja diluar Divisi Kreasi dan Usaha</li>
            </ol>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Program Kerja</th>
                        <th>Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="3">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->where('kategori', 'Pengeluaran diluar Kreus')->sum('pengeluaran') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan->where('kategori', 'Pengeluaran diluar Kreus') as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->tanggal }}</td>
                            <td style="text-align:left ;">{{ $data->proker }}</td>
                            <td style="text-align:right ;"><script> document.write(rp( {{ $data->pengeluaran }} )) </script></td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus-{{ $data->id }}"><span><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Pemasukan Divisi Kreasi dan Usaha</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/laporan-kreus/{{ $data->id }}" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <div class="form-group row">
                                                <input type="text" name="kategori" id="kategori" value="Pengeluaran diluar Kreus" hidden>
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="bulan">Bulan</label>
                                                    <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                                        <option value="1" {{ ($data->bulan === 1) ? 'selected' : '' }}>Januari</option>
                                                        <option value="2" {{ ($data->bulan === 2) ? 'selected' : '' }}>Februari</option>
                                                        <option value="3" {{ ($data->bulan === 3) ? 'selected' : '' }}>Maret</option>
                                                        <option value="4" {{ ($data->bulan === 4) ? 'selected' : '' }}>April</option>
                                                        <option value="5" {{ ($data->bulan === 5) ? 'selected' : '' }}>Mei</option>
                                                        <option value="6" {{ ($data->bulan === 6) ? 'selected' : '' }}>Juni</option>
                                                        <option value="7" {{ ($data->bulan === 7) ? 'selected' : '' }}>Juli</option>
                                                        <option value="8" {{ ($data->bulan === 8) ? 'selected' : '' }}>Agustus</option>
                                                        <option value="9" {{ ($data->bulan === 9) ? 'selected' : '' }}>September</option>
                                                        <option value="10" {{ ($data->bulan === 10) ? 'selected' : '' }}>Oktober</option>
                                                        <option value="11" {{ ($data->bulan === 11) ? 'selected' : '' }}>November</option>
                                                        <option value="12" {{ ($data->bulan === 12) ? 'selected' : '' }}>Desember</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="proker">Program Kerja</label>
                                                    <input type="text" class="form-control form-control-user" id="proker" value="{{ $data->proker }}" name="proker" placeholder="Masukkan Program Kerja" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="sumber">Tanggal</label>
                                                    <input type="date" class="form-control form-control-user" id="tanggal" value="{{ $data->tanggal }}" name="tanggal" placeholder="Masukkan Tanggal" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="pemasukan">Nominal</label>
                                                    <input type="number" class="form-control form-control-user" id="pengeluaran" value="{{ $data->pengeluaran }}" name="pengeluaran" placeholder="Masukkan Nominal" required>
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
                                        <form action="/laporan-kreus/{{ $data->id }}" method="post">
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

<h2 class="h4 mb-3 text-gray-800">Rekapitulasi</h2>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="2">Total</th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->sum('pemasukan') }} )) </script></th>
                        <th style="text-align:right ;"><script> document.write(rp( {{ $laporan->sum('pengeluaran') }} )) </script></th>
                    </tr>
                    <tr>
                        <th colspan="2">Saldo</th>
                        <th colspan="2"><script> document.write(rp( {{ $laporan->sum('pemasukan') - $laporan->sum('pengeluaran') }} )) </script></th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach ($laporan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align:left ;">{{ $data->proker }} {{ ($data->keterangan != null) ? '- '.$data->keterangan : '' }}</td>
                            @if ($data->pemasukan)
                                <td style='text-align:right ;'><script> document.write(rp({{ $data->pemasukan }})) </script></td>
                                <td style='text-align:right ;'>-</td>
                            @else
                                <td style='text-align:right ;'>-</td>
                                <td style='text-align:right ;'><script> document.write(rp({{ $data->pengeluaran }})) </script></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- modal create-1 --}}
<div class="modal fade" id="create-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pemasukan Divisi Kreasi dan Usaha</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/laporan-kreus" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <input type="text" name="kategori" id="kategori" value="Pemasukan" hidden>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control form-control-user" id="proker" name="proker" placeholder="Masukkan Program Kerja" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="sumber">Sumber Dana</label>
                            <input type="text" class="form-control form-control-user" id="sumber" name="sumber" placeholder="Masukkan Sumber Dana" required>
                        </div>
                        <div class="col-sm-5">
                            <label for="pemasukan">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="pemasukan" name="pemasukan" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pj">Penanggung Jawab</label>
                        <select class="form-control form-control-user" name="pj" id="pj" required>
                            <option value="" selected hidden>Pilih</option>
                            @foreach ($pj as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
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

{{-- modal create-2 --}}
<div class="modal fade" id="create-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengeluaran Divisi Kreasi dan Usaha</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/laporan-kreus" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <input type="text" name="kategori" id="kategori" value="Pengeluaran Kreus" hidden>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control form-control-user" id="proker" name="proker" placeholder="Masukkan Program Kerja" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="sumber">Keterangan</label>
                            <input type="text" class="form-control form-control-user" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                        </div>
                        <div class="col-sm-5">
                            <label for="pemasukan">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="pengeluaran" name="pengeluaran" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pj">Penanggung Jawab</label>
                        <select class="form-control form-control-user" name="pj" id="pj" required>
                            <option value="" selected hidden>Pilih</option>
                            @foreach ($pj as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
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

{{-- modal create-3 --}}
<div class="modal fade" id="create-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengeluaran diluar Divisi Kreasi dan Usaha</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/laporan-kreus" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <input type="text" name="kategori" id="kategori" value="Pengeluaran diluar Kreus" hidden>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control form-control-user" id="proker" name="proker" placeholder="Masukkan Program Kerja" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="sumber">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="pemasukan">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="pengeluaran" name="pengeluaran" placeholder="Masukkan Nominal" required>
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